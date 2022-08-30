<template>
  <div class="h-full bg-white flex flex-col justify-start">
    <div class="h-28 flex flex-row gap-2 items-center p-2 shadow-md">
      <v-main-menu />
      <v-sidebar-header>{{ nickname }}</v-sidebar-header>
      <div class="ml-auto">
        <v-create-button @click="openCreateModal()">
          Create thread
        </v-create-button>
      </div>
    </div>
    <div class="h-full overflow-y-scroll">
      <v-thread-item
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
            <v-users-select :thread="thread" />
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
import { mapGetters, mapActions, mapMutations } from "vuex";
import vThreadItem from "../thread/ThreadItem.vue";
import vMainMenu from "../menu/MainMenu.vue";
import vSidebarHeader from "./SidebarHeader.vue";
import vModal from "../modal/Modal.vue";
import vTitle from "../layout/Title.vue";
import vInfoIcon from "../icons/InfoIcon.vue";
import vCancelButton from "../buttons/CancelButton.vue";
import vAcceptButton from "../buttons/AcceptButton.vue";
import vCreateButton from "../buttons/CreateButton.vue";
import vUsersSelect from "../forms/inputs/UsersSelect.vue";
import vTextInput from "../forms/inputs/TextInput.vue";

export default {
  name: "Sidebar",
  components: {
    vThreadItem,
    vMainMenu,
    vSidebarHeader,
    vModal,
    vCancelButton,
    vAcceptButton,
    vInfoIcon,
    vUsersSelect,
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
    ...mapMutations("thread", ["setThread"]),
    createThread() {
      this.newThreadModalVisible = false;
      this.addThread();
    },
    openCreateModal() {
      this.setThread({ name: "", users: [] });
      this.newThreadModalVisible = true;
    },
  },
};
</script>

<style></style>
