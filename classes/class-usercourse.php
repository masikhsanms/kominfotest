<?php 
class userCourse
{
    protected $tb_usercourse = 'usercourse';
    protected $tb_users = 'users';
    protected $tb_courses = 'courses';

    function __construct()
    {
        $this->handle_form();
        $this->get_hapus_usercourse();
    }

    public function get_hapus_usercourse()
    {
        
        $action = $_POST['action'] ?? '';
        
        if( $action == 'get_hapus_usercourse' ){
            
            include '../koneksi.php';
            include 'class-sql.php';

            $id = $_POST['id'] ?? '';
            
            $db_usercourse = $this->tb_usercourse;
            $whereArr = ['id_user'=> base64_decode($id) ];
            $query = DB::deleteDB($db_usercourse,$whereArr);

            if( $query ){
                $return = ['msg' => 'success'];
            }else{
                $return = ['msg' => 'failed'];
            }

            echo json_encode( $return );
        }
    }

    public function list()
    {
        // $query = DB::showDB($db_course);
        $sql = "SELECT a.id_user, b.username,c.course,c.mentor,c.title FROM usercourse a JOIN users b ON b.id =a.id_user JOIN courses c ON c.id = a.id_course WHERE 1";
       
        $query = DB::customQuery($sql);

        return $query;
    }

    public function list_users()
    {
        $db_users = $this->tb_users;

        $query = DB::showDB($db_users);
       
        return $query;
    }

    public function list_courses()
    {
        $db_courses = $this->tb_courses;

        $query = DB::showDB($db_courses);
       
        return $query;
    }

    public function handle_form()
    {
        $db_usercourse = $this->tb_usercourse;

        $page   = $_GET['page'] ?? '';

        $action = $_POST['action'] ?? '';
        
        if( $page == 'pesertacourse' ): 

            $post_user = $_POST['id_user'] ?? '';
            $post_course = $_POST['id_course'] ?? '';

            $id_user = ucfirst( sanitasi_text($post_user) );
            $id_course = ucfirst( sanitasi_text($post_course) );
        
            if( !empty($action ) ){
                if( $action == 'tambah_data' ){
                                    
                    if(empty($id_user)){
                        $this->url_msg('User Tidak Boleh Kosong');
                        return false;
                    }

                    if(empty($id_course)){
                        $this->url_msg('Course Tidak Boleh Kosong');
                        return false;
                    }

                    $datas = compact('id_user','id_course');

                    # insert data
                    $query = DB::insertDB($db_usercourse,$datas);

                    if( $query ){
                        $this->url_success();
                    }else{
                        $this->url_failed();
                    }

                }else if($action == 'edit_data'){

                    $id = base64_decode( $_GET['id'] ) ?? '';
                    
                    if( empty($course) ){
                        $this->url_msg('Nama Daerah Tidak Boleh Kosong');
                        return false;
                    }
                    
                    $datas = compact('id_user','id_course');

                    $where = compact( 'id_user' );
                        
                    #update
                    $query = DB::updateDB($db_usercourse,$datas,$where);
                        
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
$usercourse = new userCourse();
?>