<template>
  <div
    class="w-full bg-white shadow-md p-2 cursor-pointer"
    @click="$emit('click')"
  >
    <div class="font-bold text-black text-lg">{{ nameById(id) }}</div>
    <div class="font-light text-gray-500">{{ membersById(id) }} members</div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  computed: {
    ...mapGetters("thread", ["nameById", "membersById"]),
  },
};
</script>

<style></style>
