<template>
  <button
    type="button"
    class="btn-component text-white bg-green-500 hover:bg-green-600 focus:ring-green-500"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {};
</script>

<style></style>
