<?php

use App\Models\Service;
use App\Models\Page;


function getServices(){
    return Service::orderBy('name', 'ASC')
    ->where('status', 'active')
    ->where('showHome', 'Yes')
    ->get();
}
function Pages () {
    $pages = Page::orderBy('name', 'ASC')->get();
    return $pages;
}

if (!function_exists('uploadImage')) {
    function uploadImage($image, $path = 'uploads/', $oldImage = null)
    {
        if ($image) {
            // Delete old image if exists
            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);

            return $path . $imageName;
        }

        return null;
    }
}



?>