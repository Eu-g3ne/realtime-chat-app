<template>
  <div class="menu-item">
    <slot />
  </div>
</template>

<script>
export default {};
</script>

<style>
.menu-item {
  @apply block px-4 py-2 text-sm cursor-pointer duration-100 hover:bg-gray-100;
}
</style>
