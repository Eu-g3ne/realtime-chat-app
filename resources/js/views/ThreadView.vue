<template>
  <div class="flex flex-col h-full">
    <div class="w-full bg-white shadow-md p-2">
      <div class="font-bold text-black text-lg">{{ nameById(this.id) }}</div>
      <div class="font-light text-gray-500">
        {{ membersById(this.id) }} members
      </div>
    </div>
    <div
      class="p-5 h-full overflow-y-scroll"
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
    <div class="flex flex-row justify-center items-center gap-2 px-5 mt-1 mb-2">
      <input
        class="h-[50px] w-full rounded-xl block px-2 shadow-md"
        type="text"
        @keydown.enter="sendMessage"
      />
      <v-send-button @click="sendMessage"></v-send-button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import vMessage from "../components/thread/ThreadMessage.vue";
import vSendButton from "../components/buttons/SendButton.vue";
import vTextInput from "../components/forms/inputs/TextInput.vue";
import Echo from "laravel-echo";

export default {
  data: function () {
    return {};
  },
  name: "ThreadView",
  components: { vMessage, vSendButton, vTextInput },
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  mounted() {
    this.fetchMessages(this.id);
    window.Echo.private("channel").listen("Test", (e) => {
      console.log(e);
    });
    window.Echo.private("thread.1").listen("SendMessage", (e) => {
      console.log(e);
    });
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
    ...mapGetters("thread", ["nameById", "membersById"]),
  },
};
</script>

<style></style>
