<!DOCTYPE html>
<html lang="en">
<?php include 'layout/head.php'; ?>

<body>
  <div id="q-app">

    <q-layout view="hHh lpR fFf">

      <q-header reveal elevated class="bg-primary text-white">
        <q-toolbar>
          <q-btn dense flat round icon="menu" @click="toggleLeftDrawer"> </q-btn>

          <q-toolbar-title>
            <q-avatar>
              <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
            </q-avatar>
            Title
          </q-toolbar-title>

          <q-btn dense flat round icon="menu" @click="toggleRightDrawer"> </q-btn>
        </q-toolbar>
      </q-header>

      <q-drawer v-model="leftDrawerOpen" side="left" bordered>
        <div v-for="n in 60" :key="n">
          Item {{ n }}
        </div>
      </q-drawer>

      <q-drawer v-model="rightDrawerOpen" side="right" bordered>
        <div v-for="n in 60" :key="n">
          Item {{ n }}
        </div>
      </q-drawer>

      <q-page-container>

        <iframe src="<?php echo BASE_URL ?>layout/tabs.php" frameborder="0" style="width: 100%;"></iframe>

      </q-page-container>

    </q-layout>

  </div>

  <?php include 'layout/scripts.php'; ?>

  <script>
    const {
      createApp,
      ref
    } = Vue;

    const app = createApp({
      setup() {
        const leftDrawerOpen = ref(true)
        const rightDrawerOpen = ref(false)

        return {
          leftDrawerOpen,
          toggleLeftDrawer() {
            leftDrawerOpen.value = !leftDrawerOpen.value
          },

          rightDrawerOpen,
          toggleRightDrawer() {
            rightDrawerOpen.value = !rightDrawerOpen.value
          }
        }
      }
    });

    app.use(Quasar);
    app.mount("#q-app");
  </script>

</body>

</html>