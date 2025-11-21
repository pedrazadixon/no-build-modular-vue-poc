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

                <div style="margin: 0;">
                    <div
                        v-for="tabItem in tabs"
                        :key="tabItem.name"
                        v-show="tab === tabItem.name"
                        style="padding: 0;">
                        <iframe
                            :src="tabItem.url"
                            frameborder="0"
                            style="width: 100%;"
                            :style="{ minHeight: iframeHeight, height: iframeHeight }">
                        </iframe>
                    </div>
                </div>

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
                const iframeHeight = ref(`${window.globalStore.appStore.qPageMinHeight - 60}px`);

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

                window.parent.mobx.reaction(
                    () => ({
                        qPageMinHeight: window.globalStore.appStore.qPageMinHeight,
                    }),
                    (newValues) => {
                        iframeHeight.value = `${newValues.qPageMinHeight - 60}px`;
                    }
                );

                return {
                    tabs,
                    tab,
                    addTab: window.globalStore.tabsStore.addTab,
                    iframeHeight,
                };
            },
        });

        app.use(Quasar);
        app.mount("#q-app");
    </script>
</body>

</html>