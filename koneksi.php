<?php
class Koneksi
{
    
    function __construct()
    {
        $this->koneksi_mysqli();
    }

    public static function koneksi_mysqli()
    {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'sekolahku';

        $mysqli = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
        
        if($mysqli->connect_errno ) {
            printf("Connect failed: %s<br />", $mysqli->connect_error);
            exit();
        }
        
        return $mysqli;

        $mysqli->close();
        
    }
}
$koneksi = new Koneksi();
?>