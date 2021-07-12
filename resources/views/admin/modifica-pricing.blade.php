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
                        <h1>Modifica Offerta</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Modifica Offerta</li>
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
                            <h3 class="card-title">Offerta</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.modifica-pricing', $offert->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="titolo">Titolo</label>
                                    <input type="text" id="titolo" name="titolo" class="form-control" value="{{ $offert->titolo }}"
                                           placeholder="titolo" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="scadenza">Data di scadenza</label>
                                    <input type="date" id="scadenza" name="scadenza" class="form-control" value="{{ $offert->scadenza }}"
                                           placeholder="data scadenza" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="sconto">Sconto</label>
                                    <input type="number" id="sconto" name="sconto" min="1" max="100" value="{{ $offert->sconto }}"
                                           class="form-control" required="required">
                                </div>

                                <div class="form-group">
                                    <label>Lista Eventi</label>
                                    <select class="form-control" id="evento" name="evento" required="required">
                                        <option value="{{ $offert->event->id }}" disabled selected>{{ $offert->event->nome }}</option>
                                        @foreach(\App\Models\Event::all() as $event)
                                            @if($offert->event->id != $event->id)
                                                <option value="{{ $event->id }}">{{ $event->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12" style="padding: 0 30px 5px 30px;">
                                    <input type="reset" onclick="location.href='{{ route('admin.modifica-pricing', $offert->id) }}'"
                                           class="btn btn-secondary" form="aggiungiOffertaForm" value="Cancella">
                                    <input type="submit" value="Modifica Offerta"
                                           class="btn btn-success float-right">
                                </div>
                            </form>
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
