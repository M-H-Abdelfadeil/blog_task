<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


if(!function_exists('uploadSingleFile')){
     /**
     * upload single image
     *
     * @param string $dir
     * @param  $file
     *
     * @return string $filename
     */

    function uploadSingleFile(string $dir  , $file){

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }
        //$note_img = Image::make($file)->stream();
        $extenstion= $file->getClientOriginalExtension();
        $file_name = 'image_for_web'.randomNameFile() .".". $extenstion;

        Storage::disk('public')->putFileAs($dir ."/", $file,$file_name);
        return $file_name;
    }
}


if (!function_exists('randomNameFile')) {
    /**
     *  rmake random string unique
     * @return string
     */
    function randomNameFile(){
        return Str::random(20).time();
    }

}
if (!function_exists('deleteFile')) {
    /**
     * delete file
     *
     * @param string $dir
     * @param string $filename
     *
     * @return bool
     */
    function deleteFile(string $dir , string  $filename){
        if (Storage::disk('public')->exists($dir.'/' . $filename)) {
            Storage::disk('public')->delete($dir.'/' . $filename);
            return true;
        }else{
            return false;
        }
    }
}


