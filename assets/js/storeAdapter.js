(function () {
  function getRootGlobal(key) {
    try {
      // Try to access the top window first
      if (window.top && window.top !== window) {
        // Check if the key exists in the top window
        if (window.top[key]) {
          return window.top[key];
        }
      }

      // If not found, try the parent window
      if (window.parent && window.parent !== window) {
        return window.parent[key];
      }
    } catch (e) {
      console.warn("Could not access the root window:", e);
      return null;
    }
    return null;
  }

  const parentMobx = getRootGlobal("mobx");
  const parentStore = getRootGlobal("globalStore");
  const parentQuasar = getRootGlobal("Quasar");

  if (parentMobx) {
    window.mobx = parentMobx;
  }

  if (parentStore) {
    window.globalStore = parentStore;
  }

  if (parentQuasar) {
    window.parentQuasar = parentQuasar;
  }
})();
