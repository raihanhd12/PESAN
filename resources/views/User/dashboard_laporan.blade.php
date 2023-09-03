<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PESAN - Data Laporan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>
    {{-- Section Header --}}
    <section class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <div class="container mt-4">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('reporter.index') }}">
                        <h4 class="semi-bold mb-0 text-white">PESAN</h4>
                        <p class="italic mt-0 text-white">Pengaduan Sederhana</p>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">

                    </div>
                </div>
            </div>
        </nav>

        <div class="text-center">
            <h2 class="medium text-white mt-3">Data Laporan Pengaduan</h2>
        </div>

        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </section>
    <div class="container py-5">
        <div class="row">
            <div class="col px-1">
                <div class="card" style="color: #08796e">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userTable" class="table table-striped table-bordered" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>ID Ticket</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/laporan/dashboard",
                    type: 'GET',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%'
                    },
                    {
                        data: 'reporter_name',
                        name: 'reporter.name',
                        orderable: true,
                        searchable: true,
                        width: '15%'
                    },
                    {
                        data: 'category_name',
                        name: 'category.name',
                        orderable: true,
                        searchable: true,
                        width: '10%'
                    },
                    {
                        data: 'ticket_id',
                        name: 'ticket_id',
                        orderable: true,
                        searchable: true,
                        width: '10%'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        orderable: true,
                        searchable: true,
                        width: '10%'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: true,
                        searchable: true,
                        width: '20%',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return '<span class="short-description">' + data.substr(0, 70) +
                                    '...</span>' +
                                    '<span class="full-description" style="display: none;">' +
                                    data + '</span>' +
                                    '<a href="#" class="read-more" style="text-decoration:none; color:#0cb8a7"> Baca lebih lanjut</a>';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true,
                        searchable: true,
                        width: '20%'
                    },

                ]
            });
            $(document).ready(function() {
                $('#userTable').on('click', '.read-more', function(e) {
                    e.preventDefault();
                    var container = $(this).closest('td');
                    var shortDescription = container.find('.short-description');
                    var fullDescription = container.find('.full-description');

                    if (shortDescription.is(':visible')) {
                        shortDescription.hide();
                        fullDescription.show();
                        $(this).text(' Tampilkan lebih sedikit');
                    } else {
                        shortDescription.show();
                        fullDescription.hide();
                        $(this).text(' Baca lebih lanjut');
                    }
                });
            });

        });
    </script>
</body>

</html>
