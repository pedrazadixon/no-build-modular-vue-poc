class AppStore {
  leftDrawerOpen = true;
  rightDrawerOpen = false;

  constructor() {
    window.mobx.makeAutoObservable(this);
  }

  toggleLeftDrawer = () => {
    this.leftDrawerOpen = !this.leftDrawerOpen;
  };

  toggleRightDrawer = () => {
    this.rightDrawerOpen = !this.rightDrawerOpen;
  };
}

class CounterStore {
  count = 0;

  constructor() {
    window.mobx.makeAutoObservable(this);
  }

  increment = () => {
    this.count++;
  };

  decrement = () => {
    this.count--;
  };
}

class TabsStore {
  tab = "mails";

  tabs = [
    // {
    //   name: "mails",
    //   icon: "mail",
    //   label: "Mails",
    //   url: "https://placehold.co/400?text=Mails",
    // },
    // {
    //   name: "alarms",
    //   icon: "alarm",
    //   label: "Alarms",
    //   url: "https://placehold.co/400?text=Alarms",
    // },
    // {
    //   name: "movies",
    //   icon: "movie",
    //   label: "Movies",
    //   url: "https://placehold.co/400?text=Movies",
    // },
  ];

  constructor() {
    window.mobx.makeAutoObservable(this);
  }

  setTab = (tab) => {
    this.tab = tab;
  };

  addTab = (tab) => {
    // if tab with same name exists, switch to it instead of adding a new one
    const existingTab = this.tabs.find((t) => t.name === tab.name);
    if (existingTab) {
      this.tab = existingTab.name;
      return;
    }

    const newTab = {
      name: tab.name,
      icon: tab.icon,
      label: tab.label,
      url: tab.url,
    };

    this.tabs.push(newTab);
    this.tab = newTab.name; // Switch to the newly added tab
  };
}

if (!window.globalStore) {
  window.globalStore = {};
  window.globalStore.appStore = new AppStore();
  window.globalStore.counterStore = new CounterStore();
  window.globalStore.tabsStore = new TabsStore();
}
