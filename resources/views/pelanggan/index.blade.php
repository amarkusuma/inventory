<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Inventori</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/css/mdb.min.css'><link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,latin-ext">
  <link rel="stylesheet" href="assets/navbar.css">

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
                            <h2 class="py-3 text-center font-bold font-up blue-text">Table Pelanggan</h2>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->

                    <div class="rae">
                    <a href="{{route('add-pelanggan')}}" class="btn btn-success btn-sm">+Add</a>
                    </div>
                    <!--Table-->
                    <table class="table table-hover table-responsive mb-0">
                        <!--Table head-->
                        <thead>
                            <tr>
                                <th scope="row">Kode Pelanggan</th>
                                <th class="th-lg"><a>Nama Pelanggan</th>
                                <th class="th-lg"><a href="">No Telp</a></th>
                                <th class="th-lg"><a href="">Alamat</a></th>
                                <th class="th-lg"><a href="">Action</a></th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                            @foreach ($master_pelanggan as $data)
                            <tr>
                                    <th scope="row">{{$data->kode_pelanggan}}</th>
                                    <td>{{$data->nama_pelanggan}}</td>
                                    <td>{{$data->no_telp_pelanggan}}</td>
                                    <td>{{$data->alamat_pelanggan}}</td>

                                    <td>
                                        <a href="{{route('delete-pelanggan', $data->kode_pelanggan)}}" class="btn btn-danger btn-sm">Hapus</a>
                                        <a href="{{route('show-pelanggan', $data->kode_pelanggan)}}" class="btn btn-primary btn-sm">Update</a>
                                    </td>
                             
                            </tr>
                            @endforeach

                        </tbody>
                        <!--Table body-->
                    </table>

                    {{ $master_pelanggan->render("pagination::bootstrap-4") }}
                    <!--Bottom Table UI-->
                </div>
            </div>
          
            <hr class="my-4">

        </div>
        <!--MDB Tables-->
      
    </main>
  
</body>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js'></script>
</body>
</html>
