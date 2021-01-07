<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Inventori</title>
  <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/css/mdb.min.css'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,latin-ext">
  <link rel="stylesheet" href="assets/navbar.css">

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

        <nav class="navbar">
  
            <div class="container">
            
            <h2 class="logo"><a href="#">Inventori</a></h2>
            <ul class="nav nav-right">
                <li><a href="{{route('barang')}}">Barang</a></li>
                <li><a href="{{route('pelanggan')}}">Pelanggan</a></li>
                <li><a href="{{route('supplier')}}">Supplier</a></li>
                <li><a href="{{route('transaksi-pembelian')}}">Transaksi Pembelian</a></li>
                <li><a href="{{route('transaksi-penjualan')}}">Transaksi Penjualan</a></li>
                <li><a href="{{route('laporan')}}">Laporan</a></li>
            </ul>
            </div>
        
        </nav>
        
        <!--MDB Tables-->
        <div class="container mt-4">
            
            <div class="card">
                <div class="card-body">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-12">
                            <h2 class="py-3 text-center font-bold font-up blue-text">Table Transaksi Pembelian</h2>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                    
                 <form action="{{route('add-transaksi-pembelian')}}" method="post">
                    @csrf
                    <div class="input-transaksi-pembelian">
                        <div class="form-group">
                            <div class="col-sm-4">
                              <label >Tanggal</label>
                              <input type="date" class="form-control" name="date">
                              <span class="form-highlight"></span>
                              <span class="form-bar"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4">
                                
                              <label>Supplier</label>
                              <select class="supplier_id-field form-control" name="supplier_id" id="supplier_id" required>
                                
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
                                    
                                </select>
                                <span class="form-highlight"></span>
                                <span class="form-bar"></span>
                                </div>
                            {{-- </div> --}}


                            {{-- <div class="form-group"> --}}
                                <div class="col-sm-4">
                                <label >Harga</label>
                                <input type="text" name="harga_satuan" class="form-control" >
                                <span class="form-highlight"></span>
                                <span class="form-bar"></span>
                                </div>
                            {{-- </div> --}}


                            {{-- <div class="form-group"> --}}
                                <div class="col-sm-2">
                                <label >Jumlah</label>
                                <input type="text" class="form-control" name="jumlah" >
                                <span class="form-highlight"></span>
                                <span class="form-bar"></span>
                                </div>
                            {{-- </div> --}}

                            <div class="col-sm-2">
                               <button type="submit" class="btn btn-success btn-sm" >+Add</button>
                            </div>
                       </div>

                    </div>
                   </form>

                    <!--Table-->

                    <table class="table table-hover table-responsive mb-0">
                        <!--Table head-->
                        <thead>
                            <tr>
                                <th scope="row">Kode Pembelian</th>
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
                            @foreach ($detail_pembelian as $data)
                            <tr>
                                    <th scope="row">{{$data->kode_pembelian}}</th>
                                    <td>{{$data->kode_barang}}</td>
                                    <td>{{$data->nama_barang}}</td>
                                    <td>{{number_format($data->harga_satuan,0,',','.')}}</td>
                                    <td>{{$data->jumlah}}</td>
                                    <td>{{number_format($data->sub_total,0,',','.')}}</td>


                                    <td>
                                        <a href="{{route('delete-transaksi-pembelian',$data->kode_pembelian ? $data->kode_pembelian : 0)}}" class="btn btn-danger btn-sm">Hapus</a>
                                        <a href="{{route('show-transaksi-pembelian', $data->kode_pembelian ? $data->kode_pembelian : 0)}}" class="btn btn-primary btn-sm">Update</a>
                                    </td>
                             
                            </tr>
                            @endforeach

                        </tbody>
                        <!--Table body-->
                    </table>

                    {{-- {{ $detail_pembelian->render("pagination::bootstrap-4") }} --}}
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
        
        $("#supplier_id").select2({
            ajax: { 
                url: "{{route('transaksi-pembelian-supplier')}}",
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
                        console.log(item);
                        return {
                            text: item.nama_supplier,
                            // slug: item.slug,
                            id: item.kode_supplier
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
            url: "{{route('transaksi-pembelian-barang')}}",
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

                const form = '.input-transaksi-pembelian' ;
                
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

        $('.input-transaksi-pembelian').find('input[name=date]').val(today);
    }
   
    today();

    const inputTransaksiPembelian = () => {
    
    const form = '.input-transaksi-pembelian' ;
    
    const date = $(form).find('input[name=odate]').val();
    const supplier_id =  $(form).find('select[name=supplier_id]').val();
    const barang_id =  $(form).find('select[name=barang_id]').val();
    const harga = $(form).find('input[name=harga]').val();
    const jumlah = $(form).find('input[name=harga]').val();
    
        $.ajax({

            url:"{{route('add-transaksi-pembelian')}}",
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            
            data:{
                date: date,
                supplier_id: supplier_id,
                barang_id: barang_id,
                harga: harga,
                jumlah: jumlah,
            },
            success:function(response) {
                console.log(response);

                // if (response.succes == true) {

                //     const form = '.input-transaksi-pembelian' ;
                //     $(form).find('input[name=harga').val(null);
                //     $(form).find('select[name=supplier_id]').val(null).trigger('change');
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

</script>