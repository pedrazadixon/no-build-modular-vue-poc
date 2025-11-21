<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
    <div id="q-app">
    </div>

    <?php include '../../layout/scripts.php'; ?>

    <script>
        const {
            createApp,
            ref
        } = Vue;

        const app = createApp({
            setup() {
                const counter = ref(window.globalStore.counterStore.count);
                return {};
            },
        });

        app.use(Quasar);
        app.mount("#q-app");
    </script>
</body>

</html>