@extends('admin.frame-public')
@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Lista Eventi </h3>
                                <div class="card-tools">
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('creazione-evento') }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Aggiungi evento
                                        </a>
                                    </td>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="text-align-last: center;">Immagine</th>
                                        <th style="text-align-last: center;">Nome</th>
                                        <th style="text-align-last: center;">Città</th>
                                        <th style="text-align-last: center;width:12%">Tipologia</th>
                                        <th>Stato Approvazione</th>
                                        <th style="text-align-last: center;">Azioni</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($evento as $evento)
                                        <tr>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $evento->id_copertina }}</td>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $evento->nome }}</td>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $evento->citta}}</td>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $evento->tipologia }}</td>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $evento->stato }}</td>
                                            <td class="project-actions text-right " style=" text-align-last: center;vertical-align: middle;">
                                                <a class="btn btn-primary btn-sm" href="{{ route('admin.evento', $evento->id) }}" style="margin-bottom: 3px;background-color: darkmagenta;border-color: darkmagenta; width: -webkit-fill-available;">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                    Vedi Evento
                                                </a>
                                                <a class="btn btn-primary btn-sm" href="{{ route('admin.prenotazioni', $evento->id) }}" style="margin-bottom: 3px; width: -webkit-fill-available;">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    Vedi Prenotazioni
                                                </a>
                                                <a class="btn btn-info btn-sm" href="{{ route('admin.modifica-evento', $evento->id) }}" style="margin-bottom: 3px; width: -webkit-fill-available;">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Modifica
                                                </a>
                                                <form action="{{ route('admin.events') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="action" value="elimina">
                                                    <input type="hidden" name="id" value="{{ $evento->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            style="margin-bottom: 3px; width: -webkit-fill-available;"
                                                            onclick="">
                                                        <i class="fas fa-trash">
                                                        </i>Elimina
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <style>

        /* Set a style for all buttons */
        button1 {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        button1:hover {
            opacity:1;
        }

        /* Float cancel and delete buttons and add an equal width */
        .cancelbtn1, .deletebtn1, .approvebtn1 {
            float: left;
            width: 50%;
        }

        /* Add a color to the cancel button */
        .cancelbtn1 {
            background-color: #ccc;
            color: black;
        }

        /* Add a color to the delete button */
        .deletebtn1 {
            background-color: #f44336;
        }

        .approvebtn1 {
            background-color: limegreen;
        }

        /* Add padding and center-align text to the container */
        .container1 {
            padding: 16px;
            text-align: center;
        }

        /* The Modal (background) */
        .modal1 {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: #474e5d;
            padding-top: 50px;
        }

        /* Modal Content/Box */
        .modal-content1 {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Style the horizontal ruler */
        hr1 {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* The Modal Close Button (x) */
        .close1 {
            position: absolute;
            right: 35px;
            top: 15px;
            font-size: 40px;
            font-weight: bold;
            color: #f1f1f1;
        }

        .close1:hover,
        .close1:focus {
            color: #f44336;
            cursor: pointer;
        }

        /* Clear floats */
        .clearfix1::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Change styles for cancel button and delete button on extra small screens */
        @media screen and (max-width: 300px) {
            .cancelbtn1, .deletebtn1 {
                width: 100%;
            }
        }
    </style>
@endsection
@section('scriptssrc')
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
@endsection
@section('scriptsJS')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        // Get the modal
        var modal1 = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target === modal1) {
                modal1.style.display = "none";
            }
        }
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function () {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })

    </script>

@endsection
