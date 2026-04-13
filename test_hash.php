<?php
$hash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
if (password_verify('admin123', $hash)) {
    echo "IS_ADMIN123";
} elseif (password_verify('password', $hash)) {
    echo "IS_PASSWORD";
} else {
    echo "UNKNOWN";
}
?>