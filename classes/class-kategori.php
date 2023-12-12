<?php 
class Kategori
{
    protected $tb_kategori = 'kategori';

    function __construct()
    {
        $this->handle_form();
        $this->get_hapus_kategori();
    }

    public function get_hapus_kategori()
    {
        
        $action = $_POST['action'] ?? '';
        
        if( $action == 'get_hapus_kategori' ){

            include 'class-sql.php';

            $id = $_POST['id'] ?? '';
            
            $db_kat = $this->tb_kategori;
            $whereArr = ['id_kategori'=> base64_decode($id) ];
            $query = DB::deleteDB($db_kat,$whereArr);

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
        $db_kat = $this->tb_kategori;

        $query = DB::showDB($db_kat);

        return $query;
    }

    public function handle_form()
    {
        $db_kat = $this->tb_kategori;

        $page   = $_GET['page'] ?? '';

        $action = $_POST['action'] ?? '';

        
        if( $page == 'kategori' ): 
            
            $post_ = $_POST['nama_kategori'] ?? '';
            $nama_kategori = ucfirst( sanitasi_text($post_) );
        
            if( !empty($action ) ){
                if( $action == 'tambah_data' ){
                                    
                    if(empty($nama_kategori)){
                        $this->url_msg('Nama Kategori Tidak Boleh Kosong');
                        return false;
                    }

                    $datas = compact('nama_kategori');
                    
                    # insert data
                    $query = DB::insertDB($db_kat,$datas);

                    if( $query ){
                        $this->url_success();
                    }else{
                        $this->url_failed();
                    }

                }else if($action == 'edit_data'){

                    $id_kategori = base64_decode( $_GET['id'] ) ?? '';
                    
                    if( empty($nama_kategori) ){
                        $this->url_msg('Nama Kategori Tidak Boleh Kosong');
                        return false;
                    }
                    
                    $datas = compact('nama_kategori');

                    $where = compact( 'id_kategori' );
                        
                    #update
                    $query = DB::updateDB($db_kat,$datas,$where);
                        
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
$kategori = new Kategori();
?>