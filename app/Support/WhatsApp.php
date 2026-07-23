<?php

namespace App\Support;

use App\Models\Setting;

class WhatsApp
{
    public static function orderLink(string $productName, int|string $qty = 1): string
    {
        $template = Setting::get('wa_template') ?: 'Halo, saya ingin memesan {produk} sebanyak {jumlah}.';

        $message = str_replace(
            ['{produk}', '{jumlah}'],
            [$productName, (string) $qty],
            $template
        );

        return self::link($message);
    }

    public static function link(string $message): string
    {
        $number = preg_replace('/\D/', '', (string) Setting::get('wa_number'));

        return 'https://wa.me/'.$number.'?text='.rawurlencode($message);
    }
}
