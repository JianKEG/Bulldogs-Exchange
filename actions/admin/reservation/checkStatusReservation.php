<?php
    $status_label = $row['status'];
    $status = $row['status'];

    if ($status_label === null || $status_label === '') {
        $status_label = 'Pending';
    }
    $status_value = strtolower($status_label);
    $status_class = 'bg-gray-100 text-gray-700';
    if ($status_value === 'pending') {
        $status_class = 'bg-yellow-100 text-yellow-800';
    } elseif ($status_value === 'claimed') {
        $status_class = 'bg-green-100 text-green-700';
    } else {
        $status_class = '';
    }
?>