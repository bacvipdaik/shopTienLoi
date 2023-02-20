<?php
if (isset($_SESSION['dangnhap_admin'])) {
    unset($_SESSION['username_admin']);
    unset($_SESSION['dangnhap_admin']);
    // echo 'hahahahaha';
    echo "<script>
                window.location = '" . BASE_URL . "';
            </script>";
}
