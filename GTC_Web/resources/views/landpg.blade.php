<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="css/kasir.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="bg-landingpage container-fluid d-flex flex-column gap-2" style="padding-left: 40% ;padding-top: 15%;">
        <div>
            <h1 class="fw-bold text-white">Selamat Datang!</h1>
            <h1 class="fw-bold text-white">Silahkan Pilih Tipe Akun</h1>
        </div>
            
        <div class="d-flex gap-3">
            <a class="text-decoration-none" href="login_kasir.blade.php">
                <div class="bg-white rounded-3 ps-2 pe-5 py-2">
                    <div class="gap-2 d-flex align-items-center">
                        <div class="bg-black rounded-5 p-2">
                            <i class="bi bi-shop text-white"></i>
                        </div>
                        
                        <p class="fw-bold mb-0 text-black">Kasir</p>
                    </div>
                </div>
            </a>    
            
            <a class="text-decoration-none" href="login_tenant.html">
                <div class="bg-white rounded-3 ps-2 pe-5 py-2">
                    <div class="gap-2 d-flex align-items-center">
                        <div class="bg-black rounded-5 p-2">
                            <i class="bi bi-shop text-white"></i>
                        </div>
                        <p class="fw-bold mb-0 text-black">Tenant</p>
                    </div>
                </div>
            </a>

        </div>
    </div>
</body>

</html>