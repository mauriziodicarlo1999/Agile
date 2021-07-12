@extends('layouts.frame-public')

@section('content')
    <body class="blog body_style_wide body_filled article_style_stretch top_panel_show top_panel_above sidebar_show sidebar_right sidebar_outer_hide">
    <div class="body_wrap" style="background-color: #9ab8e53b">
        <body class="page_wrap" style="background-color: #569cd678">
        <div class="top_panel_fixed_wrap"></div>
        <div class="top_panel_title top_panel_style_6  title_present breadcrumbs_present scheme_original">
            <div class="top_panel_title_inner top_panel_inner_style_6  title_present_inner breadcrumbs_present_inner" style="background-color:white">
                <div class="content_wrap">
                    <h1 class="page_title">Carrello</h1>
                    <div class="breadcrumbs">
                        <a class="breadcrumbs_item home" href="{{ route('dashboard') }}">Home</a>
                        <span class="breadcrumbs_delimiter">
                        </span>
                        <span class="breadcrumbs_item current">Carrello</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="page_content_wrap with_padding page_paddings_yes">
            <div class="content_wrap">
                <div class="content">
                    <section class="light_section no_padding">
                        <div class="container-fluid">
                            <article class="post_item post_item_excerpt odd post">
                                <div class="post_featured mobile_tap_hover">
                                </div>
                                <div class="post_content clearfix">
                                    <span class="post_icon icon-book-open">
                                    </span>
                                    <h2> Grazie per aver scelto uno dei nostri pacchetti! </h2>
                                    <p>
                                    <h4> Visita la nostra pagina degli <a href="{{ route('eventi') }}"> eventi </a> per ulteriori acquisti! </h4>
                                    </p>
                                </div>
                            </article>
                        </aside>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        </body>
        </div>
    <br/>
    <br/>
    <br/>
        </body>
    </div>
@endsection
