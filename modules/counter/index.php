<?php require_once '../../layout/head.php'; ?>

<div id="q-app">
  <div>Counter: {{ counter }}</div>
  <div>
    <q-btn @click="decrement" label="Decrement" color="primary"></q-btn>
    <q-btn @click="increment" label="Increment" color="primary"></q-btn>
  </div>
</div>

<?php require_once '../../layout/scripts.php'; ?>

<script>
  const {
    createApp,
    ref
  } = Vue;

  const app = createApp({
    setup() {
      const {
        count: counter,
        increment,
        decrement
      } = useMobxStore(
        window.globalStore.counterStore,
        ['count', 'increment', 'decrement']
      );

      return {
        counter,
        increment,
        decrement,
      };
    },
  });

  app.use(Quasar).use(DarkModeSync);
  app.mount("#q-app");
</script>

<?php require_once '../../layout/footer.php'; ?>