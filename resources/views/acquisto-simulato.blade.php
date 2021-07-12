@extends('layouts.frame-public')

@section('content')

    <div class="body_wrap">
        <div class="page_wrap">

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
                                                            @if($request->counter == 1)
                                                                <h1 class="tribe-events-single-event-title">Hai appena acquistato un biglietto!</h1>
                                                            @else
                                                                <h1 class="tribe-events-single-event-title">Hai appena acquistato {{ $request->counter }} biglietti!</h1>
                                                            @endif
                                                            <br>
                                                            <h2>Spesa Totale: € {{ $spesaTotale }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
                                                    <div class="tribe-events-meta-group tribe-events-meta-group-details">
                                                        <br>
                                                        <h3 class="tribe-events-single-section-title"> Dettagli </h3>
                                                        <dl>
                                                            <dt> Nome: </dt>
                                                            <dd class="tribe-events-event-categories">
                                                                {{$evento->nome}}
                                                            </dd>

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
                                                        </dl>
                                                    </div>
                                                    <div class="tribe-events-meta-group tribe-events-meta-group-venue">
                                                        <br>
                                                        <h3 class="tribe-events-single-section-title">Luogo</h3>
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
                                                            <a href="{{ route('eventi') }}"><span>&laquo;</span> Torna All'Elenco Degli Eventi</a>
                                                        </li>
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

                </div>
            </div>

@endsection
