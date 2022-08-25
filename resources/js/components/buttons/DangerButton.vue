<template>
  <button
    type="button"
    class="btn-component bg-red-500 text-white hover:bg-red-600 focus:ring-red-500"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {};
</script>

<style></style>
