<template>
  <div class="h-full bg-white flex flex-col justify-start">
    <div class="h-28 flex flex-row gap-2 items-center p-2 shadow-md">
      <v-main-menu />
      <v-sidebar-header>{{ nickname }}</v-sidebar-header>
      <div>
        <button
          class="p-2 bg-blue-400 rounded-xl text-white"
          @click="showModal = true"
        >
          Show Modal
        </button>
      </div>
    </div>
    <div class="h-full overflow-y-scroll">
      <v-thread
        v-for="thread in threads"
        :key="thread.id"
        :thread="thread"
      />
    </div>

    <v-modal
      :isOpen="showModal"
      @cancel="showModal = false"
      @confirm="showModal = false"
    />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import vThread from "../thread/ThreadItem.vue";
import vMainMenu from "../menu/MainMenu.vue";
import vSidebarHeader from "./SidebarHeader.vue";
import vModal from "../modal/Modal.vue";

export default {
  name: "Sidebar",
  components: { vThread, vMainMenu, vSidebarHeader, vModal },
  data: function () {
    return {
      showModal: false,
    };
  },
  mounted() {
    this.fetchThreads();
  },
  computed: {
    ...mapGetters("thread", ["threads"]),
    ...mapGetters("user", ["nickname"]),
  },
  methods: {
    ...mapActions("thread", ["fetchThreads"]),
  },
};
</script>

<style></style>
