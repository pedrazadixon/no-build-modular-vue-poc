const { createApp, ref } = Vue;

const app = createApp({
  setup() {
    const { rightDrawerOpen, toggleRightDrawer } = useMobxStore(
      window.globalStore.appStore,
      ["rightDrawerOpen", "toggleRightDrawer"]
    );

    const phoneNumber = ref("");
    return {
      phoneNumber,
      toggleRightDrawer,
    };
  },
});

app.use(Quasar).use(DarkModeSync);
app.mount("#q-app");
