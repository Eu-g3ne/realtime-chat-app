<template>
  <button
    type="button"
    class="btn-component text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-500"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {};
</script>

<style></style>
