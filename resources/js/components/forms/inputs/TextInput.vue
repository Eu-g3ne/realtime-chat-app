<template>
  <input
    class="h-[40px] w-full rounded-md block px-2 border border-gray-300 outline-none focus:ring-2 focus:ring-blue-300"
    type="text"
    v-model="model"
  />
</template>

<script>
export default {
  data: () => ({
    value: "",
  }),
  computed: {
    model: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },
};
</script>

<style></style>
