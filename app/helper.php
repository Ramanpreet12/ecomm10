<?php
// use Image;

if (!function_exists('date_time_format')) {
   function date_time_format($date){
    return \Carbon\Carbon::parse($date)->format('j F , Y');
   }
}

// custom function to store image
if (!function_exists('store_image')) {
    function store_image($imageFile , $path){
            $image = request()->file($imageFile);
            $image_name = $image->getClientOriginalName();
            if (!is_dir(storage_path($path))) {
            mkdir(storage_path($path), 0775, true);
            }
            Image::make($image)->save(storage_path($path.$image_name));
         return $image_name;
    }
 }


 // custom function to store mulitple images
if (!function_exists('make_storage_dir')) {
    function make_storage_dir($storage_path){
        if (!is_dir(storage_path($storage_path))) {
            mkdir(storage_path($storage_path), 0775, true);
            }
            return $storage_path;
    }

}




 // custom function to unlink image or video from db
 if (!function_exists('unlink_image_video_from_db')) {
    function unlink_image_video_from_db($storage_path , $image_or_video){
        $image_video_to_be_deleted = $storage_path.$image_or_video;

      if (file_exists( $image_video_to_be_deleted)) {
       unlink( $image_video_to_be_deleted);
      }

            return $image_video_to_be_deleted;
    }

}



?>
