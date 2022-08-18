<template>
  <div class="2xl:container mx-auto h-screen background overflow-hidden">
    <div class="flex flex-row h-full gap-0">
      <v-sidebar class="sm:w-[450px]"></v-sidebar>
      <div
        ref="scroll"
        class="grow overflow-hidden"
      >
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import vSidebar from "../components/sidebar/Sidebar.vue";

export default {
  data: function () {
    return {};
  },
  name: "Index",
  components: { vSidebar },
  mounted() {
    // Echo.channel("channel").listen(".test", function (e) {
    //   console.log(e);
    // });
    this.fetchAuthenticated();
  },
  methods: {
    ...mapActions("user", ["fetchAuthenticated"]),
  },
};
</script>

<style>
.background {
  position: relative;
  background-color: rgba(255, 255, 100, 0.5);
}
.background::before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -100;
  content: "";
  background-image: url("/img/pattern.svg");
  background-repeat: repeat;
  will-change: transform; /* for fps */
}
</style>
