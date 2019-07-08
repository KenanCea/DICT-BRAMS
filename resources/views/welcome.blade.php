<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BRAMS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <v-app id="app" v-cloak>

        <v-app-bar absolute elevate-on-scroll scroll-target="#scrolling">
            <v-toolbar-title style="width: 250px" class="ml-0 grey--text text--darken-2">
                <v-avatar size="40px"> <img src="/img/logo.png" alt="Logo">
                </v-avatar>
                <span class="hidden-sm-and-down">BRAMS</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="primary" depressed href="/dashboard">Sign in</v-btn>
        </v-app-bar>

        <v-sheet id="scrolling" class="scroll-y" max-height="100vh">

            <v-container grid-list-xl>

                <v-layout row wrap align-center style="height: 100vh;">
                    <v-flex xl6 xs12 md6>
                        <h3 style="font-size:45px; line-height: normal;">Barangay Records and Automation Management System</h3>
                        <p class="my-4">A record management and Automation System for the Barangay Secretary under the maintenance of DICT as prescribed by RA 11032.</p>
                        <v-btn depressed color="primary" large href="/dashboard">
                            Get Started
                        </v-btn>
                    </v-flex>
                    <v-flex xl6 md6 class="hidden-sm-and-down">
                        <v-carousel hide-delimiters cycle height="441.141" show-arrows-on-hover>
                            <v-carousel-item v-for="(item,i) in items" :key="i" :src="item.src" reverse-transition="fade-transition" transition="fade-transition"></v-carousel-item>
                        </v-carousel>
                    </v-flex>

                </v-layout>

                <v-layout row wrap align-center>
                    <v-flex class="hidden-sm-and-down" md6>
                        <v-img src="/img/issue11.png" />
                    </v-flex>
                    <v-flex md6 xs12>
                        <h3 style="font-size:32px">Issuing Permits</h3>
                        <p style="font-size:18px">
                            Barangay Records and Automation Management System is to enhance the
                            way of managing, issuing certificates and keeping all the resident's
                            confidential records and prepares and prints Barangay permits and certificates.
                        </p>
                    </v-flex>
                </v-layout>

                <v-layout row wrap align-center>
                    <v-flex xs12 md7>
                        <h3 style="font-size:32px">Records Management</h3>
                        <p style="font-size:18px">
                            The objective of this management system is to provide a faster process of
                            getting the information and the documents that the people needed.
                            The application facilitates the process of barangay records that will
                            provide an alternative and efficient way to manage the records of the barangays.
                        </p>
                    </v-flex>
                    <v-flex md5 class="hidden-sm-and-down">
                        <v-img max-width="300" max-height="400" src="/img/export.png" />
                    </v-flex>
                </v-layout>

                <v-layout row wrap align-center>
                    <v-flex xs4 class="hidden-sm-and-down">
                        <v-img max-width="300" max-height="400" src="/img/automation.png" />
                    </v-flex>
                    <v-flex xs12 md8>
                        <h3 style="font-size:32px">Automation</h3>
                        <p style="font-size:18px">
                            The business record is automated. The application will ease the management of 
                            records, and issuance clearances and certificates. This application provides 
                            them easy accessibility of the files needed. They can monitor the information 
                            of the barangay, barangay residents conveniently and make a statistical report 
                            out of it
                        </p>
                    </v-flex>
                </v-layout>
            </v-container>



        </v-sheet>

    </v-app>
    <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
</body>

</html>