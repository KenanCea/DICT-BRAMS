<template>
  <v-app class="app">
    <!-- <v-navigation-drawer id="appDrawer" v-model="drawer" fixed app width="260">
      <v-toolbar color="blue darken-4" dark>
        <img v-bind:src="computeLogo" height="36" alt="Logo">
        <v-toolbar-title class="ml-0 pl-3">
          <span class="headline">BRAMS</span>
          <span class="caption">v2.0</span>
        </v-toolbar-title>
      </v-toolbar>
      <v-list>
        <template v-for="item in menus">
          <v-layout v-if="item.heading" :key="item.heading" row align-center>
            <v-flex xs6>
              <v-subheader v-if="item.heading">{{ item.heading }}</v-subheader>
            </v-flex>
          </v-layout>

          <v-list-group
            v-else-if="item.children"
            v-model="item.model"
            :key="item.title"
            :prepend-icon="item.icon"
            no-action
          >
            <v-list-tile slot="activator">
              <v-list-tile-content>
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile :key="i" v-for="(child, i) in item.children" :to="item.children.to">
              <v-list-tile-content>
                <v-list-tile-title>{{ child.title }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-group>
          <v-list-tile v-else :key="item.title" :to="item.to">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
      </v-list>
    </v-navigation-drawer>-->
    <app-drawer class="app--drawer"></app-drawer>
    <app-toolbar class="app--toolbar"></app-toolbar>
    <!-- <v-toolbar dark app fixed color="blue darken-3">
      <v-toolbar-title class="ml-0 pl-0">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      </v-toolbar-title>
      <v-text-field
        flat
        solo-inverted
        hide-details
        prepend-inner-icon="search"
        label="Search"
        class="hidden-sm-and-down"
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>notifications</v-icon>
      </v-btn>
      <v-btn icon large>
        <v-avatar size="32px">
          <img src="/img/profile/1540016497.jpeg" alt="barangay seal">
        </v-avatar>
      </v-btn>
    </v-toolbar>-->
    <v-content>
      <page-header v-if="$route.meta.breadcrumb"></page-header>
      <v-container fluid>
        <transition name="slide-x-transition" mode="out-in">
          <router-view></router-view>
        </transition>
        <vue-progress-bar></vue-progress-bar>
      </v-container>
    </v-content>
    <app-fab></app-fab>
  </v-app>
</template>


<script>
import AppDrawer from "./layout/AppDrawer";
import AppToolbar from "./layout/AppToolbar";
import AppFab from "./layout/AppFab";
import PageHeader from "./layout/PageHeader";
import menu from "./api/menu";
import AppEvents from "../event";
export default {
  components: {
    AppDrawer,
    AppToolbar,
    PageHeader,
    AppFab
  },
  data: () => ({ expanded: true }),
  props: {
    source: String
  },
  created() {
    AppEvents.forEach(item => {
      this.$on(item.name, item.callback);
    });
    window.getApp = this;
  }
};
</script>