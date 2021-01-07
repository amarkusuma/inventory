<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Inventori</title>
  <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/css/mdb.min.css'>
  
  
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  
</head>
<body>
<!-- partial:index.partial.html -->
<body class="hm-gradient">
    
    <main>
        
        <!--MDB Tables-->
        <div class="container mt-4">
            
            <div class="card">
                <div class="card-body">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-12">
                            <h2 class="py-3 text-center font-bold font-up blue-text">Update Transaksi Penjualan</h2>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                    
                 <form action="{{route('update-transaksi-penjualan', $transaksi_penjualan['kode_penjualan'])}}" method="post">
                    @csrf
                    <div class="show-transaksi-penjualan">
                        <div class="form-group">
                            <div class="col-sm-4">
                              <label >Tanggal</label>
                              <input type="date" class="form-control" name="date" value="{{$transaksi_penjualan['tanggal_penjualan']}}">
                              <span class="form-highlight"></span>
                              <span class="form-bar"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4">
                                
                              <label>Pelanggan</label>
                              <select class="pelanggan_id-field form-control" name="pelanggan_id" id="pelanggan_id" required>
                                <option value="{{$transaksi_penjualan['kode_pelanggan']}}" selected="selected">{{$transaksi_penjualan['nama_pelanggan']}}</option>       
                                 
                              </select>
                              <span class="form-highlight"></span>
                              <span class="form-bar"></span>
                            </div>
                        </div>

                       <div class="form-group">
                        <div class="row col-sm-12">
                                <div class="col-sm-4">
                                    
                                <label>Barang</label>
                                <select class="barang_id-field form-control" name="barang_id" id="barang_id" required>
                                  <option value="{{$transaksi_penjualan['kode_barang']}}" selected="selected">{{$transaksi_penjualan['nama_barang']}}</option>       
                                </select>
                                <span class="form-highlight"></span>
                                <span class="form-bar"></span>
                                </div>
                            {{-- </div> --}}


                            {{-- <div class="form-group"> --}}
                                <div class="col-sm-4">
                                <label>Harga</label>
                                <input type="text" name="harga_satuan" class="form-control" value="{{$transaksi_penjualan['harga_satuan']}}" >
                                <span class="form-highlight"></span>
                                <span class="form-bar"></span>
                                </div>
                            {{-- </div> --}}


                            {{-- <div class="form-group"> --}}
                                <div class="col-sm-2">
                                <label >Jumlah</label>
                                <input type="text" class="form-control" name="jumlah" value="{{$transaksi_penjualan['jumlah']}}">
                                <span class="form-highlight"></span>
                                <span class="form-bar"></span>
                                </div>
                            {{-- </div> --}}

                            <div class="col-sm-2">
                               <button type="submit" class="btn btn-primary btn-sm" >Save</button>
                            </div>
                       </div>

                    </div>
                   </form>

                    <!--Table-->

                    {{-- <table class="table table-hover table-responsive mb-0">
                        <!--Table head-->
                        <thead>
                            <tr>
                                <th scope="row">Kode penjualan</th>
                                <th class="th-lg"><a>Kode Barang</th>
                                <th class="th-lg"><a>Nama Barang</th>
                                <th class="th-lg"><a href="">Harga</a></th>
                                <th class="th-lg"><a href="">Jumlah</a></th>
                                <th class="th-lg"><a href="">Sub Total</a></th>
                                <th class="th-lg"><a href="">Action</a></th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                            @foreach ($detail_penjualan as $data)
                            <tr>
                                    <th scope="row">{{$data->kode_penjualan}}</th>
                                    <td>{{$data->kode_barang}}</td>
                                    <td>{{$data->nama_barang}}</td>
                                    <td>{{number_format($data->harga_satuan,0,',','.')}}</td>
                                    <td>{{$data->jumlah}}</td>
                                    <td>{{number_format($data->sub_total,0,',','.')}}</td>


                                    <td>
                                        <a href="{{route('delete-barang', $data->kode_barang)}}" class="btn btn-danger btn-sm">Hapus</a>
                                        <a href="{{route('show-barang', $data->kode_barang)}}" class="btn btn-primary btn-sm">Update</a>
                                    </td>
                             
                            </tr>
                            @endforeach

                        </tbody>
                        <!--Table body-->
                    </table> --}}

                    {{-- {{ $detail_penjualan->render("pagination::bootstrap-4") }} --}}
                    <!--Bottom Table UI-->
                </div>
            </div>
          
            <hr class="my-4">

        </div>
        <!--MDB Tables-->
      
    </main>
  
</body>
<!-- partial -->
{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js'></script> --}}
</body>
</html>


<script type="text/javascript">

    $(document).ready(function(){
        
        $("#pelanggan_id").select2({
            ajax: { 
                url: "{{route('transaksi-penjualan-pelanggan')}}",
                type: "GET",
                dataType: 'json',
                delay: 150,
                data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                console.log(response.data);
                return {

                results: $.map(response.data, function (item) {
                        // console.log(item);
                        return {
                            text: item.nama_pelanggan,
                            // slug: item.slug,
                            id: item.kode_pelanggan
                        }
                    })
                };
            },
            cache: true
            }
        });
    });

$(document).ready(function(){
    
    $("#barang_id").select2({
        ajax: { 
            url: "{{route('transaksi-penjualan-barang')}}",
            type: "GET",
            dataType: 'json',
            delay: 150,
            data: function (params) {
            return {
                searchTerm: params.term // search term
            };
        },
        processResults: function (response) {
            // console.log(response.data);
            return {

            results: $.map(response.data, function (item) {
                    
                    return {
                        text: item.nama_barang,
                        // slug: item.harga_satuan,
                        id: item.kode_barang
                    }
                })
            };

            // console.log(results);
        },
        cache: true
        }
    });

    $('.barang_id-field').on("change", function(e) {

            $.ajax({
            
            url:"{{route('get-master-barang')}}",
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                kode_barang: $(".barang_id-field").val()

            },
            success:function(response) {

                const form = '.show-transaksi-penjualan' ;
                
                $(form).find('input[name=harga_satuan]').val(response.data.harga_satuan);

            },
            error:function(){
                alert("error");
            }

            });
    });
  
});

 
    const today = () => {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $('.show-transaksi-penjualan').find('input[name=date]').val(today);
    }
   
    today();

    const inputTransaksipenjualan = () => {
    
    const form = '.show-transaksi-penjualan' ;
    
    const date = $(form).find('input[name=odate]').val();
    const pelanggan_id =  $(form).find('select[name=pelanggan_id]').val();
    const barang_id =  $(form).find('select[name=barang_id]').val();
    const harga = $(form).find('input[name=harga]').val();
    const jumlah = $(form).find('input[name=harga]').val();
    
        $.ajax({

            url:"{{route('add-transaksi-penjualan')}}",
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            
            data:{
                date: date,
                pelanggan_id: pelanggan_id,
                barang_id: barang_id,
                harga: harga,
                jumlah: jumlah,
            },
            success:function(response) {
                console.log(response);

                // if (response.succes == true) {

                //     const form = '.show-transaksi-penjualan' ;
                //     $(form).find('input[name=harga').val(null);
                //     $(form).find('select[name=pelanggan_id]').val(null).trigger('change');
                //     alert("Data Berhasil Di Input");
                    
                // }
                // else {
                
                //     alert("Tidak Berhasil !! , Data Not Unique");

                // }

            },
            error:function(){
                alert("error");
            }

        });
    }

    // $('.show-transaksi-penjualan').find('select[name=pelanggan_id]').val('S001').trigger('change');
    // $('.show-transaksi-penjualan').find('select[name=pelanggan_id]').val("S001").trigger('change');
    


</script>