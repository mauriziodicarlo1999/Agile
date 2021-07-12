@extends('layouts.frame-public')

@section('content')

    <section class="grey_section">
        <div class="container">
            <div class="content_wrap">
                <div class="sc_form_wrap">
                    <div class="sc_form sc_form_style_form_2 contact_form_1 responsive_margins">
                        <h2 class="sc_form_title sc_item_title">Crea un nuovo account</h2>
                        <div class="sc_form_descr sc_item_descr">Organizza, iscriviti, commenta un evento e chatta con gli altri utenti.<br/>Convegni, festival, spettacoli e concerti, in un unico posto accessibile da dove vuoi.<br>
                        </div>
                        @if(isset($errore))
                            <div class="alert alert-danger" role="alert">
                                {{ $errore }}
                            </div>
                        @endif
                        <div class="sc_columns columns_wrap">
                            <div class="sc_form_address column-1_3">
                                <div class="sc_form_address_field">
                                    <span class="sc_form_address_label">Indirizzo:</span>
                                    <span class="sc_form_address_data">Globex.corporation</span>
                                </div>
                                <div class="sc_form_address_field">
                                    <span class="sc_form_address_label">Orari di apertura:</span>
                                    <span class="sc_form_address_data"> 8.00-18.00 Lunedì-Venerdì</span>
                                </div>
                                <div class="sc_form_address_field">
                                    <span class="sc_form_address_label">Chiamaci al numero:</span>
                                    <span class="sc_form_address_data">3285467892</span>
                                </div>
                                <div class="sc_form_address_field">
                                    <span class="sc_form_address_label">E-mail</span>
                                    <span class="sc_form_address_data">
																	<span>Globex.corporation@univaq.it</span>
																</span>
                                </div>
                            </div><div class="column-2_3">
                                <div class="sc_contact_form sc_form_fields">
                                    <form class="contact_1" method="post" action="{{ route('register') }}">
                                        @csrf
                                        <div class="sc_form_info">
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="text" name="nome" placeholder="Nome" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="text" name="cognome" placeholder="Cognome" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="text" name="email" placeholder="Email" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="date" name="nascita" placeholder="Data di nascita" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="number" name="telefono" placeholder="Numero di telefono" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="text" name="citta" placeholder="Città" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="text" name="indirizzo" placeholder="Indirizzo" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="number" name="civico" placeholder="Civico" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="password" name="password" placeholder="Password" required="required">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <input type="password" name="confPassword" placeholder="Conferma password" required="required">
                                            </div>
                                        </div>
                                        <div class="sc_form_item sc_form_button">
                                            <button type="submit" name="contact_submit" class="contact_form_submit">Registrati</button>
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
