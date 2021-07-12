@extends('layouts.frame-public')

@section('content')

    <div class="body_wrap" style="background-color: #9ab8e53b">
        <div class="page_wrap" style="background-color: #f4f8f9">
            <div class="top_panel_fixed_wrap">
            </div>
            <div class="top_panel_title top_panel_style_6  title_present breadcrumbs_present scheme_original">
                <div class="top_panel_title_inner top_panel_inner_style_6  title_present_inner breadcrumbs_present_inner" style="background-color: white;">
                    <div class="content_wrap">
                        <h1 class="page_title">Lista Eventi</h1>
                        <div class="breadcrumbs">
                            <a class="breadcrumbs_item home" href="{{ route('dashboard') }}">Home</a>
                            <span class="breadcrumbs_delimiter"></span>
                            <span class="breadcrumbs_item current" style="color: #232a34;">Lista Eventi</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page_content_wrap page_paddings_yes" style="background-color:white">
                <div class="content_wrap">
                    <div class="content">
                        <article class="post_content">
                            <div class="post_content">

                                <section class="light_section">
                                    <div class="container">
                                        <section class="post tribe_events_wrapper">
                                            <article class="post_content">
                                                <div id="tribe-events-pg-template">
                                                    <div id="tribe-events" class="tribe-no-js">
                                                        <div class="tribe-events-before-html">
                                                        </div>
                                                        <div id="tribe-events-content-wrapper" class="tribe-clearfix">
                                                            <input type="hidden" id="tribe-events-list-hash" value="">
                                                            <div id="tribe-events-bar">
                                                                <form id="tribe-bar-form" class="tribe-clearfix" name="tribe-bar-form" method="post" action={{ route("eventi") }} style="border-radius: 10px;">
                                                                    @csrf
                                                                    <div id="tribe-bar-collapse-toggle" >
                                                                        Trova Eventi
                                                                        <span class="tribe-bar-toggle-arrow"></span>
                                                                    </div>
                                                                    <div id="tribe-bar-views">
                                                                        <div class="tribe-bar-views-inner tribe-clearfix">
                                                                            <h3 class="tribe-events-visuallyhidden">Visualizzazione Eventi</h3>
                                                                            <label>Vedi come</label>
                                                                            <a href="{{ route('eventi') }}"> Lista </a>
                                                                            <br>
                                                                            <a href="{{ route('calendario-eventi') }}"> Calendario </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tribe-bar-filters">
                                                                        <div class="tribe-bar-filters-inner tribe-clearfix">
                                                                            <div class="tribe-bar-date-filter">
                                                                                <label class="label-tribe-bar-date" for="tribe-bar-date">Eventi da</label>
                                                                                <input type="text" name="dataCerca" id="tribe-bar-date" value="" placeholder="Data" required="required">
                                                                                <input type="hidden" name="tribe-bar-date-day" id="tribe-bar-date-day" class="tribe-no-param" value="">
                                                                            </div>
                                                                            <div class="tribe-bar-search-filter">
                                                                                <label class="label-tribe-bar-search" for="tribe-bar-search">Cerca</label>
                                                                                <input type="text" name="nomeCerca" id="tribe-bar-search" value="" placeholder="Cerca" required="required">
                                                                            </div>
                                                                            <div class="tribe-bar-submit">
                                                                                <input class="tribe-events-button tribe-no-param" type="submit" name="submit-bar" value="Trova Eventi" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div id="tribe-events-content" class="tribe-events-list">
                                                                <div id="tribe-events-header"  data-title="Past Events &#8211; Events &#8211; Event Management" data-startofweek="1" data-view="past" data-baseurl="#">
                                                                    <ul class="tribe-events-sub-nav">
                                                                    </ul>
                                                                </div>
                                                                <div class="tribe-events-loop">
                                                                    @foreach($eventi as $evento)
                                                                    <div class="type-tribe_events tribe-clearfix tribe-events-last">
                                                                        <h2 class="tribe-events-list-event-title">
                                                                            <a class="tribe-event-url" href="{{ route('evento',$evento->id)}}" title="Leadership and Management Training" rel="bookmark">{{$evento->nome}}</a>
                                                                        </h2>
                                                                        <div class="tribe-events-event-meta">
                                                                            <div class="author  location">
                                                                                <div class="tribe-event-schedule-details">
                                                                                    <span class="tribe-event-date-start">{{$evento->data_ora_inizio}}</span>
                                                                                    -
                                                                                    <span class="tribe-event-date-end">{{$evento->data_ora_fine}}</span>
                                                                                </div>
                                                                                <div class="tribe-events-venue-details">
                                                                                    <address class="tribe-events-address">
																						<span class="tribe-address">
																							<span class="tribe-street-address">{{$evento->citta}}, {{$evento->indirizzo}}</span>
																						</span>
                                                                                    </address>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tribe-events-event-image">
                                                                            <a href="{{ route('evento',$evento->id) }}">
                                                                                <img src="storage/{{ \App\Models\Image::all()->where('id', $evento->id_copertina)->first()->path }}" class="attachment-medium size-medium" alt="Immagine Evento" style="height: 350px; width: auto;" />
                                                                            </a>
                                                                        </div>
                                                                        <div class="tribe-events-list-event-description tribe-events-content">
                                                                            <p>{{$evento->descrizione}}</p>
                                                                        </div>
                                                                        <a href="{{ route('evento',$evento->id) }}" class="tribe-events-read-more" rel="bookmark">Leggi di più &raquo;</a>
                                                                    </div>
                                                                    <hr>
                                                                @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="tribe-clear">
                                                                {{ $eventi->onEachSide(8)->links() }}
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
    </div>

@endsection
