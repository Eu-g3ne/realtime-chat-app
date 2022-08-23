<template>
  <input
    class="h-[40px] w-full rounded-md block px-2 border border-gray-300 outline-none focus:ring-2 focus:ring-blue-300"
    type="text"
    :value="value"
    @input="$emit('input', $event.target.value)"
  />
</template>

<script>
export default {
  data: () => ({
    value: "",
  }),
};
</script>

<style></style>
