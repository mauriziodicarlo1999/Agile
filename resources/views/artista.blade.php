@extends('layouts.frame-public')

@section('content')

    <div class="body_wrap" style="background-color: #9ab8e53b">
        <div class="page_wrap" style="background-color: #f4f8f9">
            <div class="top_panel_fixed_wrap">
            </div>

            <div class="top_panel_title top_panel_style_6  title_present breadcrumbs_present scheme_original">
                <div class="top_panel_title_inner top_panel_inner_style_6  title_present_inner breadcrumbs_present_inner" style="background-color:white">
                    <div class="content_wrap">
                        <h1 class="page_title" style="font-family: fantasy;
                        text-transform: capitalize;color: #040461">{{ $artista -> nome_arte }}</h1>
                        <div class="breadcrumbs">
                            <a class="breadcrumbs_item home" href="{{ route('dashboard') }}">Home</a>
                            <span class="breadcrumbs_delimiter"></span>
                            <span class="breadcrumbs_item current">{{ $artista -> nome_arte }} - Artista</span>
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
                                    <div class="container" style="padding-top: 40px;">
                                        <section class="post tribe_events_wrapper">
                                            <article class="post_content">
                                                <div id="tribe-events-pg-template">
                                                    <div id="tribe-events" class="tribe-no-js" data-live_ajax="1" data-datepicker_format="0" data-category="">
                                                        <div class="tribe-events-before-html">
                                                        </div>
                                                        <span class="tribe-events-ajax-loading">
															<img class="tribe-events-spinner-medium" src="storage/{{ \App\Models\Image::all()->where('id', $artista->id_copertina)->first()->path }}" />
														</span>
                                                        <div id="tribe-events-content" class="tribe-events-single no_margin">
                                                            <p class="tribe-events-back">
                                                                <a href="{{ route('eventi') }}"> &laquo; Tutti gli Eventi</a>
                                                            </p>

                                                            <h1 class="tribe-events-single-event-title">
                                                                @foreach( $generi as $genere )
                                                                    {{ $genere -> genere}}
                                                                @endforeach
                                                            </h1>
                                                            <div id="tribe-events-header"  data-title="Upcoming Events &#8211; Leadership and Management Training &#8211; ">
                                                                <h3 class="tribe-events-visuallyhidden"></h3>
                                                                <ul class="tribe-events-sub-nav">
                                                                    <li class="tribe-events-nav-previous">
                                                                        <a href="{{ route('eventi') }}">
                                                                            <span>&laquo;</span> Torna a tutti gli eventi</a>
                                                                    </li>
                                                                    <li class="tribe-events-nav-next">
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm">
                                                                    <img src="storage/{{ \App\Models\Image::all()->where('id', $artista->id_copertina)->first()->path }}" class="attachment-full size-full wp-post-image" alt="Immagine Artista"
                                                                    style="height: 400px; width: auto; border-radius: 50%"/>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <div class="tribe-events-meta-group tribe-events-meta-group-details">
                                                                        <h3 class="tribe-events-single-section-title" style="margin-top: 20px"> Informazioni </h3>
                                                                        <dl>
                                                                            <dt> Nome: </dt>
                                                                            <dd>
                                                                                <p class="tribe-events-abbr updated published dtstart" title="2015-12-17"> {{ $artista -> nome }}</p>
                                                                            </dd>
                                                                            <dt> Cognome: </dt>
                                                                            <dd>
                                                                                <p class="tribe-events-abbr updated published dtstart" title="2015-12-17"> {{ $artista -> cognome }}</p>
                                                                            </dd>
                                                                            <dt> Nome D'Arte: </dt>
                                                                            <dd>
                                                                                <p class="tribe-events-abbr updated published dtstart" title="2015-12-17"> {{ $artista -> nome_arte }}</p>
                                                                            </dd>
                                                                            <dt> Data Di Nascita: </dt>
                                                                            <dd>
                                                                                <p class="tribe-events-abbr updated published dtstart" title="2015-12-17"> {{ $artista -> data_di_nascita }} </p>
                                                                            </dd>
                                                                            <dt> Luogo Di Nascita: </dt>
                                                                            <dd>
                                                                                <p class="tribe-events-abbr updated published dtstart" title="2015-12-17">  {{ $artista -> luogo_di_nascita }} </p>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tribe-events-after-html">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
                                                    {{ $artista->biografia }}
                                                </div>
                                                <div id="tribe-events-footer">
                                                    <h3 class="tribe-events-visuallyhidden"></h3>
                                                    <ul class="tribe-events-sub-nav">
                                                        <li class="tribe-events-nav-previous" >
                                                            <a href="{{ route('eventi') }}" style="background-color: #719bda">
                                                                <span>&laquo;</span> Torna a tutti gli eventi</a>
                                                        </li>
                                                        <li class="tribe-events-nav-next">
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

            <footer class="footer_wrap widget_area scheme_original">
                <div class="footer_wrap_inner widget_area_inner" style="background-color: aliceblue">
                    <div class="content_wrap">
                        <div class="columns_wrap">
                            <aside class="widget widget_categories">
                                <h5 class="widget_title">Eventi</h5>
                                @foreach($evento as $item4)
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

    <a href="#" class="scroll_to_top icon-angle-up" title=""></a>

    <script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
    <script type='text/javascript' src='dist/js/custom/core.googlemap.js'></script>

@endsection

