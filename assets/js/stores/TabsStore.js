class TabsStore {
  tab = "mails";

  tabs = [];

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

  closeTab = (tabName) => {
    this.tabs = this.tabs.filter((tab) => tab.name !== tabName);

    // if is current tab, move to first tab
    if (this.tab === tabName) {
      this.tab = this.tabs.length > 0 ? this.tabs[0].name : null;
    }
  };
}




if (!window.globalStore) window.globalStore = {};
if (!window.globalStore.tabsStore)
  window.globalStore.tabsStore = new TabsStore();