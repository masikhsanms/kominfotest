<?php
class Login
{
    function __construct()
    {
        $this->cek_login();
    }   

    public function cek_login()
    {
        if( !empty($_POST) ){
            
            // session_start();
             if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 
            include 'koneksi.php';
            include 'class-sql.php';

            $email      = $_POST['email'];
            $password   = $_POST['password'];
            $level      = $_POST['level'];

            $andwhere=" AND email='".$email."' AND password='".$password."' AND level='".$level."' ";
            $data = DB::showDB('users',$andwhere); 

            $cek = mysqli_num_rows($data);

            if($cek > 0){
                $_SESSION['email']  = $email;
                $_SESSION['status'] = "login";
                $_SESSION['level']  = $level;
                header("location:index.php");
            }else{
                header("location:login.php?pesan=gagal");
            }
        }
    }

    public function profil()
    {
        $andwhere=" AND email='".$_SESSION['email']."'";
        $data = DB::getRowDB('users',$andwhere); 
        return $data;
    }
}
$login = new Login();
?>