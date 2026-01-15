function initializeApp() {
  // Initialize dark mode state
  Quasar.Dark.set(window.globalStore.appStore.darkMode);

  // Set up reaction to sync dark mode changes
  mobx.reaction(
    () => window.globalStore.appStore.darkMode,
    (newValue) => {
      Quasar.Dark.set(newValue);
    }
  );
}

window.initializeApp = initializeApp;
