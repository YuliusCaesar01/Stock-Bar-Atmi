<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($number)
    {
        // Ensure the input is numeric, otherwise default to 0
        $number = is_numeric($number) ? (float) $number : 0;

        return 'Rp. ' . number_format($number, 0, ',', '.');
    }
}
