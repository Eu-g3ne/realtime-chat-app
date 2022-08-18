<template>
  <div class="h-screen overflow-hidden">
    <div
      class="mx-auto mt-20 py-10 w-96 bg-white rounded-xl shadow-2xl flex flex-col items-center gap-3"
    >
      <h1 class="text-2xl font-bold block text-center mb-3">LOGIN</h1>
      <div>
        <label
          for="nickname"
          class="block text-sm font-medium text-gray-700"
          >Nickname</label
        >
        <input
          type="text"
          name="nickname"
          id="nickname"
          autocomplete="nickname"
          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 border-2 border-solid rounded-md p-2"
          v-model="user.nickname"
        />
      </div>
      <div class="">
        <label
          for="password"
          class="block text-sm font-medium text-gray-700"
          >Password</label
        >
        <input
          type="password"
          name="password"
          id="password"
          autocomplete="current-password"
          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 border-2 border-solid rounded-md p-2"
          v-model="user.password"
        />
      </div>
      <button
        type="submit"
        class="mt-5 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        @click="authenticate()"
        :disabled="disabled"
      >
        Save
      </button>
      <div>
        or
        <router-link
          to="register"
          class="underline underline-offset-2"
          >Register</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import router from "../router";

export default {
  data() {
    return {
      user: {
        nickname: "",
        password: "",
      },
      disabled: false,
    };
  },
  methods: {
    ...mapActions("user", ["login"]),
    async authenticate() {
      this.disabled = true;
      await this.login(this.user);
      router.push("/");
    },
  },
};
</script>

<style>
body {
  position: relative;
  background-color: rgba(255, 255, 100, 0.5);
}
body::before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -100;
  content: "";
  background-image: url("/img/pattern.svg");
  background-repeat: repeat;
  will-change: transform; /* for fps */
}
</style>
