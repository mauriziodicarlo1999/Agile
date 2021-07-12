@extends('layouts.frame-public')

@section('content')
    <body class="blog body_style_wide body_filled article_style_stretch top_panel_show top_panel_above sidebar_show sidebar_right sidebar_outer_hide">
    <div class="body_wrap" style="background-color: #9ab8e536">
        <body class="page_wrap" style="background-color: #9ab8e585">
        <div class="top_panel_fixed_wrap"></div>
        <div class="top_panel_title top_panel_style_6  title_present breadcrumbs_present scheme_original">
            <div class="top_panel_title_inner top_panel_inner_style_6  title_present_inner breadcrumbs_present_inner" style="background-color:white">
                <div class="content_wrap">
                    <h1 class="page_title">Lista Topics</h1>
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="{{ route('dashboard') }}">Home</a>
                        <span class="breadcrumbs_delimiter">
                        </span>
                        <span class="breadcrumbs_item current">Lista Topics</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="page_content_wrap with_padding page_paddings_yes" style="padding: 0">
            <div class="content_wrap">
                <div class="content">
                    <br/>
                    <div class="sidebar widget_area scheme_original" style="float: right;margin: 10px 20px;">
                        <div class="sidebar_inner widget_area_inner" style="background-color: #9ab8e585">
                            <aside class="widget widget_search">
                                <form method="get" class="search_form" action="#">
                                    <input type="text" class="search_field" placeholder="Ricerca il Topics" value="" name="ricerca" title="" style="color: black;"/>
                                    <button type="submit" class="search_button icon-search-light" style="color: black"></button>
                                </form>
                            </aside>
                        </div>
                    </div>
                    <section class="light_section no_padding">
                        <div class="container-fluid">
                            @php($row=0)
                            @foreach($varTopics as $item1)
                                @if($row==0) <div class="row" style="margin-left: 3px;"> @endif
                                <div class="card" style="width: 20rem; margin-right: 50px; margin-top: 30px;">
                                    <img src="" class="" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item1->titolo }}</h5>
                                        <p class="card-text">{{ $item1->descrizione }}</p>
                                        <a href="{{ route('topic', $item1->id) }}" class="btn btn-primary">Leggi di più</a>
                                    </div>
                                </div>
                                    @if($row==1) </div> @endif
                                    @if(++$row==2) @php($row=0) @endif
                            @endforeach
                            <div class="post_descr" style="margin-bottom: 50px">
                                <a href="{{ route('creazione-topic') }}" class="sc_button sc_button_square sc_button_style_filled sc_button_size_medium" style="margin-left: 900px; top: 20px; width: 200px;">
                                    Crea un Topic
                                </a>
                            </div>
                        </div>
                    </section>
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
        </body>
    </div>

    <a href="#" class="scroll_to_top icon-angle-up" title=""></a>

    </body>
@endsection

