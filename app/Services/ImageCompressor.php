<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageCompressor
{
    /**
     * Compress, resize, and save an uploaded image file.
     *
     * @param  UploadedFile  $file
     * @param  string  $destinationSubdir  e.g. 'uploads/products'
     * @param  string  $baseName           e.g. 'sobek-pisang'
     * @param  int     $maxDimension       maximum width/height edge in pixels (default 800)
     * @param  int     $quality            compression quality 1-100 (default 80)
     * @return string                      relative path to the saved file e.g. 'uploads/products/123456_sobek-pisang.webp'
     */
    public static function compressAndSave(UploadedFile $file, string $destinationSubdir, string $baseName = 'image', int $maxDimension = 800, int $quality = 80): string
    {
        $targetDir = public_path($destinationSubdir);
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $filename = time() . '_' . Str::slug($baseName) . '.webp';
        $fullPath = $targetDir . '/' . $filename;
        $relativePath = trim($destinationSubdir, '/') . '/' . $filename;

        $tempPath = $file->getRealPath();

        // 1. Load image resource into memory using native GD
        $imageData = file_get_contents($tempPath);
        if (!$imageData) {
            // Fallback if GD fails to read
            $file->move($targetDir, $filename);
            return $relativePath;
        }

        $srcImage = @imagecreatefromstring($imageData);
        if (!$srcImage) {
            $file->move($targetDir, $filename);
            return $relativePath;
        }

        // 2. Fix smartphone EXIF orientation if available
        if (function_exists('exif_read_data')) {
            try {
                $exif = @exif_read_data($tempPath);
                if (!empty($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3:
                            $srcImage = imagerotate($srcImage, 180, 0);
                            break;
                        case 6:
                            $srcImage = imagerotate($srcImage, -90, 0);
                            break;
                        case 8:
                            $srcImage = imagerotate($srcImage, 90, 0);
                            break;
                    }
                }
            } catch (\Throwable $e) {
                // Ignore EXIF errors silently
            }
        }

        // 3. Calculate original & target dimensions (preserve aspect ratio)
        $origWidth = imagesx($srcImage);
        $origHeight = imagesy($srcImage);

        if ($origWidth > $maxDimension || $origHeight > $maxDimension) {
            if ($origWidth >= $origHeight) {
                $newWidth = $maxDimension;
                $newHeight = (int) round(($origHeight / $origWidth) * $maxDimension);
            } else {
                $newHeight = $maxDimension;
                $newWidth = (int) round(($origWidth / $origHeight) * $maxDimension);
            }

            $resizedImage = imagescale($srcImage, $newWidth, $newHeight, IMG_BESSEL);
            if ($resizedImage !== false) {
                imagedestroy($srcImage);
                $srcImage = $resizedImage;
            }
        }

        // 4. Save as WebP with specified quality
        if (function_exists('imagewebp')) {
            imagewebp($srcImage, $fullPath, $quality);
        } else {
            // Fallback to JPEG if WebP is unsupported
            $jpgPath = str_replace('.webp', '.jpg', $fullPath);
            imagejpeg($srcImage, $jpgPath, $quality);
            $relativePath = str_replace('.webp', '.jpg', $relativePath);
        }

        imagedestroy($srcImage);

        return $relativePath;
    }
}
