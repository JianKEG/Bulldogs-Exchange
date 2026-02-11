<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        
    }
    $page_title = "Reservation Cart";
    require '../../config/accessController.php';
    require '../../config/connection.php';

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if(isset($_POST['reserve_submit'])){
        $product_id = $_POST['product_id'];
        $size = $_POST['size'];
        $quantity = (int)$_POST['quantity'];

        $cart_key = $product_id . "_" . $size;

        $stmt = $connection->prepare("SELECT price, product_name FROM Product WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();

        if($product){
            if(isset($_SESSION['cart'][$cart_key])){
                $_SESSION['cart'][$cart_key]['quantity'] += $quantity;
            } 
            else {
                $_SESSION['cart'][$cart_key] = [
                'product_id'=> $product_id, 
                'product_name'=> $product['product_name'], 
                'category'=> $_POST['category'],
                'size'=> $size, 
                'quantity'=> $quantity, 
                'price'=> $product['price']
                ];
            }
            $_SESSION['message'] = "Item added to list.";
        }
            header("Location: viewReservedItems.php");
            exit();
    }

    if(isset($_GET['remove'])){
        $key = $_GET['remove'];
        unset($_SESSION['cart'][$key]);
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
        <?php if (isset($_SESSION['message'])): ?>
            <div style="padding: 15px; margin-bottom: 20px; border-radius: 8px; 
                <?= (strpos($_SESSION['message'], 'successful') !== false || strpos($_SESSION['message'], 'added') !== false) 
                    ? 'background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;' 
                    : 'background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;' ?>">
                <strong>Notice:</strong> <?= htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h2>Your Cart</h2>

        <?php if(!empty($_SESSION['cart'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $grand_total = 0;
                        foreach($_SESSION['cart'] as $key => $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $grand_total += $subtotal;
                    ?>
                        <tr>
                            <td><?= $item['product_name'] ?></td>
                            <td><?= $item['size'] ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>PHP <?= number_format($item['price'], 2) ?></td>
                            <td>PHP <?= number_format($subtotal, 2) ?></td>
                            <td>
                                <a href="?remove=<?= urlencode($key) ?>" 
                                   style="color:red; font-weight:bold;"
                                   onclick="return confirm('Remove this item?')">
                                   Remove
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total">
                Grand Total: PHP <?= number_format($grand_total, 2) ?>
            </div>

            <div class="actions">
                <a href="uniform.php" class="btn btn-more">Add More Items</a> 
                <form action="../../actions/student/finalizeReservation.php" method="POST" onsubmit="return confirm('Finalize your reservation?');">
                    <button type="submit" class="btn btn-finalize">Finalize Reservation</button>
                </form>
            </div>

        <?php else: ?>
            <p class="text-gray-500" style="margin: 20px 0;">Your list is empty.</p>
            <a href="uniform.php" class="btn btn-finalize">Go to Uniforms</a>
            <a href="merchandise.php" class="btn btn-finalize">Go to Merchandise</a>
        <?php endif; ?>
    </div>
</body>
</html>