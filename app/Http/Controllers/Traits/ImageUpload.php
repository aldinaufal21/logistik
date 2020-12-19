<?php

namespace App\Http\Controllers\Traits;

trait ImageUpload
{
    private function storeImages($file, $folder)
    {
        if(env('APP_ENV') == 'production'){
            return $this->localImageUpload($file, $folder);
        }

        // if local use this for default
        return $this->localImageUpload($file, $folder);
    }

    private function localImageUpload($file, $folder)
    {
        /* get File Extension */
        $extension = $file->getClientOriginalExtension();

        /* Your File Destination */
        $directoryTarget = 'images/' . $folder;
    
        /* unique Name for file */
        $filename = uniqid() . '.' . $extension;
    
        /* finally move file to your destination */
        $file->move($directoryTarget,  $filename);

        /** will output
         * http://localhost:8000/ + directory target + filename
         */
        return url('/') . '/' . $directoryTarget . '/' . $filename;
    }
}
