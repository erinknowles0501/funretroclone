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
  async init(id) {
    console.log("id in actions:", id);
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

  getSprint(id) {
    return getters.sprints().find((sprint) => {
      return sprint.id == id;
    });
  },

  ///
  /* LANES */
  ///
  async createLane(title, color) {
    let data = { title, color, cards: [] };
    data = JSON.stringify(data);
    console.log(data);

    await fetch("http://localhost:8888/lane/create", {
      method: "post",
      body: data,
    }).then((res) => {
      console.log(res);
    });
  },
};
