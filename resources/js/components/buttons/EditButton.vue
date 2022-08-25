<template>
  <button
    type="button"
    class="btn-component text-white bg-blue-500 hover:bg-blue-600 focus:ring-blue-600"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {};
</script>

<style></style>
