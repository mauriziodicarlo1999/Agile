@extends('layouts.frame-public')

@section('content')
    <section class="grey_section" xmlns="http://www.w3.org/1999/html">
        <div class="container">
            <div class="content_wrap">
                <div class="sc_form_wrap">
                    <div class="sc_form sc_form_style_form_2 contact_form_1 responsive_margins">
                        <h2 class="sc_form_title sc_item_title">Crea un nuovo evento</h2>
                        <div class="sc_form_descr sc_item_descr">Inserisci i dati del tuo evento, appena verrà accettato da un admin
                            gli altri utenti potranno subito iscriversi.<br/>Convegni, festival, spettacoli e concerti,
                            realizza il tuo evento.<br>
                        </div>
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
                        <div class="sc_columns columns_wrap">
                            <div class="column-1_1">
                                <div class="sc_contact_form sc_form_fields">
                                    <form class="contact_1" method="post" action="{{ route('creazione-evento') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="sc_form_info">
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome dell'evento</label>
                                                <input type="text" id="nome" name="nome" placeholder="Nome dell'evento" class="form-control" required="required">
                                            </div>
                                            <div class="mb-3">
                                                <label for="descrizione" class="form-label">Descrizione dell'evento</label>
                                                <textarea id=descrizione" name="descrizione" placeholder="Descrizione dell'evento" class="form-control"
                                                          required="required"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <label for="citta" class="form-label">Città</label>
                                                    <input type="text" id="citta" name="citta" placeholder="Città" class="form-control" required="required">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="indirizzo" class="form-label">Indirizzo</label>
                                                    <input type="text" id="indirizzo" name="indirizzo" placeholder="Indirizzo" class="form-control"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <label for="data_ora_inizio" class="form-label">Data di inizio</label>
                                                    <input type="datetime-local" id="data_ora_inizio" name="data_ora_inizio" class="form-control"
                                                           placeholder="Data di inizio" required="required">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="data_ora_fine" class="form-label">Data di fine</label>
                                                    <input type="datetime-local" id="data_ora_fine" name="data_ora_fine" class="form-control"
                                                           placeholder="Data di fine" required="required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-9 mb-3">
                                                    <label for="tipologia" class="form-label">Tipologia evento</label>
                                                    <select class="form-select" id="tipologia" name="tipologia" required="required">
                                                        <option value="" disabled selected>-- Seleziona tipologia evento --</option>
                                                        <option value="Concerto">Concerto</option>
                                                        <option value="Musical">Musical</option>
                                                        <option value="Spettacolo">Spettacolo</option>
                                                        <option value="Beneficienza">Beneficienza</option>
                                                        <option value="Sport">Sport</option>
                                                        <option value="Fiera">Fiera</option>
                                                        <option value="Congresso">Congresso</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 mb-3">
                                                    <label for="max_iscrizioni" class="form-label">Numero massimo di iscrizioni</label>
                                                    <input type="number" min="1" id="max_iscrizioni" name="max_iscrizioni" class="form-control"
                                                           placeholder="Numero massimi di iscrizioni" required="required">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="policy" class="form-label">Policy dell'evento</label>
                                                <textarea id="policy" name="policy" placeholder="Policy dell'evento" class="form-control"
                                                          required="required"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 mb-3">
                                                    <label for="tipologia_iscrizione" class="form-label">Tipologia iscrizione</label>
                                                    <select class="form-select" aria-label="Default select example" id="tipologia_iscrizione"
                                                            name="tipologia_iscrizione" required="required">
                                                        <option value="" disabled selected>-- Seleziona tipologia iscrizione
                                                            --
                                                        </option>
                                                        <option value="1">Interna al sito</option>
                                                        <option value="0">Tramite il sito TicketOne</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="artista_principale" class="form-label">Artista principale</label>
                                                    <select class="form-select" aria-label="Default select example" id="artista_principale"
                                                            name="artista_principale" required="required">
                                                        <option value="" disabled selected>-- Seleziona tipologia iscrizione --</option>
                                                        @foreach(\App\Models\Artist::all() as $artist)
                                                            @if($artist->nome_arte == null)
                                                                <option value="{{ $artist->id }}">{{ $artist->nome }} {{ $artist->cognome }}</option>
                                                            @else
                                                                <option value="{{ $artist->id }}">{{ $artist->nome_arte }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="prezzo" class="form-label">Prezzo del biglietto</label>
                                                    <input type="number" step="0.01" min="0" id="prezzo" name="prezzo" class="form-control" placeholder="Prezzo del biglietto" required="required">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="copertina" class="form-label">Immagine di copertina</label>
                                                <input class="form-control" type="file" name="copertina" id="copertina" required="required">
                                            </div>
                                        </div>
                                        <div class="sc_form_item sc_form_button">
                                            <button type="submit" class="submit_button">Crea evento</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
