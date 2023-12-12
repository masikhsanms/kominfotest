<?php 
class Users
{
    protected $tb_user = 'users';

    function __construct()
    {
        $this->handle_form();
        $this->get_hapus_user();
    }

    public function get_hapus_user()
    {
        
        $action = $_POST['action'] ?? '';
        
        if( $action == 'get_hapus_user' ){

            include '../koneksi.php';
            include 'class-sql.php';

            $id = $_POST['id'] ?? '';
            
            $db_user = $this->tb_user;
            $whereArr = ['id'=> base64_decode($id) ];
            $query = DB::deleteDB($db_user,$whereArr);

            if( $query ){
                $return = ['msg' => 'success'];
            }else{
                $return = ['msg' => 'failed'];
            }

            echo json_encode( $return );
        }
    }

    public function list_user()
    {
        $db_user = $this->tb_user;

        $query = DB::showDB($db_user);

        return $query;
    }

    public function get_userlogin($email)
    {
        $db_user = $this->tb_user;

        $andwhere = " AND email='".$email."'";

        $query = DB::getRowDB($db_user,$andwhere);

        return $query;
    }

    public function handle_form()
    {
        $db_user = $this->tb_user;

        $page   = $_GET['page'] ?? '';

        $action = $_POST['action'] ?? '';

        
        if( $page == 'users' ): 
            
            $pass = $_POST['password'] ?? '';
            $pass_konfirm = $_POST['pass-konfirmasi'] ?? '';
            $password  = sanitasi_text($pass);
            $pass_konfirmasi = sanitasi_text($pass_konfirm);
    
            $email  = $_POST['email'] ?? '';
            $username   = $_POST['nama'] ?? '';
            $level   = $_POST['level'] ?? '';
        
            if( !empty($action ) ){
                if( $action == 'tambah_data' ){
                                    
                    if($password != $pass_konfirmasi){
                        $this->url_msg('Password Tidak Sama');
                        return false;
                    }

                    $datas = compact('username','email','password','level');

                    # insert data
                    $query = DB::insertDB($db_user,$datas);

                    if( $query ){
                        $this->url_success();
                    }else{
                        $this->url_failed();
                    }

                }else if($action == 'edit_data'){

                    $id = base64_decode( $_GET['id'] ) ?? '';
                    
                    if( !empty($password) AND empty($pass_konfirmasi) ){
                        $this->url_msg('Password Konfirmasi Tidak Boleh Kosong');
                        return false;
                    }elseif( empty($password) AND !empty($pass_konfirmasi)){
                        $this->url_msg('Password Tidak Boleh Kosong');
                        return false;
                    }elseif($password != $pass_konfirmasi){
                        $this->url_msg('Password Tidak Sama');
                        return false;
                    }
                        
                    if( empty($password) AND empty($pass_konfirmasi) ){
                        $datas = compact('username','email','level');
                    }else{
                        $datas = compact('username','email','password','level');
                    }
                        
                    $where = compact( 'id' );
                        
                    #update
                    $query = DB::updateDB($db_user,$datas,$where);
                        
                    if( $query ){
                        $this->url_success();
                    }else{
                        $this->url_failed();
                    }

                }

            }

        endif;
    }

    public function url_success()
    {
        $page   = $_GET['page'] ?? '';
        $act    = $_GET['act'] ?? '';

        redirect_url('?page='.$page.'&msg=success');
    }

    public function url_failed()
    {
        $page   = $_GET['page'] ?? '';
        $act    = $_GET['act'] ?? '';
        
        redirect_url('?page='.$page.'&act='.$act.'&msg=error');
    }

    public function url_msg($pesan)
    {
        $page   = $_GET['page'] ?? '';
        $act    = $_GET['act'] ?? '';
        
        $params = '';
        if( isset($_GET['id']) ){
            $id = $_GET['id'] ?? '';
            $params = '&id='.$id;
        }

        redirect_url('?page='.$page.'&act='.$act.$params.'&msg='.$pesan);
    }
}
$users = new Users();
?>