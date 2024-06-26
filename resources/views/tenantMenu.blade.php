<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/tenant.css">
    <link href="sidebars.css" rel="stylesheet">

    <!-- JS + JS Sidebar -->
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- JS DATATABLE-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        #buttonTambahMenu:hover {
            background-color: rgba(246, 49, 57, 1) !important;
        }

        .popupAdd {

            background: rgba(0, 0, 0, 0.4);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            display: none;
            justify-content: center;
            align-items: center;
            text-align: left;

        }

        .popup-content {
            height: 350px;
            width: 900px;
            background: rgba(252, 255, 255, 1);
            padding-left: 50px;
            padding-top: 20px;
            border-radius: 5 px;
            position: relative;
            left: -10%;

        }

        .col-form-label {
            font-size: 20px !important;
        }


        .form-control {
            width: 400px !important;
        }

        .close {
            position: absolute;
            top: -15px;
            right: -15px;
            height: 25px;
            border-radius: 50%;
            background-color: white;
        }

        #buttonSunting:hover {
            background-color: rgba(246, 49, 57, 1) !important;
            color: white !important;
            border: none !important;
        }

        #buttonHapus:hover {
            background-color: rgba(246, 49, 57, 1) !important;
        }

        .popupSunting {

            background: rgba(0, 0, 0, 0.4);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            display: none;
            justify-content: center;
            align-items: center;
            text-align: left;

        }

        #buttonTambahkan:hover {
            background-color: white !important;
            color: rgba(246, 49, 57, 1) !important;
            border: 1px solid rgba(246, 49, 57, 1) !important;
        }

        #buttonSuntingUbah:hover {
            background-color: white !important;
            color: rgba(246, 49, 57, 1) !important;
            border: 1px solid rgba(246, 49, 57, 1) !important;
        }

        .popupDelete {
            background: rgba(0, 0, 0, 0.4);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            display: none;
            justify-content: center;
            align-items: center;
            text-align: center;

        }

        .popupDeleteContent {
            height: 300px;
            width: 700px;
            background: rgba(252, 255, 255, 1);
            border-radius: 5 px;
            position: relative;
            left: -10%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

</head>

<body>
    <main>
        <!--Background-->
        <div class="bg-menu" style="background-color:  rgba(255, 255, 255, 1) ; height: 100vh;">

            <!--Sidebar-->
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white "
                style="width: 260px; ; background-color: rgba(211, 36, 43, 1); height: 100vh ;">
                <a href="/"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"></a>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="/pesananTenant" class="nav-link ">
                            <i class="bi bi-receipt" style="font-size: 2rem;"></i>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#bi bi-receipt" />
                            </svg>
                            Pesanan
                        </a>
                    </li>

                    <li>
                        <a href="/menuTenant" class="nav-link text-white">
                            <i class="bi bi-egg-fried" style="font-size: 2rem;"></i>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#speedometer2" />
                            </svg>
                            Menu
                        </a>
                    </li>

                    <li>
                        <a href="/reportTenant" class="nav-link text-white">
                            <i class="bi bi-journal-text" style="font-size: 2rem;"></i>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#table" />
                            </svg>
                            Laporan
                        </a>
                    </li>

                </ul>
                <hr>

                <!--Dropdown-->
                <div class="dropdown">
                    <a href="#Syalala" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong>{{ auth()->guard('tenant')->user()->nama_tenant }}</strong>
                    </a>
                    <ul class="dropdown-menu  text-small shadow" aria-labelledby="dropdownUser1">
                        <li>
                            <form action="{{ route('tenant.keluar') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item" href="landpg.html">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Tabel Menu-->
        <div class="menu mx-5" style="width: 80vw; height: 100vh;">
            <button type="button" class="btn  mb-3 mt-3" id="buttonTambahMenu" data-bs-toggle="modal"
                data-bs-target="#popuptambahmenu" style="background-color: rgba(211, 36, 43, 1); color: white;"><i
                    class="bi bi-plus-circle"></i> Tambah Menu</button>

            <table id="menutenant" class ="table  mt-4 table-bordered" style="width:100%">
                <thead>

                    <tr>
                        <td class="table-danger">Foto Produk</td>
                        <td class="table-danger">Nama Produk</td>
                        <td class="table-danger">Harga</td>
                        <td class="table-danger">Sunting / Hapus </td>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            
                            <td><img src="{{ asset('file/' . $menu->fotoProduk) }}" alt="" width="10%"> </td>
                            <td>{{ $menu->namaProduk }}</td>
                            <td>{{ $menu->hargaProduk }}</td>
                            <td>
                                <div class="col-auto" style="margin-left: 18%;">
                                    <button type="button" class="btn  mb-0" id="buttonSunting"
                                        data-id="{{ $menu->id }}" data-bs-toggle="modal"
                                        data-bs-target="#popupsuntingmenu"
                                        style="background-color: white; color: rgba(211, 36, 43, 1); border: 1px solid rgba(211, 36, 43, 1);">Sunting</button>
                                    <button type="button" class="btn mb-0 " id="buttonHapus"
                                        data-id="{{ $menu->id }}" data-bs-toggle="modal"
                                        data-bs-target="#popuphapusmenu"
                                        style="background-color:rgba(211, 36, 43, 1); color: white;">Hapus</button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

            <!--Popup Tambah Menu-->
            <div class="modal fade modal-lg" id="popuptambahmenu">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="mb-4 mt-4"
                                style="color: rgba(211, 36, 43, 1); font-weight: bold; margin-top: 2px; ">Tambah Menu
                            </h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/menuTenant" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="fotoProduk" class="col-sm-4 col-form-label">Foto Produk</label>
                                    <div class="col-sm">
                                        <input type="file" class="form-control" id="fotoProduk"
                                            name="tambahFotoProduk">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="namaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="namaProduk"
                                            name="tambahNamaProduk">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="hargaProduk" class="col-sm-4 col-form-label">Harga Produk(Rp)</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="hargaProduk"
                                            name="tambahHargaProduk">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn mb-0 " id="buttonTambahkan"
                                        style="background-color:rgba(211, 36, 43, 1); color: white; margin-left: 80%;">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Popup Sunting Menu-->
            <div class="modal fade modal-lg" id="popupsuntingmenu">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="mb-4 mt-4"
                                style="color: rgba(211, 36, 43, 1); font-weight: bold; margin-top: 2px; ">Sunting Menu
                            </h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/menuTenant" id="suntingForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label for="fotoProduk" class="col-sm-4 col-form-label">Foto Produk</label>
                                    <div class="col-sm">
                                        <input type="file" class="form-control" id="suntingFotoProduk"
                                            name="suntingFotoProduk">
                                    </div>

                                    <div class="row mb-3">
                                        <label for="suntingNamaProduk" class="col-sm-4 col-form-label">Nama
                                            Produk</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="suntingNamaProduk"
                                                name="suntingNamaProduk">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="suntingHargaProduk" class="col-sm-4 col-form-label">Harga
                                            Produk(Rp)</label>
                                        <div class="col-sm">
                                            <input type="number" class="form-control" id="suntingHargaProduk"
                                                name="suntingHargaProduk">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn mb-0 " id="buttonSuntingUbah"
                                        style="background-color:rgba(211, 36, 43, 1); color: white; margin-left: 80%;">Sunting</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Popup Hapus Menu-->
        <div class="modal fade modal-lg" id="popuphapusmenu">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-4 mt-4"
                            style="color: rgba(211, 36, 43, 1); font-weight: bold; margin-top: 2px; ">Hapus Menu</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-auto">
                        <p style="font-weight: bold;">Apakah Anda Yakin Ingin Menghapus Barang Ini ?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="/menuTenant" method="POST" id="deleteForm" enctype="multipart/form-data">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn mb-0 " id="buttonYes"
                                style="background-color:rgba(211, 36, 43, 1); color: white;  width: 140px;">Ya</button>
                            <button type="button" class="btn mb-0 " id="buttonNo"
                                style="background-color:rgba(211, 211, 211, 1); color: white;  width: 140px;">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="js/tenant.js"></script>
        <script>
            // Popup Tambah Menu Show
            // document.getElementById("buttonTambahMenu").addEventListener("click", function () {
            //   document.querySelector(".popupAdd").style.display = "flex";
            // });

            // // Popup Tambah Menu Close
            // document.querySelector(".close").addEventListener("click", function () {
            //   document.querySelector(".popupAdd").style.display = "none";
            // });

            // // Popup Sunting Menu Show
            // // document.getElementById("buttonSunting").addEventListener("click", function () {
            // //   document.querySelector(".popupSunting").style.display = "flex";
            // // });

            // // Popup Sunting Menu Close
            // // document.querySelector("#closeSunting").addEventListener("click", function () {
            // //   document.querySelector(".popupSunting").style.display = "none";
            // // });

            // // Popup Hapus Menu Show
            // document.getElementById("buttonHapus").addEventListener("click", function () {
            //   document.querySelector(".popupDelete").style.display = "flex";
            // });
            // // Popup Hapus Menu Cancel
            // document.getElementById("buttonNo").addEventListener("click", function () {
            //   document.querySelector(".popupDelete").style.display = "none";
            // });
            document.addEventListener('DOMContentLoaded', function() {
                const sunting = document.querySelectorAll('#buttonSunting');
                const hapus = document.querySelectorAll('#buttonHapus');


                sunting.forEach(function(button) {
                    button.addEventListener('click', function() {
                        const id = button.getAttribute('data-id');
                        suntingForm.action = `/menuTenant/${id}`;

                        fetch(`/menuTenant/${id}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                document.getElementById('suntingNamaProduk').value = data
                                .namaproduk;
                                document.getElementById('suntingHargaProduk').value = data
                                    .hargaproduk;
                            })
                    });
                });

                hapus.forEach(function(button) {
                    button.addEventListener('click', function() {
                        const id = button.getAttribute('data-id');
                        deleteForm.action = `/menuTenant/${id}`;
                    })
                })
            });
        </script>

</body>

</html>
<!--INI YG BARU -->
