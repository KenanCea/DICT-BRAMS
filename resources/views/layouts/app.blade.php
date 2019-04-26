<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <v-app id="app" v-cloak>
        @auth
        <v-navigation-drawer app dense v-model="drawer" fixed clipped>
            <v-list shaped>
                <template v-for="item in items">
                    <v-layout v-if="item.heading" :key="item.heading" row align-center>
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">@{{ item.heading }}</v-subheader>
                        </v-flex>
                    </v-layout>
                    <v-list-group v-else-if="item.children" v-model="item.model" :key="item.title" :prepend-icon="item.icon" append-icon="mdi-menu-down" no-action>
                        <v-list-item slot="activator">
                            <v-list-item-content>
                                <v-list-item-title class="font-weight-medium">@{{ item.title }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item :key="i" v-for="(child, i) in item.children" :to="child.to">
                            <v-list-item-content>
                                <v-list-item-title class="font-weight-medium">@{{ child.title }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                    <v-list-item v-else :key="item.title" :to="item.to">
                        <v-list-item-action>
                            <v-icon>@{{ item.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="font-weight-medium">@{{ item.title }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar :clipped-left="$vuetify.breakpoint.mdAndUp" tile flat fixed app>
            <v-toolbar-title style="width: 250px" class="ml-0 grey--text text--darken-2">
                <v-app-bar-nav-icon size="30px" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                <v-avatar class="mx-2" size="40px"> <img src="/img/logo.png" alt="Logo">
                </v-avatar>
                <span class="hidden-sm-and-down">BRAMS</span>
            </v-toolbar-title>
            <v-autocomplete clearable light solo flat background-color="grey lighten-3" hide-details prepend-inner-icon="mdi-magnify" label="Search" class="hidden-sm-and-down"></v-autocomplete>
            <v-spacer></v-spacer>
            <v-menu offset-y>
                <template v-slot:activator="{ on }">
                    <v-btn rounded text class="pl-0" color="primary" v-on="on">
                        <v-avatar size="35px" class="mr-3"> <img src="/img/profile/{{ Auth::user()->logo }}" alt="Logo">
                        </v-avatar>
                        <span class="grey--text text--darken-2 text-none">{{ Auth::user()->name }}</span>
                    </v-btn>
                </template>
                <v-card>
                    <v-list nav>
                        <v-list-item :to="menu.to" v-for="(menu, i) in menus" :key="i">
                            <v-list-item-icon class="mr-3">
                                <v-icon v-text="menu.icon"></v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title v-text="menu.title"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="secondary" outline href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</v-btn>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </v-card-actions>
                </v-card>
            </v-menu>
        </v-app-bar>
        <v-content class="white">
            <router-view></router-view>
        </v-content>
        @endauth
        <main>
            @yield('content')
        </main>
    </v-app>
    @stack('beforeScripts')
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('afterScripts')
</body>

</html>