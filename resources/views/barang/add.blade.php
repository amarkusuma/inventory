<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Inventori</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container py-3">
    <div class="row">

     <div class="col-md-12">


        <div class="row justify-content-center">
          <div class="col-md-6">
            <span class="anchor" id="formChangePassword"></span>

            <div class="card card-outline-secondary">
              <div class="card-header">
                <h3 class="mb-0 text-center">Input Barang</h3>
              </div>

              <div class="card-body">

              <form autocomplete="off" class="form" role="form" method="POST" action="{{route('store-barang')}}">
                  @csrf
                  <div class="form-group">
                    <label for="nama">Nama Barang</label> 
			          		<input class="form-control" name="nama_barang" required="" type="text">
                  </div>

                  <div class="form-group">
                    <label class="mb-0" for="message2">Deskripsi</label>
                      <div class="row mb-1">
                        <div class="col-lg-12">
                          <textarea class="form-control" name="deskripsi"  required="" rows="3"></textarea>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="harga">Harga</label> 
                    <input class="form-control" name="harga" required="" type="number"> 
                    {{-- <small class="form-text text-muted" id="passwordHelpBlock">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</small> --}}
                  </div>
                

                  <div class="form-group">
                    <label for="stok">Stok</label> 
                    <input class="form-control" name="stok" required="" type="number"> 
                    {{-- <small class="form-text text-muted" id="passwordHelpBlock">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</small> --}}
                  </div>

                  <div class="form-group">
                    <button class="btn btn-success btn-lg float-right" type="submit">Save</button>
                  </div>
                </form>

              </div>
            </div>

          </div>
        </div>


     </div>
    </div>
  </div>


<!-- Scroll to Top -->
{{-- <a id="scroll-to-top" href="#" class="btn btn-primary btn-lg" role="button" title="Return to top of page" data-toggle="tooltip" data-placement="left"><i class="fa fa-arrow-up"></i></a> --}}
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script><script  src="./script.js"></script>

</body>
</html>
