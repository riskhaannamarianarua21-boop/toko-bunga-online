<?php
$conn = mysqli_connect(
    "sql205.infinityfree.com",
    "if0_42081437",
    "N50q2RH9AF5",
    "if0_42081437_tokobunga"
);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>