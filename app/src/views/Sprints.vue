<template>
  <div id="app">
    <h1>All sprints:</h1>

    <div v-if="!loading">
      <div v-for="sprint in sprints" :key="sprint.id">
        <router-link :to="`/sprint/${sprint.id}`">{{
          sprint.nickname
        }}</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { getters, actions } from "../utilities/store";

export default {
  name: "App",
  data() {
    return {
      loading: true,
    };
  },
  computed: {
    sprints() {
      return getters.sprints();
    },
  },
  async created() {
    const vm = this;
    actions.init(vm.$route.params.id);
    vm.loading = false;
  },
};
</script>
