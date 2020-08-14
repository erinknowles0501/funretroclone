<template>
    <div id="app">
        <h1 v-if="!loading">{{ sprint.nickname }}:</h1>

        <button @click="createLane">Add lane</button>

        <div v-if="!loading">
            <Lane v-for="lane in lanes" :key="lane.id" :lane="lane" />
        </div>
    </div>
</template>

<script>
// this is where the ~*~*magic*~*~ happens
// Render X number of lane components, + add lane button
// also - allow edit sprint details here.
// can assume all sprints have the same lanes.

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
    },
};
</script>
