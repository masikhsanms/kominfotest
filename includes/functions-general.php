<?php 
function base_url(){
    $url_root = $_SERVER['DOCUMENT_ROOT'];
    $base_folder_web = str_replace('index.php','', $_SERVER['PHP_SELF']);
    return $url_root.$base_folder_web;
}

function path_url()
{
    return strtok($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'], '?');
}

function EMACalculator($limit,$array)
{
    $EMA_previous_day = $array[0];
    //print_r($array);
    $multiplier1 = (2/$limit+1);
    $EMA[]=array();
    $EMA = $array[0];
    $Close= $array[1];
   
    while($limit)
{   
    //echo"EMA is $EMA\n";
    $EMA = ($Close - $EMA_previous_day) * $multiplier1 + $EMA_previous_day;
    $EMA_previous_day= $EMA;
   
    $limit--;
}
return $EMA;
}

function sanitasi_text($string){
    return preg_replace('/[^\p{L}\p{N}\s]/u', '', $string);
}

function redirect_url($newURL=""){
    $url = empty( $newURL ) ? base_url() : $newURL ;
    header('Location: '.$url);

}

function get_kecamatan(){
    global $daerah;
    return $daerah->list();
}

function get_nama_kecamatan($id_daerah){
    $tb_daerah  = 'daerah';
    $andwhere = " AND id_daerah='".$id_daerah."'"; 
    $getrow = (object) DB::getRowDB($tb_daerah,$andwhere); 
    return $getrow->nama_daerah;
}

function indonesia_time(){
    date_default_timezone_set("Asia/Bangkok");
    return date('Y-m-d H:i:s');
}

?>