<?php

use Illuminate\Support\Facades\Storage;

/** Handle File Upload */


function handleUpload($inputName, $model = null)
{
    try {
        if (request()->hasFile($inputName)) {

            if ($model && $model->{$inputName}) {
                Storage::disk('uploads')->delete($model->{$inputName});
            }

            $file = request()->file($inputName);
            $fileName = rand() . $file->getClientOriginalName();

            Storage::disk('uploads')->putFileAs('', $file, $fileName);

            $appUrl = rtrim(env('APP_URL'), '/');
            return $appUrl . '/uploads/' . $fileName;
        }
    } catch (\Exception $e) {
        throw $e;
    }
}





/** Delete File */

function deleteFileIfExist($fileName)
{
    try {
        Storage::disk('uploads')->delete($fileName);
    } catch (\Exception $e) {
        throw $e;
    }
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