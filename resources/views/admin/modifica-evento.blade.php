@extends('admin.frame-public')
@section('link')
<!-- Select2 -->
<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- BS Stepper -->
<link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
<!-- dropzonejs -->
<link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifica Evento</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Modifica Evento</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->

        <section class="content" style="width: 53%;margin-inline: auto;">
            <div class="row">
                <div class="col-md-6" style="flex: none;max-width: none;">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Evento</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        @if(isset($errore))
                            <div class="alert alert-danger" role="alert">
                                {{ $errore }}
                            </div>
                        @endif
                        @if(isset($successo))
                            <div class="alert alert-success" role="su">
                                {{ $successo }}
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="post" id="modificaEventoForm" action="{{ route('admin.modifica-evento', $evento->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" id="nome" name="nome" value="{{ $evento->nome }}" class="form-control" placeholder="nome" required>
                                </div>
                                <div class="form-group">
                                    <label for="descrizione">Descrizione</label>
                                    <textarea id="descrizione" name="descrizione" class="form-control" rows="4" required> {{ $evento->descrizione }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="data_ora_inizio">Data e Ora di Inizio</label>
                                    <input type="datetime-local" id="data_ora_inizio" name="data_ora_inizio" value="{{ $evento->data_ora_inizio }}" class="form-control" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="data_ora_fine">Data e Ora di Fine</label>
                                    <input type="datetime-local" id="data_ora_fine" name="data_ora_fine" value="{{ $evento->data_ora_fine }}" class="form-control" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipologia">Tipologia</label>
                                        <select class="form-control" name="tipologia" id="tipologia" >
                                            <option value="Concerto">Concerto</option>
                                            <option value="Musical">Musical</option>
                                            <option value="Spettacolo">Spettacolo</option>
                                            <option value="Beneficienza">Beneficienza</option>
                                            <option value="Sport">Sport</option>
                                            <option value="Fiera">Fiera</option>
                                            <option value="Congresso">Congresso</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="policy">Policy</label>
                                    <textarea id="policy" name="policy" class="form-control" rows="4" required> {{ $evento->policy }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="max_iscritti">Massimo numero d'iscrizioni</label>
                                    <input type="number" id="max_iscritti" name="max_iscritti" value="{{ $evento->max_iscritti }}" class="form-control" placeholder="" required>
                                </div>
                                <!--<div class="form-group">
                                    <label for="customFile">Allega immagine</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="customFile" id="customFile" required>
                                        <label class="custom-file-label" for="customFile">Allega immagine</label>
                                    </div>
                                </div>-->
                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>
        <div class="col-12" style="padding: 0 30px 5px 30px;">
            <input type="reset" onclick="location.href='{{ route('admin.modifica-evento', $evento->id) }}'" class="btn btn-secondary" form="modificaEventoForm" value="Annulla modifiche">
            <input type="submit" name="submit" form="modificaEventoForm" value="Salva modifiche" class="btn btn-success float-right">
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <style>
        .sopra{
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .sopra:target{
            visibility: visible;
            opacity: 1;
        }

        .popup{
            margin: 90px auto auto auto;
            padding: 0px 10px 10px 10px;
            background: #fff;
            border-radius: 5px;
            width: fit-content;
            position: relative;
            transition: all 1s ease-in-out;
        }

        .popup .chiudi{
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .chiudi:hover{
            color: red;
        }

        .popup .contenuto{
            max-height: 30%;
            overflow: auto;
        }

        @media screen and (max-width: 700px) {
            .popup{
                width: 70%;
            }
        }
        .alert {
            opacity: 1;
            transition: opacity 0.6s; /* 600ms to fade out */
        }
    </style>

@endsection
@section('scriptssrc')
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
@endsection
@section('scriptsJS')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });
            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
    </script>
@endsection
