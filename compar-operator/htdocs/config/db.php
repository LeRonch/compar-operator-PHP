<?php

try {
    $db = new PDO("mysql:host=127.0.0.1;dbname=compar_operator", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo 'Error!: ', $e->getMessage(), '<br />';
    die();
}
