<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require '../../config/accessController.php';

    $page_title = "Uniforms";

    include ('../../includes/student/header.php');
    require '../../actions/admin/product/productQuery.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../src/output.css" rel="stylesheet">
    </head>

    <body class="bg-white font-sans antialiased text-zinc-900">
        <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight mb-6">Uniforms</h2>
            <?php 
                $isAUniform = false;
                $uniform_rows = [];

                while ($row = mysqli_fetch_array($result)) {
                    if ($row['category'] === 'Uniform') {
                        $isAUniform = true;
                    }
                    $uniform_rows[] = $row;
                }
            ?>
            <?php if ($isAUniform): ?>      
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($uniform_rows as $row) { ?>
                <?php if ($row['category'] !== 'Uniform') { continue; } ?>
                <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                    <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                        <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                            <?php if (!empty($row['image'])) { ?>
                                <img src="../../assets/uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>" class="w-full h-full object-cover mix-blend-multiply">
                            <?php } else { ?>
                                <div class="text-sm text-gray-400">No image</div>
                            <?php } ?>
                        </div>

                        <div class="px-2.5 mb-4">
                            <p class="font-medium text-base"><?php echo $row['product_name']; ?></p>
                            <p class="text-gray-500 text-sm my-1"><?php echo $row['category']; ?></p>
                            <?php
                                $sizes = $row['sizes'] ? explode('|', $row['sizes']) : [];
                                $stocks = $row['stocks'] ? explode('|', $row['stocks']) : [];
                                $count = count($sizes);
                                $total_stock = 0;
                                for ($i = 0; $i < $count; $i++) {
                                    $total_stock += (int) $stocks[$i];
                                }
                            ?>
                            <div class="flex justify-between items-center mt-2">
                                <p class="font-medium">₱<?php echo number_format($row['price'], 2); ?></p>
                                <p class="text-sm text-gray-600">
                                    Stock: <span id="stock-display-<?php echo $row['product_id']; ?>" class="<?php echo $total_stock <= 10 ? 'text-red-600 font-semibold' : ''; ?>"><?php echo $total_stock; ?></span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-auto px-2.5 flex flex-col gap-3">
                            <div class="flex gap-2">
                                <select name="size" required 
                                    id="size-select-<?php echo $row['product_id']; ?>"
                                    class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black"
                                    onchange="updateStockDisplay(<?php echo $row['product_id']; ?>, <?php echo $total_stock; ?>)">
                                    <option value="">Size</option>
                                    <?php
                                        for ($i = 0; $i < $count; $i++) {
                                            $size = $sizes[$i];
                                            $stock = $stocks[$i];
                                    ?>
                                        <option value="<?php echo $size; ?>" 
                                                data-stock="<?php echo (int) $stock; ?>"
                                                <?php echo ((int) $stock) <= 0 ? 'disabled' : ''; ?>>
                                            <?php echo $size; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <input type="number" name="quantity" value="1" min="1" max="3" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                            </div>
                            
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                            <input type="hidden" name="category" value="<?php echo $row['category']; ?>">

                            <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                                Reserve Now
                            </button>
                        </div>
                    </form>
                </div>
            <?php } ?>
            </div>
            <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No Products Available</p>
            </div>
            <?php endif; ?>
        </div>
        <script src="../../assets/js/displayStock.js"></script>
    </body>
</html>