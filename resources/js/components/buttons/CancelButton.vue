<template>
  <button
    type="button"
    class="btn-component text-gray-700 hover:bg-gray-200 focus:ring-gray-500"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {};
</script>

<style></style>
