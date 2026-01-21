<?php require_once '../../layout/head.php'; ?>

<div id="q-app">
  <div>Counter: {{ counter }}</div>
  <div>
    <q-btn @click="decrement" label="Decrement" color="primary"></q-btn>
    <q-btn @click="increment" label="Increment" color="primary"></q-btn>
  </div>
</div>

<?php require_once '../../layout/scripts.php'; ?>
<script src="<?php echo BASE_URL; ?>modules/counter/counter.js?v=<?php echo APP_VERSION; ?>"></script>

<?php require_once '../../layout/footer.php'; ?>