<?php
defined('admin') or exit;
if (!isset($_GET['id'])) {
    exit('Invalid ID!');
}
// Retrieve order items
$stmt = $pdo->prepare('SELECT ti.*, p.title FROM transactions t JOIN transactions_items ti ON ti.txn_id = t.txn_id LEFT JOIN products p ON p.id = ti.item_id WHERE t.id = ?');
$stmt->execute([ $_GET['id'] ]);
$order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Retrieve order details
$stmt = $pdo->prepare('SELECT a.email, a.id AS a_id, a.first_name AS a_first_name, a.last_name AS a_last_name, a.address_street AS a_address_street, a.address_city AS a_address_city, a.address_state AS a_address_state, a.address_zip AS a_address_zip, a.address_country AS a_address_country, t.* FROM transactions t LEFT JOIN transactions_items ti ON ti.txn_id = t.txn_id LEFT JOIN accounts a ON a.id = t.account_id WHERE t.id = ?');
$stmt->execute([ $_GET['id'] ]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);
// Delete transaction
if (isset($_GET['delete'])) {
    // Delete the transaction
    $stmt = $pdo->prepare('DELETE t, ti FROM transactions t LEFT JOIN transactions_items ti ON ti.txn_id = t.txn_id WHERE t.id = ?');
    $stmt->execute([ $_GET['id'] ]);
    header('Location: index.php?page=orders&success_msg=3');
    exit;
}
if (!$order) {
    exit('Invalid ID!');
}
$_GET['id'] = sprintf('%05d', $_GET['id']);
$order['id'] = sprintf('%05d', $order['id']);
?>
<?=template_admin_header('Orders', 'orders')?>

<div class="content-title responsive-flex-wrap responsive-pad-bot-3">
    <h2 class="responsive-width-100">Поръчка # <?=$_GET['id']?></h2>
    <a href="index.php?page=orders" class="btn alt mar-right-2">Cancel</a>
    <a href="index.php?page=order&id=<?=$_GET['id']?>&delete=true" class="btn red mar-right-2" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
    <a href="index.php?page=order_manage&id=<?=$_GET['id']?>" class="btn">Edit</a>
</div>

<div class="content-block-wrapper">
    <div class="content-block order-details">
        <div class="block-header">
            <div class="icon">
                <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            </div>
            Данни на поръчка
        </div>
        <div class="order-detail">
            <h3>Номер на поръчка</h3>
            <p># <?=$order['id']?></p>
        </div>
        <!-- <div class="order-detail">
            <h3>Transaction ID</h3>
            <p><?=$order['txn_id']?></p>
        </div> -->
        <?php if ($order['shipping_method']): ?>
        <div class="order-detail">
            <h3>Shipping Method</h3>
            <p><?=$order['shipping_method'] ? htmlspecialchars($order['shipping_method'], ENT_QUOTES) : '--'?></p>
        </div>
        <?php endif; ?>
                <div class="order-detail">
    <h3>Тип доставка</h3>
    <p>
        <?php
        if ($order['speedy'] === 'ofis') {
            echo 'Доставка до офис/автомат на Спиди';
        } elseif ($order['speedy'] === 'vrata') {
            echo 'Доставка до адрес със Спиди';
        }
        ?>
    </p>
</div>

        <div class="order-detail">
            <h3>Адрес на доставка</h3>
            <p style="text-align:right;"><?=htmlspecialchars($order['address_street'], ENT_QUOTES)?><br>    
            </p>
        </div>
        <div class="order-detail">
            <h3>Метод на плащане</h3>
            <p><?=$order['payment_method']?></p>
        </div>
        <div class="order-detail">
            <h3>Статус</h3>
            <p><?=$order['payment_status']?></p>
        </div>
        <div class="order-detail">
            <h3>Дата</h3>
            <p><?=date('F j, Y H:ia', strtotime($order['created']))?></p>
        </div>
        <?php if ($order['discount_code']): ?>
        <div class="order-detail">
            <h3>Discount Code</h3>
            <p><?=htmlspecialchars($order['discount_code'], ENT_QUOTES)?></p>
        </div>
        <?php endif; ?>
    </div>

    <div class="content-block order-details">
        <div class="block-header">
            <div class="icon">
                <svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" /></svg>
            </div>
            Данни на потребител
        </div>
        <?php if ($order['email']): ?>
        <div class="order-detail">
            <h3>Имейл</h3>
            <p><a href="index.php?page=account&id=<?=$order['a_id']?>" target="_blank" class="link1" style="margin:0"><?=htmlspecialchars($order['email'], ENT_QUOTES)?></a></p>
        </div>
        <div class="order-detail">
            <h3>Име</h3>
            <p><?=htmlspecialchars($order['a_first_name'], ENT_QUOTES)?> <?=htmlspecialchars($order['a_last_name'], ENT_QUOTES)?></p>
        </div>
        <div class="order-detail">
            <h3>Телефонен номер</h3>
            <p><?=htmlspecialchars($order['tel'], ENT_QUOTES)?></p>
        </div>

        <?php else: ?>
        <p>The order is not associated with an account.</p>
        <?php endif; ?>
    </div>

    <div class="content-block order-details">
        <div class="block-header">
        <div class="icon">
    <svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M19 2H8C6.9 2 6 2.9 6 4V20C6 21.1 6.9 22 8 22H19C20.1 22 21 21.1 21 20V4C21 2.9 20.1 2 19 2M19 20H8V4H19V20M10 6H17V8H10V6M10 10H17V12H10V10M10 14H17V16H10V14Z" />
    </svg>
</div>

            Данни за фактуриране
        </div>
        <div class="order-detail">
            <h3>Име на фирма</h3>
            <p><?=htmlspecialchars($order['company'], ENT_QUOTES)?></p>
        </div>
        <div class="order-detail">
            <h3>МОЛ</h3>
            <p><?=htmlspecialchars($order['mol'], ENT_QUOTES)?></p>
        </div>

        <div class="order-detail">
            <h3>Адрес</h3>
            <p><?=htmlspecialchars($order['address_company'], ENT_QUOTES)?></p>
        </div>
        <div class="order-detail">
            <h3>ДДС номер</h3>
            <p><?=htmlspecialchars($order['dds'], ENT_QUOTES)?></p>
        </div>
        <div class="order-detail">
            <h3>ЕИК номер</h3>
            <p><?=htmlspecialchars($order['eik'], ENT_QUOTES)?></p>
        </div>
        
    </div>
</div>

<div class="content-block">
    <div class="block-header">
        <div class="icon">
            <svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" /></svg>
        </div>
        Order
    </div>
    <div class="table order-table">
        <table>
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Options</td>
                    <td>Qty</td>
                    <td class="responsive-hidden">Price</td>
                    <td style="text-align:right;">Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($order_items)): ?>
                <tr>
                    <td colspan="20" class="no-results">There are no order items.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?=$item['title'] ? htmlspecialchars($item['title'], ENT_QUOTES) : '(Product ' . $item['item_id'] . ')'?></td>
                    <td><?=$item['item_options'] ? htmlspecialchars(str_replace(',', ', ', $item['item_options']), ENT_QUOTES) : '--'?></td>
                    <td><?=$item['item_quantity']?></td>
                    <td class="responsive-hidden"><?=number_format($item['item_price'], 2)?> <?=currency_code?></td>
                    <td style="text-align:right;"><?=number_format($item['item_price']*$item['item_quantity'], 2)?> <?=currency_code?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td colspan="5" class="item-list-end"></td>
                </tr>

               

                <tr>
                    <td colspan="4" class="subtotal">Стойност:</td>
                    <td class="num"><?=number_format($order['payment_amount']/1.2/0.9, 2)?> <?=currency_code?> / <?=number_format($order['payment_amount']/1.2/0.9/1.95583, 2)?> €</td>
                </tr>

                <tr>
                    <td colspan="4" class="subtotal">Отстъпка 10%:</td>
                    <td class="num">-<?=number_format($order['payment_amount']/1.2/0.9*0.1, 2)?> <?=currency_code?> / -<?=number_format($order['payment_amount']/1.2/0.9*0.1/1.95583, 2)?> €</td>
                </tr>

                <tr>
                    <td colspan="4" class="subtotal">Нето:</td>
                    <td class="num"><?=number_format($order['payment_amount']/1.2, 2)?> <?=currency_code?> / <?=number_format($order['payment_amount']/1.2/1.95583, 2)?> €</td>
                </tr>

                <tr>
                    <td colspan="4" class="subtotal">ДДС:</td>
                    <td class="num"><?=number_format(($order['payment_amount']/1.2)* 0.2, 2)?> <?=currency_code?> / <?=number_format(($order['payment_amount']/1.2)* 0.2/1.95583, 2)?> €</td>
                </tr>

                <tr>
                    <td colspan="4" class="total"><b>Общо:</b></td>
                    <td class="num"><b><?=number_format($order['payment_amount'], 2)?> <?=currency_code?> / <?=number_format($order['payment_amount']/1.95583, 2)?> €</b></td>
                </tr>
                    
            </tbody>
        </table>
    </div>
</div>

<?=template_admin_footer()?>