<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

    $page_title = "My Reservations";
    
    require '../../config/accessController.php';

    $user = $_SESSION['username'];
    $cookie_name = 'cart_' . $user;

    if (isset($_COOKIE[$cookie_name]) && empty($_SESSION['cart'])) {
        $_SESSION['cart'] = json_decode($_COOKIE[$cookie_name], true);
    }

    if (isset($_POST['reserve_submit'])) {
        $newItem = [
            'id'=> uniqid(),'product'=> $_POST['product_name'], 'size'=> $_POST['size'],'quantity'=> $_POST['quantity'],'price'=> $_POST['price']
        ];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][] = $newItem;
        
        $cart = json_encode($_SESSION['cart']);

        setcookie($cookie_name, $cart, time() + (60*60*24*7), '/');
        
        header("Location: viewReservedItems.php");
        exit();
    }
?>

<?php include ('../../includes/student/header.html'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reservation Cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../src/output.css" rel="stylesheet">
        <style>
            body { font-family: sans-serif; background: #f9f9f9; }
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
    
    <body class="bg-white font-sans antialiased text-zinc-900">
        <div class="cart-container">
            <h2>Your Reservation List</h2>
            
            <?php if (isset($_SESSION['message'])): ?>
                <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; 
                    <?php 
                    if (strpos($_SESSION['message'], 'successfully') !== false) {
                        echo 'background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;';
                    } else {
                        echo 'background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;';
                    }
                    ?>">
                    <?php 
                    echo htmlspecialchars($_SESSION['message']); 
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
            
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
                    
                    <form action="../../actions/student/finalizeReservation.php" method="POST">
                        <button type="submit" class="btn btn-finalize">Finalize Reservation</button>
                    </form>
                </div>

            <?php else: ?>
                <p class="mt-4 mb-4 text-gray-600">Your reservation list is empty.</p>
                <a href="uniform.php" class="btn btn-finalize inline-block">Go to Uniforms</a>
            <?php endif; ?>
        </div>
    </body>
</html>