<template>
  <div :class="isOwn">
    <div class="rounded-xl bg-green-400 w-fit flex">
      <span class="p-2 text-black">{{ message.body }}</span>
      <span class="text-gray-600 text-[12px] place-self-end px-2">{{
        createdAt
      }}</span>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data: function () {
    return {};
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
  computed: {
    ...mapGetters("user", ["authenticated"]),
    isOwn() {
      return {
        "self-end": this.message.user.id === this.authenticated.id,
      };
    },
    createdAt() {
      let date = new Date(this.message.created_at);
      return `${date.getHours()}:${date.getMinutes()}`;
    },
  },
};
</script>

<style></style>
