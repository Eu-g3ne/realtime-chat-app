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
          @edit="edit(message)"
          @delete="del(message)"
        />
      </div>
    </div>
    <div class="flex flex-row justify-center items-center gap-2 px-5 mt-1 mb-2">
      <input
        class="h-[50px] w-full rounded-xl block px-2 shadow-md"
        type="text"
        v-model="newMessage"
        @keydown.enter="sendMessage(id, newMessage)"
      />
      <v-send-button @click="sendMessage(id, newMessage)"></v-send-button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import vMessage from "../components/thread/ThreadMessage.vue";
import vSendButton from "../components/buttons/SendButton.vue";
import vTextInput from "../components/forms/inputs/TextInput.vue";

export default {
  data: function () {
    return {
      newMessage: "",
    };
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
    window.Echo.private(`thread.${this.id}`).listen(
      "SendMessage",
      (message) => {
        this.updateMessages([...this.messages, message]);
        this.fetchThreads();
      }
    );
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
    ...mapActions("message", ["fetchMessages", "addMessage", "removeMessage"]),
    ...mapActions("thread", ["fetchThreads"]),
    ...mapMutations("message", ["updateMessages"]),
    scrollToEnd() {
      this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight;
    },
    sendMessage(id, newMessage) {
      this.scrollToEnd();
      this.addMessage({ threadId: id, message: newMessage });
      this.newMessage = "";
    },
    edit(message) {
      console.log(this.id, message);
    },
    del(message) {
      this.removeMessage({ threadId: this.id, message });
    },
  },
  computed: {
    ...mapGetters("message", ["messages"]),
    ...mapGetters("thread", ["nameById", "membersById"]),
  },
};
</script>

<style></style>
