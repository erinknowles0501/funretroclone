<template>
    <div class="lane" :style="`background: #${lane.color}`">
        <h2>{{ lane.title }}</h2>
        <button @click="creatingCard = true">Create card</button>

        <div v-if="creatingCard">
            <textarea v-model="newCardText"></textarea>
            <button @click="createCard">Create</button>
        </div>

        <div class="card" v-for="card in cards" :key="card.id">{{ card.text }}</div>
    </div>
</template>

<script>
import { getters, actions } from "../utilities/store";

export default {
    name: "Lane",
    props: ["lane", "sprintId"],
    data() {
        return {
            creatingCard: false,
            newCardText: "",
        };
    },
    computed: {
        cards() {
            return getters.cards().filter((card) => {
                console.log(card.lane_id, this.lane.id);
                return (
                    card.lane_id === this.lane.id &&
                    card.sprint_id === this.sprintId
                );
            });
        },
    },
    methods: {
        async createCard() {
            await actions.createCard(
                this.newCardText,
                this.sprintId,
                this.lane.id
            );
            await actions.init();
            this.creatingCard = false;
            this.newCardText = "";
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