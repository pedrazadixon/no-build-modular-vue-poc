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

        <q-scroll-area class="fit">
          <q-list padding>

            <template v-for="menuItem in mainMenu" :key="menuItem.text">
              <q-item v-if="!menuItem.items" v-ripple clickable @click="addTab(menuItem)">
                <q-item-section avatar>
                  <q-icon color="grey" :name="menuItem.icon" />
                </q-item-section>
                <q-item-section>
                  <q-item-label>{{ menuItem.text }}</q-item-label>
                </q-item-section>
              </q-item>

              <q-expansion-item
                v-else
                :expand-separator="true"
                :icon="menuItem.icon"
                :label="menuItem.text">
                <q-list padding>
                  <q-item v-for="subMenuItem in menuItem.items" :key="subMenuItem.text" v-ripple clickable @click="addTab(subMenuItem)">
                    <q-item-section avatar>
                      <q-icon color="grey" :name="subMenuItem.icon" />
                    </q-item-section>
                    <q-item-section>
                      <q-item-label>{{ subMenuItem.text }}</q-item-label>
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-expansion-item>
            </template>

          </q-list>

        </q-scroll-area>

      </q-drawer>

      <q-drawer v-model="rightDrawerOpen" side="right" bordered>
        <div v-for="n in 60" :key="n">
          Item {{ n }}
        </div>
      </q-drawer>

      <q-page-container>
        <iframe src="<?php echo BASE_URL ?>layout/tabs.php" frameborder="0" style="width: 100%;" height="600"></iframe>
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

        const leftDrawerOpen = ref(window.globalStore.appStore.leftDrawerOpen);
        const rightDrawerOpen = ref(window.globalStore.appStore.rightDrawerOpen);

        window.parent.mobx.reaction(
          () => ({
            left: window.globalStore.appStore.leftDrawerOpen,
            right: window.globalStore.appStore.rightDrawerOpen
          }),
          (newValues) => {
            leftDrawerOpen.value = newValues.left;
            rightDrawerOpen.value = newValues.right;
          }
        );

        const addTab = (menuItem) => {
          tabInfo = {
            name: menuItem.text,
            icon: menuItem.icon,
            label: menuItem.text,
            url: menuItem.url
          }
          window.globalStore.tabsStore.addTab(tabInfo);
        };


        const mainMenu = [{
            icon: 'home',
            text: 'Home',
            url: 'https://placehold.co/400?text=Hello',
          },
          {
            icon: 'countertops',
            text: 'Counter',
            url: '<?php echo BASE_URL ?>modules/counter/index.php',
          },
          {
            icon: 'calculate',
            text: 'Form',
            url: '<?php echo BASE_URL ?>modules/form/index.php',
          },
          {
            icon: 'whatshot',
            text: 'Trending',
            items: [{
                icon: 'fireplace',
                text: 'Today',
                url: 'https://placehold.co/400?text=Today',
              },
              {
                icon: 'local_fire_department',
                text: 'This week',
                url: 'https://placehold.co/400?text=This+week',
              },
            ],
          },
          {
            icon: 'subscriptions',
            text: 'Subscriptions',
            url: 'https://placehold.co/400?text=Subscriptions',
          },

          {
            icon: 'folder',
            text: 'Reports',
            items: [{
                icon: 'insert_drive_file',
                text: 'Report 1',
                url: 'https://placehold.co/400?text=Report+1',
              },
              {
                icon: 'insert_drive_file',
                text: 'Report 2',
                url: 'https://placehold.co/400?text=Report+2',
              },
              {
                icon: 'insert_drive_file',
                text: 'Report 3',
                url: 'https://placehold.co/400?text=Report+3',
              },
            ],
          },
        ]

        return {
          leftDrawerOpen,
          toggleLeftDrawer: window.globalStore.appStore.toggleLeftDrawer,
          rightDrawerOpen,
          toggleRightDrawer: window.globalStore.appStore.toggleRightDrawer,
          mainMenu,
          addTab,
        }
      }
    });

    app.use(Quasar);
    app.mount("#q-app");
  </script>

</body>

</html>