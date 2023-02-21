<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AvatarHelper extends Helper
{

    /**
     * define constant variable.
     */
    const FORMAT = 'jpg';
    const EXT = '.jpeg';
    const SIZE = 150;
    const QUALITY = 80;
    const DIR = 'avatar/';

    /**
     * Generate avatar name, upload new avatar delete old avatar.
     */
    public static function generate($img, $oldName = null): String
    {
        if ($oldName) {
            self::destroy($oldName);
        }

        $name = parent::uniqueName(self::EXT);
        $tmp = Image::make($img)->fit(self::SIZE, self::SIZE, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put(self::DIR . $name, (string) $tmp->encode(self::FORMAT, self::QUALITY));

        return $name;
    }

    /**
     * Delete avatar.
     */
    public static function destroy($name = null): void
    {
        if ($name && Storage::exists(self::DIR . $name)) {
            Storage::delete(self::DIR . $name);
        }
    }

    /**
     * Get the avatar url.
     */
    public static function getUrl($name): String
    {
        if (!$name) {
            return asset('img/placeholder/avatar.png');
        }
        return Storage::url(self::DIR . $name);
    }
}
