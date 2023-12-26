<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/kasir.css">
    <link href="sidebars.css" rel="stylesheet">

    <!-- JS DATATABLE-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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

    .popupConfirm{
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

    .popupConfirmContent{
        height: 300px;
        width: 700px;
        background:rgba(252, 255, 255, 1);
        border-radius: 5 px;
        position: relative; 
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
                    <a href="Confirm.html" class="nav-link">
                        <i class="bi bi-receipt" style="font-size: 2rem;"></i>
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#bi bi-receipt"/></svg>
                        Pesanan
                    </a>
                </li>
                <li>
                    <a href="menu.html" class="nav-link text-white">
                        <i class="bi bi-cup-straw" style="font-size: 2rem;"></i>
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                        Menu
                    </a>
                </li>
                <li>
                    <a href="report.html" class="nav-link text-white">
                        <i class="bi bi-journal-text" style="font-size: 2rem;"></i>
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                        Laporan
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#Syalala" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/pp kasir.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>Syalala</strong>
                </a>
                <ul class="dropdown-menu  text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="landpg.html">Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mb-2" style="height: 100vh; margin: 0;">
        <div class="card bg-light-subtle mt-4">
        <img src="assets\Nasi Goreng.jpg" class="card-img-top">
        <div class="card-body">
            <div class="text-section">
                <h5 class="card-title">Nasi Goreng</h5>
                <p class="card-text">ID Pesanan: ABC1234</p>
                <p class="card-text">Kolor Basecamp</p>
            </div>
            <div class="cta-section">
                <div>Rp 15,000</div>
                <button class="btn btn-danger" style="color: white;" id="butt">Konfirmasi Pemabayaran</button>
            </div>
        </div>
        </div>

        <div class="popupConfirm pt-2">
            <div class="popupConfirmContent ">

            <i class="bi bi-exclamation-circle" style="color: rgba(211, 36, 43, 1) ; font-size: 120px;"></i>
            <p style="font-weight: bold;">Pesanan berhasil Dikonfirmasi</p>
            <button type="button" class="btn mb-0 " id="buttonYes" style="background-color:rgba(211, 36, 43, 1); color: white;  width: 140px;">Ya</button>

            </div>
        </div>
    </div>

    <script>
        document.getElementById("butt").addEventListener("click", function () {
        document.querySelector(".popupConfirm").style.display = "flex";
    });
        document.getElementById("buttonYes").addEventListener("click", function () {
        document.querySelector(".popupConfirm").style.display = "none";
        });
    </script>

</body>
</html>