<template>
  <div class="h-full bg-white">
    <div class="h-16 flex items-center px-2">
      <button class="p-2 bg-gray-600 rounded-3xl text-white">Logout</button>
    </div>
    <div>
      <v-thread
        v-for="thread in threads"
        :key="thread.id"
        :thread="thread"
      />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import vThread from "./Thread.vue";
export default {
  name: "Sidebar",
  components: { vThread },
  data: function () {
    return {
      threads: [],
    };
  },
  mounted() {
    axios.get("threads").then((response) => {
      this.threads = response.data;
    });
  },
  computed: {
    lastMessage: function () {
      return this.messages;
    },
  },
};
</script>

<style></style>
