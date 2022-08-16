<template>
  <div class="menu">
    <slot :is-open="isOpen" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false,
    };
  },
  methods: {
    open() {
      this.isOpen = true;
    },
    close() {
      this.isOpen = false;
    },
    toggle() {
      this.isOpen = !this.isOpen;
    },
  },
};
</script>

<style>
.menu {
  @apply relative inline-block text-left;
}
</style>
