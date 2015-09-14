<?php
Class Photos extends CI_Model{

  function __contruct(){
    parent::__contruct();
  }
 
  function get_all_photos( $path , $cdn_path , $folio_id){
    
    $images_list = array();
    $dir_images_path = $path . "/" . $folio_id . "/images/";
    if ($handle = opendir( $dir_images_path )) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $images_list[] = $cdn_path.$folio_id.'/images/'.$entry;
        }
    }
    closedir($handle);

    return $images_list;
}
    
 }
}
?>