<!DOCTYPE html>
<html lang="en" dir="ltr">
    {{-- menu + HEAD  --}}
    @include("partials.menu")
    {{-- fine menu --}}
    <body>

        {{-- main --}}

        <section>
            <div class="bg-img">
                <div class="container ">
                    <div class="jumbotron d-flex justify-content-center">

                        <div class="cta">

                            <div class="box-cta">
                                <p>Dove vuoi andare?</p>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="box-cta">
                                <p>Check-in</p>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="box-cta">
                                <p>Check-out</p>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="box-cta">
                                <p>Aggiungi ospiti</p>
                                <i class="fas fa-angle-down"></i>
                            </div>

                            <button class="button" type="button" name="button">CERCA</button>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- fine main --}}
        <section class="apartament">

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h6>APPARTAMENTI IN EVIDENZA</h6>
                    </div>
                </div>
            </div>

            <div class="container d-flex justify-content-center img-app">
                <div class="col-3">

                </div>
                <div class="col-3">

                </div>
                <div class="col-3">

                </div>

            </div>
            <div class="container d-flex justify-content-center img-app">
                <div class="col-3">

                </div>
                <div class="col-3">

                </div>
                <div class="col-3">

                </div>

            </div>

        </section>
        <div class="footer">
            <div class="col-7">
                <small>© 2020 BoolBnb, Inc. All rights reserved      · Privacy     · Termini     · Mappa del sito     · Dettagli dell'azienda</small>
            </div>
        </div>
        <script src="{{("js/app.js")}}" charset="utf-8"></script>
    </body>
</html>
