<template>
  <button
    class="menu-button"
    @click="$parent.toggle()"
    v-click-outside="$parent.close"
    @keyup.escape="$parent.close()"
  >
    <slot />
  </button>
</template>

<script>
export default {};
</script>

<style>
.menu-button {
  @apply inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none;
}
</style>
