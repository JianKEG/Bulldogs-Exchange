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

        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Uniforms</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Type A Women's Uniform -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/IMG_2859.jpg" alt="Type A Uniform" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Type A Women's</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 560.00</p>
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
                        <input type="hidden" name="price" value="560.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Type A Men's Uniform -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/IMG_2860.jpg" alt="Type A Men's Uniform" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Type A Men's</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 560.00</p>
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
                        <input type="hidden" name="price" value="560.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- PE Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/peSHIRT.jpg" alt="PE Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">PE Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 260.00</p>
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
                        <input type="hidden" name="price" value="260.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- NSTP Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/NSTP.jpg" alt="NSTP Uniform" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">NSTP Uniform</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 260.00</p>
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
                        <input type="hidden" name="price" value="260.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- ESS Men Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/ESSMen.jpg" alt="ESS Men Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">ESS Men Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 480.00</p>
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

                        <input type="hidden" name="product_name" value="ESS Women Shirt">
                        <input type="hidden" name="price" value="480.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- ESS Women Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/ESSWomen.jpg" alt="ESS Women Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">ESS Women Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 480.00</p>
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

                        <input type="hidden" name="product_name" value="ESS Men Uniform">
                        <input type="hidden" name="price" value="480.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Psych Men Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/psychM.jpg" alt="Psych Men Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Psych Men Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 600.00</p>
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

                        <input type="hidden" name="product_name" value="Psych Men Shirt">
                        <input type="hidden" name="price" value="600.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Psych Women Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/psychW.jpg" alt="Psych Women Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Psych Women Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 600.00</p>
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

                        <input type="hidden" name="product_name" value="Psych Women Shirt">
                        <input type="hidden" name="price" value="600.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- SHS Type A Women Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/SHSTypeAWomen.jpg" alt="SHS Women Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">SHS Women Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 480.00</p>
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

                        <input type="hidden" name="product_name" value="SHS Type A Women Uniform">
                        <input type="hidden" name="price" value="480.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- SHS Type A Men Shirt -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/SHSTypeAMen.jpg" alt="SHS Men Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">SHS Men Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 480.00</p>
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

                        <input type="hidden" name="product_name" value="SHS Type A Men Uniform">
                        <input type="hidden" name="price" value="480.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tourism A -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                        <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                            <img src="../../assets/images/tourismA.jpg" alt="Tourism Uniform" class="w-full h-full object-cover mix-blend-multiply">
                        </div>

                        <div class="px-2.5 mb-4">
                            <p class="font-medium text-base">Tourism Uniform</p>
                            <p class="text-gray-500 text-sm my-1">Uniform</p>
                            <p class="font-medium mt-2">PHP 480.00</p>
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

                            <input type="hidden" name="product_name" value="Tourism Uniform">
                            <input type="hidden" name="price" value="480.00">

                            <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                                Reserve Now
                            </button>
                        </div>
                    </form>
                </div>

            <!-- Tourism AA -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                        <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                            <img src="../../assets/images/tourismA.jpg" alt="Tourism Uniform" class="w-full h-full object-cover mix-blend-multiply">
                        </div>

                        <div class="px-2.5 mb-4">
                            <p class="font-medium text-base">Tourism Uniform</p>
                            <p class="text-gray-500 text-sm my-1">Uniform</p>
                            <p class="font-medium mt-2">PHP 480.00</p>
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

                            <input type="hidden" name="product_name" value="Tourism Uniform">
                            <input type="hidden" name="price" value="480.00">

                            <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                                Reserve Now
                            </button>
                        </div>
                    </form>
                </div>
        </div>

    </body>
</html>