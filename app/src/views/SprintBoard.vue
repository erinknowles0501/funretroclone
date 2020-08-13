<template>
  <div id="app">
    <h1 v-if="!loading">{{ sprint.nickname }}:</h1>
  </div>
</template>

<script>
import { getters, actions } from "../utilities/store";

export default {
  name: "App",
  data() {
    return {
      loading: true,
      sprint: {},
    };
  },
  computed: {
    sprints() {
      return getters.sprints();
    },
  },
  async created() {
    const vm = this;
    await actions.init(vm.$route.params.id);
    vm.sprint = actions.getSprint(vm.$route.params.id);
    vm.loading = false;
  },
};
</script>
