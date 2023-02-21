<?php

namespace App\Helpers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class HeroHelper extends Helper
{

    /**
     * define constant variable.
     */
    const FORMAT = 'jpg';
    const EXT = '.jpeg';
    const DIR = 'hero/';
    const SIZES = [
        'large' => ['width' => 1024, 'height' => 576, 'quality' => 75],
        'thumb' => ['width' => 320, 'height' => 180, 'quality' => 75],
        'small' => ['width' => 64, 'height' => 36, 'quality' => 85],
        'blur' => ['width' => 16, 'height' => 9, 'quality' => 20],
    ];

    /**
     * Generate hero name, upload new hero delete old hero.
     */
    public static function generate($img, $oldName = null): String
    {
        $name = parent::uniqueName();

        foreach (self::SIZES as $key => $size) {
            $tmp = Image::make($img)->fit($size['width'], $size['height'], function ($c) {
                $c->aspectRatio();
            });
            $newName = self::DIR . $name . '-' . $key . self::EXT;
            Storage::put($newName, (string) $tmp->encode(self::FORMAT, $size['quality']));
        }

        if ($oldName) {
            self::destroy($oldName);
        }

        return $name;
    }

    /**
     * Delete the hero.
     */
    public static function destroy($name): void
    {
        foreach (self::SIZES as $key => $size) {
            $newName = self::DIR . $name . '-' . $key . self::EXT;
            if (Storage::exists($newName)) {
                Storage::delete($newName);
            }
        }
    }

    /**
     * Get the hero urls.
     */
    public static function getUrl($name = null): array
    {
        $urls = [];
        foreach (self::SIZES as $key => $size) {
            if ($name) {
                $newName = self::DIR . $name . '-' . $key . self::EXT;
                $urls[$key] = Storage::url($newName);
            } else {
                $urls[$key] = asset('/img/placeholder/hero-' . $key . '.jpg');
            }
        }
        return $urls;
    }
}
