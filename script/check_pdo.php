<?php
if (extension_loaded('pdo_mysql')) {
    echo 'pdo_mysql extension is enabled.';
} else {
    echo 'pdo_mysql extension is NOT enabled.';
}
?>