<?php



/** Handle File Upload */

function handleUpload($inputName, $model=null)
{
    try {
        if(request()->hasFile($inputName)) {

            if($model && \File::exists(public_path($model->{$inputName}))) {
                \File::delete(public_path($model->{$inputName}));
            }

            $file = request()->file($inputName);
            $fileName = rand().$file->getClientOriginalName();

            // Define o caminho correto para uploads, dependendo do ambiente
            if(app()->environment('production')){
                // caminho absoluto da pasta public_html no servidor
                $uploadPath = '/home/storage/7/66/ec/danqueiroz1/public_html/uploads';
            } else {
                // caminho local padrão (laravel/public)
                $uploadPath = public_path('uploads');
            }

            if(!file_exists($uploadPath)){
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $fileName);

            return "/uploads/".$fileName;
        }
    } catch(\Exception $e) {
        throw $e;
    }
}



/** Delete File */

function deleteFileIfExist($filePath)
{

    try {
        if(\File::exists(public_path($filePath))){
            \File::delete(public_path($filePath));
        }
    } catch(\Exception $e) {
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