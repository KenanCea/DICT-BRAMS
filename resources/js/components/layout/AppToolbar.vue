<template>
  <v-toolbar fixed light app height="58">
    <v-btn icon>
    <v-icon color="grey" @click.stop="handleDrawerToggle">menu</v-icon>
    </v-btn>
    <!-- <v-text-field single-line append-icon="search" placeholder="Search" class="hidden-sm-and-down"></v-text-field> -->
    <!-- <v-text-field solo flat label="Append" append-icon="search"></v-text-field> -->
    <v-spacer></v-spacer>
    <v-btn icon>
      <v-icon color="grey">notifications</v-icon>
    </v-btn>
    <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
      <v-btn icon large flat slot="activator">
        <v-avatar size="30px">
          <img src="img/profile/1540267402.jpeg" alt="Michael Wang">
        </v-avatar>
      </v-btn>
      <v-list>
        <v-list-tile
          v-for="(item,index) in items"
          :to="!item.href ? { name: item.name } : null"
          :href="item.href"
          @click="item.click"
          ripple="ripple"
          :disabled="item.disabled"
          :target="item.target"
          rel="noopener"
          :key="index"
        >
          <v-list-tile-action v-if="item.icon">
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-menu>
  </v-toolbar>
</template>
<script>
export default {
  name: "app-toolbar",
  data: () => ({
    items: [
      {
        icon: "account_circle",
        href: "#",
        title: "Profile",
        click: e => {
          console.log(e);
        }
      },
      {
        icon: "settings",
        href: "#",
        title: "Settings",
        click: e => {
          console.log(e);
        }
      },
      {
        icon: "power_settings_new",
        href: "#",
        title: "Logout",
        click: e => {
          window.getApp.$emit("APP_LOGOUT");
        }
      }
    ]
  }),
  methods: {
    handleDrawerToggle() {
      window.getApp.$emit("APP_DRAWER_TOGGLED");
    }
  }
};
</script>