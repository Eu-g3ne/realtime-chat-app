<template>
  <div>
    <v-menu>
      <v-menu-button>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>
      </v-menu-button>
      <v-menu-items>
        <v-menu-item>Profile</v-menu-item>
        <v-menu-item>Settings</v-menu-item>
        <v-menu-item @click.native="logout()">Logout</v-menu-item>
      </v-menu-items>
    </v-menu>
  </div>
</template>

<script>
import vMenu from "./Menu.vue";
import vMenuButton from "./MenuButton.vue";
import vMenuItem from "./MenuItem.vue";
import vMenuItems from "./MenuItems.vue";
export default {
  components: { vMenu, vMenuButton, vMenuItem, vMenuItems },
  methods: {
    logout() {
      alert("logout");
    },
  },
};
</script>

<style></style>
