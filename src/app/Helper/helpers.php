<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/** Handle File Upload */


function handleUpload($inputName, $model = null)
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
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::uuid()->toString() . ($extension ? '.' . $extension : '');

            Storage::disk('uploads')->putFileAs('', $file, $fileName);

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
