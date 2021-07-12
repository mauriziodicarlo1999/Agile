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
                                        <h3 class="sc_title margin_bottom_50 margin_top_40">Eventi organizzati</h3>

                                        @if(isset($errore))
                                            <div class="alert alert-danger" role="alert">
                                                {{ $errore }}
                                            </div>
                                        @endif
                                        @if(isset($successo))
                                            <div class="alert alert-success" role="su">
                                                {{ $successo }}
                                            </div>
                                        @endif

                                        @if(\Illuminate\Support\Facades\Auth::user()->organizedEvents->count() == 0)
                                            <div class="alert alert-danger" role="alert">
                                                Nessun evento organizzato da mostrare, <a
                                                    href="{{ route('creazione-evento') }}">crea ora il tuo primo
                                                    evento!</a>
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
                                                        <th>Stato dell'evento</th>
                                                        <th>Azioni</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php($count=1)
                                                    @foreach(\Illuminate\Support\Facades\Auth::user()->organizedEvents as $event)
                                                        <tr>
                                                            <td>
                                                                <b>{{ $count++ }}</b>
                                                            </td>
                                                            <td>{{ $event->nome }}</td>
                                                            <td>{{ $event->tipologia }}</td>
                                                            <td>{{ $event->citta }}</td>
                                                            <td>{{ $event->data_ora_inizio }}</td>
                                                            <td>{{ $event->data_ora_fine }}</td>
                                                            @if($event->stato == 1)
                                                                <td>In revisione</td>
                                                            @else
                                                                @if($event->data_ora_inizio > now())
                                                                    <td>Confermato</td>
                                                                @else
                                                                    @if($event->data_ora_fine > now())
                                                                        <td>In corso</td>
                                                                    @else
                                                                        <td>Concluso</td>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <button id="btnGroupDrop1" type="button"
                                                                            class="btn btn-primary dropdown-toggle"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false"></button>
                                                                    <ul class="dropdown-menu"
                                                                        aria-labelledby="btnGroupDrop1">
                                                                        <li><a class="dropdown-item"
                                                                               href="{{ route('evento', $event->id) }}">Apri
                                                                                evento</a></li>
                                                                        <li>
                                                                            <button type="button" class="dropdown-item"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#newArtist"
                                                                                    data-bs-event="{{ $event->id }}">
                                                                                Aggiungi artista partecipante
                                                                            </button>
                                                                        </li>
                                                                        <li>
                                                                            <button type="button" class="dropdown-item"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#newSubevent"
                                                                                    data-bs-event="{{ $event->id }}">
                                                                                Aggiungi sottoevento
                                                                            </button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
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

                        <!-- Modale di aggiunta artista -->
                        <div class="modal fade" id="newArtist" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: deepskyblue">
                                        <h5 class="modal-title">Aggiungi un artista partecipante all'evento</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="{{ route('eventi-organizzati') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="action" value="newArtist">
                                            <input type="hidden" id="id_evento" name="id_evento" value="">
                                                <div class="form-group col-lg-12">
                                                    <label for="artista">Nuovo artista</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                            id="artista" name="artista" required="required">
                                                        <option value="" disabled="" selected="">-- Seleziona artista
                                                            --
                                                        </option>
                                                        @foreach(\App\Models\Artist::all() as $artist)
                                                            @if($artist->nome_arte == null)
                                                                <option value="{{ $artist->id }}">{{ $artist->nome }} {{ $artist->cognome }}</option>
                                                            @else
                                                                <option value="{{ $artist->id }}">{{ $artist->nome_arte }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Annulla
                                            </button>
                                            <input type="submit" class="btn btn-success" value="Salva modifiche">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modale di aggiunta sottoevento -->
                        <div class="modal fade" id="newSubevent" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: deepskyblue">
                                        <h5 class="modal-title">Aggiungi un sottoevento</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="{{ route('eventi-organizzati') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="action" value="newSubevent">
                                            <input type="hidden" name="id_evento" id="id_evento" value="">
                                            <div class="form-group col-lg-12">
                                                <label for="titolo">Titolo sottoevento</label>
                                                <input id="titolo" name="titolo" type="text" class="form-control" required="required">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label for="data_ora_inizio">Orario di inizio<br/>(successivo a quello dell'evento principale)</label>
                                                    <input id="data_ora_inizio" name="data_ora_inizio" type="datetime-local" class="form-control" required="required">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="data_ora_fine">Orario di fine<br/>(precedente a quello dell'evento principale)</label>
                                                    <input id="data_ora_fine" name="data_ora_fine" type="datetime-local" class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label for="descrizione">Descrizione</label>
                                                <textarea id="descrizione" name="descrizione" type="text" class="form-control" required="required"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                            <input type="submit" class="btn btn-success" value="Salva modifiche">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </article>
            </div>

        </div>
    </div>

    <script>
        var newArtist = document.getElementById('newArtist');
        newArtist.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            newArtist.querySelector('.modal-body #id_evento').value = button.getAttribute('data-bs-event');
        });
        var newSubevent = document.getElementById('newSubevent');
        newSubevent.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            newSubevent.querySelector('.modal-body #id_evento').value = button.getAttribute('data-bs-event');
        });
    </script>

@endsection
