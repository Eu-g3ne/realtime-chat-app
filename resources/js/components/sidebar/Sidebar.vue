<template>
  <div class="h-full bg-white flex flex-col justify-start">
    <div class="h-28 flex flex-row gap-2 items-center p-2 shadow-md">
      <v-main-menu />
      <v-sidebar-header>{{ nickname }}</v-sidebar-header>
      <div class="ml-auto">
        <v-create-button @click="newThreadModalVisible = true">
          Create thread
        </v-create-button>
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
      v-if="newThreadModalVisible"
      @close="newThreadModalVisible = false"
    >
      <template v-slot:icon>
        <v-info-icon />
      </template>
      <template v-slot:main>
        <div class="flex flex-col gap-4">
          <div>
            <v-title>Choose name:</v-title>
            <v-text-input v-model="thread.name" />
          </div>
          <div>
            <v-title>Add members</v-title>
            <v-select-checkbox />
          </div>
        </div>
      </template>
      <template v-slot:handler>
        <v-accept-button @click="createThread()"> Accept </v-accept-button>
        <v-cancel-button @click="newThreadModalVisible = false">
          Cancel
        </v-cancel-button>
      </template>
    </v-modal>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import vThread from "../thread/ThreadItem.vue";
import vMainMenu from "../menu/MainMenu.vue";
import vSidebarHeader from "./SidebarHeader.vue";
import vModal from "../modal/Modal.vue";
import vTitle from "../layout/Title.vue";
import vQuestionIcon from "../icons/QuestionIcon.vue";
import vWarningIcon from "../icons/WarningIcon.vue";
import vInfoIcon from "../icons/InfoIcon.vue";
import vCancelButton from "../buttons/CancelButton.vue";
import vAcceptButton from "../buttons/AcceptButton.vue";
import vDangerButton from "../buttons/DangerButton.vue";
import vCreateButton from "../buttons/CreateButton.vue";
import vSelectCheckbox from "../SelectCheckbox.vue";
import vTextInput from "../forms/inputs/TextInput.vue";

export default {
  name: "Sidebar",
  components: {
    vThread,
    vMainMenu,
    vSidebarHeader,
    vModal,
    vQuestionIcon,
    vCancelButton,
    vDangerButton,
    vAcceptButton,
    vWarningIcon,
    vInfoIcon,
    vSelectCheckbox,
    vCreateButton,
    vTitle,
    vTextInput,
  },
  data: function () {
    return {
      newThreadModalVisible: false,
    };
  },
  mounted() {
    this.fetchThreads();
  },
  computed: {
    ...mapGetters("thread", ["threads", "thread"]),
    ...mapGetters("user", ["nickname"]),
  },
  methods: {
    ...mapActions("thread", ["fetchThreads", "addThread"]),
    createThread() {
      this.newThreadModalVisible = false;
      this.addThread(this.thread);
    },
  },
};
</script>

<style></style>
