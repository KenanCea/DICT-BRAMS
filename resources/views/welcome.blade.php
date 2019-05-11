<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <v-app light v-cloak>
            <v-content>
                <section>
                    <v-parallax src="/img/hero.png" height="600">
                        <v-layout column align-center justify-center class="white--text">
                            <img src="/img/vuetify.png" alt="No logo.js" height="200">
                            <h1 class="white--text mt-3 display-1 text-xs-center">Barangay Records Automation and</h1>
                            <h1 class="white--text mb-2 display-1 text-xs-center"> Management System</h1>
                            <v-btn class="blue lighten-2 mt-5" dark large href="/dashboard">
                                Get Started
                            </v-btn>
                        </v-layout>
                    </v-parallax>
                </section>

                <section>
                    <v-layout column wrap class="my-5" align-center>
                        <v-flex xs12 sm4 class="my-3">
                            <div class="text-xs-center">
                                <h2 class="headline">Features of Barangay Records  <br> Automation and Management System</h2>
                            </div>
                        </v-flex>
                        <v-flex xs12>
                            <v-container grid-list-xl>
                                <v-layout row wrap align-center>
                                    <v-flex xs12 md4>
                                        <v-card class="elevation-0 transparent">
                                            <v-card-text class="text-xs-center">
                                                <v-icon x-large class="blue--text text--lighten-2">mdi-database</v-icon>
                                            </v-card-text>
                                            <v-card-title primary-title class="layout justify-center">
                                                <div class="headline text-xs-center">Records Management</div>
                                            </v-card-title>
                                            <v-card-text>
                                                Records management is an organizational function responsible
                                                for the creation and maintenance of a system dealing with records.
                                                It is for the efficient and systematic control of the creation, and
                                                disposition of records.
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                        <v-card class="elevation-0 transparent">
                                            <v-card-text class="text-xs-center">
                                                <v-icon x-large class="blue--text text--lighten-2">mdi-home-automation</v-icon>
                                            </v-card-text>
                                            <v-card-title primary-title class="layout justify-center">
                                                <div class="headline">Automation</div>
                                            </v-card-title>
                                            <v-card-text>
                                                Barangay Automation System and information management is a
                                                good tool to boost and enhance the process of the business
                                                organization in handling the data from collection to processing
                                                in such a way that it performs report generation.
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                    <v-flex xs12 md4>
                                        <v-card class="elevation-0 transparent">
                                            <v-card-text class="text-xs-center">
                                                <v-icon x-large class="blue--text text--lighten-2">mdi-file-document-box-multiple</v-icon>
                                            </v-card-text>
                                            <v-card-title primary-title class="layout justify-center">
                                                <div class="headline text-xs-center">Issuing Permit</div>
                                            </v-card-title>
                                            <v-card-text>
                                                Barangay Records and Automation Management System is to enhance the
                                                way of managing, issuing certificates and keeping all the resident's
                                                confidential records and prepares and prints Barangay permits and certificates.
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-flex>
                    </v-layout>
                </section>

                <section>
                    <v-parallax src="/img/section.png" height="380">
                        <v-layout column align-center justify-center>
                            <div class="headline white--text mb-3 text-xs-center">Upload and Export Files</div>
                            <em>You can quickly upload and print the files needed.</em>
                            <v-btn class="blue lighten-2 mt-5" dark large href="/dashboard">
                                Get Started
                            </v-btn>
                        </v-layout>
                    </v-parallax>
                </section>

                <section>
                    <v-container grid-list-xl>
                        <v-layout row wrap justify-center class="my-5">
                            <v-flex xs12 sm4>
                                <v-card class="elevation-0 transparent">
                                    <v-card-title primary-title class="layout justify-center">
                                        <div class="headline">Government info</div>
                                    </v-card-title>
                                    <v-card-text>
                                        The Department of Information and Communications Technology is the executive
                                        department of the Philippine government responsible for the planning, development
                                        and promotion of the country's information and communications technology agenda
                                        in support of national development
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 sm4 offset-sm1>
                                <v-card class="elevation-0 transparent">
                                    <v-card-title primary-title class="layout justify-center">
                                        <div class="headline">Contact us</div>
                                    </v-card-title>

                                    <v-list class="transparent">
                                        <v-list-tile>
                                            <v-list-tile-action>
                                                <v-icon class="blue--text text--lighten-2">mdi-cellphone-android</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>(074) 442-3362</v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile>
                                            <v-list-tile-action>
                                                <v-icon class="blue--text text--lighten-2">mdi-map-marker</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>Pacdal, Baguio City</v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile>
                                            <v-list-tile-action>
                                                <v-icon class="blue--text text--lighten-2">mdi-email</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>rey.parnacio@icto.dost.gov.ph</v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </section>

                <v-footer class="blue darken-2">
                    <v-layout row wrap align-center>
                        <v-flex xs12>
                            <div class="white--text ml-3 text-md-center">
                                BRAMS@2019
                            </div>
                        </v-flex>
                    </v-layout>
                </v-footer>
            </v-content>
        </v-app>
    </div>
    <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
</body>

</html>