<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require '../../config/accessController.php';
    include('../../includes/admin/header.html');

    $page_title = "Reservations";

    require '../../actions/admin/reservation/searchReservation.php';
    require '../../actions/admin/reservation/filterReservation.php';
    
    if (!isset($result) || (isset($_POST['search']) && trim($_POST['search']) === '') || (isset($_POST['status']) && $_POST['status'] === 'all')) {
        require '../../actions/admin/reservation/reservation.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/output.css">
    <title>Document</title>
</head>
    <body>
         <div class="flex">
            <?php include('../../includes/admin/sidebar.html'); ?>
            
            <main id="main-content" class="flex-1 p-8 bg-gray-50 text-center">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Reservation Management</h1>
                </div>

                <div class="mb-4 flex flex-col items-center gap-3 sm:flex-row sm:justify-center">
                    <div class="relative w-full sm:w-auto">
                        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </span>
                            <form method="POST">
                                <input
                                    type="text"
                                    name="search"
                                    value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>"
                                    placeholder="Search Student ID..."
                                    class="w-full sm:w-64 rounded-lg border border-gray-300 py-2 pl-10 pr-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none"
                                />
                            </form>
                    </div>
                    <div class="flex items-center gap-2">
                        <form method="POST">
                            <button type="submit" name="status" value="pending" class="rounded-lg bg-yellow-100 px-3 py-2 text-sm font-medium text-yellow-800 hover:bg-yellow-200 transition cursor-pointer">
                                Pending
                            </button>

                            <button type="submit" name="status" value="claimed" class="rounded-lg bg-green-100 px-3 py-2 text-sm font-medium text-green-700 hover:bg-green-200 transition cursor-pointer">
                                Claimed
                            </button>

                            <button type="submit" name="status" value="all" class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition cursor-pointer">
                                All
                            </button>
                        </form>
                    </div>
                </div>

                <div class="inline-block bg-white rounded-lg shadow-sm border border-gray-200 overflow-x-auto">
                    <table class="divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-900">Student ID</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-900">Product Name</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-900">Category</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-900">Size</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-900">Quantity</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-900">Reservation Date</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-900">Status</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) {
                            require '../../actions/admin/reservation/checkStatusReservation.php';
                        ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900"><?php echo $row['student_id']; ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo $row['product_name']; ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo $row['category']; ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo $row['size']; ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo $row['quantity']; ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?php echo $row['reservation_date']; ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium <?php echo $status_class; ?>">
                                        <?php echo $status_label; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <?php if ($status_value === 'pending') { ?>
                                        <a href="../../actions/admin/reservation/claimReservation.php?id=<?php echo $row['reservation_id']; ?>" class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 transition">
                                            Mark as Claimed
                                        </a>
                                    <?php } elseif ($status_value === 'claimed') { ?>
                                        <a href="../../actions/admin/reservation/deleteReservation.php?id=<?php echo $row['reservation_id']; ?>" class="inline-flex items-center text-red-600 hover:text-red-800 transition" onclick="return confirm('Delete this claimed reservation?')">
                                            <svg class="h-5.5 w-5.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </a>
                                    <?php } else { ?>
                                        <span class="text-gray-500">--</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </body>
</html>