<template>
  <div
    :class="isOwn"
    class="max-w-[70%] w-fit"
    @contextmenu.prevent="show($event)"
  >
    <v-context-menu
      v-if="isActionsVisible"
      :position="position"
      @hide="hide()"
    >
      <v-edit-button
        class="p-1"
        @click="edit()"
      >
        <span class="mr-3">Edit</span>
        <v-edit-icon />
      </v-edit-button>
      <v-danger-button
        class="p-1"
        @click="del()"
      >
        <span class="mr-3">Delete</span>
        <v-trash-icon />
      </v-danger-button>
    </v-context-menu>
    <div class="rounded-xl bg-green-400 flex justify-between">
      <span class="p-2 text-black">
        {{ message.body }}
      </span>
      <span class="text-gray-600 text-[12px] place-self-end px-2">
        {{ createdAt }}
      </span>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
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
  data: function () {
    return {
      isActionsVisible: false,
      position: {
        x: 0,
        y: 0,
      },
      vcoConfig: {
        events: ["dblclick", "click", "contextmenu"],
        handler: this.hide,
      },
    };
  },
  props: {
    message: {
      id: Number,
      body: String,
      created_at: String,
      updated_at: String,
      user: {
        id: Number,
        nickname: String,
      },
    },
  },
  methods: {
    show(event) {
      this.position = { x: event.pageX, y: event.pageY };
      this.isActionsVisible = true;
    },
    hide() {
      this.isActionsVisible = false;
    },
    edit() {
      this.$emit("edit");
      this.hide();
    },
    del() {
      this.$emit("delete");
      this.hide();
    },
  },
  computed: {
    ...mapGetters("user", ["authenticated"]),
    isOwn() {
      return {
        "self-end": this.message.user.id === this.authenticated.id,
      };
    },
    createdAt() {
      let date = new Date(this.message.created_at);
      return [date.getHours(), date.getMinutes()]
        .map((date) => {
          return String(date).padStart(2, "0");
        })
        .join(":");
    },
  },
};
</script>

<style></style>
