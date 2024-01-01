<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/kasir.css">

    <!-- JS DATATABLE-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--Things Needed for Date Range Picker-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    <main>
        <div class="bg-menu" style="background-color:  rgba(255, 255, 255, 1) ; height: 100vh;">

            <!--Sidebar-->
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white "
                style="width: 260px; ; background-color: rgba(211, 36, 43, 1); height: 100vh ;">
                <a href="/"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"></a>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="/pesananKasir" class="nav-link ">
                            <i class="bi bi-receipt" style="font-size: 2rem;"></i>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#bi bi-receipt" />
                            </svg>
                            Pesanan
                        </a>
                    </li>

                    <li>
                        <a href="/menuKasir" class="nav-link text-white">
                            <i class="bi bi-cup-straw" style="font-size: 2rem;"></i>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#speedometer2" />
                            </svg>
                            Menu
                        </a>
                    </li>

                    <li>
                        <a href="/reportKasir" class="nav-link text-white">
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

        <div class="report mx-5" style="width: 80vw; height: 100vh;">

            <div class="container" id="custom-container">
                <p>
                <div class="mx-5 mt-4" style="color: rgba(196, 35, 41, 1)">Cetak Laporan Pemesanan</div>
                </p>

                <p>
                <div class="mx-5 mt-4" style="color: rgba(196, 35, 41, 1)">Waktu Pesanan Dibuat</div>
                </p>

                {{-- <div class="col-4">
                    <div class="mt-4 input-group" style="margin-left: 0px;">
                        <input type="text" name="daterange" class="form-control" style="width: 250px;"
                            placeholder="Pilih Tanggal" />
                        <div class="input-group-append">
                            <button class="btn show-data-btn" type="button"
                                style="margin-left: 30px; background-color: rgba(211, 36, 43, 1); color: white; outline: none; box-shadow: none;">Show</button>
                        </div>
                    </div>
                </div> --}}

                <div class="col-4">
                    <div class="mt-4 input-group" style="margin-left: 0px;">
                        <input type="text" name="daterange" id="daterange" class="form-control" style="width: 250px;"
                            placeholder="Pilih Tanggal" />
                    </div>
                </div>


                <div class="container-fluid">
                    <table id="reportDataTable" class="table  mt-4 table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <td class="table-danger">ID Pesanan Kasir</td>
                                <td class="table-danger">Total Harga</td>
                                <td class="table-danger">Metode Pembayaran</td>
                                <td class="table-danger">Waktu Penjualan</td>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($reportData as $data)
                                <tr>
                                    <td>{{ $data->idPesananKasir }}</td>
                                    <td>{{ $data->totalHarga }}</td>
                                    <td>{{ $data->metodePembayaran }}</td>
                                    <td>{{ $data->waktuPenjualan }}</td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="menu.js"></script>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="sidebars.js"></script>

    <!--Date Range Picker Script-->
    {{-- <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'right',
                showDropdowns: true,
                ranges: {
                    'Last 7 Days': [moment().subtract(7, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                },
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' to ',
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });

            $('input[name="daterange"]').val('');
        });
    </script> --}}

    <script>
        $(function() {
            var table = $('#reportDataTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('reportKasir.index') }}",
                    data: function(data) {
                        data.startDate = $('#daterange').data('daterangepicker') ?
                            $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD') :
                            null;
                        data.endDate = $('#daterange').data('daterangepicker') ?
                            $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD') :
                            null;
                    }
                },
                columns: [{
                        data: 'idPesananKasir',
                        name: 'idPesananKasir'
                    },
                    {
                        data: 'totalHarga',
                        name: 'totalHarga'
                    },
                    {
                        data: 'metodePembayaran',
                        name: 'metodePembayaran'
                    },
                    {
                        data: 'waktuPenjualan',
                        name: 'waktuPenjualan'
                    }
                ]
            });

            $('input[name="daterange"]').daterangepicker({
                opens: 'right',
                showDropdowns: true,
                ranges: {
                    'Last 7 Days': [moment().subtract(7, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                },
                locale: {
                    format: 'YYYY-MM-DD', // Ensure the format matches the server-side format
                    separator: ' to ',
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
                table.draw();
            });
        });
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    
    {{-- <script src="js/report.js"></script> --}}


</body>

</html>
