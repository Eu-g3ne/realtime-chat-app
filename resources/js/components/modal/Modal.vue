<template>
  <transition name="fade">
    <div>
      <div>
        <div
          class="fixed inset-0 w-full h-full bg-black/50 flex justify-center items-center"
          @mousedown.self="$emit('close')"
        >
          <div
            class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
          >
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div>
                  <slot name="icon" />
                </div>
                <div class="text-start mt-0 sm:ml-4 sm:text-left sm:grow">
                  <slot name="main" />
                </div>
              </div>
            </div>
            <div
              class="bg-gray-50 px-4 py-3 sm:px-6 flex flex-col sm:flex-row justify-end gap-2"
            >
              <slot name="handler" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
.fade-leave-from .fade-enter-to {
  opacity: 0;
}
</style>
