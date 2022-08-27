<template>
  <div
    :class="isOwn"
    class="max-w-[70%] w-fit"
    @contextmenu.prevent="show($event)"
  >
    <v-message-context-menu
      v-if="isActionsVisible"
      :position="position"
      @hide="hide()"
      @edit="edit()"
      @del="del()"
    />
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

import vContextMenu from "../contextmenu/ContextMenu.vue";
import vMessageContextMenu from "../contextmenu/MessageContextMenu.vue";

export default {
  components: {
    vContextMenu,
    vMessageContextMenu,
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
      if (this.authenticated.id === this.message.user.id) {
        this.position = { x: event.pageX, y: event.pageY };
        this.isActionsVisible = true;
      }
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
