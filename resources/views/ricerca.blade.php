@extends('layouts.frame-public')

@section('content')

    <div class="body_wrap" style="background-color: #9ab8e53b">
        <div class="page_wrap" style="background-color: #f4f8f9">
            <div class="top_panel_fixed_wrap">
            </div>
            <div class="top_panel_title top_panel_style_6  title_present breadcrumbs_present scheme_original">
                <div
                    class="top_panel_title_inner top_panel_inner_style_6  title_present_inner breadcrumbs_present_inner"
                    style="background-color: #9ab8e585">
                    <div class="content_wrap">
                        <h1 class="page_title">Risultati per "{{ $search }}"</h1>
                        <div class="breadcrumbs">
                            <a class="breadcrumbs_item home" href="http://127.0.0.1:8000">Home</a>
                            <span class="breadcrumbs_delimiter"></span>
                            <span class="breadcrumbs_item current" style="color: #232a34;">Risultati ricerca</span>
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
                                                    <div id="tribe-events" class="">
                                                        <div class="tribe-events-before-html">
                                                        </div>
                                                        <div id="tribe-events-content-wrapper" class="tribe-clearfix">
                                                            <input type="hidden" id="tribe-events-list-hash" value="">
                                                            <div id="tribe-events-content" class="tribe-events-list">
                                                                <div id="tribe-events-header"
                                                                     data-title="Past Events – Events – Event Management"
                                                                     data-startofweek="1" data-view="past"
                                                                     data-baseurl="#">
                                                                    <ul class="tribe-events-sub-nav">
                                                                    </ul>
                                                                </div>
                                                                <h1>Eventi</h1>
                                                                <div class="tribe-events-loop">
                                                                    @foreach($events as $event)
                                                                        <div class="type-tribe_events tribe-clearfix tribe-events-last">
                                                                            <h2 class="tribe-events-list-event-title">
                                                                                <a class="tribe-event-url" href="{{ route('evento',$event->id)}}" title="Leadership and Management Training" rel="bookmark">{{$event->nome}}</a>
                                                                            </h2>
                                                                            <div class="tribe-events-event-meta">
                                                                                <div class="author  location">
                                                                                    <div class="tribe-event-schedule-details">
                                                                                        <span class="tribe-event-date-start">{{$event->data_ora_inizio}}</span>
                                                                                        -
                                                                                        <span class="tribe-event-date-end">{{$event->data_ora_fine}}</span>
                                                                                    </div>
                                                                                    <div class="tribe-events-venue-details">
                                                                                        <address class="tribe-events-address">
																						<span class="tribe-address">
																							<span class="tribe-street-address">{{$event->citta}}, {{$event->indirizzo}}</span>
																						</span>
                                                                                        </address>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="tribe-events-event-image">
                                                                                <a href="{{ route('evento',$event->id) }}">
                                                                                    <img src="storage/{{ \App\Models\Image::all()->where('id', $event->id_copertina)->first()->path }}" class="attachment-medium size-medium" alt="Immagine Evento" />
                                                                                </a>
                                                                            </div>
                                                                            <div class="tribe-events-list-event-description tribe-events-content">
                                                                                <p>{{$event->descrizione}}</p>
                                                                                <a href="{{ route('evento',$event->id) }}" class="tribe-events-read-more" rel="bookmark">Leggi di più &raquo;</a>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div id="tribe-events-footer">
                                                                    <ul class="tribe-events-sub-nav">
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tribe-events-after-html">
                                                        </div>
                                                    </div>
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

            <footer class="footer_wrap widget_area scheme_original">
                <div class="footer_wrap_inner widget_area_inner" style="background-color: aliceblue">
                    <div class="content_wrap">
                        <div class="columns_wrap">
                            <aside class="widget widget_categories">
                                <h5 class="widget_title">Eventi</h5>
                                <ul>
                                    <li class="cat-item cat-item-42">
                                        <a href="http://127.0.0.1:8000/evento-1">Tito Watsica</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="cat-item cat-item-42">
                                        <a href="http://127.0.0.1:8000/evento-2">Aniya Bayer</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="cat-item cat-item-42">
                                        <a href="http://127.0.0.1:8000/evento-3">Dr. Nadia Abbott I</a>
                                    </li>
                                </ul>
                            </aside>
                            <aside class="widget widget_recent_comments">
                                <h5 class="widget_title">Commenti Recenti</h5>
                            </aside>
                            <aside class="widget widget_recent_entries" style="width: auto;margin-right: 20px;">
                                <h5 class="widget_title">Topics Recenti</h5>
                                <ul>
                                    <li>
                                        <a href="http://127.0.0.1:8000/topic-4">Leon Ryan</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <a href="http://127.0.0.1:8000/topic-5">Gilda Becker</a>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <a href="http://127.0.0.1:8000/topic-2">Karen Johnson</a>
                                    </li>
                                </ul>
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
    </div>

@endsection
