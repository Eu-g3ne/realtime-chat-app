<template>
  <div class="h-96 flex flex-col gap-4">
    <div>
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
              :checked="thread.users.includes(user.id)"
              @click="setUsers(user.id)"
            />
          </label>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import vSearchInput from "./SearchInput.vue";

export default {
  components: {
    vSearchInput,
  },
  data() {
    return {};
  },
  mounted() {},
  methods: {
    ...mapMutations("thread", ["updateUsers"]),
    setUsers(id) {
      if (this.thread.users.includes(id)) {
        this.updateUsers(this.thread.users.filter((e) => e !== id));
      } else {
        this.updateUsers(this.thread.users.concat(id));
      }
    },
  },
  computed: {
    ...mapGetters("user", ["users"]),
    ...mapGetters("thread", ["thread"]),
  },
};
</script>

<style></style>
