// Vue plugin for dark mode sync - auto-executes when registered with app.use()
const DarkModeSync = {
  install() {
    Quasar.Dark.set(window.globalStore.appStore.darkMode);
    mobx.reaction(
      () => window.globalStore.appStore.darkMode,
      (darkMode) => Quasar.Dark.set(darkMode)
    );
  }
};

window.DarkModeSync = DarkModeSync;
