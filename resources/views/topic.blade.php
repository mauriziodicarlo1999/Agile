@extends('layouts.frame-public')

@section('content')

    <body class="single single-post body_style_wide body_filled article_style_stretch top_panel_show top_panel_above sidebar_show sidebar_right sidebar_outer_hide">

    <div class="body_wrap">
        <div class="page_wrap" style="background-color:#f4f8f9">
            <div class="top_panel_fixed_wrap">
            </div>

            <div class="top_panel_title top_panel_style_6  title_present breadcrumbs_present scheme_original" >
                <div class="top_panel_title_inner top_panel_inner_style_6  title_present_inner breadcrumbs_present_inner" style="background-color:white">
                    <div class="content_wrap">
                        <h1 class="page_title">{{ $topic->titolo }}</h1>
                        <div class="breadcrumbs">
                            <a class="breadcrumbs_item home" href="{{ route('dashboard') }}">Home</a>
                            <span class="breadcrumbs_delimiter" style="color: unset">
							</span>
                            <span class="breadcrumbs_item current" style="color: unset">{{ $topic->titolo }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page_content_wrap with_padding page_paddings_yes margin_top_10" >
                <div class="content_wrap">
                    <div class="content">
                        <section class="light_section no_padding">
                            <div class="container-fluid">

                                <article class="post_item post_item_single post">
                                    <section class="post_featured">
                                        <div class="post_thumb" data-image="images/960x768.png" data-title="Best CRM Software 2015">
                                            <img alt="" src="">
                                        </div>
                                    </section>
                                    <h3 class="post_title entry-title">{{ $topic->titolo }}</h3>
                                    <div class="post_info">
                                        <div class="post_info_item post_info_posted">{{ $topic->created_at }}</div>
                                        <div class="post_info_item post_info_counters">
                                            <a class="post_counters_item post_counters_comments icon-speech-bubble25" title="Comments">
                                                <span class="post_counters_number">{{ $topic->comments->count() }} commenti</span>
                                            </a>
                                        </div>
                                    </div>
                                    <section class="post_content">
                                        <p>{{ $topic->descrizione }}</p>
                                    </section>
                                    <span class="badge bg-primary">Commenti</span>
                                    @if($topic->comments->count()==0)
                                        <section class="post_author author vcard" style="background-color: #c2d4ef";>
                                            <div class="alert alert-info" role="alert" style="background-color: aliceblue">
                                                Commenta prima di tutti!
                                            </div>
                                        </section>
                                    @else
                                        <section class="post_author author vcard">
                                            @foreach($topic->comments as $comment)
                                                <h6 class="post_author_title">
                                                <span>
                                                    <p>Nome utente: {{ $comment->nome_mittente }}</p>
                                                </span>
                                                </h6>
                                                <div class="post_author_info">
                                                    {{ $comment->testo }}
                                                </div>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            @endforeach()
                                        </section>
                                    @endif
                                    <section class="related_wrap related_wrap_empty"></section>
                                    <div class="column-2_3">
                                        <div class="sc_contact_form sc_form_fields">
                                            <form name="commento_topic" class="contact_1" method="post" action="{{ route('topic', $topic->id) }}">
                                                @csrf
                                                <div class="sc_form_info">
                                                    <div class="sc_form_item sc_form_field label_over">
                                                        <input type="text" name="nome" id="nome" placeholder="Inserisci il nome" value="" style="border: 1px solid black;border-radius: 10px;margin: 10px;">
                                                    </div>
                                                    <div class="sc_form_item sc_form_field label_over">
                                                        <input type="text" name="cognome" id="cognome" placeholder="Inserisci il cognome" value="" style="border: 1px solid black;border-radius: 10px;margin: 10px;">
                                                    </div>
                                                    <div class="sc_form_item sc_form_field label_over">
                                                        <input type="text" name="email" id="email" placeholder="Inserisci l'email" value="" style="border: 1px solid black;border-radius: 10px;margin: 10px;">
                                                    </div>
                                                </div>
                                                <div class="sc_form_item sc_form_message label_over">
                                                    <textarea  id="messaggio" class="textAreaSize" name="messaggio" placeholder="Inserisci il messaggio"
                                                               value="" style="border: 1px solid black;border-radius: 10px;margin: 10px;"></textarea>
                                                </div>
                                                <div class="sc_form_item sc_form_button">
                                                    <button type="submit" name="commento_topic" class="contact_form_submit">Invia</button>
                                                </div>
                                                <div class="result sc_infobox"></div>
                                            </form>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </section>
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

    </body>
@endsection

