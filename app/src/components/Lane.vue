<template>
    <div class="lane" :style="`background: #${lane.color}`">
        <h2>{{ lane.title }}</h2>

        <div class="card" v-for="card in cards" :key="card.id">{{ card.text }}</div>
    </div>
</template>

<script>
import { getters } from "../utilities/store";

export default {
    name: "Lane",
    props: ["lane"],
    computed: {
        cards() {
            return getters.cards().filter((card) => {
                console.log(this.lane.cards);
                return this.lane.cards.includes(card.id);
            });
        },
    },
};
</script>

<style scoped>
.lane {
    height: 100%;
    width: 100%;
    padding: 1em;
}
</style>