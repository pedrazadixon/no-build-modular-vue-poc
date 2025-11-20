(function () {
  function getParentGlobal(key) {
    try {
      if (window.parent && window.parent !== window) {
        return window.parent[key];
      }
    } catch (e) {
      console.warn("No se pudo acceder al padre:", e);
      return null;
    }
    return null;
  }

  const parentMobx = getParentGlobal("mobx");
  const parentStore = getParentGlobal("globalStore");

  if (parentMobx) {
    window.mobx = parentMobx;
  }

  if (parentStore) {
    window.globalStore = parentStore;
  }
})();