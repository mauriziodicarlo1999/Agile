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
                                        <a href="{{ route('calendario-eventi-preferiti') }}" class="sc_button sc_button_square sc_button_style_filled sc_button_size_medium" style="margin-left: 900px; top: 20px; width: 200px;">
                                            Vista Calendario
                                        </a>
                                        <h3 class="sc_title margin_bottom_50 margin_top_40">I Tuoi Sottoeventi Preferiti</h3>
                                        @if(\Illuminate\Support\Facades\Auth::user()->subevents->count() == 0)
                                            <div class="alert alert-danger" role="alert">
                                                Nessun sottoevento preferito da mostrare, <a href="{{ route('eventi') }}">iscriviti ora al tuo primo evento </a> per poter accedere ai relativi sottoeventi!
                                            </div>
                                        @else
                                             <div class="sc_table margin_top_0">
                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Evento</th>
                                                        <th>Tipologia</th>
                                                        <th>Città</th>
                                                        <th>Sottoevento preferito</th>
                                                        <th>Data inizio</th>
                                                        <th>Data fine</th>
                                                        <th>Visualizza dettagli</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php($count=1)
                                                    @foreach(\Illuminate\Support\Facades\Auth::user()->subevents as $subevent)
                                                        <tr>
                                                            <td>
                                                                <b>{{ $count++ }}</b>
                                                            </td>
                                                            <td>{{ $subevent->event->nome }}</td>
                                                            <td>{{ $subevent->event->tipologia }}</td>
                                                            <td>{{ $subevent->event->citta }}</td>
                                                            <td>{{ $subevent->titolo }}</td>
                                                            <td>{{ $subevent->data_ora_inizio }}</td>
                                                            <td>{{ $subevent->data_ora_fine }}</td>
                                                            <td><a href="{{ route('sottoevento', $subevent->id) }}">Vai alla pagina del sottoevento</a></td>
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
