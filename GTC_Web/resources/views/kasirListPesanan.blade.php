<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/kasir.css">
    <link rel="stylesheet" href="css/virtual-select.min.css">

    <!-- JS + JS Sidebar -->
    <script src="js/kasir.js"></script>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    .card img {
        max-width: 25%;
        margin: auto;
        padding: 0.5em;
        border-radius: 0.7em;
    }

    .card {
        flex-direction: row;
        max-width: 30em;
    }

    #navSlide{
        color: rgba(211, 36, 43, 1) !important;
      }
    </style>

</head>
<body>
    <main>
    <!--Background-->
    <div class="bg-menu" style="background-color:  rgba(255, 255, 255, 1) ; height: 100vh;">

        <!--Sidebar-->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white " style="width: 260px; ; background-color: rgba(211, 36, 43, 1); height: 100vh ;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"></a>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/pesananKasir" class="nav-link">
                        <i class="bi bi-receipt" style="font-size: 2rem;"></i>
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#bi bi-receipt"/></svg>
                        Pesanan
                    </a>
                </li>
                <li>
                    <a href="/menuKasir" class="nav-link text-white">
                        <i class="bi bi-cup-straw" style="font-size: 2rem;"></i>
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                        Menu
                    </a>
                </li>
                <li>
                    <a href="/reportKasir" class="nav-link text-white">
                        <i class="bi bi-journal-text" style="font-size: 2rem;"></i>
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                        Laporan
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#Syalala" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{ auth()->guard('kasir')->user()->nama_kasir }}</strong>
                </a>
                <ul class="dropdown-menu  text-small shadow" aria-labelledby="dropdownUser1">
                    <li>
                        <form action="{{ route('kasir.keluar') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" href="landpg.html">Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--Isi Content-->
    <div class="container ms-0" style="height: 100vh;">
        <button class ="btn  ms-3 mt-3 mb-2" data-bs-toggle="modal" data-bs-target="#modalTambahPesanan" id ="buttonTambahPesanan" style="background-color: rgba(211, 36, 43, 1); color: white;"><i class="bi bi-plus-circle"></i>      Tambah Pesanan</button>

        

        <!--Nav Tab-->
        <ul class="nav nav-underline nav-fill ms-3 mb-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="navSlide" data-bs-toggle="tab" href="#tabMenungguPembayaran">Menunggu Pembayaran</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="navSlide" data-bs-toggle="tab" href="#tabPesananDiproses">Dalam Proses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="navSlide" data-bs-toggle="tab" href="#tabPesananSelesai">Selesai</a>
          </li>
        </ul>
      
        <!--Nav Tab Content-->
        <div class="tab-content">

          <!--Nav Tab Menunggu Pembayaran-->
          <div id="tabMenungguPembayaran" class="tab-pane active">
            <div class="row row-cols-1 row-cols-md-3 g-6 ms-0">
              @foreach ($groupedPesananMenunggu as $idPesananKasir => $pesananDetails)
                <div class="col">
                  <div class="card bg-light-subtle mt-4">
                    <div class="card-body">
                      <div class="text-section mb-0 lh-1">
                        <h5 class="card-title fs-5 fw-semibold">ID Pesanan : {{ $idPesananKasir }}</h5>
                        <p class="card-text fs-6">
                        @foreach ($pesananDetails as $detail)
                          {{ $detail->quantity }}x {{ $detail->menu->nama_produk }} - 
                        @endforeach
                        </p>
                        <p class="card-text fs-6 text-danger fw-semibold" >Rp{{ $pesananDetails->sum('totalHarga') }}</p>
                        <p class="card-text fs-6 fw-semibold" >{{ $pesananDetails->first()->metodePembayaran }}</p>
                      </div>
                      <div class="d-grid mt-3 text-canter">
                        <button class="btn btn-danger btn-block fw-medium" id="buttonKonfirmasiPembayaran" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiPembayaran"
                        >Konfirmasi Pembayaran</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <!--Nav Tab Pesanan Diproses-->
          <div id="tabPesananDiproses" class="tab-pane ">
            <div class="row row-cols-1 row-cols-md-3 g-6 ms-0">
              @foreach ($groupedPesananDiproses as $idPesanan => $pesananDetails )
                <div class="col">
                  <div class="card bg-light-subtle mt-4">
                    <div class="card-body">
                      <div class="text-section mb-0 lh-1">
                          <h5 class="card-title fs-5 fw-semibold">ID Pesanan : {{ $idPesanan }}</h5>
                          <p class="card-text fs-6 ">
                            @foreach ($pesananDetails as $detail)
                              {{ $detail->quantity }}x {{ $detail->menu->namaProduk }} - 
                            @endforeach
                          </p>
                          <p class="card-text fs-6 text-danger fw-semibold" >Rp{{ $pesananDetails->sum('totalHarga') }}</p>
                          <p class="card-text fs-6 fw-semibold" >{{ $pesananDetails->first()->metodePembayaran }}</p>
                          <p class="card-text text-end fs-6 fw-semibold">
                            {{ $pesananDetails->first()->kasir->nama_kasir }}
                          </p>
                      </div>
                      <div class="d-grid gap-2  mt-3 ">
                          <button class="btn btn-danger fw-medium" id="buttonPesananSelesai" data-bs-toggle="modal" data-bs-target="#modalSelesaikanPesanan"  >Pesanan Selesai</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div> 

          <!--Nav Tab Pesanan Selesai-->
          <div id="tabPesananSelesai" class="tab-pane ">
            <div class="row row-cols-1 row-cols-md-3 g-6 ms-0">
              @foreach ($groupedPesananSelesai as $idPesanan => $pesananDetails)
                <div class="col">
                  <div class="card bg-light-subtle mt-4">
                    <div class="card-body">
                      <div class="text-section mb-0 lh-1">
                          <h5 class="card-title fs-5 fw-semibold">ID Pesanan : {{ $idPesanan }}</h5>
                          <p class="card-text fs-6 ">
                            @foreach ($pesananDetails as $detail)
                              {{ $detail->quantity }}x {{ $detail->menu->namaProduk }} - 
                            @endforeach
                          </p>
                          <p class="card-text fs-6 text-danger fw-semibold" >Rp{{ $pesananDetails->sum('totalHarga') }}</p>
                          <p class="card-text fs-6 fw-semibold" >{{ $pesananDetails->first()->metodePembayaran }}</p>
                          <p class="card-text text-end fs-6 fw-semibold">{{ $pesananDetails->first()-kasir->nama_kasir }}</p>
                      </div>
                      <div class="d-grid gap-2  mt-3 ">
                          <button class="btn btn-danger fw-medium" id="buttonPesananSelesai" disabled >Pesanan Selesai</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

        </div> 

        <!--Modal Pesanan Ditolak-->
        <div class="modal" id="modalTolakPesanan">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
        
              <!-- Modal body -->
              <div class="modal-body">
                <p class="fs-5 text-danger fw-semibold">Apakah Anda Yakin Untuk Menolak Pesanan ?</p>
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Ya</button>
              </div>
        
            </div>
          </div>
        </div>

        <!--Modal Pesanan Diterima-->
        <div class="modal" id="modalPesananDiterima">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
        
              <!-- Modal body -->
              <div class="modal-body">
                <p class="fs-5 text-danger fw-semibold">Apakah Anda Yakin Menerima Pesanan ?</p>
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Ya</button>
              </div>
        
            </div>
          </div>
        </div>

        <!--Modal Konfirmasi Pembayaran-->
        <div class="modal" id="modalKonfirmasiPembayaran">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
        
              <!-- Modal body -->
              <div class="modal-body">
                <p class="fs-5 text-danger fw-semibold">Konfirmasi Pembayaran ?</p>
              </div>
        
              <!-- Modal footer -->
              @if ($groupedPesananMenunggu->isNotEmpty())
                <form action="{{ route('pesananKasir.konfirmasiPembayaran', ['id' => $groupedPesananMenunggu->first()->first()->idPesanan]) }}" method="POST">
              @endif
                @csrf
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                  <button type="submit" class="btn btn-outline-danger" data-bs-dismiss="modal">Ya</button>
                </div>
                @if ($groupedPesananMenunggu->isNotEmpty())
              </form>
                @endif

        
            </div>
          </div>
        </div>

        <!--Modal Selesaikan Pesanan-->
        <div class="modal" id="modalSelesaikanPesanan">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
        
              <!-- Modal body -->
              <div class="modal-body">
                <p class="fs-5 text-danger fw-semibold">Selesaikan pesanan ?</p>
              </div>
        
              <!-- Modal footer -->
              @if ($groupedPesananDiproses->isNotEmpty())
                <form action="{{ route('pesananKasir.pesananSelesai', ['id' => $groupedPesananDiproses->first()->first()->idPesanan]) }}" method="POST">
              @endif
                @csrf
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                  <button type="submit" class="btn btn-outline-danger" data-bs-dismiss="modal">Ya</button>
                </div>
              @if ($groupedPesananDiproses->isNotEmpty())
                </form>
              @endif
        
            </div>
          </div>
        </div>

        <!--Modal Tambah Pesanan-->
        <div class="modal" id="modalTambahPesanan">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <form action="/pesananKasir" method="POST">
                @csrf
                <div class="modal-header">
                  <h3 class="text-danger">Tambah Pesanan</h3>
                </div>
                <div class="modal-body">
                  <button id="tambah-menu" type="button" class="btn btn-danger" >Tambahkan Menu</button>
                  <div id="dropdown">
                  </div>
                  <p class="text-danger fs-5 mt-3 ms-2">Metode Pembayaran : </p>
                  <select class='form-select' name='metode' placeholder='Native Select'data-search='false'data-silent-initial-value-set='true'>
                    <option value="QRIS" >QRIS</option>
                    <option value="Tunai">Tunai</option>
                  </select>
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-outline-danger" data-bs-dismiss="modal">Pesan</button>
                </div>
              </form>
            </div>
          </div>
        </div>


      </div>

</main>
    <script src="js/virtual-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      VirtualSelect.init({ 
        ele: '#selectPaymentMethod' 
      });

      $(document).ready(function() {
      // Event handler untuk tombol "tambah menu"
      $("#buttonTambahPesanan").click(function() {
        $('#dropdown').hide();
      })

      $("#tambah-menu").click(function() {
        if ($('#dropdown').is(":hidden")) {
          $("#dropdown").empty();
          $('#dropdown').show();
        }
        // $('#dropdown').show();

        // Buat dua dropdown
        var dropdown = $("<select class='form-select mt-3 'name='menu[]' placeholder='Native Select'data-search='false'data-silent-initial-value-set='true' id='id'></select>");

        // Isi dropdown pertama dengan data multi select
        $.ajax({
            url: '/get-menuKasir',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Iterate over the menu options and append them to the dropdown
                $.each(data, function (index, option) {
                    dropdown.append("<option value='" + option.id + "'>" + option.nama_produk + "</option>");
                });
            },
            error: function (error) {
                console.log(error);
            }
        });

        // Letakkan kedua dropdown sejajar
        $("#dropdown").append(dropdown);
      });
    });
   
    </script>

</body>
</html>