<template>
    <div id="app">
        <div>
            <router-link to="/sprints">Sprints</router-link>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
// Implement Storybook for funsies

export default {
    name: "App",

    data() {
        return {
            //
        };
    },
    // async created() {
    //   const vm = this;
    //   await fetch("http://localhost:8888/sprint/all").then((res) => {
    //     res.json().then(function(data) {
    //       console.log(data);
    //       vm.sprints = data;
    //     });
    //   });

    //   vm.loading = false;
    // },
};
</script>
