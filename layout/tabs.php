<!DOCTYPE html>
<html lang="en">

<?php require_once '../layout/head.php'; ?>

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
                        :label="tabItem.label"
                        class="tab-with-close">
                        <q-btn flat unelevated ripple="false" glossy="false" label="✕" size="xs" class="close-tab-btn" @click.stop="closeTab(tabItem.name)"></q-btn>
                    </q-tab>
                </q-tabs>

                <div style="margin: 0; position: relative; overflow: hidden;">
                    <div
                        v-for="tabItem in tabs"
                        :key="tabItem.name"
                        class="tab-content"
                        :class="{ 'active': tab === tabItem.name }"
                        style="padding: 0; width: 100%; position: absolute; top: 0; left: 0;">
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

    <?php require_once '../layout/scripts.php'; ?>

    <script>
        const {
            createApp,
            ref,
            computed
        } = Vue;

        const app = createApp({
            setup() {
                const { tabs, tab, addTab, closeTab } = useMobxStore(
                    window.globalStore.tabsStore,
                    ['tabs', 'tab', 'addTab', 'closeTab']
                );

                const { qPageMinHeight } = useMobxStore(
                    window.globalStore.appStore,
                    ['qPageMinHeight']
                );

                const iframeHeight = computed(() => `${qPageMinHeight.value - 60}px`);

                return {
                    tabs,
                    tab,
                    addTab,
                    closeTab,
                    iframeHeight,
                };
            },
        });

        app.use(Quasar).use(DarkModeSync);
        app.mount("#q-app");
    </script>
</body>

</html>