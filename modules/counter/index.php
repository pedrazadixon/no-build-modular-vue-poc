<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
  <div id="q-app">
    <div>Counter: {{ counter }}</div>
    <div>
      <q-btn @click="decrement" label="Decrement" color="primary"></q-btn>
      <q-btn @click="increment" label="Increment" color="primary"></q-btn>
    </div>
  </div>

  <?php include '../../layout/scripts.php'; ?>

  <script>
    const {
      createApp,
      ref
    } = Vue;

    const app = createApp({
      setup() {
        initializeApp();

        const { count: counter, increment, decrement } = useMobxStore(
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

    app.use(Quasar);
    app.mount("#q-app");
  </script>
</body>

</html>