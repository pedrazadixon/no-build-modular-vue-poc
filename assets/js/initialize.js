var initializeApp = function () {
  // Initialize dark mode state
  Quasar.Dark.set(window.globalStore.appStore.darkMode);

  // Set up reaction to sync dark mode changes
  window.parent.mobx.reaction(
    () => window.globalStore.appStore.darkMode,
    (newValue) => {
      Quasar.Dark.set(newValue);
    }
  );
};
