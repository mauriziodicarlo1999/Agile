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
                                <h3 class="card-title">Lista Offerte</h3>
                                <div class="card-tools">
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.aggiungi-pricing') }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Aggiungi offerta
                                        </a>
                                    </td>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="text-align-last: center;">Titolo</th>
                                        <th style="text-align-last: center;">Scadenza</th>
                                        <th style="text-align-last: center;">Sconto</th>
                                        <th style="text-align-last: center;width:12%">Evento</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($offerts as $offert)
                                        <tr>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $offert->titolo }}</td>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $offert->scadenza }}</td>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $offert->sconto}}</td>
                                            <td style="text-align-last: center;vertical-align: middle">{{ $offert->event->nome }}</td>
                                            <td class="project-actions text-right " style=" text-align-last: center;vertical-align: middle;">
                                                <a class="btn btn-info btn-sm" href="{{ route('admin.modifica-pricing', $offert->id) }}"
                                                        style="margin-bottom: 3px; width: -webkit-fill-available;"
                                                        onclick="">
                                                    <i class="fas fa-trash">
                                                    </i>Modifica
                                                </a>
                                                <form action="{{ route('admin.pricing') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="action" value="elimina">
                                                    <input type="hidden" name="id" value="{{ $offert->id }}">
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
@endsection
