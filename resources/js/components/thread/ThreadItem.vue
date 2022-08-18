<template>
  <router-link
    :to="{
      name: 'thread',
      params: { id: this.thread.id },
    }"
  >
    <div
      class="h-20 duration-200 hover:bg-gray-200 cursor-pointer p-2 m-2 rounded-xl"
    >
      <!-- <div class="rounded-full bg-red-900 p-2"></div> -->
      <div class="font-bold text-black text-lg">{{ this.thread.name }}</div>
      <div>
        <span class="font-normal text-gray-700">{{ nickname }}</span>
        <span class="font-light text-gray-500">{{ lastMessage }}</span>
      </div>
    </div>
  </router-link>
</template>

<script>
export default {
  props: {
    thread: {
      type: Object,
      required: true,
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
