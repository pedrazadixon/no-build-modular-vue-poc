<!DOCTYPE html>
<html lang="en">

<?php include '../layout/head.php'; ?>

<body>
    <div id="q-app">
        <div class="">
            <div class="q-gutter-y-md">
                <q-tabs
                    v-model="tab"
                    inline-label
                    outside-arrows
                    mobile-arrows
                    align="left"
                    class="bg-primary text-white shadow-2">
                    <q-tab
                        v-for="tabItem in tabs"
                        :key="tabItem.name"
                        :name="tabItem.name"
                        :icon="tabItem.icon"
                        :label="tabItem.label">
                    </q-tab>
                </q-tabs>

                <q-tab-panels v-model="tab" animated keep-alive style="margin: 0;">
                    <q-tab-panel
                        style="padding: 0;"
                        v-for="tabItem in tabs"
                        :key="tabItem.name"
                        :name="tabItem.name">
                        <iframe :src="tabItem.url" frameborder="0" style="width: 100%;"></iframe>
                    </q-tab-panel>
                </q-tab-panels>

            </div>
        </div>

    </div>

    <?php include '../layout/scripts.php'; ?>

    <script>
        const {
            createApp,
            ref
        } = Vue;

        const app = createApp({
            setup() {
                const tabs = ref(window.globalStore.tabsStore.tabs);
                const tab = ref(window.globalStore.tabsStore.tab);

                window.parent.mobx.reaction(
                    () => ({
                        tabs: window.globalStore.tabsStore.tabs,
                        tab: window.globalStore.tabsStore.tab,
                    }),
                    (newValues) => {
                        tabs.value = newValues.tabs;
                        tab.value = newValues.tab;
                    }
                );

                return {
                    tabs,
                    tab,
                    addTab: window.globalStore.tabsStore.addTab,
                };
            },
        });

        app.use(Quasar);
        app.mount("#q-app");
    </script>
</body>

</html>