<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $page_title = "Merchandise";

    include ('../../includes/student/header.html');
    require '../../config/accessController.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../src/output.css" rel="stylesheet">
    </head>

    <body class="bg-white font-sans antialiased text-zinc-900">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    *       {
                font-family: 'Poppins', sans-serif;
            }
        </style>
        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-10 text-center tracking-tight">Merchandise</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Tote Bag -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/tote.jpg" alt="Tote Bag" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Tote Bag</p>
                        <p class="text-gray-500 text-sm my-1">Merchandise</p>
                        <p class="font-medium mt-2">PHP 199.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="One Size">One Size</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>
                        
                        <input type="hidden" name="product_id" value="13">
                        <input type="hidden" name="price" value="199.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Sling bag -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/bag.jpg" alt="Sling Bag" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Sling Bag</p>
                        <p class="text-gray-500 text-sm my-1">Merchandise</p>
                        <p class="font-medium mt-2">PHP 299.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="One Size">One Size</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_id" value="14">
                        <input type="hidden" name="price" value="299.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tumbler -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/tumbler.png" alt="Tumbler" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Tumbler</p>
                        <p class="text-gray-500 text-sm my-1">Merchandise</p>
                        <p class="font-medium mt-2">PHP 399.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="One Size">One Size</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_id" value="15">
                        <input type="hidden" name="price" value="399.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Yellow Varsity Jacket -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/yellow.jpg" alt="Yellow Varsity Jacket" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Yellow Varsity Jacket</p>
                        <p class="text-gray-500 text-sm my-1">Merchandise</p>
                        <p class="font-medium mt-2">PHP 899.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_id" value="16">
                        <input type="hidden" name="price" value="899.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Blue Varsity Jacket -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/bluevarsity.jpg" alt="Blue Varsity Jacket" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Blue Varsity Jacket</p>
                        <p class="text-gray-500 text-sm my-1">Merchandise</p>
                        <p class="font-medium mt-2">PHP 899.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_id" value="17">
                        <input type="hidden" name="price" value="899.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bulldog Toy -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/bulldogtoy.png" alt="Bulldog Toy" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Bulldog Stuff Toy</p>
                        <p class="text-gray-500 text-sm my-1">Merchandise</p>
                        <p class="font-medium mt-2">PHP 399.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="One Size">One Size</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_id" value="18">
                        <input type="hidden" name="price" value="399.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Adidas Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/adidas.png" alt="Adidas Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">NUxAdidas Exclusive Shirt </p>
                        <p class="text-gray-500 text-sm my-1">Merchandise</p>
                        <p class="font-medium mt-2">PHP 1300.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_id" value="19">
                        <input type="hidden" name="price" value="1300.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php include ('../../includes/footer.html'); ?>
    </body>
</html>