<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

    $page_title = "My Reservations";
    require '../../config/accessController.php';
    if (isset($_POST['reserve_submit'])) {
        $newItem = [
            'id'=> uniqid(),'product'=> $_POST['product_name'], 'size'=> $_POST['size'],'quantity'=> $_POST['quantity'],'price'=> $_POST['price']
        ];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][] = $newItem;
        
        header("Location: viewReservedItems.php");
        exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation Cart</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f9f9f9; }
        .cart-container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .total { font-size: 1.2rem; font-weight: bold; text-align: right; }
        .actions { display: flex; justify-content: space-between; margin-top: 20px; }
        .btn { padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold; cursor: pointer; border: none; }
        .btn-more { background: #eee; color: #333; }
        .btn-finalize { background: #111; color: #fff; }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>Your Reservation List</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Size</th>
                    <th>Qty</th>
                    <th>Price</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                foreach ($_SESSION['cart'] as $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $grand_total += $subtotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product']); ?></td>
                    <td><?php echo htmlspecialchars($item['size']); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>PHP <?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <a href="../../actions/student/removeItem.php?id=<?php echo $item['id']; ?>" 
                        style="color: #ff4d4d; text-decoration: none; font-weight: bold;"
                        onclick="return confirm('Remove this item from your reservation?')">
                        Remove
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">Grand Total: PHP <?php echo number_format($grand_total, 2); ?></div>

        <div class="actions">
            <a href="uniform.php" class="btn btn-more">Reserve More Items</a>
            
            <form action="finalize_reservation.php" method="POST">
                <button type="submit" class="btn btn-finalize">Finalize Reservation</button>
            </form>
        </div>

    <?php else: ?>
        <p>Your reservation list is empty.</p>
        <a href="uniform.php" class="btn btn-finalize">Go to Uniforms</a>
    <?php endif; ?>
</div>
</body>
</html>