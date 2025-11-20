<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
  <div id="q-app">
    <div>Counter: {{ counter }}</div>
    <div>
      <q-btn @click="decrement" label="Decrement"></q-btn>
      <q-btn @click="increment" label="Increment"></q-btn>
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
        const counter = ref(window.parent.globalStore.count);

        window.parent.mobx.reaction(
          () => window.parent.globalStore.count,
          (newValue) => {
            counter.value = newValue;
          }
        );

        return {
          counter,
          increment: window.parent.globalStore.increment,
          decrement: window.parent.globalStore.decrement,
        };
      },
    });

    app.use(Quasar);
    app.mount("#q-app");
  </script>
</body>

</html>