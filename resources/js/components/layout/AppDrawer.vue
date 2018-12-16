<template>
  <v-navigation-drawer
    id="appDrawer"
    :mini-variant.sync="mini"
    fixed
    app
    v-model="drawer"
    width="260"
  >
    <v-toolbar color="primary darken-1" dark>
      <img v-bind:src="computeLogo" height="36" alt="Logo">
      <v-toolbar-title class="ml-0 pl-3">
        <span class="headline">BRAMS</span>
        <span class="caption">2.0</span>
      </v-toolbar-title>
    </v-toolbar>
    <vue-perfect-scrollbar class="drawer-menu--scroll" :settings="scrollSettings">
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
    </vue-perfect-scrollbar>
  </v-navigation-drawer>
</template>
<script>
import menu from "../api/menu";
import VuePerfectScrollbar from "vue-perfect-scrollbar";
export default {
  name: "app-drawer",
  components: {
    VuePerfectScrollbar
  },
  data: () => ({
    mini: false,
    drawer: true,
    menus: menu,
    scrollSettings: {
      maxScrollbarLength: 160
    }
  }),
  created() {
    window.getApp.$on("APP_DRAWER_TOGGLED", () => {
      this.drawer = !this.drawer;
    });
  },
  computed: {
    computeGroupActive() {
      return true;
    },
    computeLogo() {
      return "/img/logo.png";
    }
  }
};
</script>