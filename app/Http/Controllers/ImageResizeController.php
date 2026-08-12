<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class ImageResizeController extends Controller
{
    /**
     * Resize and compress all images in public/img/products to WebP format,
     * save them to public/uploads/compressed, and update database image paths.
     */
    public function resizeAll()
    {
        $sourceDir = public_path('img/products');
        $targetDir = public_path('uploads/compressed');

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (!file_exists($sourceDir)) {
            return response()->json(['error' => 'Folder public/img/products tidak ditemukan.'], 404);
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($sourceDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        $results = [];
        $totalOriginalSize = 0;
        $totalCompressedSize = 0;

        foreach ($iterator as $file) {
            if ($file->isFile() && in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp'])) {
                $originalPath = $file->getPathname();
                $originalSize = filesize($originalPath);
                $totalOriginalSize += $originalSize;

                // Relative path in public, e.g. "img/products/roti/sobek coklat.jpg"
                $relativeSourcePath = str_replace(public_path() . DIRECTORY_SEPARATOR, '', $originalPath);
                $relativeSourcePath = str_replace('\\', '/', $relativeSourcePath);

                $filename = time() . '_' . Str::slug(pathinfo($originalPath, PATHINFO_FILENAME)) . '.webp';
                $destinationPath = $targetDir . '/' . $filename;
                $relativeDestinationPath = 'uploads/compressed/' . $filename;

                // Compress image using native GD
                $compressed = $this->compressImage($originalPath, $destinationPath, 800, 75);

                if ($compressed && file_exists($destinationPath)) {
                    $compressedSize = filesize($destinationPath);
                    $totalCompressedSize += $compressedSize;

                    // Update database records that use this image
                    Product::where('image', $relativeSourcePath)->update(['image' => $relativeDestinationPath]);
                    ProductCategory::where('image', $relativeSourcePath)->update(['image' => $relativeDestinationPath]);
                    Banner::where('image', $relativeSourcePath)->update(['image' => $relativeDestinationPath]);

                    $savings = $originalSize > 0 ? round((($originalSize - $compressedSize) / $originalSize) * 100, 1) : 0;

                    $results[] = [
                        'name' => $file->getFilename(),
                        'old_path' => $relativeSourcePath,
                        'new_path' => $relativeDestinationPath,
                        'old_size_formatted' => $this->formatBytes($originalSize),
                        'new_size_formatted' => $this->formatBytes($compressedSize),
                        'savings_percent' => $savings,
                    ];
                }
            }
        }

        $totalSavingsPercent = $totalOriginalSize > 0 
            ? round((($totalOriginalSize - $totalCompressedSize) / $totalOriginalSize) * 100, 1) 
            : 0;

        return view('public.resize_result', [
            'results' => $results,
            'total_original' => $this->formatBytes($totalOriginalSize),
            'total_compressed' => $this->formatBytes($totalCompressedSize),
            'total_savings' => $totalSavingsPercent,
            'total_files' => count($results),
        ]);
    }

    /**
     * Helper to compress image to WebP with native GD.
     */
    private function compressImage(string $sourcePath, string $destinationPath, int $maxDimension = 800, int $quality = 75): bool
    {
        $imageData = @file_get_contents($sourcePath);
        if (!$imageData) return false;

        $srcImage = @imagecreatefromstring($imageData);
        if (!$srcImage) return false;

        // Fix EXIF orientation if available
        if (function_exists('exif_read_data')) {
            try {
                $exif = @exif_read_data($sourcePath);
                if (!empty($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3: $srcImage = imagerotate($srcImage, 180, 0); break;
                        case 6: $srcImage = imagerotate($srcImage, -90, 0); break;
                        case 8: $srcImage = imagerotate($srcImage, 90, 0); break;
                    }
                }
            } catch (\Throwable $e) {}
        }

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

        $success = false;
        if (function_exists('imagewebp')) {
            $success = imagewebp($srcImage, $destinationPath, $quality);
        } else {
            $jpgPath = str_replace('.webp', '.jpg', $destinationPath);
            $success = imagejpeg($srcImage, $jpgPath, $quality);
        }

        imagedestroy($srcImage);
        return $success;
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
