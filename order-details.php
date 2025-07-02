<!-- <?php
// Prevent direct access to file
defined('shoppingcart') or exit;

// Check if txn_id parameter is set
if (isset($_GET['txn_id'])) {
    // Prepare statement to prevent SQL injection
    $stmt = $pdo->prepare('SELECT txn_id FROM transactions WHERE txn_id = ?');
    $stmt->execute([ $_GET['txn_id'] ]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        http_response_code(404);
        exit('Товарителницата не съществува!');
    }
} else {
    http_response_code(400);
    exit('Липсва параметър txn_id!');
}
?> -->



<div class="content-wrapper">
    <p><strong><?=htmlspecialchars($order['txn_id'])?></strong></p>
</div>

<a href="#">fd</a>

<?=template_footer()?>
