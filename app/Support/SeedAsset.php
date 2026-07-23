<?php

namespace App\Support;

class SeedAsset
{
    /**
     * Copy a real photo bundled in resources/images/seeders into the public storage disk.
     */
    public static function copy(string $sourceFile, string $targetRelativePath): string
    {
        $source = resource_path('images/seeders/'.$sourceFile);
        $destination = storage_path('app/public/'.$targetRelativePath);

        if (! is_dir(dirname($destination))) {
            mkdir(dirname($destination), 0755, true);
        }

        copy($source, $destination);

        return $targetRelativePath;
    }
}
