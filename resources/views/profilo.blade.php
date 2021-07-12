@extends('layouts.frame-public')

@section('content')
    <section class="grey_section">
        <div class="container">
            <div class="content_wrap">
                <div class="sc_form_wrap">
                    <div class="sc_form sc_form_style_form_2 contact_form_1 responsive_margins">
                        <h2 class="sc_form_title sc_item_title">Area Personale</h2>
                        <div class="sc_columns columns_wrap">
                            <div class="sc_form_address column-1_3" style="margin-left: auto;width: auto;float: right;">
                                @if(\Illuminate\Support\Facades\Auth::user()->categoria == "admin")
                                    <div class="sc_form_address_field">
                                        <a href="{{ route("admin.dashboard") }}"><button style="border-radius: 10px;background-color: black;width: -webkit-fill-available;text-align-last: center;">Area amministratore</button></a>
                                    </div>
                                @endif
                                <div class="sc_form_address_field">
                                    <a href="{{ route("creazione-evento") }}"><button style="border-radius: 10px;background-color: black;width: 210px;text-align-last: center;">Proponi Evento</button></a>
                                </div>
                                    <hr>
                                <div class="sc_form_address_field">
                                    <a href="{{ route("storico-eventi") }}"><button style="border-radius: 10px;background-color: #3a87ad;width: -webkit-fill-available;text-align-last: center;">Storico Eventi</button></a>
                                </div>
                                <div class="sc_form_address_field">
                                    <a href="{{ route("eventi-organizzati") }}"><button style="border-radius: 10px;background-color: #3a87ad;width: -webkit-fill-available;text-align-last: center;">Eventi organizzati</button></a>
                                </div>
                                <div class="sc_form_address_field">
                                    <a href="{{ route("eventi-preferiti") }}"><button style="border-radius: 10px;background-color: #3a87ad;width: -webkit-fill-available;text-align-last: center;">Eventi Preferiti</button></a>
                                </div>
                               
                                <br><br><br>
                                <div class="sc_form_address_field">
                                    <a href="{{ route("logout") }}"><button style="border-radius: 10px;background-color: #3a87ad;width: -webkit-fill-available;text-align-last: center;">Log out</button></a>
                                </div>
                            </div>
                            <div class="column-2_3">
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
                                <div class="sc_contact_form sc_form_fields">
                                    <form class="contact_1" method="post" action="{{ route('profilo') }}">
                                        @csrf
                                        <input type="hidden" name="azione" value="modificaProfilo" />
                                        <div class="sc_form_info">
                                            <div class="sc_form_item sc_form_field label_over">
                                                <p>Nome</p>
                                                <input type="text" name="nome" id="nome" placeholder="Nome" value="{{ \Illuminate\Support\Facades\Auth::user()->nome }}" readonly="readonly" style="border: 1px solid">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <p>Cognome</p>
                                                <input type="text" name="cognome" id="cognome" placeholder="Cognome" value="{{ \Illuminate\Support\Facades\Auth::user()->cognome }}" readonly="readonly" style="border: 1px solid">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <p>Email</p>
                                                <input type="text" name="email" id="email" placeholder="Email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" readonly="readonly" style="border: 1px solid">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <p>Data di nascita</p>
                                                <input type="date" name="dataDiNascita" id="dataDiNascita" placeholder="Data di nascita" value="{{ \Illuminate\Support\Facades\Auth::user()->data_di_nascita }}" style="border: 1px solid" readonly="readonly">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <p>Telefono</p>
                                                <input type="text" name="telefono" id="telefono" placeholder="Telefono" value="{{ \Illuminate\Support\Facades\Auth::user()->telefono }}" style="border: 1px solid">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <p>Città</p>
                                                <input type="text" name="citta" id="citta" placeholder="Citta" value="{{ \Illuminate\Support\Facades\Auth::user()->citta }}" style="border: 1px solid">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <p>Indirizzo</p>
                                                <input type="text" name="indirizzo" id="indirizzo" placeholder="Indirizzo" value="{{ \Illuminate\Support\Facades\Auth::user()->indirizzo }}" style="border: 1px solid">
                                            </div>
                                            <div class="sc_form_item sc_form_field label_over">
                                                <p>Civico</p>
                                                <input type="text" name="civico" id="civico" placeholder="Civico" value="{{ \Illuminate\Support\Facades\Auth::user()->civico }}" style="border: 1px solid">
                                            </div>
                                            <div class="sc_form_item sc_form_button" style="text-align-last: center;margin-bottom: 20px;">
                                                <button type="submit" name="contact_submit" class="contact_form_submit" style=" background-color: #930816;">Modifica</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form method="post" action="">
                                        @csrf
                                        <input name="azione" type="hidden" value="modificaPassword" >
                                        <div class="sc_form_item sc_form_field label_over">
                                            <input type="password" id="passwordNuova" name="passwordNuova" class="form-control" placeholder="Inserisci password Nuova" style="background-color: white; border: 1px solid">
                                        </div>
                                        <div class="sc_form_item sc_form_field label_over">
                                            <input type="password" name="confermaPassword" id="confermaPassword" class="form-control" placeholder="Conferma password" style="background-color: white; border: 1px solid">
                                        </div>
                                        <div class="sc_form_item sc_form_button" style="text-align-last: center;" >
                                            <button type="submit" name="contact_submit" class="contact_form_submit" style=" background-color: #930816;">Cambia Password</button>
                                        </div>
                                        <div class="result sc_infobox"></div>
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

