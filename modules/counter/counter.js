const { createApp, ref } = Vue;

const app = createApp({
  setup() {
    const {
      count: counter,
      increment,
      decrement,
    } = useMobxStore(window.globalStore.counterStore, [
      "count",
      "increment",
      "decrement",
    ]);

    return {
      counter,
      increment,
      decrement,
    };
  },
});

app.use(Quasar).use(DarkModeSync);
app.mount("#q-app");
