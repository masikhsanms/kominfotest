<div class="row">
          <div class="col-12 mb-4">
            <div class="card">

            <div class="card-header">
                <form action="">
                    <input type="hidden" name="page" value="prediksi">
                    <input type="hidden" name="s" value="cari-prediksi">
                    <label>Cari Berdasarkan Periode</label>
                    <div class="form-inline">
                        <div class="form-group mr-2">
                            <select name="periode" class="form-control">
                                <option value="">Pilih Periode</option>
                                <?php 
                                for ($i=3; $i <= 5 ; $i++) : 
                                    $selected = ( isset($_GET['periode']) && $_GET['periode'] == $i ) ? 'selected' : '';    
                                ?> 
                                    <option value="<?= $i; ?>" <?= $selected; ?>><?= 'Periode Ke - '.$i; ?></option>
                                    <?php endfor; ?>
                                </select>
                        </div>
                        <div class="form-group mr-2">
                                <?php 
                                $tb  = 'produksi';
                                
                                $where_desc = " GROUP BY tahun DESC LIMIT 1";
                                $where_asc = " GROUP BY tahun ASC LIMIT 1";
                                
                                $param_search = $prediksi->search_periode();
                                $periode = empty($param_search['periode']) ? 5 : (int)$param_search['periode'];


                                $row_tahun_desc = DB::getRowDB($tb,$where_desc)['tahun'];
                                $row_tahun_asc = DB::getRowDB($tb,$where_asc)['tahun'];
                                
                               
                                $th_prediksi_desc = $row_tahun_desc.'-'.date('m-d');
                                $th_periode = date( 'Y',strtotime($th_prediksi_desc.' -'.$periode.' year') );
                                
                                
                                ?>
                            <select name="tahun" class="form-control">
                                <option value="">Pilih Tahun</option>
                                <?php
                                    for ($i=$row_tahun_asc; $i <= $th_periode ; $i++):
                                        $selected = ( isset($_GET['tahun']) && $_GET['tahun'] == $i ) ? 'selected' : '';    
                                ?> 
                                    <option value="<?= $i; ?>" <?= $selected; ?>><?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                        </div>
                        <div class="form-group ml-1">
                            <button class="btn btn-info" type="submit">Cari</button>
                        </div>
                        <div class="form-group ml-1">
                            <a class="btn btn-danger" href="home.php" >Reset</a>
                        </div>
                    </div>
                </form>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered dt-general-spk">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tahun</th>
                            <th>Hasil Produksi</th>
                            <th>MA (Moving Avarage)</th>
                            <th>SSE (Error)</th>
                            <th>MSE</th>
                            <th>MAPE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            global $prediksi;
                                                    
                            $data_prediksi = $prediksi->avarage_hasil_produksi($periode);
                            $MA = $data_prediksi['ma'];
                            $mse_arr = $data_prediksi['mse_arr'];
                            $mape_arr = $data_prediksi['mape_arr'];
                            
                            $mse_avg = $data_prediksi['mse'];
                            $mape_avg = $data_prediksi['mape'];
                            $sse_avg = $data_prediksi['sse'];
                            
                            $arr_hasilproduksi = [];
                            $arr_tahun = [];

                            foreach($prediksi->list_group_by_tahun() as $key => $row_tahun ): 
                                $hasil_produksi = $prediksi->sum_hasilproduksi_by_tahun($row_tahun);
                                $MA_loop = empty( $MA[$key-1] ) ? '' : $MA[$key-1];
                                
                                $arr_hasilproduksi[] = round($hasil_produksi,2);
                                $arr_tahun[] = (int)$row_tahun;

                                $MSE = 0;
                                $error = 0;
                                $perhitungan_mape = 0;
                                if( !empty($MA_loop) ){
                                    if( $hasil_produksi != 0 ){
                                        $error = (float)$hasil_produksi - (float)$MA_loop;
                                        $MSE = $error * $error;
                                        $perhitungan_mape_1 = $error / $hasil_produksi;
                                        $perhitungan_mape = $perhitungan_mape_1*100*-1;
                                    }else{
                                        $MSE                = $mse_avg;
                                        $perhitungan_mape   = $mape_avg;
                                        $error              = $sse_avg;
                                    }
                                                                                                           
                                }
                        ?>      
                        <tr>
                            <td><?= $row_tahun; ?></td>
                            <td><?= round($hasil_produksi,2); ?></td>
                            <td><?= round( $MA_loop,2); ?></td>
                            <td><?= round($error,2); ?></td>
                            <td><?= round($MSE,2); ?></td>
                            <td><?= $perhitungan_mape; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6 mb-4">
              <div class="card">
                  <div class="card-body">
                    <h6>Grafik Hasil Produksi</h6>
                    <canvas id="produksiChart" style="width:100%;max-width:600px"></canvas>
                  </div>
              </div>
          </div>
          <div class="col-md-6 mb-4">
              <div class="card">
                  <div class="card-body">
                    <h6>Grafik Moving Avarage</h6>
                    <canvas id="maChart" style="width:100%;max-width:600px"></canvas>
                  </div>
              </div>
          </div>
          <div class="col-md-6 mb-4">
              <div class="card">
                  <div class="card-body">
                    <h6>Grafik MAPE</h6>
                    <canvas id="mapeChart" style="width:100%;max-width:600px"></canvas>
                  </div>
              </div>
          </div>
          <div class="col-md-6 mb-4">
              <div class="card">
                  <div class="card-body">
                    <h6>Grafik MSE</h6>
                    <canvas id="mseChart" style="width:100%;max-width:600px"></canvas>
                  </div>
              </div>
          </div>
        </div>
        <!-- /.row -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        var xTahun = JSON.parse( '<?= json_encode( $arr_tahun ); ?>');
        var yHasilProduksi = JSON.parse( '<?= json_encode( $arr_hasilproduksi ); ?>');
        var yMape = JSON.parse( '<?= json_encode( $mape_arr ); ?>');
        var yMse = JSON.parse( '<?= json_encode( $mse_arr ); ?>');
        var yMA = JSON.parse( '<?= json_encode( array_values($MA) ); ?>');


        new Chart("produksiChart", {
          type: "line",
          data: {
              labels: xTahun,
              datasets: [{
              fill: false,
              lineTension: 0,
              backgroundColor: "rgba(0,0,255,1.0)",
              borderColor: "rgba(0,0,255,0.1)",
              data: yHasilProduksi
              }]
          },
          options: {
              legend: {display: false},
          }
        });

        new Chart("mapeChart", {
          type: "line",
          data: {
              labels: xTahun,
              datasets: [{
              fill: false,
              lineTension: 0,
              backgroundColor: "rgba(0,0,255,1.0)",
              borderColor: "rgba(0,0,255,0.1)",
              data: yMape
              }]
          },
          options: {
              legend: {display: false},
          }
        });

        new Chart("maChart", {
          type: "line",
          data: {
              labels: xTahun,
              datasets: [{
              fill: false,
              lineTension: 0,
              backgroundColor: "rgba(0,0,255,1.0)",
              borderColor: "rgba(0,0,255,0.1)",
              data: yMA
              }]
          },
          options: {
              legend: {display: false},
          }
        });

        new Chart("mseChart", {
          type: "line",
          data: {
              labels: xTahun,
              datasets: [{
              fill: false,
              lineTension: 0,
              backgroundColor: "rgba(0,0,255,1.0)",
              borderColor: "rgba(0,0,255,0.1)",
              data: yMse
              }]
          },
          options: {
              legend: {display: false},
          }
        });
    </script>