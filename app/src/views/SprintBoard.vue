<template>
  <div id="app">
    <h1 v-if="!loading">{{ sprint.nickname }}:</h1>
    <p>
      {{ displayDate(sprint.start_date) }} - {{ displayDate(sprint.end_date) }}
    </p>

    <button @click="createLane">Add lane</button>

    <div v-if="!loading" class="lanes">
      <Lane
        v-for="lane in lanes"
        :key="lane.id"
        :lane="lane"
        :sprintId="sprint.id"
      />
    </div>
  </div>
</template>

<script>
// this is where the ~*~*magic*~*~ happens
// Render X number of lane components, + add lane button
// also - allow edit sprint details here.
// can assume all sprints have the same lanes.
// CAN WE THOUGH? What happens to cards in a deleted lane?
//    - delete
//    - disappear... (no)
//    - prevent deleting lane if has cards (might have cards in another sprint!!)
//      - notify which sprint it has cards
//    - move cards to 'uncategorized' lane

import moment from "moment";

import Lane from "../components/Lane";
import { getters, actions } from "../utilities/store";

export default {
  name: "SprintBoard",
  components: {
    Lane,
  },
  data() {
    return {
      loading: true,
      sprint: {},
    };
  },
  computed: {
    lanes() {
      return getters.lanes();
    },
  },
  async created() {
    const vm = this;
    await actions.init(vm.$route.params.id);
    vm.sprint = actions.getSprint(vm.$route.params.id);
    vm.loading = false;
  },
  methods: {
    createLane() {
      actions.createLane("New lane", "FF0000");
    },
    displayDate(date) {
      return moment(date).format("MMM D");
    },
  },
};
</script>

<style scoped>
.lanes {
  display: flex;
  justify-content: space-between;
  height: 100%;
}
</style>
