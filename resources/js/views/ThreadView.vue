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
          class="first:mt-auto"
        />
      </div>
    </div>
    <div
      class="flex flex-row justify-center items-center gap-2 px-5 mt-1 mb-2"
      v-if="!isEditing"
    >
      <input
        class="h-[50px] w-full rounded-xl block px-2 shadow-md"
        type="text"
        v-model="newMessage.body"
        @keydown.enter="sendMessage(id, newMessage.body)"
      />
      <v-send-button @click="sendMessage(id, newMessage.body)"></v-send-button>
    </div>
    <div
      class="flex flex-row justify-center items-center gap-2 px-5 mt-1 mb-2"
      v-else
    >
      <input
        ref="input"
        class="h-[50px] w-full rounded-xl block px-2 shadow-md"
        type="text"
        v-model="newMessage.body"
        @keydown.enter="confirmUpdate(newMessage)"
        @keydown.escape="cancelUpdate()"
      />
      <v-accept-button @click="confirmUpdate(newMessage)">
        <v-confirm-icon />
      </v-accept-button>
      <v-danger-button @click="cancelUpdate()">
        <v-cross-icon />
      </v-danger-button>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import vMessage from "../components/thread/ThreadMessage.vue";
import vSendButton from "../components/buttons/SendButton.vue";
import vAcceptButton from "../components/buttons/AcceptButton.vue";
import vDangerButton from "../components/buttons/DangerButton.vue";
import vConfirmIcon from "../components/icons/ConfirmIcon.vue";
import vCrossIcon from "../components/icons/CrossIcon.vue";
import vTextInput from "../components/forms/inputs/TextInput.vue";

export default {
  data: function () {
    return {
      newMessage: {
        body: "",
      },
      isEditing: false,
    };
  },
  name: "ThreadView",
  components: {
    vMessage,
    vSendButton,
    vTextInput,
    vAcceptButton,
    vDangerButton,
    vConfirmIcon,
    vCrossIcon,
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  mounted() {
    this.fetchMessages(this.id);
    window.Echo.private(`thread.${this.id}`)
      .listen("SendMessage", (message) => {
        this.setMessages([...this.messages, message]);
      })
      .listen("UpdateMessage", (message) => {
        this.setMessages(
          this.messages.map((msg) => (msg.id === message.id ? message : msg))
        );
      })
      .listen("DeleteMessage", (message) => {
        this.setMessages(this.messages.filter((msg) => msg.id !== message.id));
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
    ...mapActions("message", [
      "fetchMessages",
      "addMessage",
      "updateMessage",
      "removeMessage",
    ]),
    ...mapMutations("message", ["setMessages"]),
    scrollToEnd() {
      this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight;
    },
    sendMessage(id, newMessage) {
      this.scrollToEnd();
      this.addMessage({ threadId: id, message: newMessage });
      this.newMessage = { body: "" };
    },
    edit(message) {
      this.isEditing = true;
      this.newMessage = _.cloneDeep(message);
      this.$nextTick(() => this.$refs.input.focus());
    },
    del(message) {
      this.removeMessage({ threadId: this.id, message });
    },
    confirmUpdate(message) {
      this.updateMessage({ threadId: this.id, message: message });
      this.newMessage = { body: "" };
      this.isEditing = false;
    },
    cancelUpdate() {
      this.newMessage = { body: "" };
      this.isEditing = false;
    },
  },
  computed: {
    ...mapGetters("message", ["messages"]),
    ...mapGetters("thread", ["nameById", "membersById"]),
  },
};
</script>

<style></style>
