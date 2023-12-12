<?php
function select_level_user( $level_selected="" ){
    $opt = '<option value="">Pilih</option>';
    foreach(data_level() as $level){
        $selected = $level_selected == $level ? 'selected' : '';
        $opt .= '<option value="'.$level.'" '.$selected.'>'.ucfirst( $level ).'</option>';
    }
    return $opt;
}

function data_level(){
    $level = ['admin','user'];
    return $level;
}
?>