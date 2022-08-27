<template>
  <div
    class="absolute z-100 flex flex-col gap-1 bg-white p-1 rounded-lg"
    :style="pos"
    v-click-outside="vcoConfig"
  >
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    position: {
      x: Number,
      y: Number,
    },
  },
  data() {
    return {
      vcoConfig: {
        events: ["dblclick", "click", "contextmenu"],
        handler: this.hide,
      },
    };
  },
  methods: {
    hide() {
      this.$emit("hide");
    },
  },
  computed: {
    pos: function () {
      return {
        top: this.position.y + "px",
        left: this.position.x + "px",
      };
    },
  },
};
</script>

<style></style>
