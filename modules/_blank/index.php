<?php require_once '../../layout/head.php'; ?>

<div id="q-app">
    <!-- Your module content will go here -->
    <div v-for="n in randomNumber" :key="n">
        Item {{ n }}
    </div>

</div>

<?php require_once '../../layout/scripts.php'; ?>
<script src="<?php echo BASE_URL; ?>modules/_blank/_blank.js?v=<?php echo APP_VERSION; ?>"></script>

<?php require_once '../../layout/footer.php'; ?>