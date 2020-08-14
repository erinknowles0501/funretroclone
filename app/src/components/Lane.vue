<template>
    <div class="lane" :style="`background: #${lane.color}`">
        <div>
            <button @click="deleteLane">Delete lane</button>
            <button style="background: red" @click="setColor('FF0000')">Red</button>
            <button style="background: cyan" @click="setColor('00FFFF')">Blue</button>
            <button style="background: yellow" @click="setColor('FFFF00')">Yellow</button>
            <button style="background: lime" @click="setColor('00FF00')">Green</button>
            <button style="background: white" @click="setColor('FFFFFF')">White</button>
        </div>
        <h2 v-if="!editing" @click="startEditing">{{ lane.title }}</h2>
        <h2>
            <input
                type="text"
                v-if="editing"
                v-model="lane.title"
                @blur="updateLane"
                @keypress.enter="updateLane"
                ref="titleField"
            />
        </h2>

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
            editing: false,
        };
    },
    computed: {
        cards() {
            return getters.cards().filter((card) => {
                return (
                    card.lane_id === this.lane.id &&
                    card.sprint_id === this.sprintId
                );
            });
        },
    },
    methods: {
        startEditing() {
            this.editing = true;
            this.$nextTick(() => {
                this.$refs.titleField.focus();
            });
        },
        setColor(color) {
            this.lane.color = color;
            this.updateLane();
        },
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
        async deleteLane() {
            await actions.deleteLane(this.lane.id);
            await actions.init();
        },
        async updateLane() {
            console.log("lane title before", this.lane.title);
            await actions.updateLane(
                this.lane.id,
                this.lane.title,
                this.lane.color
            );
            await actions.init();
            console.log("lane title after", this.lane.title);
            this.editing = false;
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

.card {
    background: rgba(255, 255, 255, 0.5);
    padding: 1em;
    margin-top: 0.2em;
}
</style>