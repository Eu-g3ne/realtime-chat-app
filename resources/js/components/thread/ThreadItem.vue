<template>
  <div>
    <router-link
      :to="{
        name: 'thread',
        params: { id: this.thread.id },
      }"
    >
      <div
        class="h-20 duration-200 hover:bg-gray-200 cursor-pointer p-2 m-2 rounded-xl"
        @contextmenu.prevent="show($event)"
      >
        <v-thread-context-menu
          v-if="isActionsVisible"
          :position="position"
          @hide="hide()"
          @edit="edit()"
          @leave="confirmLeave()"
        />
        <div class="font-bold text-black text-lg">{{ this.thread.name }}</div>
        <div>
          <span class="font-normal text-gray-700">{{ nickname }}</span>
          <span class="font-light text-gray-500">{{ lastMessage }}</span>
        </div>
      </div>
    </router-link>
    <v-thread-edit-modal
      v-if="isEditModalVisible"
      @accept="confirmEdit()"
      @close="close()"
      @leave="confirmLeave()"
    />
    <v-confirmation-modal
      v-if="isConfirmationVisible"
      @accept="accept()"
      @cancel="cancel()"
    />
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import vThreadContextMenu from "../contextmenu/ThreadContextMenu.vue";
import vThreadEditModal from "../modal/ThreadEditModal.vue";
import vConfirmationModal from "../modal/ConfirmationModal.vue";

export default {
  components: { vThreadContextMenu, vThreadEditModal, vConfirmationModal },
  props: {
    thread: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      isActionsVisible: false,
      isEditModalVisible: false,
      isConfirmationVisible: false,
      action: "",
      position: {
        x: 0,
        y: 0,
      },
    };
  },
  methods: {
    ...mapActions("thread", ["updateThread", "leaveFromThread"]),
    ...mapMutations("thread", ["setThread"]),
    accept() {
      switch (this.action) {
        case "edit":
          this.updateThread();
          break;
        case "leave":
          this.setThread(this.thread);
          this.leaveFromThread();
          break;
      }
    },
    confirmEdit() {
      this.action = "edit";
      this.isConfirmationVisible = true;
    },
    confirmLeave() {
      this.hide();
      this.action = "leave";
      this.isConfirmationVisible = true;
    },
    show(event) {
      this.position = { x: event.pageX, y: event.pageY };
      this.isActionsVisible = true;
    },
    hide() {
      this.isActionsVisible = false;
    },
    edit() {
      this.setThread(this.thread);
      this.isEditModalVisible = true;
      this.isActionsVisible = false;
    },
    leave() {
      this.isActionsVisible = false;
    },
    close() {
      this.isEditModalVisible = false;
    },
    cancel() {
      this.isConfirmationVisible = false;
    },
  },
  computed: {
    nickname: function () {
      return this.thread.message ? this.thread.message.user.nickname + ":" : "";
    },
    lastMessage: function () {
      return this.thread.message ? this.thread.message.body : "New chat";
    },
  },
};
</script>

<style></style>
