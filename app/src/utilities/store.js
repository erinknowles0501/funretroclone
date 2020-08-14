import Vue from "vue";

const store = Vue.observable({
  sprints: [],
  lanes: [],
  cards: [],
});

export const getters = {
  sprints: () => store.sprints,
  lanes: () => store.lanes,
  cards: () => store.cards,
};

const mutations = {
  setSprints: (sprints) => (store.sprints = sprints),
  setLanes: (lanes) => (store.lanes = lanes),
  setCards: (cards) => (store.cards = cards),
};
//dgdg

export const actions = {
  async init() {
    //  console.log("id in actions:", id);
    await fetch("http://localhost:8888/sprint/all").then((res) => {
      res.json().then(function(data) {
        console.log(data);
        mutations.setSprints(data);
      });
    });

    await fetch("http://localhost:8888/lane/all").then((res) => {
      res.json().then(function(data) {
        console.log(data);
        mutations.setLanes(data);
      });
    });

    await fetch("http://localhost:8888/card/all").then((res) => {
      res.json().then(function(data) {
        console.log(data);
        mutations.setCards(data);
      });
    });
  },

  ///
  /* Sprints */
  ///
  getSprint(id) {
    return getters.sprints().find((sprint) => {
      return sprint.id == id;
    });
  },

  ///
  /* LANES */
  ///
  async createLane(title, color) {
    let data = { title, color };
    data = JSON.stringify(data);
    console.log(data);

    await fetch("http://localhost:8888/lane/create", {
      method: "post",
      body: data,
    })
      .then((res) => {
        console.log(res);
      })
      .catch((err) => console.log(err));
  },

  async updateLane(id, title, color) {
    let data = { id, title, color };
    data = JSON.stringify(data);
    console.log(data);

    await fetch("http://localhost:8888/lane/update", {
      method: "post",
      body: data,
    })
      .then((res) => {
        console.log(res);
      })
      .catch((err) => console.log(err));
  },

  async deleteLane(id) {
    await fetch("http://localhost:8888/lane/delete", {
      method: "post",
      body: id,
    })
      .then((res) => {
        console.log(res);
      })
      .catch((err) => console.log(err));
  },

  ///
  /* CARDS */
  ///
  async createCard(text, sprintId, laneId) {
    let data = {
      text,
      sprintId,
      laneId,
    };
    data = JSON.stringify(data);
    console.log("createcard", data);

    await fetch("http://localhost:8888/card/create", {
      method: "post",
      body: data,
    })
      .then((res) => {
        console.log(res);
      })
      .catch((err) => console.log(err));
  },

  async updateCard(id, text) {
    let data = { id, text };
    data = JSON.stringify(data);
    console.log(data);

    await fetch("http://localhost:8888/card/update", {
      method: "post",
      body: data,
    })
      .then((res) => {
        console.log(res);
      })
      .catch((err) => console.log(err));
  },

  async deleteCard(id) {
    await fetch("http://localhost:8888/card/delete", {
      method: "post",
      body: id,
    })
      .then((res) => {
        console.log(res);
      })
      .catch((err) => console.log(err));
  },
};
