<?php if (isset($_SESSION['alert'])): ?>
<script>
Swal.fire({
  icon: '<?= $_SESSION['alert']['type'] ?>',
  title: '<?= $_SESSION['alert']['title'] ?>',
  text: '<?= $_SESSION['alert']['text'] ?>',
  showConfirmButton: false,
  timer: 2000
});
</script>
<?php unset($_SESSION['alert']);?>
<?php endif; ?>