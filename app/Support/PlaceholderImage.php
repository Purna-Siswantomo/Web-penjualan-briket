<?php

namespace App\Support;

class PlaceholderImage
{
    protected const FONT_BOLD = 'C:\Windows\Fonts\arialbd.ttf';

    protected const PALETTES = [
        'padi' => ['#e9c46a', '#8a5a2b'],
        'char' => ['#57534e', '#1c1917'],
        'amber' => ['#d97706', '#5b3a1a'],
        'dawn' => ['#f4a261', '#6b3e26'],
        'ash' => ['#78716c', '#292524'],
    ];

    public static function product(string $relativePath, string $label, string $palette = 'char'): void
    {
        $width = 900;
        $height = 900;
        $image = imagecreatetruecolor($width, $height);

        self::gradient($image, $width, $height, ...self::PALETTES[$palette]);
        self::briketPile($image, $width, $height, $label);
        self::labelBar($image, $width, $height, $label);

        self::save($image, $relativePath);
    }

    public static function categoryIcon(string $relativePath): void
    {
        $size = 400;
        $image = imagecreatetruecolor($size, $size);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $transparent);

        [$r, $g, $b] = self::hexToRgb('#d97706');
        $bg = imagecolorallocate($image, $r, $g, $b);
        imagefilledellipse($image, $size / 2, $size / 2, $size - 10, $size - 10, $bg);

        self::flame($image, $size / 2, $size / 2, $size * 0.34, '#2b1a0e');

        self::save($image, $relativePath);
    }

    public static function banner(string $relativePath, string $palette = 'char'): void
    {
        $width = 1600;
        $height = 700;
        $image = imagecreatetruecolor($width, $height);

        self::gradient($image, $width, $height, ...self::PALETTES[$palette]);
        self::briketPile($image, $width, $height, 'banner');

        self::save($image, $relativePath);
    }

    public static function gallery(string $relativePath, string $palette, string $seed): void
    {
        $width = 900;
        $height = 650;
        $image = imagecreatetruecolor($width, $height);

        self::gradient($image, $width, $height, ...self::PALETTES[$palette]);
        self::briketPile($image, $width, $height, $seed);

        self::save($image, $relativePath);
    }

    public static function about(string $relativePath): void
    {
        $width = 1200;
        $height = 800;
        $image = imagecreatetruecolor($width, $height);

        self::gradient($image, $width, $height, ...self::PALETTES['dawn']);
        self::briketPile($image, $width, $height, 'about');

        self::save($image, $relativePath);
    }

    public static function logo(string $relativePath): void
    {
        self::categoryIcon($relativePath);
    }

    public static function avatar(string $relativePath, string $name): void
    {
        $size = 300;
        $image = imagecreatetruecolor($size, $size);

        $hue = crc32($name) % 360;
        [$r, $g, $b] = self::hslToRgb($hue / 360, 0.45, 0.4);
        $bg = imagecolorallocate($image, $r, $g, $b);
        imagefilledrectangle($image, 0, 0, $size, $size, $bg);

        $initial = mb_strtoupper(mb_substr($name, 0, 1));
        $white = imagecolorallocate($image, 255, 255, 255);
        $box = imagettfbbox(80, 0, self::FONT_BOLD, $initial);
        $textWidth = abs($box[4] - $box[0]);
        $textHeight = abs($box[5] - $box[1]);
        imagettftext($image, 80, 0, (int) (($size - $textWidth) / 2), (int) (($size + $textHeight) / 2), $white, self::FONT_BOLD, $initial);

        self::save($image, $relativePath);
    }

    protected static function gradient($image, int $width, int $height, string $topHex, string $bottomHex): void
    {
        [$r1, $g1, $b1] = self::hexToRgb($topHex);
        [$r2, $g2, $b2] = self::hexToRgb($bottomHex);

        for ($y = 0; $y < $height; $y++) {
            $ratio = $y / $height;
            $r = (int) ($r1 + ($r2 - $r1) * $ratio);
            $g = (int) ($g1 + ($g2 - $g1) * $ratio);
            $b = (int) ($b1 + ($b2 - $b1) * $ratio);
            $color = imagecolorallocate($image, $r, $g, $b);
            imageline($image, 0, $y, $width, $y, $color);
        }
    }

    protected static function briketPile($image, int $width, int $height, string $seed): void
    {
        mt_srand(crc32($seed));

        $count = (int) ($width * $height / 60000);
        $baseY = $height * 0.55;

        for ($i = 0; $i < $count; $i++) {
            $cx = mt_rand(0, $width);
            $cy = mt_rand((int) $baseY, $height + 40);
            $radius = mt_rand((int) ($width * 0.03), (int) ($width * 0.075));

            $shade = mt_rand(18, 34);
            $dark = imagecolorallocate($image, $shade, (int) ($shade * 0.85), (int) ($shade * 0.75));
            imagefilledellipse($image, $cx, $cy, $radius * 2, $radius * 1.6, $dark);

            $hl = mt_rand($shade + 12, $shade + 28);
            $highlight = imagecolorallocate($image, $hl, (int) ($hl * 0.85), (int) ($hl * 0.7));
            imagefilledellipse($image, (int) ($cx - $radius * 0.3), (int) ($cy - $radius * 0.35), (int) ($radius * 0.9), (int) ($radius * 0.6), $highlight);
        }

        mt_srand();
    }

    protected static function labelBar($image, int $width, int $height, string $label): void
    {
        imagealphablending($image, true);
        $barHeight = (int) ($height * 0.16);
        $barColor = imagecolorallocatealpha($image, 0, 0, 0, 45);
        imagefilledrectangle($image, 0, $height - $barHeight, $width, $height, $barColor);

        $white = imagecolorallocate($image, 255, 255, 255);
        $fontSize = 28;
        $wrapped = wordwrap($label, 22, "\n", true);
        $lines = explode("\n", $wrapped);
        $lineHeight = $fontSize + 10;
        $startY = $height - ($barHeight / 2) - ((count($lines) - 1) * $lineHeight / 2) + ($fontSize / 2);

        foreach ($lines as $index => $line) {
            $box = imagettfbbox($fontSize, 0, self::FONT_BOLD, $line);
            $textWidth = abs($box[4] - $box[0]);
            $x = (int) (($width - $textWidth) / 2);
            $y = (int) ($startY + $index * $lineHeight);
            imagettftext($image, $fontSize, 0, $x, $y, $white, self::FONT_BOLD, $line);
        }
    }

    protected static function flame($image, float $cx, float $cy, float $size, string $hex): void
    {
        [$r, $g, $b] = self::hexToRgb($hex);
        $color = imagecolorallocate($image, $r, $g, $b);

        $points = [
            $cx, $cy - $size,
            $cx + $size * 0.55, $cy - $size * 0.1,
            $cx + $size * 0.35, $cy + $size * 0.15,
            $cx + $size * 0.5, $cy + $size * 0.75,
            $cx, $cy + $size,
            $cx - $size * 0.5, $cy + $size * 0.75,
            $cx - $size * 0.35, $cy + $size * 0.15,
            $cx - $size * 0.55, $cy - $size * 0.1,
        ];

        imagefilledpolygon($image, $points, $color);
    }

    protected static function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');

        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }

    protected static function hslToRgb(float $h, float $s, float $l): array
    {
        if ($s === 0.0) {
            $v = (int) ($l * 255);

            return [$v, $v, $v];
        }

        $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
        $p = 2 * $l - $q;

        $hue2rgb = function ($p, $q, $t) {
            if ($t < 0) {
                $t += 1;
            }
            if ($t > 1) {
                $t -= 1;
            }
            if ($t < 1 / 6) {
                return $p + ($q - $p) * 6 * $t;
            }
            if ($t < 1 / 2) {
                return $q;
            }
            if ($t < 2 / 3) {
                return $p + ($q - $p) * (2 / 3 - $t) * 6;
            }

            return $p;
        };

        return [
            (int) round($hue2rgb($p, $q, $h + 1 / 3) * 255),
            (int) round($hue2rgb($p, $q, $h) * 255),
            (int) round($hue2rgb($p, $q, $h - 1 / 3) * 255),
        ];
    }

    protected static function save($image, string $relativePath): void
    {
        $fullPath = storage_path('app/public/'.$relativePath);

        if (! is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        imagejpeg($image, $fullPath, 85);
        imagedestroy($image);
    }
}
