<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    /**
     * Handle the image upload process.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string|null
     */
    public function uploadImage($file,$folder = 'images')
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->move(public_path($folder), $filename);
        // Return the full path
        return asset($folder . '/' . $filename);
    }
}

?>