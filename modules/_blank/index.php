<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

<body>
    <div id="q-app">
        <!-- Your module content will go here -->

        <div v-for="n in 60" :key="n">
            Item {{ n }}
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
                // Your module logic will go here

                return {
                    // Your module data will go here
                };
            },
        });

        app.use(Quasar).use(DarkModeSync);
        app.mount("#q-app");
    </script>
</body>

</html>