<template>
  <div>{{ this.id }}</div>
</template>

<script>
import axios from "axios";
export default {
  data: function () {
    return {
      messages: [],
    };
  },
  name: "Thread",
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  updated() {
    axios.get(`threads/${this.$props.id}/messages`).then((res) => {
      this.messages = res.data;
      console.log(this.messages);
    });
  },
};
</script>

<style></style>
