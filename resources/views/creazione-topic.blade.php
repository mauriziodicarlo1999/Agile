@extends('layouts.frame-public')

@section('content')
    <section class="grey_section" xmlns="http://www.w3.org/1999/html" style="background-color: #9ab8e585">
        <div class="container">
            <div class="content_wrap">
                <div class="sc_form_wrap">
                    <div class="sc_form sc_form_style_form_2 contact_form_1 responsive_margins">
                        <h2 class="sc_form_title sc_item_title">Crea un nuovo topic</h2>
                        <div class="sc_form_descr sc_item_descr">Inserisci i dati del tuo topic!
                            <br> Appena creato gli utenti potranno commentare con te!
                            <br/>
                            Convegni, festival, spettacoli e concerti,
                            realizza il tuo topic.<br>
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
                                    <form class="contact_1" method="post" action="{{ route('creazione-topic') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="sc_form_info">
                                            <div class="mb-3">
                                                <label for="titolo" class="form-label">Titolo del topic</label>
                                                <input type="text" id="titolo" name="titolo" placeholder="Titolo del topic" class="form-control" required="required">
                                            </div>
                                            <div class="mb-3">
                                                <label for="descrizione" class="form-label">Descrizione del Topic</label>
                                                <textarea id=descrizione" name="descrizione" placeholder="Descrizione del Topic" class="form-control"
                                                          required="required"></textarea>
                                            </div>
                                        </div>
                                        <div class="sc_form_item sc_form_button">
                                            <button type="submit" class="submit_button">Crea topic</button>
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
