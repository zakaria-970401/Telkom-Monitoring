<?php

if(!function_exists('formatUangIndonesia'))
{
    function formatUangIndonesia($angka)
    {
        return "Rp. ".number_format($angka, 0, ',', '.');
    }
}
