jQuery(document).ready(function($){

    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    datepicker_years();
    function datepicker_years(){
        $(".select-tahuns").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years",
            autoclose: true
        }).on('change',function(){
            if( getUrlParameter('page') == 'produksi' && getUrlParameter('act') == 'add' && !getUrlParameter('id')) {
                $('.kecamatan-select').prop('selectedIndex',0);
            }
        });
    }

    cek_produksi_kecamatan();
    function cek_produksi_kecamatan(){
        
        if( getUrlParameter('page') == 'produksi' && getUrlParameter('act') == 'add' && !getUrlParameter('id')) {

            $('.kecamatan-select').on('change',function(e){
                e.preventDefault();
                var root    = $(this);
                var idkec   = root.val();
                var tahun   = root.closest('.frm-produksi').find('.select-tahuns').val();
                var data    = {action:'cek_produksi_kecamatan','idkec':idkec,'tahun':tahun};

                let url = window.location.origin+window.location.pathname+'classes/class-produksi.php';

                if( tahun.length != 0 ){
                    
                    $.ajax({
                        url:url,
                        data:data,
                        type:'POST',
                        dataType:'JSON',
                        success: function(response)
                        {
                            if(response.msg == 'success'){
                                $( `<div class="alert mt-2 alert-success" role="alert"><i class="fa fa-check-circle"></i> `+response.text+`</div>` ).insertAfter( ".kecamatan-select" );
                                
                                setTimeout(function() { 
                                    root.closest('.form-group').find('.alert').remove();
                                }, 1000);
                            }else{
                                $('.select-tahuns').val('');
                                $('.kecamatan-select').prop('selectedIndex',0);
                                $( `<div class="alert mt-2 alert-warning" role="alert">`+response.text+`</div>` ).insertAfter( ".kecamatan-select" );
                                
                                setTimeout(function() { 
                                    root.closest('.form-group').find('.alert').remove();
                                }, 1000);
                            }
                        },
                        error:function()
                        {
                            alert('Sorry Error');
                            return false;
                        }
                    });

                }else{
                    alert('Anda Belum Memilih Tahun');
                    $('.kecamatan-select').prop('selectedIndex',0);
                }
            });
        }
    }
    
    dt_general();
    function dt_general() {
        $(".dt-export").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

          $('.dt-without-export').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('.dt-general-spk').DataTable({
            "responsive": true,
            "lengthMenu": [
                [50, -1],
                [50, 'All'],
            ],
        });
    }

    hapus_user();
    function hapus_user(){
        $('body').on('click','.users-delete',function(e){
            let root = $(this);
            let id = root.data('id');
            let data = {action:'get_hapus_user','id':id};
            let page = getUrlParameter('page');

            // var getUrl = window.location;
            // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

            let url = baseUrl+'/classes/class-users.php';

            let konfirmasi = confirm('Apakah Anda Yakin Menghapus Data ini ?');
            console.log(baseUrl);
            if( konfirmasi ) {

                $.ajax({
                    url:url,
                    data:data,
                    type:'POST',
                    dataType:'JSON',
                    success: function(response)
                    {
                        if(response.msg == 'success'){
                            location.href = '?page='+page+'&msg=success';
                        }else{
                            location.href = '?page='+page+'&msg=error';
                        }
                        console.log(response);
                    },
                    error:function()
                    {
                        alert('Sorry Error');
                        return false;
                    }
                });

            }
        });

    }

    hapus_course();
    function hapus_course(){
        $('body').on('click','.course-delete',function(e){
            let root = $(this);
            let id = root.data('id');
            let data = {action:'get_hapus_course','id':id};
            let page = getUrlParameter('page');

            // let url = window.location.origin+window.location.pathname+'classes/class-course.php';
            let url = baseUrl+'/classes/class-course.php';

            let konfirmasi = confirm('Apakah Anda Yakin Menghapus Data ini ?');

            if( konfirmasi ) {

                $.ajax({
                    url:url,
                    data:data,
                    type:'POST',
                    dataType:'JSON',
                    success: function(response)
                    {
                        if(response.msg == 'success'){
                            location.href = '?page='+page+'&msg=success';
                        }else{
                            location.href = '?page='+page+'&msg=error';
                        }
                    },
                    error:function()
                    {
                        alert('Sorry Error');
                        return false;
                    }
                });

            }
        });

    }

    hapus_kategori();
    function hapus_kategori(){
        $('body').on('click','.kategori-delete',function(e){
            let root = $(this);
            let id  = root.data('id');
            let data = {action:'get_hapus_kategori','id':id};
            let page = getUrlParameter('page');

            let url = window.location.origin+window.location.pathname+'classes/class-kategori.php';

            let konfirmasi = confirm('Apakah Anda Yakin Menghapus Data ini ?');

            if( konfirmasi ) {

                $.ajax({
                    url:url,
                    data:data,
                    type:'POST',
                    dataType:'JSON',
                    success: function(response)
                    {
                        if(response.msg == 'success'){
                            location.href = '?page='+page+'&msg=success';
                        }else{
                            location.href = '?page='+page+'&msg=error';
                        }
                    },
                    error:function()
                    {
                        alert('Sorry Error');
                        return false;
                    }
                });

            }
        });

    }

    hapus_usercourse();
    function hapus_usercourse(){
        $('body').on('click','.pesertacourse-delete',function(e){
            let root = $(this);
            let id  = root.data('id');
            let data = {action:'get_hapus_usercourse','id':id};
            let page = getUrlParameter('page');

            // let url = window.location.origin+window.location.pathname+'classes/class-produksi.php';
            let url = baseUrl+'/classes/class-usercourse.php';

            let konfirmasi = confirm('Apakah Anda Yakin Menghapus Data ini ?');

            if( konfirmasi ) {

                $.ajax({
                    url:url,
                    data:data,
                    type:'POST',
                    dataType:'JSON',
                    success: function(response)
                    {
                        if(response.msg == 'success'){
                            location.href = '?page='+page+'&msg=success';
                        }else{
                            location.href = '?page='+page+'&msg=error';
                        }
                    },
                    error:function()
                    {
                        alert('Sorry Error');
                        return false;
                    }
                });

            }
        });

    }

    cek_pass();
    function cek_pass()
    {
        $('input[name="password"],input[name="pass-konfirmasi"]').on('keyup', function () {
            if ($('input[name="password"]').val() == $('input[name="pass-konfirmasi"]').val()) {
                $('.card-body #message').html('Password Sesuai').css('color', 'green');
            } else {
                $('.card-body #message').html('Password Tidak Sesuai').css('color', 'red');
            }
        });
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
    
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
    
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    }

    console.log('test');
});