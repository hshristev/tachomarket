<?php
defined('admin') or exit;
// Default transaction values
$transaction = [
    'txn_id' => '',
    'payment_amount' => '',
    'payment_status' => '',
    'payer_email' => '',
    'first_name' => '',
    'last_name' => '',
    'account_id' => '',
    'payment_method' => '',
    'discount_code' => '',
    'address_street' => '',
    'address_city' => '',
    'address_state' => '',
    'address_zip' => '',
    'address_country' => '',
    'shipping_method' => '',
    'shipping_amount' => '',
    'created' => date('Y-m-d\TH:i')
];
// Retrieve the products from the database
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY id');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Retrieve the accounts from the database
$stmt = $pdo->prepare('SELECT * FROM accounts ORDER BY id');
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Use str_pad to pad the ID with leading zeros to a length of 5
$order_id = str_pad($id, 5, '0', STR_PAD_LEFT);
// Add transactions items to the database
function addOrderItems($pdo, $txn_id) {
    if (isset($_POST['item_id']) && is_array($_POST['item_id']) && count($_POST['item_id']) > 0) {
        // Iterate items
        $delete_list = [];
        for ($i = 0; $i < count($_POST['item_id']); $i++) {
            // If the item doesnt exist in the database
            if (!intval($_POST['item_id'][$i])) {
                // Insert new item
                $stmt = $pdo->prepare('INSERT INTO transactions_items (txn_id,item_id,item_price,item_quantity,item_options) VALUES (?,?,?,?,?)');
                $stmt->execute([ $txn_id, $_POST['item_product'][$i], $_POST['item_price'][$i], $_POST['item_quantity'][$i], $_POST['item_options'][$i] ]);
                $delete_list[] = $pdo->lastInsertId();
            } else {
                // Update existing item
                $stmt = $pdo->prepare('UPDATE transactions_items SET txn_id = ?, item_id = ?, item_price = ?, item_quantity = ?, item_options = ? WHERE id = ?');
                $stmt->execute([ $txn_id, $_POST['item_product'][$i], $_POST['item_price'][$i], $_POST['item_quantity'][$i], $_POST['item_options'][$i], $_POST['item_id'][$i] ]);    
                $delete_list[] = $_POST['item_id'][$i];          
            }
        }
        // Delete item
        $in  = str_repeat('?,', count($delete_list) - 1) . '?';
        $stmt = $pdo->prepare('DELETE FROM transactions_items WHERE txn_id = ? AND id NOT IN (' . $in . ')');
        $stmt->execute(array_merge([ $txn_id ], $delete_list));
    } else {
        // No item exists, delete all
        $stmt = $pdo->prepare('DELETE FROM transactions_items WHERE txn_id = ?');
        $stmt->execute([ $txn_id ]);       
    }
}
// Save captured data
if (isset($_GET['id'])) {
    // Retrieve the transaction from the database
    $stmt = $pdo->prepare('SELECT * FROM transactions WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

    // Save original status before update
    $original_status = $transaction['payment_status'];

    $original_tracking_no = $transaction['tracking_no'];

    // Retrieve the transaction items from the database
    $stmt = $pdo->prepare('SELECT * FROM transactions_items WHERE txn_id = ?');
    $stmt->execute([ $transaction['txn_id'] ]);
    $transactions_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ID param exists, edit an existing transaction
    $page = 'Edit';

    if (isset($_POST['submit'])) {
        $upload_dir = __DIR__ . '/uploads/'; // Directory to store uploaded files
    
        // Ensure the uploads directory exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
    
        // Handle the invoice file upload
        if (isset($_FILES['invoice']) && $_FILES['invoice']['error'] == 0) {
            $file_tmp = $_FILES['invoice']['tmp_name'];
            $file_name = basename($_FILES['invoice']['name']);
            $file_type = $_FILES['invoice']['type'];
    
            // Check if the uploaded file is a PDF
            if ($file_type == 'application/pdf') {
                // Move the file to the uploads directory
                $file_path = $upload_dir . $file_name;
    
                if (move_uploaded_file($file_tmp, $file_path)) {
                    // Send the invoice email with the uploaded PDF
                  
                    send_invoice_email($_POST['email'], $order_id, $file_path);
                } else {
                    echo "Failed to upload the invoice.";
                }
            } else {
                echo "Please upload a valid PDF file.";
            }
        } else {
            echo "Error uploading the invoice file.";
        }
    }
    

    if (isset($_POST['submit'])) {
        // Update the transaction
        $stmt = $pdo->prepare('UPDATE transactions SET txn_id = ?, payment_amount = ?, payment_status = ?, created = ?, payer_email = ?, first_name = ?, last_name = ?, address_street = ?, address_city = ?, address_state = ?, address_zip = ?, address_country = ?, account_id = ?, payment_method = ?, discount_code = ?, shipping_method = ?, shipping_amount = ?, company = ?, mol=?,address_company=?,dds=?,eik=?, speedy = ?,tracking_no =? WHERE id = ?');
        $stmt->execute([ $_POST['txn_id'], $_POST['amount'], $_POST['status'], date('Y-m-d H:i:s', strtotime($_POST['created'])), $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['address_street'], $_POST['address_city'], $_POST['address_state'], $_POST['address_zip'], $_POST['address_country'], empty($_POST['account']) ? NULL : $_POST['account'], $_POST['method'], $_POST['discount_code'], $_POST['shipping_method'], $_POST['shipping_amount'],$_POST['company'],$_POST['mol'],$_POST['address_company'],$_POST['dds'],$_POST['eik'],$_POST['speedy'],$_POST['tracking_no'], $_GET['id'] ]);
        
        // Add/Update/Delete order items
        addOrderItems($pdo, $_POST['txn_id']);
        
        // Check if the status has changed
        if ($original_status !== $_POST['status']) {
            // Send email notification on status change
            send_status_change_email(
                $_POST['email'], 
                $order_id, 
                $_POST['status'], 
                'support@example.com'  // Contact email
            );
        }


        if ($original_tracking_no !== $_POST['tracking_no']) {
            // Send email notification on status change
            send_tracking_no_email(
                $_POST['email'], 
                $order_id, 
                $_POST['tracking_no'], 
                'support@example.com'  // Contact email
            );
        }
        

        // Redirect after successful update
        header('Location: index.php?page=orders&success_msg=2');
        exit;
    }

    // Handle order deletion if needed
    if (isset($_POST['delete'])) {
        header('Location: index.php?page=orders&delete='.$_GET['id']);
        exit;
    }
}
 else {
    // Create a new transaction
    $page = 'Create';
    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT INTO transactions (txn_id,payment_amount,payment_status,created,payer_email,first_name,last_name,address_street,address_city,address_state,address_zip,address_country,account_id,payment_method,discount_code,shipping_method,shipping_amount) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->execute([ $_POST['txn_id'], $_POST['amount'], $_POST['status'], date('Y-m-d H:i:s', strtotime($_POST['created'])), $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['address_street'], $_POST['address_city'], $_POST['address_state'], $_POST['address_zip'], $_POST['address_country'], empty($_POST['account']) ? NULL : $_POST['account'], $_POST['method'], $_POST['discount_code'], $_POST['shipping_method'], $_POST['shipping_amount'] ]);
        addOrderItems($pdo, $_POST['txn_id']);
        header('Location: index.php?page=orders&success_msg=1');
        exit;
    }
}
?>
<?=template_admin_header($page . ' Order', 'orders', 'manage')?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="content-title">
        <h2><?=$page?> Order</h2>
        <a href="index.php?page=orders" class="btn alt mar-right-2">Cancel</a>
        <?php if ($page == 'Edit'): ?>
        <input type="submit" name="delete" value="Delete" class="btn red mar-right-2" onclick="return confirm('Are you sure you want to delete this order?')">
        <?php endif; ?>
        <input type="submit" name="submit" value="Save" class="btn">
    </div>

    <div class="tabs">
        <a href="#" class="active">Данни на поръчка </a>
        <a href="#">Данни за фактуриране  </a>
        <a href="#">Продукти</a>
    </div>

    <div class="content-block tab-content active">

        <div class="form responsive-width-100">

            <label for="txn_id"><span class="required">*</span> Transaction ID</label>
            <input id="txn_id" type="text" name="txn_id" placeholder="Transaction ID" value="<?=$transaction['txn_id']?>" required>

            <label for="status"><span class="required">*</span> Status</label>
            <select id="status" name="status" required>
                <option value="В изчакване"<?=$transaction['payment_status']=='В изчакване'?' selected':''?>>В изчакване</option>
                <option value="Подготвена"<?=$transaction['payment_status']=='Подготвена'?' selected':''?>>Подготвена</option>
                <option value="Изпратена"<?=$transaction['payment_status']=='Изпратена'?' selected':''?>>Изпратена</option>
                <option value="Приключена"<?=$transaction['payment_status']=='Приключена'?' selected':''?>>Приключена</option>
                <option value="Отказана"<?=$transaction['payment_status']=='Отказана'?' selected':''?>>Отказана</option>    
            </select>

            <label for="amount"><span class="required">*</span> Payment Amount</label>
            <input id="amount" type="number" name="amount" placeholder="0.00" value="<?=$transaction['payment_amount']?>" step=".01" required>

            <label for="email"><span class="required">*</span> Customer Email</label>
            <input id="email" type="email" name="email" placeholder="joebloggs@example.com" value="<?=htmlspecialchars($transaction['payer_email'], ENT_QUOTES)?>" required>

            <label for="account">Account</label>
            <select id="account" name="account">
                <option value=""<?=$transaction['account_id']==NULL?' selected':''?>>(none)</option>
                <?php foreach ($accounts as $account): ?>
                <option value="<?=$account['id']?>"<?=$account['id']==$transaction['account_id']?' selected':''?>><?=$account['id']?> - <?=htmlspecialchars($account['email'], ENT_QUOTES)?></option>
                <?php endforeach; ?>
            </select>

            <label for="first_name">First Name</label>
            <input id="first_name" type="text" name="first_name"  value="<?=htmlspecialchars($transaction['first_name'], ENT_QUOTES)?>">

            <label for="last_name">Last Name</label>
            <input id="last_name" type="text" name="last_name"  value="<?=htmlspecialchars($transaction['last_name'], ENT_QUOTES)?>">

            <label for="address_street">Адрес</label>
            <input id="address_street" type="text" name="address_street"  value="<?=htmlspecialchars($transaction['address_street'], ENT_QUOTES)?>">


                        <label for="speedy">Тип доставка</label>
<select id="speedy" name="speedy">
    <option value="ofis" <?= $transaction['speedy'] == 'ofis' ? 'selected' : '' ?>>
        Доставка до офис/автомат на Спиди
    </option>
    <option value="vrata" <?= $transaction['speedy'] == 'vrata' ? 'selected' : '' ?>>
        Доставка до адрес със Спиди
    </option>
</select>


<label for="tracking_no">Товарителница</label>
            <input id="tracking_no" type="text" name="tracking_no"  value="<?=htmlspecialchars($transaction['tracking_no'], ENT_QUOTES)?>">

            <label for="method">Начин на плащане</label>
<select id="method" name="method">
    <option value="Наложен платеж" <?= $transaction['payment_method'] == 'Наложен платеж' ? 'selected' : '' ?>>
        Наложен платеж
    </option>
    <option value="Банков превод" <?= $transaction['payment_method'] == 'Банков превод' ? 'selected' : '' ?>>
        Банков превод
    </option>
</select>


            <!-- Hidden shipping method -->
<input type="hidden" id="shipping_method" name="shipping_method" value="<?= htmlspecialchars($transaction['shipping_method'], ENT_QUOTES) ?>">

<!-- Hidden shipping amount -->
<input type="hidden" id="shipping_amount" name="shipping_amount" value="<?= htmlspecialchars($transaction['shipping_amount'], ENT_QUOTES) ?>">

<!-- Hidden discount code -->
<input type="hidden" id="discount_code" name="discount_code" value="<?= htmlspecialchars($transaction['discount_code'], ENT_QUOTES) ?>">


            <label for="created"><span class="required">*</span> Date</label>
            <input id="created" type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($transaction['created']))?>" required>

            <!-- Invoice Upload Section -->
<div class="invoice-upload-container">
    <label for="invoice">Upload Invoice (PDF)</label>
    <div class="file-upload-wrapper">
        <!-- PDF Upload Input -->
        <input id="invoice" type="file" name="invoice" accept="application/pdf">
        <!-- Send Invoice Button -->
 
    </div>
</div>


        </div>

    </div>

    <div class="content-block tab-content">

        <div class="form responsive-width-100">



            <label for="company">Име на фирма</label>
            <input id="company" type="text" name="company"  value="<?=htmlspecialchars($transaction['company'], ENT_QUOTES)?>">

            <label for="mol">МОЛ</label>
            <input id="mol" type="text" name="mol"  value="<?=htmlspecialchars($transaction['mol'], ENT_QUOTES)?>">

            <label for="address_company">Адрес</label>
            <input id="address_company" type="text" name="address_company"  value="<?=htmlspecialchars($transaction['address_company'], ENT_QUOTES)?>">

            <label for="dds">ДДС номер</label>
            <input id="dds" type="text" name="dds"  value="<?=htmlspecialchars($transaction['dds'], ENT_QUOTES)?>">

            <label for="eik">ЕИК номер</label>
            <input id="eik" type="text" name="eik"  value="<?=htmlspecialchars($transaction['eik'], ENT_QUOTES)?>">

        </div>

    </div>

    <div class="content-block tab-content">
        <div class="table manage-order-table">
            <table>
                <thead>
                    <tr>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Options</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transactions_items)): ?>
                    <tr>
                        <td colspan="20" class="no-order-items-msg no-results">There are no order items.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($transactions_items as $item): ?>
                    <tr>
                        <td>
                            <input type="hidden" name="item_id[]" value="<?=$item['id']?>">
                            <select name="item_product[]">
                                <?php foreach ($products as $product): ?>
                                <option value="<?=$product['id']?>"<?=$item['item_id']==$product['id']?' selected':''?>><?=$product['id']?> - <?=htmlspecialchars($product['title'], ENT_QUOTES)?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input name="item_price[]" type="number" placeholder="Price" value="<?=$item['item_price']?>" step=".01"></td>
                        <td><input name="item_quantity[]" type="number" placeholder="Quantity" value="<?=$item['item_quantity']?>"></td>
                        <td><input name="item_options[]" type="text" placeholder="Options" value="<?=htmlspecialchars($item['item_options'], ENT_QUOTES)?>"></td>
                        <td><svg class="delete-item" width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>close</title><path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" /></svg></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <a href="#" class="add-item"><svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>Add Item</a>
        </div>
    </div>

</form>

<?=template_admin_footer('initManageOrder(' . json_encode($products) . ')')?>