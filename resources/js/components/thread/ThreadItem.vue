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
        <div class="font-bold text-black text-lg">{{ this.thread.name }}</div>
        <div>
          <span class="font-normal text-gray-700">{{ nickname }}</span>
          <span class="font-light text-gray-500">{{ lastMessage }}</span>
        </div>
      </div>
    </router-link>
    <v-thread-context-menu
      v-if="isActionsVisible"
      :position="position"
      @hide="hide()"
      @edit="edit()"
      @leave="showConfirmLeave()"
    />
    <v-thread-edit-modal
      v-if="isEditModalVisible"
      @close="close()"
    />
    <v-confirmation-modal
      v-if="isConfirmLeaveVisible"
      @accept="confirmLeave()"
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
      isConfirmLeaveVisible: false,
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
    showConfirmLeave() {
      this.hide();
      this.isConfirmLeaveVisible = true;
    },
    confirmLeave() {
      this.setThread(this.thread);
      this.leaveFromThread();
      this.setThread({});
      if (this.$route.path !== "/") {
        this.$router.push({ name: "index" });
      }
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
      this.isConfirmLeaveVisible = false;
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
