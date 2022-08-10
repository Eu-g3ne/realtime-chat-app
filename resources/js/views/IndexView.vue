<template>
  <div class="2xl:container mx-auto">
    <h1>Index View</h1>
    <div>
      <button class="m-2 p-2 bg-gray-600 rounded-xl">Press me</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Index",
  mounted() {
    Echo.channel("channel").listen(".test", function (e) {
      console.log(e);
    });
  },
};
</script>

<style></style>
