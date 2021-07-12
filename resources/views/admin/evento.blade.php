@extends('admin.frame-public')
@section('link')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Evento</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Evento</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12" style="text-align-last: center;">
                            <h3 class="d-inline-block d-sm-none">{{ $evento->nome }}</h3>
                            <div class="col-12">
                                <img src="../storage/{{ \App\Models\Image::all()->where('id', $evento->id_copertina)->first()->path }}" class="product-image" alt="Event Image" style="border-radius: 15px;width: auto;border: 1px solid #001f3f;">
                            </div>
                        </div>
                        <div class="col-12" style="display: grid;grid-template-columns: auto auto;">
                            <h2 class="my-3" style="text-transform: capitalize;">Dettagli</h2>
                            <br>
                            <b>Nome: </b> {{ $evento->nome }}
                            <b>Città: </b> {{ $evento->citta }}
                            <b>Indirizzo: </b> {{ $evento->indirizzo }}
                            <b>Data e ora di inizio: </b> {{ $evento->data_ora_inizio }}
                            <b>Data e ora di fine: </b> {{ $evento->data_ora_fine }}
                            <b>Tipologia Evento: </b> {{ $evento->tipologia }}
                            <b>Massimo numero d'iscrizioni: </b> {{ $evento->max_iscritti }}
                            <b>Prezzo: </b> {{ $evento->prezzo }}
                            <b>Creatore: </b> {{ $evento->organizer->nome }}
                            <hr>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            </div>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            </div>
                            <div class="row" style="flex-wrap: nowrap;width: min-content;margin-left: 460px;">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.modifica-evento', $evento->id) }}" style="flex-wrap: nowrap;height: -webkit-fill-available;margin-right: 10px; -webkit-text-stroke: snow;">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Modifica
                                </a>
                                @if($evento->stato == 0)
                                    <div class="alert alert-success" role="alert" style=";margin-right: 10px;flex-wrap: nowrap;width: min-content;">Evento già approvato!</div>
                                @else
                                    <form action="{{ route('admin.evento', $evento->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="approvaEvento">
                                        <input type="hidden" name="id" value="{{ $evento->id }}">
                                        <button type="submit" class="btn btn-success btn-sm"
                                                style="margin-right: 10px;"
                                                onclick="">
                                            <i class="fas fa-check">
                                            </i>
                                            Approva Evento
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.events') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="action" value="elimina">
                                    <input type="hidden" name="id" value="{{ $evento->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            style="margin-right: 10px;"
                                            onclick="">
                                        <i class="fas fa-trash">
                                        </i>Elimina
                                    </button>
                                </form>
                        </div>
                    </div>
                    <div class="row mt-4" style="width: -webkit-fill-available;">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Descrizione</a>
                                <a class="nav-item nav-link" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Policy</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab" style="font-size: 13px;" > {{ $evento->descrizione }}</div>
                            <div class="tab-pane fade show" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab" style="font-size: 13px;" > {{ $evento->policy }}</div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
    <!-- jQuery -->
    <script src="dtml/ADMIN/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="dtml/ADMIN/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dtml/ADMIN/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dtml/ADMIN/dist/js/demo.js"></script>
@endsection
@section('scriptsJS')
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
