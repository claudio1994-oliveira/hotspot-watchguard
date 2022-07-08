<?php
if (isset($_SESSION['type']) &&   isset($_SESSION['message'])) {
?>
<div class="alert alert-<?= $_SESSION['type'] ?> alert-dismissible fade show" role="alert">
    <strong><?= $_SESSION['message'] ?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
}

unset($_SESSION['type'],  $_SESSION['message']);

?>