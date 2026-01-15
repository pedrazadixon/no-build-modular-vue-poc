<?php require_once '../../layout/head.php'; ?>

<div id="q-app">
    <!-- Your module content will go here -->
    <div v-for="n in 60" :key="n">
        Item {{ n }}
    </div>

</div>

<?php require_once '../../layout/scripts.php'; ?>

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

<?php require_once '../../layout/footer.php'; ?>