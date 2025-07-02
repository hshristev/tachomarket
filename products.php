<?php
// Prevent direct access to file
defined('shoppingcart') or exit;
// Get all the categories from the database
$stmt = $pdo->query('SELECT * FROM categories');
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Execute query to retrieve product options and group by the title
$stmt = $pdo->query('SELECT option_name, option_value FROM products_options WHERE option_type = "select" OR option_type = "radio" OR option_type = "checkbox" GROUP BY option_name, option_value ORDER BY option_name, option_value ASC');
$stmt->execute();
$product_options = $stmt->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
// Get the current category from the GET request, if none exists set the default selected category to: all
$category_list = isset($_GET['category']) && $_GET['category'] ? $_GET['category'] : [];
$category_list = is_array($category_list) ? $category_list : [$category_list];
$selectedCategories = $category_list;

$availability_list = isset($_GET['availability']) && $_GET['availability'] ? $_GET['availability'] : [];
$availability_list = is_array($availability_list) ? $availability_list : [$availability_list];
$selectedAvailability = $availability_list;

$category_sql = ''; // гарантираме, че променливата съществува

if ($category_list) {
    $category_sql = 'JOIN products_categories pc ON FIND_IN_SET(pc.category_id, :category_list) AND pc.product_id = p.id JOIN categories c ON c.id = pc.category_id';
}
// Get the options from the GET request, if none exists set the default selected options to: all
$options_list = isset($_GET['option']) && $_GET['option'] ? $_GET['option'] : [];
$options_list = is_array($options_list) ? $options_list : [$options_list];
$options_sql = '';
if ($options_list) {
    $options_sql = 'JOIN products_options po ON po.product_id = p.id AND FIND_IN_SET(CONCAT(po.option_name, "-", po.option_value), :option_list)';
}
// Availability options
$availability_list = isset($_GET['availability']) && $_GET['availability'] ? $_GET['availability'] : [];
$availability_list = is_array($availability_list) ? $availability_list : [$availability_list];
$availability_sql = '';
if ($availability_list) {
    $availability_sql = 'AND (p.quantity > 0 OR p.quantity = -1)';
    if (in_array('out-of-stock', $availability_list)) {
        $availability_sql = 'AND p.quantity = 0';
    }
}
// Get price min
$price_min = isset($_GET['price_min']) && is_numeric($_GET['price_min']) ? $_GET['price_min'] : '';
// Get price max
$price_max = isset($_GET['price_max']) && is_numeric($_GET['price_max']) ? $_GET['price_max'] : '';
$price_sql = '';
// If the price min is set, add the WHERE clause to the SQL query
if ($price_min) {
    $price_sql .= ' AND p.price >= :price_min ';
}
// If the price max is set, add the WHERE clause to the SQL query
if ($price_max) {
    $price_sql .= ' AND p.price <= :price_max ';
}
// Get the sort from GET request, will occur if the user changes an item in the select box
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
// The amounts of products to show on each page
$num_products_on_each_page = 12;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Order by statement
$order_by = '';
// Select products ordered by the date added
if ($sort == 'a-z') {
    // sort1 = Alphabetical A-Z
    $order_by = 'ORDER BY p.title ASC';
} elseif ($sort == 'z-a') {
    // sort2 = Alphabetical Z-A
    $order_by = 'ORDER BY p.title DESC';
} elseif ($sort == 'newest') {
    // sort3 = Newest
    $order_by = 'ORDER BY p.created DESC';
} elseif ($sort == 'oldest') {
    // sort4 = Oldest
    $order_by = 'ORDER BY p.created ASC';
} elseif ($sort == 'highest') {
    // sort5 = Highest Price
    $order_by = 'ORDER BY p.price DESC';
} elseif ($sort == 'lowest') {
    // sort6 = Lowest Price
    $order_by = 'ORDER BY p.price ASC';
} elseif ($sort == 'popular') {
    // sort7 = Most Popular
    $order_by = 'ORDER BY (SELECT COUNT(*) FROM transactions_items ti WHERE ti.item_id = p.id) DESC';
}
$stmt = $pdo->prepare('SELECT p.*, (SELECT m.full_path FROM products_media pm JOIN media m ON m.id = pm.media_id WHERE pm.product_id = p.id ORDER BY pm.position ASC LIMIT 1) AS img FROM products p ' . $category_sql . ' ' . $options_sql . ' WHERE p.product_status = 1 ' . $price_sql . ' ' . $availability_sql . ' GROUP BY p.id, p.title, p.description, p.price, p.rrp, p.quantity, p.created, p.weight, p.url_slug, p.product_status, p.sku, p.subscription, p.subscription_period, p.subscription_period_type ' . $order_by . ' LIMIT :page,:num_products');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
if ($category_list) {
    $stmt->bindValue(':category_list', implode(',', $category_list), PDO::PARAM_STR);
}
if ($options_list) {
    $stmt->bindValue(':option_list', implode(',', $options_list), PDO::PARAM_STR);
}
if ($price_min) {
    $stmt->bindValue(':price_min', $price_min, PDO::PARAM_STR);
}
if ($price_max) {
    $stmt->bindValue(':price_max', $price_max, PDO::PARAM_STR);
}
$stmt->bindValue(':page', ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(':num_products', $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$stmt = $pdo->prepare('SELECT COUNT(*) FROM (SELECT p.id FROM products p ' . $category_sql . ' ' . $options_sql . ' WHERE p.product_status = 1  ' . $price_sql . ' ' . $availability_sql . ' GROUP BY p.id) q');
if ($category_list) {
    $stmt->bindValue(':category_list', implode(',', $category_list), PDO::PARAM_STR);
}
if ($options_list) {
    $stmt->bindValue(':option_list', implode(',', $options_list), PDO::PARAM_STR);
}
if ($price_min) {
    $stmt->bindValue(':price_min', $price_min, PDO::PARAM_STR);
}
if ($price_max) {
    $stmt->bindValue(':price_max', $price_max, PDO::PARAM_STR);
}
$stmt->execute();
$total_products = $stmt->fetchColumn();
?>
<?=template_header('Products')?>




<style>::after.custom-category-list {
    list-style: none;
    padding-left: 0;
    margin: 0;
}

.category-item {
    border-bottom: 1px solid #eee;
    padding: 10px 0;
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    cursor: pointer;
}

.category-header label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: normal;
}

.toggle-subcategories {
    background: none;
    border: none;
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
    color: #333;
}

.subcategories {
    display: none;
    padding-top: 5px;
}

.category-item.expanded > .subcategories {
    display: block;
}

.products-container {
  display: flex;
  gap: 2rem;
  margin-top: 20px;
}

.products-filters {
  width: 250px;
  flex-shrink: 0;
  border-right: 1px solid #eee;
  padding-right: 1rem;
}

.products-view {
  flex-grow: 1;
}

.products-filter {
  margin-bottom: 20px;
}

.filter-title {
  font-weight: bold;
  display: block;
  margin-bottom: 0.5rem;
}

.checkbox-list label {
  display: block;
  margin-bottom: 5px;
}

.price-range input {
  width: 80px;
  margin-right: 5px;
}


</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-subcategories').forEach(button => {
        button.addEventListener('click', function () {
            const item = this.closest('.category-item');
            item.classList.toggle('expanded');
            this.textContent = item.classList.contains('expanded') ? '−' : '+';
        });
    });
});
</script>


<div class="products content-wrapper">
  <h1 class="page-title">Продукти</h1>

  <form action="<?=url('index.php?page=products')?>" method="get" class="products-form form">

    <?php if (!rewrite_url): ?>
      <input type="hidden" name="page" value="products">
    <?php endif; ?>

    <div class="products-container">
      <!-- ФИЛТРИ (лява колона) -->
      <aside class="products-filters">
        <form method="get" id="filtersForm">
          <!-- Категории -->
          <?php if (!empty($categories)): ?>
            <div class="products-filter categories-filter">
              <span class="filter-title">Категории</span>
              <div class="filter-options checkbox-list">
                <?= populate_categories_checkboxes($categories, $selectedCategories) ?>
              </div>
            </div>
          <?php endif; ?>

          <!-- Наличност -->
          <div class="products-filter availability-filter">
            <span class="filter-title">Наличност</span>
            <div class="filter-options checkbox-list">
              <label><input type="checkbox" name="availability[]" value="in-stock" <?= in_array('in-stock', $selectedAvailability) ? 'checked' : '' ?>> В наличност</label>
              <label><input type="checkbox" name="availability[]" value="out-of-stock" <?= in_array('out-of-stock', $selectedAvailability) ? 'checked' : '' ?>> Изчерпано</label>
            </div>
          </div>

          <!-- Цена -->
          <div class="products-filter">
            <span class="filter-title">Цена</span>
            <div class="filter-options price-range">
              <input type="number" step=".01" min="0" name="price_min" placeholder="Мин." value="<?=htmlspecialchars($price_min, ENT_QUOTES)?>">
              <span>до</span>
              <input type="number" step=".01" min="0" name="price_max" placeholder="Макс." value="<?=htmlspecialchars($price_max, ENT_QUOTES)?>">
            </div>
          </div>

          <button type="submit" class="btn-apply-filters">Приложи филтри</button>
        </form>
      </aside>

      <!-- ПРОДУКТИ (дясна колона) -->
      <section class="products-view">
        <div class="products-header">
          <p><?=$total_products?> Продукт<?=$total_products!=1?'а':''?></p>
          <div class="products-form form">
            <label class="sortby form-select" for="sort">
              Сортирай по:
              <select name="sort" id="sort">
                <option value="newest"<?=($sort == 'newest' ? ' selected' : '')?>>Нов → стар</option>
                <option value="oldest"<?=($sort == 'oldest' ? ' selected' : '')?>>Стар → нов</option>
                <option value="highest"<?=($sort == 'highest' ? ' selected' : '')?>>Цена ↓</option>
                <option value="lowest"<?=($sort == 'lowest' ? ' selected' : '')?>>Цена ↑</option>
                <option value="popular"<?=($sort == 'popular' ? ' selected' : '')?>>Популярни</option>
              </select>
            </label>
          </div>
        </div>

        <div class="products-wrapper">
          <?php foreach ($products as $product): ?>
            <a href="<?=url('index.php?page=product&id=' . ($product['url_slug'] ? $product['url_slug']  : $product['id']))?>" class="product<?=$product['quantity']==0?' no-stock':''?>">
              <?php if (!empty($product['img']) && file_exists($product['img'])): ?>
                <div class="img">
                  <img src="<?=base_url?><?=$product['img']?>" width="180" height="180" alt="<?=$product['title']?>">
                </div>
              <?php endif; ?>
              <span class="name"><?=$product['title']?></span>
              <?php if (isset($_SESSION['account_role']) && in_array($_SESSION['account_role'], ['Workshop', 'Admin'])): ?>
                <span class="price"><?=number_format($product['price'],2)?> <?=currency_code?> / <?=number_format($product['price']/1.95583,2)?> €</span>
                <?php if ($product['rrp'] > 0): ?>
                  <span class="rrp"><?=number_format($product['rrp'],2)?> <?=currency_code?></span>
                <?php endif; ?>
              <?php endif; ?>
            </a>
          <?php endforeach; ?>
        </div>

        <!-- ПАГИНАЦИЯ -->
        <div class="buttons">
          <?php if ($current_page > 1): ?>
            <?php $_GET['p'] = $current_page-1; $query = http_build_query($_GET); ?>
            <a href="?<?=$query?>" class="btn">Предишна стр.</a>
          <?php endif; ?>
          <?php if ($total_products > (($current_page+1) * $num_products_on_each_page) - $num_products_on_each_page): ?>
            <?php $_GET['p'] = $current_page+1; $query = http_build_query($_GET); ?>
            <a href="?<?=$query?>" class="btn">Следваща стр.</a>
          <?php endif; ?>
        </div>
      </section>
    </div> <!-- /products-container -->
  </form>
</div>


<?=template_footer()?>