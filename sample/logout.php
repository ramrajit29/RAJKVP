<?php
session_start();
unset($_SESSION['admin_loggedin_id']);
session_destroy();
?>
<script>
window.location="index.php";
</script>