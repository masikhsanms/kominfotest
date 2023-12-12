<?php 
class Course
{
    protected $tb_course = 'courses';

    function __construct()
    {
        $this->handle_form();
        $this->get_hapus_course();
    }

    public function get_hapus_course()
    {
        
        $action = $_POST['action'] ?? '';
        
        if( $action == 'get_hapus_course' ){
            
            include '../koneksi.php';
            include 'class-sql.php';

            $id = $_POST['id'] ?? '';
            
            $db_course = $this->tb_course;
            $whereArr = ['id'=> base64_decode($id) ];
            $query = DB::deleteDB($db_course,$whereArr);

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
        $db_course = $this->tb_course;

        $query = DB::showDB($db_course);

        return $query;
    }

    public function handle_form()
    {
        $db_course = $this->tb_course;

        $page   = $_GET['page'] ?? '';

        $action = $_POST['action'] ?? '';
        
        if( $page == 'course' ): 

            $post_course = $_POST['nama_course'] ?? '';
            $post_mentor = $_POST['mentor'] ?? '';
            $post_title = $_POST['title'] ?? '';

            $course = ucfirst( sanitasi_text($post_course) );
            $mentor = ucfirst( sanitasi_text($post_mentor) );
            $title = $post_title;
        
            if( !empty($action ) ){
                if( $action == 'tambah_data' ){
                                    
                    if(empty($course)){
                        $this->url_msg('Course Tidak Boleh Kosong');
                        return false;
                    }

                    if(empty($mentor)){
                        $this->url_msg('Mentor Tidak Boleh Kosong');
                        return false;
                    }

                    if(empty($title)){
                        $this->url_msg('Title Tidak Boleh Kosong');
                        return false;
                    }

                    $datas = compact('course','mentor','title');

                    # insert data
                    $query = DB::insertDB($db_course,$datas);

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
                    
                    $datas = compact('course','mentor','title');

                    $where = compact( 'id' );
                        
                    #update
                    $query = DB::updateDB($db_course,$datas,$where);
                        
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
$course = new Course();
?>