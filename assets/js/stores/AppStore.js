class AppStore {
  leftDrawerOpen = true;
  rightDrawerOpen = true;
  qPageMinHeight = 100;
  darkMode = false;

  constructor() {
    window.mobx.makeAutoObservable(this);
  }

  toggleLeftDrawer = () => {
    this.leftDrawerOpen = !this.leftDrawerOpen;
  };

  toggleRightDrawer = () => {
    this.rightDrawerOpen = !this.rightDrawerOpen;
  };

  toggleDarkMode = () => {
    this.darkMode = !this.darkMode;
  };
}

if (!window.globalStore) window.globalStore = {};
if (!window.globalStore.appStore) window.globalStore.appStore = new AppStore();
