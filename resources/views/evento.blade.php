@extends('layouts.frame-public')

@section('content')

    <div class="body_wrap">
        <div class="page_wrap">
            <div class="top_panel_fixed_wrap"></div>
            <div class="top_panel_title top_panel_style_6  title_present breadcrumbs_present scheme_original">
                <div class="top_panel_title_inner top_panel_inner_style_6  title_present_inner breadcrumbs_present_inner">
                    <div class="content_wrap">
                        <h1 class="page_title">{{$evento->nome}}</h1>
                        <div class="breadcrumbs">
                            <a class="breadcrumbs_item home" href="{{ route('dashboard') }}">Home</a>
                            <span class="breadcrumbs_delimiter"></span>
                            <a class="breadcrumbs_item home" href="{{ route('eventi') }}">Eventi</a>
                            <span class="breadcrumbs_delimiter"></span>
                            <span class="breadcrumbs_item current">{{$evento->nome}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page_content_wrap page_paddings_yes">
                <div class="content_wrap">
                    <div class="content">
                        <article class="post_content">
                            <div class="post_content">

                                <section class="light_section">
                                    <div class="container">
                                        <section class="post tribe_events_wrapper">
                                            <article class="post_content">
                                                <div id="tribe-events-pg-template">
                                                    <div id="tribe-events" class="tribe-no-js" data-live_ajax="1" data-datepicker_format="0" data-category="">
                                                        <div class="tribe-events-before-html">
                                                        </div>
                                                        <span class="tribe-events-ajax-loading">
															<img class="tribe-events-spinner-medium" src="js/vendor/the-events-calendar/resources/images/tribe-loading.gif" alt="Loading Events" />
														</span>
                                                        <div id="tribe-events-content" class="tribe-events-single no_margin">
                                                            <p class="tribe-events-back">
                                                                <a href="{{ route('eventi') }}"> &laquo; Tutti gli Eventi</a>
                                                            </p>
                                                            @if($evento->data_ora_fine < now())
                                                            <div class="tribe-events-notices">
                                                                <ul>
                                                                    <li>Questo Evento è Passato!</li>
                                                                </ul>
                                                            </div>
                                                            @endif
                                                            <h1 class="tribe-events-single-event-title">{{$evento->nome}}</h1>
                                                            <div class="tribe-events-schedule tribe-clearfix">
                                                                <h2>
                                                                    <span class="tribe-event-date-start">{{$evento->data_ora_inizio}}</span>
                                                                    -
                                                                    <span class="tribe-event-date-end">{{$evento->data_ora_fine}}</span>
                                                                </h2>
                                                            </div>
                                                            
                                                                <div class="tribe-events-single-event-description tribe-events-content">
                                                                    <p>{{$evento->descrizione}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tribe-events-after-html"></div>
                                                    </div>
                                                </div>
                                                <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
                                                    <div class="tribe-events-meta-group tribe-events-meta-group-details">
                                                        <h3 class="tribe-events-single-section-title">Dettagli:</h3>
                                                        <dl>
                                                            <dt> Data Inizio: </dt>
                                                            <dd class="tribe-events-abbr updated published dtstart">
                                                                {{$evento->data_ora_inizio}}
                                                            </dd>
                                                            <dt> Data Fine: </dt>
                                                            <dd class="tribe-events-abbr updated published dtstart">
                                                                {{$evento->data_ora_fine}}
                                                            </dd>
                                                            <dt>Categoria Evento:</dt> <dd class="tribe-events-event-categories">
                                                                {{$evento->tipologia}}
                                                            </dd>
                                                            @if($artisti->count() > 0)
                                                            <dt>Artisti Presenti All'Evento:</dt>
                                                            @endif
                                                            @foreach($artisti as $artista)
                                                            <li class="tribe-events-event-categories"><a href="{{route('artista', $artista->id)}}">{{$artista->anome_arte}}</a></li>
                                                            @endforeach
                                                            @if($sottoeventi->count() > 0)
                                                            <dt>Sottoeventi a cui potrai accedere:</dt>
                                                            @endif
                                                            @foreach($sottoeventi as $sottoevento)
                                                                <li class="tribe-events-event-categories"><a href="{{ route('sottoevento',$sottoevento->id)}}">{{$sottoevento->titolo}}</a></li>
                                                            @endforeach
                                                        </dl>
                                                    </div>
                                                    <div class="tribe-events-meta-group tribe-events-meta-group-venue">
                                                        <h3 class="tribe-events-single-section-title">Luogo:</h3>
                                                        <dl>
                                                            <dt></dt>
                                                            <dd class="tribe-venue-location">
                                                                <address class="tribe-events-address">
																<span class="tribe-address">
																	<span class="tribe-street-address">{{$evento->citta}}, {{$evento->indirizzo}}</span>
																</span>
                                                                </address>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                                <div id="tribe-events-footer">
                                                    <h3 class="tribe-events-visuallyhidden">Event Navigation</h3>
                                                    <ul class="tribe-events-sub-nav">
                                                        <li class="tribe-events-nav-previous">
                                                            <a href="{{ route('eventi') }}" style="z-index: 0"><span>&laquo;</span> Torna All'Elenco Degli Eventi</a>
                                                        </li>

                                                            @if(\Illuminate\Support\Facades\DB::table('inscriptions')->where('id_evento', $evento->id)->sum('biglietti_acquistati') >= $evento->max_iscritti)
                                                                <div class="alert alert-danger" role="alert" style="width: 500px;float: right;background: #eb5b5b;font-weight: bold;">Nessun posto disponibile!</div>
                                                            @else
                                                                @if($evento->data_ora_fine > now())
                                                                    @if($evento->tipologia_iscrizione == 1)
                                                                        <button class="tribe-events-nav-next" style="border-radius: 30px" onclick="document.getElementById('id01').style.display='block'"> Acquista</button>
                                                                    @else
                                                                        <button class="tribe-events-nav-next" style="border-radius: 30px" onclick="window.location.href='https://www.ticketone.it/';">Acquista su ticketone</button>
                                                                    @endif
                                                                @endif
                                                            @auth

                                                                @if($offerte->count() > 0)
                                                                    <div id="id01" class="modal1" style="width: auto;height: 420px;margin-top: 130px;margin-left: 500px;overflow: hidden;border-radius: 20px;">
                                                                    <span onclick="document.getElementById('id01').style.display='none'" class="close1" title="Close Modal">&times;</span>
                                                                    <form method="post" class="modal-content1" style="width: fit-content;height: 420px;margin-top: -50px;padding:75px;border-radius: 20px;" action="{{ route('acquisto-simulato') }}">
                                                                @else
                                                                    <div id="id01" class="modal1" style="width: auto;height: 330px;margin-top: 130px;margin-left: 500px;overflow: hidden;border-radius: 20px;">
                                                                    <span onclick="document.getElementById('id01').style.display='none'" class="close1" title="Close Modal">&times;</span>
                                                                    <form method="post" class="modal-content1" style="width: fit-content;height: 330px;margin-top: -50px;padding:75px;border-radius: 20px;" action="{{ route('acquisto-simulato') }}">
                                                                @endif
                                                                        @csrf
                                                                        <div class="container1">

                                                                            <h2>Acquista Biglietti</h2>
                                                                            <p>Indicare qui sotto il numero di biglietti che si desidera acquistare.</p>

                                                                            <label for="counter">Numero Biglietti:</label>
                                                                            <input type="number" value="1" min="1" max="{{ ($evento->max_iscritti) - \Illuminate\Support\Facades\DB::table('inscriptions')->where('id_evento', $evento->id)->sum('biglietti_acquistati') }}" name="counter" id="counter" class="form-control" style="height: 30px;text-align-last: center;border: 1px solid lightgray;margin-bottom: 10px;float: right;width: fit-content;">
                                                                            <input type="hidden" value="{{ $evento->id }}" name="id">
                                                                            <input type="hidden" value="{{ $evento->prezzo }}" name="prezzo">

                                                                            @if($offerte->count() > 0)
                                                                                <div class="row" style="margin-top: 30px; justify-content: center;">
                                                                                    @foreach($offerte as $offerta)
                                                                                        <div class="card" style="width: 20rem; margin-right: 50px; margin-bottom: 10px;">
                                                                                            <div class="card-body">
                                                                                                <p class="card-text">Verrà applicato uno sconto del {{ $offerta->sconto }}&#37; ! </p>
                                                                                                <input type="hidden" value="{{ $offerta->sconto }}" name="sconto">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                            <div class="clearfix1" style="padding: 25px;">
                                                                                <!--<button type="button" class="cancelbtn1" onclick="document.getElementById('id01').style.display='none'">Annulla</button>
                                                                                <button type="button" class="deletebtn1" onclick="location.href='eliminaOggetto.php?id=<[id]>&table=<[table]>'">Elimina</button>
                                                                                <button type="button" class="tribe-events-nav-previous" onclick="document.getElementById('id01').style.display='none'" style="background: #b0b0b0;">Annulla</button>
                                                                                -->

                                                                                <li class="tribe-events-nav-previous">
                                                                                    <a  onclick="document.getElementById('id01').style.display='none'" style="background: #b0b0b0;">Annulla</a>
                                                                                </li>
                                                                                <input class="tribe-events-nav-next" type="submit" style="border-radius: 30px" value="Compra Evento" >
                                                                            </div>
                                                                    </form>

                                                            </div>
                                                            @endauth
                                                        @guest
                                                                <div id="id01" class="modal1" style="margin-top: 10px;left: 189px; right: 189px;border-radius: 20px;background-color: unset;width: auto; height: auto;">
                                                                    <span onclick="document.getElementById('id01').style.display='none'" class="close1" title="Close Modal" style="margin-top: 100px;">&times;</span>
                                                                    <form method="post" class="modal-content1" style="border-radius: 20px;width:auto;" action="{{ route('acquisto-simulato') }}">
                                                                        @csrf
                                                                        <div class="container1">
                                                                                <h2>Inserisci i dati ed acquista i biglietti</h2>
                                                                                <p>Indicare qui sotto una email dove ricevere gli acquisti e un metodo di pagamento valido.<br> Successivamente scegliere il numero di biglietti che si desidera acquistare.</p>
                                                                            <!--<div class="row">
                                                                                <div class="col">
                                                                                    <label for="email">Email</label>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <input type="email" name="email" id="email" class="form-control" style="float: right; background-color: white; border: 1px solid grey; height: 30px;">
                                                                                </div>
                                                                            </div>-->
                                                                            <div class="row2">
                                                                                <div class="col-752">
                                                                                    <div class="container2">
                                                                                        <h3 style="display: block">Indirizzo di fatturazione e pagamento</h3>
                                                                                        <div class="row2">
                                                                                                <div class="col-502">
                                                                                                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                                                                                    <input type="text" id="fname" name="nome" placeholder="Mario Rossi" required>
                                                                                                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                                                                                    <input type="text" id="email" name="email" placeholder="mario@example.com" required>
                                                                                                    <!--<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                                                                                    <input type="text" id="adr" name="indirizzo" placeholder="542 W. 15th Street">
                                                                                                    <label for="city"><i class="fa fa-institution"></i> City</label>
                                                                                                    <input type="text" id="city" name="city" placeholder="New York">-->
                                                                                                    <label for="cname">Nome sulla carta</label>
                                                                                                    <input type="text" id="cname" name="cardname" placeholder="Mario Rossi" required>
                                                                                                </div>

                                                                                                <div class="col-502">

                                                                                                    <label for="ccnum">Numero della carta</label>
                                                                                                    <input type="text" id="ccnum" name="cardnumber" maxlength="19" pattern="/^([0-9]{4}( |\-)){3}[0-4]{4}$/" placeholder="1111-2222-3333-4444" required>
                                                                                                    <label for="expmonth">Scadenza</label>
                                                                                                    <input type="month" id="expmonth" name="expmonth" placeholder="01/2023" required>
                                                                                                    <label for="cvv">CVV</label>
                                                                                                    <input type="text" id="cvv" name="cvv" maxlength="3" placeholder="123" required>

                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="row2">
                                                                                                <div class="col-502" style="text-align: -webkit-right;">
                                                                                                    <label for="counter" style="vertical-align: -webkit-baseline-middle;">Numero Biglietti:</label>
                                                                                                </div>
                                                                                                <div class="col-502">
                                                                                                    <input type="number" value="1" min="1" max="{{ ($evento->max_iscritti) - \Illuminate\Support\Facades\DB::table('inscriptions')->where('id_evento', $evento->id)->sum('biglietti_acquistati') }}" name="counter" id="counter" class="form-control" style="height: 46px;text-align-last: center;border: 1px solid lightgray;margin-bottom: 10px;float: right;">
                                                                                                </div>
                                                                                            </div>
                                                                                        <div class="clearfix1" style="padding: 25px;">
                                                                                        <li class="tribe-events-nav-previous">
                                                                                            <a onclick="document.getElementById('id01').style.display='none'" style="background: #b0b0b0;">Annulla</a>
                                                                                        </li>
                                                                                        <input class="tribe-events-nav-next" type="submit" style="border-radius: 30px" value="Compra Evento" >
                                                                                        </div>
                                                                                            <!--<input type="submit" value="Continue to checkout" class="btn">-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" value="{{ $evento->id }}" name="id">
                                                                            <input type="hidden" value="{{ $evento->max_iscritti }}" name="maxIscritti">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endguest
                                                            @endif

                                                    </ul>
                                                </div>
                                                <div class="tribe-events-after-html">
                                                </div>
                                            </article>
                                        </section>
                                    </div>
                                </section>

                            </div>
                        </article>
                    </div>

                    <footer class="footer_wrap widget_area scheme_original">
                        <div class="footer_wrap_inner widget_area_inner" style="background-color: aliceblue">
                            <div class="content_wrap">
                                <div class="columns_wrap">
                                    <aside class="widget widget_categories">
                                        <h5 class="widget_title">Eventi</h5>
                                        @foreach($evento1 as $item4)
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
                                          
                                             <span>Globex-corporation@univaq.it</span>
                                            </p>
                                        </div>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </footer>

                </div>
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
                .cancelbtn1, .deletebtn1 {
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
                    color: #b2aeae;
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

                .row2 {
                    display: -ms-flexbox; /* IE10 */
                    display: flex;
                    -ms-flex-wrap: wrap; /* IE10 */
                    flex-wrap: wrap;
                    margin: 0 -16px;
                }

                .col-25 {
                    -ms-flex: 25%; /* IE10 */
                    flex: 25%;
                }

                .col-502 {
                    -ms-flex: 50%; /* IE10 */
                    flex: 50%;
                }

                .col-752 {
                    -ms-flex: 75%; /* IE10 */
                    flex: 75%;
                }

                .col-25,
                .col-502,
                .col-752 {
                    padding: 0 16px;
                }

                .container2 {
                    background-color: #f2f2f2;
                    padding: 5px 20px 15px 20px;
                    border: 1px solid lightgrey;
                    border-radius: 3px;
                }

                input[type=text] {
                    width: 100%;
                    margin-bottom: 20px;
                    padding: 12px;
                    border: 1px solid #ccc;
                    border-radius: 3px;
                }
                input[type=month] {
                    width: 100%;
                    margin-bottom: 20px;
                    padding: 12px;
                    border: 1px solid #ccc;
                    border-radius: 3px;
                }

                label2 {
                    margin-bottom: 10px;
                    display: block;
                }

                .icon-container2 {
                    margin-bottom: 20px;
                    padding: 7px 0;
                    font-size: 24px;
                }

                .btn2 {
                    background-color: #04AA6D;
                    color: white;
                    padding: 12px;
                    margin: 10px 0;
                    border: none;
                    width: 100%;
                    border-radius: 3px;
                    cursor: pointer;
                    font-size: 17px;
                }

                .btn2:hover {
                    background-color: #45a049;
                }

                span.price {
                    float: right;
                    color: grey;
                }

                /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
                @media (max-width: 800px) {
                    .row {
                        flex-direction: column-reverse;
                    }
                    .col-25 {
                        margin-bottom: 20px;
                    }
                }
            </style>
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
