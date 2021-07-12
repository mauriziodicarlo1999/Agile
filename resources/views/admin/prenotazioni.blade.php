@extends('admin.frame-public')

@section('link')
    <!-- datatables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista prenotati</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Gestione prenotazioni</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">{{ $evento->nome }}</h3>
                            <p class="text-muted text-center">dal {{ $evento->data_ora_inizio }}<br/>al {{ $evento->data_ora_fine }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Sottoeventi</b> <a class="float-right">{{ $evento->subevents->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Biglietti venduti</b> <a class="float-right">{{ $num }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Posti disponibili</b> <a class="float-right">{{ $evento->max_iscritti - $num}}</a>
                                </li>
                            </ul>

                            <a href="{{ route('admin.evento', $evento->id) }}" class="btn btn-primary btn-block"><b>Vai all'evento</b></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped display nowrap">
                                <thead>
                                <tr>
                                    <th>NOME</th>
                                    <th>COGNOME</th>
                                    <th>EMAIL</th>
                                    <th>TELEFONO</th>
                                    <th>BIGLIETTI ACQUISTATI</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($biglietti as $item)
                                    <tr>
                                        <td>{{ \App\Models\User::all()->where('id', $item->id_utente)->first()->nome }}</td>
                                        <td>{{ \App\Models\User::all()->where('id', $item->id_utente)->first()->cognome }}</td>
                                        <td>{{ \App\Models\User::all()->where('id', $item->id_utente)->first()->email }}</td>
                                        <td>{{ \App\Models\User::all()->where('id', $item->id_utente)->first()->telefono }}</td>
                                        <td>{{ $item->biglietti_acquistati }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection

@section('scriptssrc')
    <!-- TABLE -->
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
            $("#table").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "scrollX": true,
                "buttons": ["copy", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection



