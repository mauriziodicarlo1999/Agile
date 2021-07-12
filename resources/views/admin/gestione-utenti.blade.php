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
                    <h1>Lista Utenti nel sistema</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Gestione utenti</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped display nowrap">
                                <thead>
                                <tr>
                                    <th>NOME</th>
                                    <th>COGNOME</th>
                                    <th>EMAIL</th>
                                    <th>TELEFONO</th>
                                    <th>DATA DI NASCITA</th>
                                    <th>CITTA</th>
                                    <th>INDIRIZZO</th>
                                    <th>CATEGORIA</th>
                                    <th>ORGANIZZATI</th>
                                    <th>AMMINISTRAZIONE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Models\User::all() as $user)
                                    <tr>
                                        <td>{{ $user->nome }}</td>
                                        <td>{{ $user->cognome }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->telefono }}</td>
                                        <td>{{ $user->data_di_nascita }}</td>
                                        <td>{{ $user->citta }}</td>
                                        <td>{{ $user->indirizzo }}, {{ $user->civico }}</td>
                                        <td>{{ $user->categoria }}</td>
                                        <td>{{ $user->organizedEvents->count() }}</td>
                                        <td>
                                            <form method="post" action="{{ route('admin.gestione-utenti') }}">
                                                @csrf
                                                <input type="hidden" name="user" value="{{ $user->id }}">
                                                @if($user->categoria == "admin")
                                                    <input type="hidden" name="action" value="deleteAdmin">
                                                    <button type="submit" class="btn btn-danger">Rimuovi come admin</button>
                                                @else
                                                    <input type="hidden" name="action" value="insertAdmin">
                                                    <button type="submit" class="btn btn-success">Aggiungi come admin</button>
                                                @endif
                                            </form>
                                        </td>
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



