<template>
  <div class="h-96 flex flex-col gap-4">
    <div v-if="thread.users.length">
      <div>
        <v-title>Edit members:</v-title>
      </div>
      <div
        class="bg-blue-100 rounded-lg p-2 flex flex-row flex-wrap items-center gap-2"
      >
        <span
          v-for="user in thread.users"
          :key="user.id"
          class="flex items-center gap-1"
        >
          {{ user.nickname }}
          <button @click="removeUserById(user.id)">
            <v-cross-icon class="w-5 h-5" />
          </button>
        </span>
      </div>
    </div>
    <div>
      <v-title>Add New members:</v-title>
      <v-search-input />
    </div>
    <div class="h-full overflow-y-auto overflow-x-hidden">
      <ul class="w-full">
        <li
          v-for="user in users"
          :key="user.id"
        >
          <label
            class="duration-150 hover:bg-gray-100 rounded-lg h-12 w-full flex flex-row items-center justify-between p-2 cursor-pointer"
          >
            <span>{{ user.nickname }}</span>
            <input
              class="cursor-pointer"
              type="checkbox"
              :checked="userIds.includes(user.id)"
              @click="updateUsers(user)"
            />
          </label>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import vDangerButton from "../../buttons/DangerButton.vue";
import vCrossIcon from "../../icons/CrossIcon.vue";
import vSearchInput from "../../SearchInput.vue";
import vTitle from "../../layout/Title.vue";

export default {
  components: {
    vSearchInput,
    vDangerButton,
    vCrossIcon,
    vTitle,
  },
  data: () => ({
    nickname: "",
  }),
  methods: {
    ...mapActions("user", ["getByNickname"]),
    ...mapMutations("thread", ["pushUserToThread", "removeUserById"]),
    updateUsers(user) {
      console.log(_.map(this.thread.users, "id").includes(user.id));
      if (_.map(this.thread.users, "id").includes(user.id)) {
        this.removeUserById(user.id);
      } else {
        this.pushUserToThread(user);
      }
    },
    search() {
      if (this.nickname !== "") {
        this.getByNickname(this.nickname);
        console.log(thread.users.includes(user.id));
      }
    },
    debouncedSearch: _.debounce(function () {
      this.search();
    }, 700),
  },
  watch: {
    nickname: "search",
  },
  computed: {
    ...mapGetters("user", ["users"]),
    ...mapGetters("thread", ["thread"]),
    nicknames() {
      return _.map(this.users, "nickname");
    },
    userIds() {
      return _.map(this.thread.users, "id");
    },
  },
};
</script>

<style>
.vue-tags-input .ti-input {
  @apply rounded-md text-base;
}

.vue-tags-input.ti-focus .ti-input {
  @apply border border-blue-300;
}
</style>
