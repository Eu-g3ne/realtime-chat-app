<template>
  <div>
    <v-modal
      @close="$emit('close')"
      v-show="!isConfirmModalVisible"
    >
      <template v-slot:icon>
        <v-edit-icon class="h-12 w-12 bg-blue-300 rounded-full p-2" />
      </template>
      <template v-slot:main>
        <div class="flex flex-col gap-4">
          <div>
            <v-title>Thread:</v-title>
            <v-text-input v-model="thread.name" />
          </div>
          <div>
            <v-users-select :thread="thread" />
          </div>
        </div>
      </template>
      <template v-slot:handler>
        <v-danger-button
          @click="openConfirmLeave()"
          class="mr-auto"
        >
          Leave
          <v-leave-icon />
        </v-danger-button>
        <v-accept-button @click="openConfirmUpdate()"> Accept </v-accept-button>
        <v-cancel-button @click="$emit('close')"> Cancel </v-cancel-button>
      </template>
    </v-modal>
    <v-confirmation-modal
      v-if="isConfirmModalVisible"
      @accept="confirmUpdate()"
      @cancel="cancel()"
    />
    <v-confirmation-modal
      v-if="isConfirmLeaveModalVisible"
      @accept="confirmLeave()"
      @cancel="cancel()"
    />
  </div>
</template>

<script>
import vModal from "./Modal.vue";
import vAcceptButton from "../buttons/AcceptButton.vue";
import vCancelButton from "../buttons/CancelButton.vue";
import vDangerButton from "../buttons/DangerButton.vue";
import vTextInput from "../forms/inputs/TextInput.vue";
import vTitle from "../layout/Title.vue";
import vEditIcon from "../icons/EditIcon.vue";
import vUsersSelect from "../forms/inputs/UsersSelect.vue";
import vLeaveIcon from "../icons/LeaveIcon.vue";
import vConfirmationModal from "./ConfirmationModal.vue";
import { mapActions, mapGetters } from "vuex";

export default {
  components: {
    vModal,
    vAcceptButton,
    vCancelButton,
    vDangerButton,
    vTextInput,
    vTitle,
    vEditIcon,
    vUsersSelect,
    vLeaveIcon,
    vConfirmationModal,
  },
  data: () => ({
    nickname: "",
    isConfirmModalVisible: false,
    isConfirmLeaveModalVisible: false,
  }),
  methods: {
    ...mapActions("thread", ["updateThread", "leaveFromThread"]),
    openConfirmUpdate() {
      this.isConfirmModalVisible = true;
    },
    confirmUpdate() {
      this.updateThread();
      this.$emit("cancel");
    },
    openConfirmLeave() {
      this.isConfirmLeaveModalVisible = true;
    },
    confirmLeave() {
      this.leaveFromThread();
      if (this.$route.path !== "/") {
        this.$router.push({ name: "index" });
      }
      this.$emit("cancel");
    },
    cancel() {
      this.isConfirmModalVisible = false;
    },
  },
  computed: {
    ...mapGetters("thread", ["thread"]),
  },
};
</script>

<style></style>
