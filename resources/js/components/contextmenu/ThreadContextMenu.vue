<template>
  <v-context-menu
    :position="position"
    @hide="$emit('hide')"
  >
    <v-edit-button
      class="p-1"
      @click="$emit('edit')"
    >
      <span class="mr-3">Edit</span>
      <v-edit-icon />
    </v-edit-button>
    <v-danger-button
      class="p-1"
      @click="$emit('leave')"
    >
      <span class="mr-3">Leave</span>
      <v-trash-icon />
    </v-danger-button>
  </v-context-menu>
</template>

<script>
import vTrashIcon from "../icons/TrashIcon.vue";
import vEditIcon from "../icons/EditIcon.vue";
import vEditButton from "../buttons/EditButton.vue";
import vDangerButton from "../buttons/DangerButton.vue";

import vContextMenu from "./ContextMenu.vue";

export default {
  components: {
    vContextMenu,
    vTrashIcon,
    vEditIcon,
    vEditButton,
    vDangerButton,
  },
  props: {
    position: {
      x: {
        type: Number,
        required: true,
      },
      y: {
        type: Number,
        required: true,
      },
    },
  },
};
</script>

<style></style>
