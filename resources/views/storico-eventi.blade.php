@extends('layouts.frame-public')

@section('content')
    <div class="page_content_wrap with_padding page_paddings_yes">
        <div class="content_wrap">
            <div class="content">
                <article class="post_item post_item_single page type-page">
                    <div class="post_content">

                        <section class="light_section no_padding">
                            <div class="container-fluid">
                                <div class="sc_section">
                                    <div class="sc_section_inner">
                                        <h3 class="sc_title margin_bottom_50 margin_top_40">Storico degli eventi</h3>
                                        @if(\Illuminate\Support\Facades\Auth::user()->inscriptions->count() == 0)
                                            <div class="alert alert-danger" role="alert">
                                                Nessun evento da mostrare, <a href="{{ route('eventi') }}">iscriviti ora al tuo primo evento!</a>
                                            </div>
                                        @else
                                            <div class="sc_table margin_top_0">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome</th>
                                                    <th>Tipologia</th>
                                                    <th>Città</th>
                                                    <th>Data inizio</th>
                                                    <th>Data fine</th>
                                                    <th>Visulizza dettagli</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($count=1)
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->inscriptions as $event)
                                                    <tr>
                                                        <td>
                                                            <b>{{ $count++ }}</b>
                                                        </td>
                                                        <td>{{ $event->nome }}</td>
                                                        <td>{{ $event->tipologia }}</td>
                                                        <td>{{ $event->citta }}</td>
                                                        <td>{{ $event->data_ora_inizio }}</td>
                                                        <td>{{ $event->data_ora_fine }}</td>
                                                        <td><a href="{{ route('evento', $event->id) }}">Vai alla pagina dell'evento</a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="sc_line sc_line_style_solid sc_line_style_3 responsive_margins"
                                     style="undefined;"></div>
                            </div>
                        </section>

                    </div>
                </article>
            </div>

        </div>
    </div>
@endsection
