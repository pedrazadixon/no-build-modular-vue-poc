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

if (!window.globalStore) window.globalStore = {};
if (!window.globalStore.counterStore)
  window.globalStore.counterStore = new CounterStore();
