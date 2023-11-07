<?php

if (!function_exists('date_time_format')) {
   function date_time_format($date){
    return \Carbon\Carbon::parse($date)->format('j F , Y');
   }
}
?>
