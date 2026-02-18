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
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    *       {
                font-family: 'Poppins', sans-serif;
            }
        </style>
        <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-10 text-center tracking-tight">Uniforms</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Type A Women's Polo -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/typeAWomen.jpg" alt="Type A Women's Polo" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Type A Women's Polo</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 560.00</p>
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
                        
                        <input type="hidden" name="product_id" value="12">
                        <input type="hidden" name="price" value="560.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Type A Men's Polo -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/typeAMen.jpg" alt="Type A Men's Polo" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Type A Men's Polo</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 560.00</p>
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

                        <input type="hidden" name="product_id" value="11">
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
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded text-sm text-center focus:outline-none focus:border-black">
                        </div>

                        <input type="hidden" name="product_id" value="2">
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
                        <img src="../../assets/images/NSTP.jpg" alt="NSTP Shirt" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">NSTP Shirt</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 260.00</p>
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

                        <input type="hidden" name="product_id" value="1">
                        <input type="hidden" name="price" value="260.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- ESS Men Top -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/ESSMen.jpg" alt="ESS Men Top" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">ESS Men Top</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 480.00</p>
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

                        <input type="hidden" name="product_id" value="3">
                        <input type="hidden" name="price" value="480.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- ESS Women Top -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/ESSWomen.jpg" alt="ESS Women Top" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">ESS Women Top</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 480.00</p>
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

                        <input type="hidden" name="product_id" value="4">
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
                        <img src="../../assets/images/psychM.jpg" alt="Psych Men Top" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Psych Men's Top</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 600.00</p>
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

                        <input type="hidden" name="product_id" value="7">
                        <input type="hidden" name="price" value="600.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Psych Women Top -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/psychW.jpg" alt="Psych Women Top" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">Psych Women's Top</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 600.00</p>
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

                        <input type="hidden" name="product_id" value="8">
                        <input type="hidden" name="price" value="600.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- SHS Type A Women Polo -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/SHSTypeAWomen.jpg" alt="SHS Women Polo" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">SHS Women's Type A Polo</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 560.00</p>
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

                        <input type="hidden" name="product_id" value="10">
                        <input type="hidden" name="price" value="560.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- SHS Type A Men Polo -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                    <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                        <img src="../../assets/images/SHSTypeAMen.jpg" alt="SHS Men Polo" class="w-full h-full object-cover mix-blend-multiply">
                    </div>

                    <div class="px-2.5 mb-4">
                        <p class="font-medium text-base">SHS Men's Type A Polo</p>
                        <p class="text-gray-500 text-sm my-1">Uniform</p>
                        <p class="font-medium mt-2">PHP 560.00</p>
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

                        <input type="hidden" name="product_id" value="9">
                        <input type="hidden" name="price" value="560.00">

                        <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                            Reserve Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tourism Vest -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                        <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                            <img src="../../assets/images/tourismVest.jpg" alt="Tourism Vest" class="w-full h-full object-cover mix-blend-multiply">
                        </div>

                        <div class="px-2.5 mb-4">
                            <p class="font-medium text-base">Tourism Vest</p>
                            <p class="text-gray-500 text-sm my-1">Uniform</p>
                            <p class="font-medium mt-2">PHP 560.00</p>
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

                            <input type="hidden" name="product_id" value="5">
                            <input type="hidden" name="price" value="560.00">

                            <button type="submit" name="reserve_submit" class="w-full bg-[#111] text-white py-3 rounded-full font-medium hover:bg-gray-800 transition-colors">
                                Reserve Now
                            </button>
                        </div>
                    </form>
                </div>

            <!-- Tourism Men's Coat -->
            <div class="group bg-white pb-5 transition-transform duration-200 hover:-translate-y-1">
                <form action="viewReservedItems.php" method="POST" class="flex flex-col h-full">
                        <div class="bg-neutral-100 aspect-square flex items-center justify-center overflow-hidden relative mb-3">
                            <img src="../../assets/images/tourismMCoat.jpg" alt="Tourism Men's Coat" class="w-full h-full object-cover mix-blend-multiply">
                        </div>

                        <div class="px-2.5 mb-4">
                            <p class="font-medium text-base">Tourism Men's Coat</p>
                            <p class="text-gray-500 text-sm my-1">Uniform</p>
                            <p class="font-medium mt-2">PHP 560.00</p>
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

                            <input type="hidden" name="product_id" value="6">
                            <input type="hidden" name="price" value="1260.00">

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