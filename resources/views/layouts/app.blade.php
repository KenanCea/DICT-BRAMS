<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BRAMS') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <v-app id="app" v-cloak>
        @can('isUser')
        <v-navigation-drawer app v-model="drawer" fixed clipped>
            <v-list shaped>
                <template v-for="user in users">
                    <v-layout v-if="user.heading" :key="user.heading" row align-center>
                        <v-flex xs6>
                            <v-subheader v-if="user.heading">@{{ user.heading }}</v-subheader>
                        </v-flex>
                    </v-layout>
                    <v-list-group v-else-if="user.children" v-model="user.model" :key="user.title" :prepend-icon="user.icon" append-icon="mdi-menu-down" no-action>
                        <v-list-item slot="activator">
                            <v-list-item-content>
                                <v-list-item-title class="font-weight-medium">@{{ user.title }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item :key="i" v-for="(child, i) in user.children" :to="child.to">
                            <v-list-item-content>
                                <v-list-item-title class="font-weight-medium">@{{ child.title }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                    <v-list-item v-else :key="user.title" :to="user.to">
                        <v-list-item-action>
                            <v-icon>@{{ user.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="font-weight-medium">@{{ user.title }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>
        @endcan
        @can('isAdmin')
        <v-navigation-drawer app v-model="drawer" fixed clipped>
            <v-list shaped>
                <template v-for="admin in admins">
                    <v-layout v-if="admin.heading" :key="admin.heading" row align-center>
                        <v-flex xs6>
                            <v-subheader v-if="admin.heading">@{{ admin.heading }}</v-subheader>
                        </v-flex>
                    </v-layout>
                    <v-list-group v-else-if="admin.children" v-model="admin.model" :key="admin.title" :prepend-icon="admin.icon" append-icon="mdi-menu-down" no-action>
                        <v-list-item slot="activator">
                            <v-list-item-content>
                                <v-list-item-title class="font-weight-medium">@{{ admin.title }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item :key="i" v-for="(child, i) in admin.children" :to="child.to">
                            <v-list-item-content>
                                <v-list-item-title class="font-weight-medium">@{{ child.title }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                    <v-list-item v-else :key="admin.title" :to="admin.to">
                        <v-list-item-action>
                            <v-icon>@{{ admin.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="font-weight-medium">@{{ admin.title }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>
        @endcan
        <v-app-bar :clipped-left="$vuetify.breakpoint.mdAndUp" tile flat fixed app>
            <v-toolbar-title style="width: 250px" class="ml-0 grey--text text--darken-2">
                <v-app-bar-nav-icon size="30px" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                <v-avatar class="mx-2" size="40px"> <img src="/img/logo.png" alt="Logo">
                </v-avatar>
                <span class="hidden-sm-and-down">BRAMS</span>
            </v-toolbar-title>
            <!-- <v-autocomplete clearable light solo flat background-color="grey lighten-3" hide-details prepend-inner-icon="mdi-magnify" label="Search" class="hidden-sm-and-down"></v-autocomplete> -->
            <v-spacer></v-spacer>
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn to="/needquestions" text icon v-on="on">
                        <v-icon>mdi-help-circle-outline</v-icon>
                    </v-btn>
                </template>
                <span>Question</span>
            </v-tooltip>
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn to="/secretaryduties" text icon v-on="on">
                        <v-icon>mdi-information-outline</v-icon>
                    </v-btn>
                </template>
                <span>Secretary Duties</span>
            </v-tooltip>
            <v-menu offset-y>
                <template v-slot:activator="{ on }">
                    <v-btn icon large v-on="on" class="mr-0">
                        <v-avatar size="40px" v-on="on"> <img src="/img/profile/{{ Auth::user()->logo }}" alt="Logo"></div>
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card width="300">
                    <v-list>
                        <v-list-item>
                            <v-list-item-avatar>
                                <img src="/img/profile/{{ Auth::user()->logo }}" alt="Logo">
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title>{{ Auth::user()->name }}</v-list-item-title>
                                <v-list-item-subtitle>{{ Auth::user()->email }}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                    <v-divider></v-divider>
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
    </v-app>
    @auth
    <script>
        window.user = @json(auth() -> user())
    </script>
    @endauth
    @stack('beforeScripts')
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('afterScripts')
</body>

</html>