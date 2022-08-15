<template>
  <div class="flex flex-col gap-1 h-full">
    <div
      class="p-5 basis-[90%] h-full overflow-y-scroll"
      ref="messages"
    >
      <div class="flex flex-col h-full gap-4">
        <v-message
          v-for="message in messages"
          :key="message.id"
          :message="message"
        />
      </div>
    </div>
    <div
      class="flex flex-row justify-center items-center gap-2 px-5 basis-[10%]"
    >
      <input
        class="h-[50px] w-full rounded-xl block px-2"
        type="text"
      />
      <button
        class="rounded-xl p-2 bg-green-400"
        @click="sendMessage"
      >
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
            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"
          />
        </svg>
      </button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import vMessage from "../components/thread/vMessage.vue";
export default {
  data: function () {
    return {};
  },
  name: "Thread",
  components: { vMessage },
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  mounted() {
    this.fetchMessages(this.id);
  },
  updated() {
    this.$nextTick(function () {
      this.scrollToEnd();
    });
  },
  watch: {
    id: function (newVal, oldVal) {
      this.fetchMessages(newVal);
    },
  },
  methods: {
    ...mapActions("message", ["fetchMessages"]),
    scrollToEnd() {
      this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight;
    },
    sendMessage() {
      this.scrollToEnd();
    },
  },
  computed: {
    ...mapGetters("message", ["messages"]),
  },
};
</script>

<style></style>
