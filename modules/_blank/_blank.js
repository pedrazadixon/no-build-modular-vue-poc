const { createApp, ref } = Vue;

const app = createApp({
  setup() {
    // Your module logic will go here
    
    const randomNumber = Math.floor(Math.random() * (100 - 60 + 1)) + 60;

    return {
      // Your module data will go here
      randomNumber
    };
  },
});

app.use(Quasar).use(DarkModeSync);
app.mount("#q-app");
