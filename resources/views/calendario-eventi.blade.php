@extends('layouts.frame-public')

@section('content')

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="../plugins/fullcalendar/main.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Calendario Eventi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Calendario</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('eventi') }}" class="btn btn-primary">Torna indietro</a>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="sticky-top mb-3">
                                <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Lista Eventi</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- the events -->
                                            <div id="external-events">
                                                @foreach($eventi as $evento)
                                                    <div class="post_content" style="margin-bottom: 5px;background-color: antiquewhite;text: bold;font-variant-ligatures: contextual;font-size: larger;font-family: -webkit-pictograph;font-weight: bold;"> <a href="{{ route('evento', $evento->id) }}">{{ $evento->nome }}</a></div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                            <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card card-primary">
                                    <div class="card-body p-0">
                                        <!-- THE CALENDAR -->
                                        <div id="calendar"></div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <footer class="footer_wrap widget_area scheme_original">
            <div class="footer_wrap_inner widget_area_inner" style="background-color: aliceblue">
                <div class="content_wrap">
                    <div class="columns_wrap">
                        <aside class="widget widget_categories">
                            <h5 class="widget_title">Eventi</h5>
                            @foreach($evento2 as $item4)
                                <ul>
                                    <li class="cat-item cat-item-42">
                                        <a href="{{ route('evento', $item4->id) }}">{{ $item4->nome }}</a>
                                    </li>
                                </ul>
                            @endforeach
                        </aside>
                        <aside class="widget widget_recent_comments">
                            <h5 class="widget_title">Commenti Recenti</h5>
                            @foreach($varTopics3 as $item3)
                                <ul>
                                    <li class="recentcomments">
                                        <span class="comment-author-link">{{ $item3->nome_mittente }}</span>
                                        il
                                        <a href="{{ route('topic', $item3->id_topic)}}">{{ $item3->created_at }}</a>
                                    </li>
                                </ul>
                            @endforeach
                        </aside>
                        <aside class="widget widget_recent_entries" style="width: auto;margin-right: 20px;">
                            <h5 class="widget_title">Topics Recenti</h5>
                            @foreach($varTopics2 as $item2)
                                <ul>
                                    <li>
                                        <a href="{{ route('topic', $item2->id)}}">{{ $item2->titolo }}</a>
                                    </li>
                                </ul>
                            @endforeach
                        </aside>
                        <aside class="widget widget_recent_entries">
                            <h5 class="widget_title">Contattaci</h5>
                            <div class="textwidget">
                            <h6>Indirizzo</h6>
                                    <p>Via 20 settembre 2,L'Aquila</p>
                                    <p></p>
                                    <h6>Chiamaci</h6>
                                    <p>3285467892</p>
                                    <p></p>
                                    <h6>Email</h6>
                                    <p>
                                    <span>Globex.corporation@univaq.it</span>
                                </p>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery UI -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/fullcalendar/main.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex        : 1070,
                        revert        : true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [
                        @foreach($eventi as $event)
                        {
                            title          : '{{ $event->nome }}',
                            start          : '{{ $event->data_ora_inizio }}',
                            end            : '{{ $event->data_ora_fine }}',
                            backgroundColor: '#f39c12', //yellow
                            borderColor    : '#f39c12' //yellow
                        },
                        @endforeach
                ],
                editable  : true,
                droppable : true, // this allows things to be dropped onto the calendar !!!
                drop      : function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();
            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color'    : currColor
                })
            })
            $('#add-new-event').click(function (e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color'    : currColor,
                    'color'           : '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>
@endsection
