<?php
class DB
{
    public static function insertDB($tabel,$paramsArr)
    {
        $key = array_keys($paramsArr);
        $val = array_values($paramsArr);

        $sql = "INSERT INTO $tabel (" . implode(', ', $key) . ") "
            . "VALUES ('" . implode("', '", $val) . "')";
    
        $query = Koneksi::koneksi_mysqli()->query($sql);

        return $query;

    }

    public static function showDB($tabel,$andwhere="")
    {
        $sql = "SELECT * FROM $tabel WHERE 1 ".$andwhere;

        $query = Koneksi::koneksi_mysqli()->query($sql);

        return $query;
    }

    public static function getRowDB($tabel,$andwhere="")
    {
        $sql = "SELECT * FROM $tabel WHERE 1 ".$andwhere;

        $query = Koneksi::koneksi_mysqli()->query($sql);

        $get_row = $query->fetch_assoc();

        return $get_row;
    }

    public static function updateDB($tabel,$paramsArr,$whereArr)
    {

        $setParams = [];
        foreach( $paramsArr as $key => $value ){
            $setParams[]= $key.'='.'"'.$value.'"';
        }

        $datas = [];
        foreach( $whereArr as $key_where => $row ){     
                $datas[] = $key_where.'='.'"'.$row.'"';
        }
        $andwhere = implode(' AND ',$datas);

        $sql = "UPDATE $tabel SET ".implode(', ', $setParams)." WHERE $andwhere ";
    
        $query = Koneksi::koneksi_mysqli()->query($sql);

        return $query;

    }

    public static function deleteDB($tabel,$whereArr)
    {
        // include '../koneksi.php';
        $datas = [];
        foreach( $whereArr as $key_where => $row ){     
                $datas[] = $key_where.'='.'"'.$row.'"';
        }
        $andwhere = implode(',',$datas);

        $sql = "DELETE FROM $tabel WHERE $andwhere ";
    
        $query = Koneksi::koneksi_mysqli()->query($sql);

        return $query;

    }

    public static function customQuery($sql)
    {
        $query = Koneksi::koneksi_mysqli()->query($sql);

        return $query;
    }

}
$db = new DB();