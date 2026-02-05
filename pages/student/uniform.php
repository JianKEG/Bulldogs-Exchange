<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $page_title = "Uniforms";
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

        <h2 class="text-2xl font-bold mb-6 pl-2 tracking-tight">Uniforms</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/IMG_2859.jpg" alt="Type A Uniform" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Type A Women's Uniform</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 5000.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>
                        
                        <input type="hidden" name="product_name" value="Type A Women's Uniform">
                        <input type="hidden" name="price" value="5000.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/IMG_2860.jpg" alt="Type A Men's Uniform" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Type A Men's Uniform</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 4500.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_name" value="Type A Men's Uniform">
                        <input type="hidden" name="price" value="4500.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/IMG_2859.jpg" alt="PE Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">PE Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 5000.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_name" value="PE Shirt">
                        <input type="hidden" name="price" value="5000.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/IMG_2860.jpg" alt="NSTP Uniform" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">NSTP Uniform</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 4500.00</p>
                    </div>

                    <div class="mt-auto px-2.5 flex flex-col gap-3">
                        <div class="flex gap-2">
                            <select name="size" required class="flex-1 p-2 border border-gray-300 rounded text-sm bg-white focus:outline-none focus:border-black">
                                <option value="">Size</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_name" value="NSTP Uniform">
                        <input type="hidden" name="price" value="4500.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>