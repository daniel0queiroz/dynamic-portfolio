<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/** Handle File Upload */

/**
 * Extensions we know how to re-encode. Anything else (pdf, ico, svg, etc.)
 * is stored as-is, untouched.
 */
const OPTIMIZABLE_IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];

function handleUpload($inputName, $model = null, $maxWidth = 1920, $maxHeight = 1920, $quality = 82)
{
    try {
        if (request()->hasFile($inputName)) {

            if ($model && $model->{$inputName}) {
                $oldPath = normalizeUploadPath($model->{$inputName});
                if ($oldPath) {
                    Storage::disk('uploads')->delete($oldPath);
                }
            }

            $file = request()->file($inputName);
            $extension = strtolower($file->getClientOriginalExtension());
            $uuid = Str::uuid()->toString();

            // Re-encode raster images to WebP (smaller than JPEG/PNG at equivalent
            // quality) — this is what actually gets served, not just resized originals.
            $optimized = null;
            $finalExtension = $extension;
            if ($maxWidth && in_array($extension, OPTIMIZABLE_IMAGE_EXTENSIONS, true)) {
                try {
                    $manager = new ImageManager(new Driver());
                    $encoded = (string) $manager->read($file->getRealPath())
                        ->scaleDown($maxWidth, $maxHeight)
                        ->toWebp(quality: $quality);

                    // Only keep the re-encoded version if it actually saved bytes —
                    // GD can bloat already-optimized/graphic-heavy images otherwise.
                    if (strlen($encoded) < $file->getSize()) {
                        $optimized = $encoded;
                        $finalExtension = 'webp';
                    }
                } catch (\Throwable $e) {
                    // Unsupported codec (e.g. GD built without WebP) or unreadable
                    // image — fall back to storing the original untouched.
                    $optimized = null;
                }
            }

            $fileName = $uuid . ($finalExtension ? '.' . $finalExtension : '');

            if ($optimized !== null) {
                Storage::disk('uploads')->put($fileName, $optimized);
            } else {
                Storage::disk('uploads')->putFileAs('', $file, $fileName);
            }

            return 'uploads/' . $fileName;
        }
    } catch (\Exception $e) {
        throw $e;
    }
}





/** Delete File */

function deleteFileIfExist($fileName)
{
    try {
        $path = normalizeUploadPath($fileName);
        if ($path) {
            Storage::disk('uploads')->delete($path);
        }
    } catch (\Exception $e) {
        throw $e;
    }
}

/**
 * Normalize a stored upload path or URL into a disk-relative path.
 */
function normalizeUploadPath($value)
{
    if (empty($value)) {
        return null;
    }

    $path = $value;
    $parsed = parse_url($value);
    if (is_array($parsed) && isset($parsed['path'])) {
        $path = $parsed['path'];
    }

    $path = ltrim($path, '/');
    if (Str::startsWith($path, 'uploads/')) {
        $path = Str::after($path, 'uploads/');
    }

    return $path ?: null;
}

/**
 * Strip trailing <br> tags (and the whitespace around them) left over from
 * rich text editors — otherwise a lone <br> right before a closing tag pushes
 * any CSS-generated content (e.g. a closing quote mark) onto its own line.
 */
function stripTrailingLineBreaks($value)
{
    if (is_array($value)) {
        return array_map('stripTrailingLineBreaks', $value);
    }

    if (!is_string($value)) {
        return $value;
    }

    $value = preg_replace('/(\s|<br\s*\/?>)+(<\/p>)\s*$/i', '$2', $value);
    $value = preg_replace('/(\s|<br\s*\/?>)+$/i', '', $value);

    return $value;
}

/**
 * Drop empty-string locale entries from a translatable field's input array
 * before assigning it to a model.
 *
 * Spatie\Translatable's setTranslations() re-reads getTranslations() (which
 * filters out empty/null values) on every locale it iterates — so passing an
 * array with several empty-string locales causes each iteration to "forget"
 * the previously-set-but-empty ones, leaving only the last-processed locale
 * in the stored JSON. Filtering first avoids ever feeding it an empty value.
 */
function filterTranslatableInput($value)
{
    if (!is_array($value)) {
        return $value;
    }

    return array_filter($value, fn($v) => filled($v));
}

/** Get Dynamic Colors */

function getColor($index)
{
    $colors = ['#558bff', '#fecc90', '#ff885e', '#282828', '#190844', '#9dd3ff'];

    return $colors[$index % count($colors)];
}

/** Set Sidebar Active */

function setSidebarActive($route)
{
    if(is_array($route)){
        foreach ($route as $r) {
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}
