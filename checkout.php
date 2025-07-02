<?php
// Prevent direct access to file
defined('shoppingcart') or exit;
// Default values for the input form elements
$account = [
    'first_name' => '',
    'last_name' => '',
    'address_street' => '',
    'address_city' => 'test',
    'address_state' => 'test',
    'address_zip' => '12345',
    'address_company' => '',
    'speedy' => '',
    'role' => 'Member'
];
// Error array - output errors on the form
$errors = [];
// Redirect the user if the shopping cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: ' . url('index.php?page=cart'));
    exit;
}
// Check if user is logged in
if (isset($_SESSION['account_loggedin'])) {
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([ $_SESSION['account_id'] ]);
    // Fetch the account from the database and return the result as an Array
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
}
// Update discount code
if (isset($_POST['discount_code']) && !empty($_POST['discount_code'])) {
    $_SESSION['discount'] = $_POST['discount_code'];
} else if (isset($_POST['discount_code'], $_SESSION['discount']) && empty($_POST['discount_code'])) {
    unset($_SESSION['discount']);
}
// Variables
$products_in_cart = $_SESSION['cart'];
$subtotal = 0.00;
$shipping_total = 0.00;
$discount = null;
$discount_total = 0.00;
$tax_total = 0.00;
$weight_total = 0;
$selected_country = isset($_POST['address_country']) ? $_POST['address_country'] : $account['address_country'];
$selected_shipping_method = isset($_POST['shipping_method']) ? $_POST['shipping_method'] : null;
$selected_shipping_method_name = '';
$shipping_methods_available = [];




$_POST['address_city'] = "";
$_POST['address_state'] = "";
$_POST['address_zip'] = "";
$_POST['address_country'] = "";







// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include: IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT p.*, (SELECT m.full_path FROM products_media pm JOIN media m ON m.id = pm.media_id WHERE pm.product_id = p.id ORDER BY pm.position ASC LIMIT 1) AS img, (SELECT GROUP_CONCAT(pc.category_id) FROM products_categories pc WHERE pc.product_id = p.id) AS categories FROM products p WHERE p.id IN (' . $array_to_question_marks . ')');
    // We use the array_column to retrieve only the id's of the products
    $stmt->execute(array_column($products_in_cart, 'id'));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Retrieve the discount code
    if (isset($_SESSION['discount'])) {
        $stmt = $pdo->prepare('SELECT * FROM discounts WHERE discount_code = ?');
        $stmt->execute([ $_SESSION['discount'] ]);
        $discount = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Get tax
    $stmt = $pdo->prepare('SELECT * FROM taxes WHERE country = ?');
    $stmt->execute([ isset($_POST['address_country']) ? $_POST['address_country'] : $account['address_country'] ]);
    $tax = $stmt->fetch(PDO::FETCH_ASSOC);
    $tax_rate = $tax ? $tax['rate'] : 0.00;
    // Get the current date
    $current_date = strtotime((new DateTime())->format('Y-m-d H:i:s'));
    // Retrieve shipping methods
    $shipping_methods = $pdo->query('SELECT * FROM shipping')->fetchAll(PDO::FETCH_ASSOC);
    // Iterate the products in cart and add the meta data (product name, desc, etc)
    foreach ($products_in_cart as &$cart_product) {
        foreach ($products as $product) {
            if ($cart_product['id'] == $product['id']) {
                // If product no longer in stock, prepare for removal
                if ((int)$product['quantity'] === 0) {
                    $cart_product['remove'] = 1;
                } else {
                    $cart_product['meta'] = $product;
                    // Prevent the cart quantity exceeding the product quantity
                    $cart_product['quantity'] = (int)$cart_product['quantity'] > (int)$product['quantity'] && (int)$product['quantity'] !== -1 ? (int)$product['quantity'] : (int)$cart_product['quantity'];
                    // Calculate the weight
                    $weight_total += (float)$cart_product['options_weight'] * $cart_product['quantity'];
                    // Calculate the subtotal
                    $product_price = (float)$cart_product['options_price'];
                    $subtotal += $product_price * $cart_product['quantity'];
                    // Calculate the final price, which includes tax
                    $cart_product['final_price'] = $product_price + round(($tax_rate / 100) * $product_price, 2);
                    $tax_total += round(($tax_rate / 100) * $product_price, 2) * (int)$cart_product['quantity'];
                    // Check which products are eligible for a discount
                    if ($discount && $current_date >= strtotime($discount['start_date']) && $current_date <= strtotime($discount['end_date'])) {
                        // Check whether product list is empty or if product id is whitelisted
                        if (empty($discount['product_ids']) || in_array($product['id'], explode(',', $discount['product_ids']))) {
                            // Check whether category list is empty or if category id is whitelisted
                            if (empty($discount['category_ids']) || array_intersect(explode(',', $product['categories']), explode(',', $discount['category_ids']))) {
                                $cart_product['discounted'] = true;
                            }
                        }
                    }
                }
            }
        }
    }
    // Remove products that are out of stock
    for ($i = 0; $i < count($products_in_cart); $i++) {
        if (isset($products_in_cart[$i]['remove'])) {
            unset($_SESSION['cart'][$i]);
            unset($products_in_cart[$i]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    $products_in_cart = array_values($products_in_cart);
    // Redirect the user if the shopping cart is empty
    if (empty($products_in_cart)) {
        header('Location: ' . url('index.php?page=cart'));
        exit;
    }
    // Calculate the shipping
    foreach ($products_in_cart as &$cart_product) {
        foreach ($shipping_methods as $shipping_method) {
            // Product weight
            $product_weight = $cart_product['options_weight'] && $shipping_method['shipping_type'] == 'Single Product' ? $cart_product['options_weight'] : $weight_total;
            // Determine the price
            $product_price = $shipping_method['shipping_type'] == 'Single Product' ? (float)$cart_product['options_price'] : $subtotal;
            // Check if no country required or if shipping method only available in specified countries
            if (empty($shipping_method['countries']) || in_array($selected_country, explode(',', $shipping_method['countries']))) {
                // Compare the price and weight to meet shipping method requirements
                if ($shipping_method['id'] == $selected_shipping_method && $product_price >= $shipping_method['price_from'] && $product_price <= $shipping_method['price_to'] && $product_weight >= $shipping_method['weight_from'] && $product_weight <= $shipping_method['weight_to']) {
                    if ($shipping_method['shipping_type'] == 'Single Product') {
                        // Calculate single product price
                        $cart_product['shipping_price'] += (float)$shipping_method['price'] * (int)$cart_product['quantity'];
                        $shipping_total += $cart_product['shipping_price'];
                    } else {
                        // Calculate entire order price
                        $cart_product['shipping_price'] = (float)$shipping_method['price'] / count($products_in_cart);
                        $shipping_total = (float)$shipping_method['price'];
                    }
                    $shipping_methods_available[] = $shipping_method['id'];
                } else if ($product_price >= $shipping_method['price_from'] && $product_price <= $shipping_method['price_to'] && $product_weight >= $shipping_method['weight_from'] && $product_weight <= $shipping_method['weight_to']) {
                    // No method selected, so store all methods available
                    $shipping_methods_available[] = $shipping_method['id'];
                }
            }
            // Update selected shipping method name
            if ($shipping_method['id'] == $selected_shipping_method) {
                $selected_shipping_method_name = $shipping_method['title'];
            }
        }
    }
    // Number of discounted products
    $num_discounted_products = count(array_column($products_in_cart, 'discounted'));
    // Iterate the products and update the price for the discounted products
    foreach ($products_in_cart as &$cart_product) {
        if (isset($cart_product['discounted']) && $cart_product['discounted'] && $discount) {
            $price = &$cart_product['final_price'];
            if ($discount['discount_type'] == 'Percentage') {
                $d = round((float)$price * ((float)$discount['discount_value'] / 100), 2);
                $price -= $d;
                $discount_total += $d * (int)$cart_product['quantity'];
            }
            if ($discount['discount_type'] == 'Fixed') {
                $d = (float)$discount['discount_value'] / $num_discounted_products;
                $price -= $d / (int)$cart_product['quantity'];
                $discount_total += $d;
            }
        }
    }
}
// Make sure when the user submits the form all data was submitted and shopping cart is not empty
if (isset($_POST['method'], $_POST['first_name'], $_POST['last_name'], $_POST['address_street'], $_POST['address_city'], $_POST['address_state'], $_POST['address_zip'], $_POST['address_country'], $_POST['mol'], $_POST['company'], $_POST['address_company'], $_POST['dds'], $_POST['eik']) && !isset($_POST['update'])) {
    // Account ID
    $account_id = null;

    // If the user is already logged in, update the user's details or if the user is not logged in, create a new account
    if (isset($_SESSION['account_loggedin'])) {
        // normalize all of your inputs, turning “empty” into null
        $first_name       = trim($_POST['first_name']   ?? '');
        $last_name        = trim($_POST['last_name']    ?? '');
        $address_street           = trim($_POST['address_street']  ?? '');
        $address_city             = trim($_POST['address_city']    ?? '');
        $address_state            = trim($_POST['address_state']   ?? '');
        $address_zip              = trim($_POST['address_zip']     ?? '');
        $address_country          = trim($_POST['address_country'] ?? '');
        $mol              = trim($_POST['mol']          ?? '');
        $company          = trim($_POST['company']      ?? '');
        $address_company     = trim($_POST['address_company'] ?? '');
        $dds              = trim($_POST['dds']          ?? '');
        $eik              = trim($_POST['eik']          ?? '');
        $speedy           = trim($_POST['speedy']      ?? '');
        $tel              = trim($_POST['tel']         ?? '');
    
        // Convert any empty string into a real NULL
        foreach (['address_street','city','state','zip','country','addess_company','mol','company','address_company','dds','eik','speedy','tel'] as $f) {
            if ($$f === '') {
                $$f = null;
            }
        }
    
        $stmt = $pdo->prepare(
            'UPDATE accounts SET
                address_street   = ?,
                first_name       = ?,
                last_name        = ?,
                mol              = ?,
                company          = ?,
                address_company  = ?,
                dds              = ?,
                eik              = ?,
                speedy           = ?,
                tel              = ?
             WHERE id = ?'
        );
    
        $stmt->execute([
            $address_street ,
            $first_name,
            $last_name,
            $mol,
            $company,
            $address_company,
            $dds,
            $eik,
            $speedy,
            $tel,
            $_SESSION['account_id'],
        ]);
    
        $account_id = $_SESSION['account_id'];
    }
     else if (isset($_POST['email'], $_POST['password'], $_POST['cpassword']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {
        // User is not logged in, check if the account already exists with the email they submitted
        $stmt = $pdo->prepare('SELECT id FROM accounts WHERE email = ?');
        $stmt->execute([ $_POST['email'] ]);
    	if ($stmt->fetchColumn() > 0) {
            // Email exists, user should login instead...
    		$errors[] = 'Account already exists with that email!';
        }
        if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            // Password must be between 5 and 20 characters long.
            $errors[] = 'Password must be between 5 and 20 characters long!';
    	}
        if ($_POST['password'] != $_POST['cpassword']) {
            // Password and confirm password fields do not match...
            $errors[] = 'Passwords do not match!';
        }



        if (!$errors) {
            // Hash the password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // Email doesn't exist, create new account
            $stmt = $pdo->prepare('INSERT INTO accounts (email, password, first_name, last_name, address_street, address_city, address_state, address_zip, address_country, mol, company, address_company, dds, eik, speedy, tel) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->execute([
                $_POST['email'], 
                $password, 
                $_POST['first_name'], 
                $_POST['last_name'], 
                $_POST['address_street'], 
                "", 
                "", 
                "", 
                "",
                $_POST['mol'], 
                $_POST['company'], 
                $_POST['address_company'], 
                $_POST['dds'], 
                $_POST['eik'],
                $_POST['speedy'],
                $_POST['tel']
            ]);
            $account_id = $pdo->lastInsertId();

            // Fetch the account from the database and return the result as an Array
            $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
            $stmt->execute([ $account_id ]);
            $account = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } else if (account_required) {
        $errors[] = 'Account creation required!';
    }
    // Process the order with the details provided
    if (!$errors && $products_in_cart) {
        // No errors, process the order
        // Log the user in with the details provided
        if ($account_id != null && !isset($_SESSION['account_loggedin'])) {
            // Log the user in with the details provided
            session_regenerate_id();
            $_SESSION['account_loggedin'] = TRUE;
            $_SESSION['account_id'] = $account_id;
            $_SESSION['account_role'] = $account['role'];
            $_SESSION['account_name'] = $account['first_name'] . ' ' . $account['last_name'];
        }
        // Process Stripe Payment
       
        if (pay_on_delivery_enabled && $_POST['method'] == 'payondelivery') {
            // Process Normal Checkout
            // Generate unique transaction ID
            $transaction_id = strtoupper(uniqid('SC') . substr(md5(mt_rand()), 0, 5));
            // Customer email
            $customer_email = isset($account['email']) && !empty($account['email']) ? $account['email'] : $_POST['email'];
            // Total amount
                    if (isset($_SESSION['account_role']) && in_array($_SESSION['account_role'], ['Workshop', 'Admin'])){ 
                        $vat = $subtotal * 0.9;
                       $total_with_vat = $subtotal * 1.2;
                      $total = $total_with_vat*0.9;
                      
                    }else{
                        $vat = $subtotal * 0.9;
                       $total_with_vat = $subtotal * 1.2;
                       $total = $total_with_vat;
                    }



        
        
            // Insert transaction into database with additional fields for MOL, Company, Address, DDS, and EIK
            $stmt = $pdo->prepare('INSERT INTO transactions (txn_id, payment_amount, payment_status, created, payer_email, first_name, last_name, address_street, address_city, address_state, address_zip, address_country, account_id, payment_method, shipping_method, shipping_amount, discount_code, mol, company, address_company, dds, eik, speedy, tel) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$stmt->execute([
    $transaction_id,
    $total,
    default_payment_status,
    date('Y-m-d H:i:s'),
    $customer_email,
    $_POST['first_name'],
    $_POST['last_name'],
    $_POST['address_street'],
    "",
   "",
    "",
    "",
    $account_id,
    'Наложен платеж',  // Payment method: Pay on Delivery
    $selected_shipping_method_name,
    $shipping_total,
    $discount ? $discount['discount_code'] : '',
    $_POST['mol'],          // MOL field from form
    $_POST['company'],      // Company field from form
    $_POST['address_company'],      // Address field from form
    $_POST['dds'],          // DDS number field from form
    $_POST['eik'],          // EIK number field from form
    $_POST['speedy'],
    $_POST['tel']       // Speedy field for delivery type (either 'ofis' or 'vrata')
]);

        
            // Get order ID
            $order_id = $pdo->lastInsertId();

            $_POST['payment_method']   = 'Наложен платеж';
        
            // Iterate products and deduct quantities
            foreach ($products_in_cart as $product) {
                // For every product in the shopping cart, insert a new transaction item into our database
                $stmt = $pdo->prepare('INSERT INTO transactions_items (txn_id, item_id, item_price, item_quantity, item_options) VALUES (?,?,?,?,?)');
                $stmt->execute([ $transaction_id, $product['id'], $product['final_price'], $product['quantity'], $product['options'] ]);
        
                // Update product quantity in the products table
                $stmt = $pdo->prepare('UPDATE products SET quantity = GREATEST(quantity - ?, 0) WHERE quantity > 0 AND id = ?');
                $stmt->execute([ $product['quantity'], $product['id'] ]);
        
                // Deduct option quantities, if applicable
                if ($product['options']) {
                    $options = explode(',', $product['options']);
                    foreach ($options as $opt) {
                        $option_name = explode('-', $opt)[0];
                        $option_value = explode('-', $opt)[1];
                        $stmt = $pdo->prepare('UPDATE products_options SET quantity = GREATEST(quantity - ?, 0) WHERE quantity > 0 AND option_name = ? AND (option_value = ? OR option_value = "") AND product_id = ?');
                        $stmt->execute([ $product['quantity'], $option_name, $option_value, $product['id'] ]);
                    }
                }
            }
        
            // Send order details to the specified email address
            send_order_details_email(
                $customer_email, 
                $products_in_cart, 
                $_POST['first_name'], 
                $_POST['last_name'], 
                $_POST['address_street'], 
                $_POST['address_city'], 
                $_POST['address_state'], 
                $_POST['address_zip'], 
                $_POST['address_country'], 
                $total, 
                $order_id, 
                $_POST['company'], 
                $_POST['address_company'],   // Company address
                $_POST['mol'],               // MOL
                $_POST['dds'],               // DDS
                $_POST['eik'],               // EIK
                $_POST['speedy'],            // Speedy delivery type
                $_POST['tel'],
                $_POST['payment_method']                
            );
               // Redirect to the place order page
            header('Location: ' . url('index.php?page=placeorder'));
            exit;
        }
        

        if (pay_via_bank_transfer && $_POST['method'] == 'payviabanktransfer') {
            // Process Normal Checkout
            // Generate unique transaction ID
            $transaction_id = strtoupper(uniqid('SC') . substr(md5(mt_rand()), 0, 5));
            // Customer email
            $customer_email = isset($account['email']) && !empty($account['email']) ? $account['email'] : $_POST['email'];
            // Total amount
            if (isset($_SESSION['account_role']) && in_array($_SESSION['account_role'], ['Workshop', 'Admin'])){ 
                        $vat = $subtotal * 0.9;
                       $total_with_vat = $subtotal * 1.2;
                      $total = $total_with_vat*0.9;
                      
                    }else{
                        $vat = $subtotal * 0.9;
                       $total_with_vat = $subtotal * 1.2;
                       $total = $total_with_vat;
                    }
        
            
            // Insert transaction into database with additional fields for MOL, Company, Address, DDS, and EIK
            $stmt = $pdo->prepare('INSERT INTO transactions (txn_id, payment_amount, payment_status, created, payer_email, first_name, last_name, address_street, address_city, address_state, address_zip, address_country, account_id, payment_method, shipping_method, shipping_amount, discount_code, mol, company, address_company, dds, eik, speedy, tel) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$stmt->execute([
    $transaction_id,
    $total,
    default_payment_status,
    date('Y-m-d H:i:s'),
    $customer_email,
    $_POST['first_name'],
    $_POST['last_name'],
    $_POST['address_street'],
    $_POST['address_city'],
    $_POST['address_state'],
    $_POST['address_zip'],
    $_POST['address_country'],
    $account_id,
    'Банков превод',  // Payment method: Pay on Delivery
    $selected_shipping_method_name,
    $shipping_total,
    $discount ? $discount['discount_code'] : '',
    $_POST['mol'],          // MOL field from form
    $_POST['company'],      // Company field from form
    $_POST['address_company'],      // Address field from form
    $_POST['dds'],          // DDS number field from form
    $_POST['eik'],          // EIK number field from form
    $_POST['speedy'],
    $_POST['tel'],        // Speedy field for delivery type (either 'ofis' or 'vrata')
]);

        
            // Get order ID
            $order_id = $pdo->lastInsertId();

            $_POST['payment_method']   = 'Банков превод';
        
            // Iterate products and deduct quantities
            foreach ($products_in_cart as $product) {
                // For every product in the shopping cart, insert a new transaction item into our database
                $stmt = $pdo->prepare('INSERT INTO transactions_items (txn_id, item_id, item_price, item_quantity, item_options) VALUES (?,?,?,?,?)');
                $stmt->execute([ $transaction_id, $product['id'], $product['final_price'], $product['quantity'], $product['options'] ]);
        
                // Update product quantity in the products table
                $stmt = $pdo->prepare('UPDATE products SET quantity = GREATEST(quantity - ?, 0) WHERE quantity > 0 AND id = ?');
                $stmt->execute([ $product['quantity'], $product['id'] ]);
        
                // Deduct option quantities, if applicable
                if ($product['options']) {
                    $options = explode(',', $product['options']);
                    foreach ($options as $opt) {
                        $option_name = explode('-', $opt)[0];
                        $option_value = explode('-', $opt)[1];
                        $stmt = $pdo->prepare('UPDATE products_options SET quantity = GREATEST(quantity - ?, 0) WHERE quantity > 0 AND option_name = ? AND (option_value = ? OR option_value = "") AND product_id = ?');
                        $stmt->execute([ $product['quantity'], $option_name, $option_value, $product['id'] ]);
                    }
                }
            }
        }
        
            // Send order details to the specified email address
            send_order_details_email(
                $customer_email, 
                $products_in_cart, 
                $_POST['first_name'], 
                $_POST['last_name'], 
                $_POST['address_street'], 
                $_POST['address_city'], 
                $_POST['address_state'], 
                $_POST['address_zip'], 
                $_POST['address_country'], 
                $total, 
                $order_id, 
                $_POST['company'], 
                $_POST['address_company'],   // Company address
                $_POST['mol'],               // MOL
                $_POST['dds'],               // DDS
                $_POST['eik'],               // EIK
                $_POST['speedy'],            // Speedy delivery type
                $_POST['tel'],   
                $_POST['payment_method']                // Phone number
            );
               // Redirect to the place order page
            header('Location: ' . url('index.php?page=placeorder'));
            exit;
        }
    // Preserve form details if the user encounters an error
    $account = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'address_street' => $_POST['address_street'],
    ];
}
?>
<?=template_header('Checkout')?>

<div class="checkout content-wrapper">

    <h1 class="page-title">Завършване на поръчка</h1>

    <?php if ($errors): ?>
    <p class="error"><?=implode('<br>', $errors)?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['account_loggedin'])): ?>
    <p>Имате акаунт? <a href="<?=url('index.php?page=myaccount')?>" class="link">Log In</a></p>
    <?php endif; ?>

    <form action="" method="post" class="form pad-top-2">

        <div class="container">

            <div class="shipping-details">

                <h2>Метод на плащане</h2>

                <div class="payment-methods">
                    <?php if (pay_on_delivery_enabled): ?>
                    <input id="payondelivery" type="radio" name="method" value="payondelivery" checked>
                    <label for="payondelivery">Наложен платеж</label>
                    <?php endif; ?>

                    <?php if (pay_via_bank_transfer): ?>
    <input id="payviabanktransfer" type="radio" name="method" value="payviabanktransfer">
    <label for="payviabanktransfer">Банков превод</label>
<?php endif; ?>



                    <?php if (paypal_enabled): ?>
                    <input  id="paypal" type="radio" name="method" value="paypal">
                    <label for="paypal"><img src="data:image/png;base64,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" width="100" height="26" alt="PayPal"></label>
                    <?php endif; ?>

                    <?php if (stripe_enabled): ?>
                    <input style=" visibility: hidden;"id="stripe" type="radio" name="method" value="stripe">
                    <label style=" visibility: hidden;" for="stripe"><svg class="stripe-icon" width="60" height="60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M165 144.7l-43.3 9.2-.2 142.4c0 26.3 19.8 43.3 46.1 43.3 14.6 0 25.3-2.7 31.2-5.9v-33.8c-5.7 2.3-33.7 10.5-33.7-15.7V221h33.7v-37.8h-33.7zm89.1 51.6l-2.7-13.1H213v153.2h44.3V233.3c10.5-13.8 28.2-11.1 33.9-9.3v-40.8c-6-2.1-26.7-6-37.1 13.1zm92.3-72.3l-44.6 9.5v36.2l44.6-9.5zM44.9 228.3c0-6.9 5.8-9.6 15.1-9.7 13.5 0 30.7 4.1 44.2 11.4v-41.8c-14.7-5.8-29.4-8.1-44.1-8.1-36 0-60 18.8-60 50.2 0 49.2 67.5 41.2 67.5 62.4 0 8.2-7.1 10.9-17 10.9-14.7 0-33.7-6.1-48.6-14.2v40c16.5 7.1 33.2 10.1 48.5 10.1 36.9 0 62.3-15.8 62.3-47.8 0-52.9-67.9-43.4-67.9-63.4zM640 261.6c0-45.5-22-81.4-64.2-81.4s-67.9 35.9-67.9 81.1c0 53.5 30.3 78.2 73.5 78.2 21.2 0 37.1-4.8 49.2-11.5v-33.4c-12.1 6.1-26 9.8-43.6 9.8-17.3 0-32.5-6.1-34.5-26.9h86.9c.2-2.3 .6-11.6 .6-15.9zm-87.9-16.8c0-20 12.3-28.4 23.4-28.4 10.9 0 22.5 8.4 22.5 28.4zm-112.9-64.6c-17.4 0-28.6 8.2-34.8 13.9l-2.3-11H363v204.8l44.4-9.4 .1-50.2c6.4 4.7 15.9 11.2 31.4 11.2 31.8 0 60.8-23.2 60.8-79.6 .1-51.6-29.3-79.7-60.5-79.7zm-10.6 122.5c-10.4 0-16.6-3.8-20.9-8.4l-.3-66c4.6-5.1 11-8.8 21.2-8.8 16.2 0 27.4 18.2 27.4 41.4 .1 23.9-10.9 41.8-27.4 41.8zm-126.7 33.7h44.6V183.2h-44.6z"/></svg></label>
                    <?php endif; ?>
                    
                    <?php if (coinbase_enabled): ?>
                    <input id="coinbase" type="radio" name="method" value="coinbase">
                    <label for="coinbase">Cryptocurrency</label>
                    <?php endif; ?>
                </div>

                <?php if (!isset($_SESSION['account_loggedin'])): ?>
                <h2>Create Account<?php if (!account_required): ?> (optional)<?php endif; ?></h2>

                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" placeholder="john@example.com" class="form-input expand" required>

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="form-input expand" autocomplete="new-password">

                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" class="form-input expand" autocomplete="new-password">
                <?php endif; ?>

                <h2>Фактуриране и доставка</h2>

                <div class="form-group">
                    <div class="col pad-right-2">
                        <label for="first_name" class="form-label">Първо име</label>
                        <input type="text" value="<?=htmlspecialchars($account['first_name'], ENT_QUOTES)?>" name="first_name" id="first_name" placeholder="" class="form-input expand" required>
                    </div>
                    <div class="col pad-left-2">
                        <label for="last_name" class="form-label">Фамилно име</label>
                        <input type="text" value="<?=htmlspecialchars($account['last_name'], ENT_QUOTES)?>" name="last_name" id="last_name" placeholder="" class="form-input expand" required>
                    </div>
                    
                </div>

               
                <label   for="address_city" class="form-label">Телефонен номер</label>
                <input   type="text" value="<?=htmlspecialchars($account['tel'], ENT_QUOTES)?>"  name="tel" id="tel" placeholder="" class="form-input expand" required>

                

                <label for="delivery_type" class="form-label">Тип доставка</label>
<select id="delivery_type" name="speedy" class="form-input expand" onchange="toggleAddressField()" required>
    <option value="" disabled <?=!isset($account['speedy']) ? 'selected' : ''?>>Изберете тип доставка</option>
    <option value="ofis" <?=$account['speedy'] == 'ofis' ? 'selected' : ''?>>Доставка до офис/автомат на Спиди</option>
    <option value="vrata" <?=$account['speedy'] == 'vrata' ? 'selected' : ''?>>Доставка до адрес със Спиди</option>
</select>

<label for="address_street" class="form-label">Адрес</label>
<input
  type="text"
  id="address_street"
  name="address_street"
  class="form-input expand"
  value="<?= htmlspecialchars( trim($account['address_street'] ?? ''), ENT_QUOTES ) ?>"
  required
>

                
                <label  style="display:none;" for="address_city" class="form-label">Населено място</label>
                <input  style="display:none;"  type="text" value="<?=htmlspecialchars($account['address_city'], ENT_QUOTES)?>" value="TEST" name="address_city" id="address_city" placeholder="" class="form-input expand" required>

                <div  style="display:none;" class="form-group">
                    <div class="col pad-right-2">
                        <label for="address_state" class="form-label">State</label>
                        <input type="text" value="<?=htmlspecialchars($account['address_state'], ENT_QUOTES)?>" name="address_state" id="address_state" placeholder="" class="form-input expand" >
                    </div>
                    <div class="col pad-left-2">
                        <label for="address_zip" class="form-label">Zip</label>
                        <input type="text" value="<?=htmlspecialchars($account['address_zip'], ENT_QUOTES)?>" name="address_zip" id="address_zip" placeholder="" class="form-input expand" >
                    </div>
                </div>

                <select  style="display:none;" name="address_country" id="address_country" class="ajax-update form-input expand" required>
        <?php
        // Retrieve list of countries
        $countries = get_countries();
        $defaultCountry = 'Bulgaria'; // Set Bulgaria as the default value

        foreach ($countries as $country):
        ?>
        <option value="<?=$country?>" <?=$country == $defaultCountry ? 'selected' : ''?>><?=$country?></option>
        <?php endforeach; ?>
    </select>


                
                
<div class="form-container">
    <label id="invoiceLabel" class="main-label" onclick="toggleAdditionalInfo()" style="
      text-decoration: none;
      display: flex;
      justify-content: center;
      align-items: center;
      border: 3px solid #edeff3;
      border-radius: 5px;
      height: 60px;
      width: 159px;
      margin:10px 10px 10px 0px;
      font-weight: 500;
      color: #434f61;
      padding: 0;
      cursor: pointer;
      transition: border 0.2s ease;">
      Фактура
    </label>

    <div id="additionalInfo" class="additional-info">
        <label for="company" class="form-label">Име на фирма:</label>
        <input type="text" value="<?=htmlspecialchars($account['company'] ?? '', ENT_QUOTES)?>" name="company" id="company" class="form-input expand">

        <label for="address_company" class="form-label">Адрес:</label>
        <input type="text" value="<?=htmlspecialchars($account['address_company'] ?? '', ENT_QUOTES)?>" name="address_company" id="address_company" class="form-input expand">

        <label for="mol" class="form-label">Мол:</label>
        <input type="text" value="<?=htmlspecialchars($account['mol'] ?? '', ENT_QUOTES)?>" name="mol" id="mol" class="form-input expand">

        <div class="form-group">
            <div class="col pad-right-2">
                <label for="dds" class="form-label">ДДС номер:</label>
                <input type="text" value="<?=htmlspecialchars($account['dds'] ?? '', ENT_QUOTES)?>" name="dds" id="dds" class="form-input expand">
            </div>
            <div class="col pad-left-2">
                <label for="eik" class="form-label">ЕИК номер:</label>
                <input type="text" value="<?=htmlspecialchars($account['eik'] ?? '', ENT_QUOTES)?>" name="eik" id="eik" class="form-input expand">
            </div>
        </div>
    </div>
</div>


<style>
.additional-info {
    display: none;
}

.main-label.active {
    border: 3px solid #7ed1a1 !important;
}
</style>

<script>
let isInvoiceVisible = false;

function toggleAdditionalInfo() {
    const additionalInfo = document.getElementById('additionalInfo');
    const label = document.getElementById('invoiceLabel');

    isInvoiceVisible = !isInvoiceVisible;

    additionalInfo.style.display = isInvoiceVisible ? 'block' : 'none';

    if (isInvoiceVisible) {
        label.classList.add('active');
    } else {
        label.classList.remove('active');
    }
}

// Auto-show if saved data exists
window.onload = function() {
    const companyField = document.getElementById('company').value;
    const label = document.getElementById('invoiceLabel');

    if (companyField) {
        document.getElementById('additionalInfo').style.display = 'block';
        isInvoiceVisible = true;
        label.classList.add('active');
    }
};
</script>


            
            
            
            
            
            

            </div>

            <div class="cart-details">
                    
                <h2>Количка</h2>

                <table>
                    <?php foreach($products_in_cart as $product): ?>
                    <tr>
                        <td><img src="<?=$product['meta']['img']?>" width="35" height="35" alt="<?=$product['meta']['title']?>"></td>
                        <td><?=$product['quantity']?> x <?=$product['meta']['title']?></td>
                        <td class="price"><?=number_format($product['options_price'] * $product['quantity'],2)?><?=currency_code?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                 <!-- <div class="discount-code">
                    <input type="text" class="ajax-update form-input expand" name="discount_code" placeholder="Discount Code" value="<?=isset($_SESSION['discount']) ? htmlspecialchars($_SESSION['discount'], ENT_QUOTES) : ''?>">
                    <span class="result">
                        <?php if (isset($_SESSION['discount']) && !$discount): ?>
                        Incorrect discount code!
                        <?php elseif ($discount && $current_date < strtotime($discount['start_date'])): ?>
                        Incorrect discount code!
                        <?php elseif ($discount && $current_date > strtotime($discount['end_date'])): ?>
                        Discount code expired!
                        <?php elseif ($discount): ?>
                        Discount code applied!
                        <?php endif; ?>
                    </span>
                </div> -->

                <div class="shipping-methods-container" style="display:none">
                    <?php if ($shipping_methods_available): ?>
                    <div class="shipping-methods">
                        <h3>Shipping Method</h3>
                        <?php foreach($shipping_methods as $k => $method): ?>
                        <?php if (!in_array($method['id'], $shipping_methods_available)) continue; ?>
                        <div class="shipping-method">
                            <input type="radio" class="ajax-update" id="sm<?=$k?>" name="shipping_method" value="<?=$method['id']?>" <?=$selected_shipping_method==$method['id']?' checked':''?>>
                            <label for="sm<?=$k?>"><?=$method['title']?> (<?=currency_code?><?=number_format($method['price'], 2)?><?=$method['shipping_type']=='Single Product'?' per item':''?>)</label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- <div class="summary1">
                    <div class="subtotal">
                        <span>Междинна сума</span>
                        <span><?=number_format($subtotal,2)?><?=currency_code?></span>
                    </div>

                    <?php if ($tax): ?>
                     <class="vat">
                        <span>ДДС<span class="alt">(<?=$tax['rate']?>%)</span></span>
                        <span><?=number_format(round($tax_total, 2),2)?><?=currency_code?></span>
                    </div>
                    <?php endif; ?>

                    <div class="shipping">
                        <span>Shipping</span>
                        <span><?=currency_code?><?=number_format($shipping_total,2)?></span>
                    </div> 

                    <?php if ($discount_total > 0): ?>
                    <div class="discount">
                        <span>Discount</span>
                        <span><?=currency_code?><?=number_format(round($discount_total, 2),2)?><?=currency_code?></span>
                    </div>
                    <?php endif; ?>
                </div> -->

                <?php
$vat = $subtotal * 0.9;
$total_with_vat = $subtotal * 1.2;
?>

                <div class="total">
                    <span>Стойност: <span class="alt"></span></span><span><?=number_format($subtotal-round($discount_total, 2),2)?> <?=currency_code?> / <?=number_format($subtotal/1.95583-round($discount_total, 2),2)?> €</span><br>

                    <?php if (isset($_SESSION['account_role']) && in_array($_SESSION['account_role'], ['Workshop', 'Admin'])){ $total_with_vat = $total_with_vat*0.9?>

                       

                        <span>Отстъпка 10%: <span class="alt"></span></span><span>-<?= number_format($subtotal*0.1, 2) ?> <?= currency_code ?> / -<?= number_format($subtotal*0.1/ 1.95583, 2) ?> €</span><br>



    

    <span class="text">Нето:</span>
    <span class="price"><?= number_format($subtotal*0.9, 2) ?> <?= currency_code ?> / <?= number_format($subtotal*0.9 / 1.95583, 2) ?>€</span><br><br>

    <span class="text">ДДС:</span>
    <span class="price"><?= number_format($vat*0.2, 2) ?> <?= currency_code ?> / <?= number_format($vat*0.2 / 1.95583, 2) ?>€</span><br>

    <?php }else{ ?>

        <span class="text">Нето:</span>
    <span class="price"><?= number_format($subtotal, 2) ?> <?= currency_code ?> / <?= number_format($subtotal / 1.95583, 2) ?>€</span><br><br>

    <span class="text">ДДС:</span>
    <span class="price"><?= number_format($vat/0.9*0.2, 2) ?> <?= currency_code ?> / <?= number_format($vat/0.9*0.2 / 1.95583, 2) ?>€</span><br>

    <?php } ?>

    <br>

                    
 
                    <?php if (isset($_SESSION['account_role']) && in_array($_SESSION['account_role'], ['Workshop', 'Admin'])){ ?>

    <span style="font-weight: bold; font-size: 21px;" class="price total-bold">
        Общо: <?= number_format($total_with_vat, 2) ?> <?= currency_code ?> / <?= number_format($total_with_vat / 1.95583, 2) ?>€
    </span><br>

    <?php }else{ ?>

        <span style="font-weight: bold; font-size: 25px;" class="price total-bold">
        Общо: <?= number_format($total_with_vat, 2) ?> <?= currency_code ?> / <?= number_format($total_with_vat / 1.95583, 2) ?>€
    </span><br>

    <?php } ?>

    <br>

                <div class="buttons">
                    <button type="submit" name="checkout" class="btn" style="background-color: #f58634;font-weight:bold;font-size: 20px;">Приключи поръчка</button>
                </div>

            </div>

        </div>

    </form>

</div>

<?=template_footer()?>