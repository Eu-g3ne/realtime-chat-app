<template>
  <button
    type="button"
    class="btn-component bg-red-600 text-white hover:bg-red-700 focus:ring-red-500"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {};
</script>

<style></style>
