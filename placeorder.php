<?php
// Prevent direct access to file
defined('shoppingcart') or exit;
// Remove all the products in cart, the variable is no longer needed as the order has been processed
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}
// Remove subscription
if (isset($_SESSION['sub'])) {
    unset($_SESSION['sub']);
}
// Remove discount code
if (isset($_SESSION['discount'])) {
    unset($_SESSION['discount']);
}
?>
<?=template_header('Place Order')?>

<div class="placeorder content-wrapper">

    <h1 class="page-title">Вашата поръчка беше успешно изпратена</h1>

    <!-- Display the order number dynamically -->
    

    <p>Благодарим Ви, че ни се доверихте. Ще ви изпратим по имейл данни за поръчката</p>

</div>

<?=template_footer()?>
