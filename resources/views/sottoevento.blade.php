@extends('layouts.frame-public')

@section('content')

    <div class="body_wrap">
        <div class="page_wrap">
            <div class="top_panel_fixed_wrap"></div>
            <div class="top_panel_title top_panel_style_6  title_present breadcrumbs_present scheme_original">
                <div class="top_panel_title_inner top_panel_inner_style_6  title_present_inner breadcrumbs_present_inner">
                    <div class="content_wrap">
                        <h1 class="page_title">{{$sottoevento->titolo}}</h1>
                        <div class="breadcrumbs">
                            <a class="breadcrumbs_item home" href="{{ route('dashboard') }}">Home</a>
                            <span class="breadcrumbs_delimiter"></span>
                            <a class="breadcrumbs_item home" href="{{ route('eventi') }}">Eventi</a>
                            <span class="breadcrumbs_delimiter"></span>
                            <span class="breadcrumbs_item current">{{$sottoevento->titolo}}</span>
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
                                                                <a href="{{ route('evento', $sottoevento->id_evento) }}"> &laquo; Torna all'evento principale</a>
                                                            </p>
                                                            @if($sottoevento->data_ora_fine < now())
                                                                <div class="tribe-events-notices">
                                                                    <ul>
                                                                        <li>Questo Sottovento è Passato!</li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                            <h1 class="tribe-events-single-event-title">{{$sottoevento->titolo}}</h1>
                                                            <div class="tribe-events-schedule tribe-clearfix">
                                                                <h2>
                                                                    <span class="tribe-event-date-start">{{$sottoevento->data_ora_inizio}}</span>
                                                                    -
                                                                    <span class="tribe-event-date-end">{{$sottoevento->data_ora_fine}}</span>
                                                                </h2>
                                                            </div>
                                                            <div class="tribe_events type-tribe_events status-publish has-post-thumbnail hentry tribe_events_cat-conferences cat_conferences">
                                                                
                                                                <div class="tribe-events-single-event-description tribe-events-content">
                                                                    <p>{{$sottoevento->descrizione}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tribe-events-after-html"></div>
                                                    </div>
                                                </div>
                                                <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
                                                    <div class="tribe-events-meta-group tribe-events-meta-group-details">
                                                        <h3 class="tribe-events-single-section-title"> Dettagli </h3>
                                                        <dl>
                                                            <dt> Data Inizio: </dt>
                                                            <dd class="tribe-events-abbr updated published dtstart">
                                                                {{$sottoevento->data_ora_inizio}}
                                                            </dd>
                                                            <dt> Data Fine: </dt>
                                                            <dd class="tribe-events-abbr updated published dtstart">
                                                                {{$sottoevento->data_ora_fine}}
                                                            </dd>
                                                            <dt>Evento Principale:</dt> <dd class="tribe-events-event-categories">
                                                                <a href="{{ route('evento', $eventoPrincipale->eid) }}">{{$eventoPrincipale->enome}}</a>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div id="tribe-events-footer">
                                                    <h3 class="tribe-events-visuallyhidden">Event Navigation</h3>
                                                    <ul class="tribe-events-sub-nav">
                                                        <li class="tribe-events-nav-previous">
                                                            <a href="{{ route('evento', $eventoPrincipale->eid) }}"><span>&laquo;</span> Torna All'Evento principale</a>
                                                        </li>
                                                        @if(\Illuminate\Support\Facades\Auth::user() != null)
                                                            <li class="tribe-events-nav-next">
                                                                <form method="post" action="{{ route('sottoevento', $sottoevento->id) }}">
                                                                    @csrf
                                                                    @if(\Illuminate\Support\Facades\DB::table('subevents_selected')->where('id_subevento', $sottoevento->id)->where('id_utente', \Illuminate\Support\Facades\Auth::user()->id)->count() == 0)
                                                                        <input type="hidden" name="action" value="insert">
                                                                        <div class="sc_form_item sc_form_button">
                                                                            <button type="submit" class="submit_button">Aggiungi ai preferiti</button>
                                                                        </div>
                                                                    @else
                                                                        <input type="hidden" name="action" value="delete">
                                                                        <div class="sc_form_item sc_form_button">
                                                                            <button type="submit" class="submit_button">Rimuovi dai preferiti</button>
                                                                        </div>
                                                                    @endif
                                                                </form>
                                                            </li>
                                                        @else
                                                            <li class="tribe-events-nav-next">
                                                                <a href="{{ route('login') }}">Aggiungi ai preferiti</a>
                                                            </li>
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

@endsection
