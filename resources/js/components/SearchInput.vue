<template>
  <div>
    <div
      class="flex items-center border-solid border-2 focus-within:border-blue-300 rounded-md"
    >
      <input
        type="text"
        class="h-[40px] w-full rounded-md block px-2 outline-none"
        v-model="nickname"
        @keyup.enter="search(nickname)"
        @input="debouncedSearch()"
      />
      <button
        class="block px-2 duration-300 hover:scale-110"
        @click="search(nickname)"
      >
        <v-search-icon />
      </button>
    </div>
    <!-- <div
      v-show="errors[0]"
      class="bg-red-200 rounded-md p-2 my-2"
    >
      {{ errors[0] }}
    </div> -->
  </div>
</template>

<script>
import vSearchIcon from "./icons/SearchIcon.vue";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      nickname: "",
    };
  },
  components: {
    vSearchIcon,
  },
  methods: {
    ...mapActions("user", ["getByNickname"]),
    async search() {
      if (this.nickname !== "") {
        await this.getByNickname(this.nickname);
      } else {
        this.nickname = "";
      }
    },
    debouncedSearch: _.debounce(function () {
      this.search();
    }, 700),
  },
};
</script>

<style></style>
