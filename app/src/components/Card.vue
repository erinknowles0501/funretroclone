<template>
    <div class="card" @mouseover="showCardEdit = true" @mouseleave="showCardEdit = false">
        <div class="edit" v-if="showCardEdit">
            <button @click="startEditingCard">Edit</button>
            <button @click="deleteCard">Delete</button>
        </div>
        <p v-if="!editingCard">{{ card.text }}</p>
        <input
            v-if="editingCard"
            type="text"
            v-model="card.text"
            @blur="updateCard"
            @keypress.enter="updateCard"
            ref="editCardField"
            :disabled="saving"
        />
    </div>
</template>


<script>
import { actions } from "../utilities/store";

export default {
    name: "Card",
    props: ["card"],
    data() {
        return {
            showCardEdit: false,
            editingCard: false,
            saving: false,
        };
    },
    methods: {
        startEditingCard() {
            this.editingCard = true;
            this.$nextTick(() => {
                this.$refs.editCardField.focus();
            });
        },
        async updateCard() {
            this.saving = true;
            await actions.updateCard(this.card.id, this.card.text);
            await actions.init();
            this.saving = false;
            this.editingCard = false;
        },
        deleteCard() {},
    },
};
</script>

<style scoped>
.edit {
    position: absolute;
    top: 0;
    right: 0;
}

.card {
    background: rgba(255, 255, 255, 0.5);
    padding: 1em;
    margin-top: 0.2em;
    position: relative;
}
</style>