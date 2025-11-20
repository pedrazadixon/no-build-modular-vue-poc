<!DOCTYPE html>
<html lang="en">
<?php include 'layout/head.php'; ?>

<body>
  <div id="q-app">
    <div>Counter: {{ counter }}</div>
    <div>
      <q-btn @click="decrement" label="Decrement"></q-btn>
      <q-btn @click="increment" label="Increment"></q-btn>
    </div>

    <div class="column">
      <iframe width="300" height="100" src="modules/counter/index_iframe1.php" frameborder="0"></iframe>
    </div>
  </div>

  <?php include 'layout/scripts.php'; ?>

  <script>
    const {
      createApp,
      ref
    } = Vue;

    const app = createApp({
      setup() {
        const counter = ref(window.globalStore.count);

        mobx.reaction(
          () => window.globalStore.count,
          (newValue) => {
            counter.value = newValue;
          }
        );

        return {
          counter,
          increment: window.globalStore.increment,
          decrement: window.globalStore.decrement,
        };
      },
    });

    app.use(Quasar);
    app.mount("#q-app");
  </script>

</body>

</html>