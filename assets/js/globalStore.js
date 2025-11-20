class GlobalStore {
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

if (!window.globalStore) {
  window.globalStore = new GlobalStore();
}