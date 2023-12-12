<?php 

class Dashboard
{
	protected $tb_produksi  = 'produksi';
	protected $tb_kecamatan = 'daerah';
	protected $tb_prediksi  = 'prediksi';
	protected $tb_user      = 'users';

	function __construct()
	{

    }

    public function count_data()
    {
        $query_produksi = DB::showDB($this->tb_produksi," GROUP BY tahun");
        $query_kecamatan = DB::showDB($this->tb_kecamatan);
        $query_pengguna = DB::showDB($this->tb_user);

        $data = [
            'produksi'=>0,
            'kecamatan'=>0,
            'pengguna'=>0
        ];
        
        return $data;
    }


}

$dashboard = new Dashboard();

?>