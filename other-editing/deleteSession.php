<?php

session_start();

if (!isset($_SESSION['requests']) || !is_array($_SESSION['requests'])) {
    $_SESSION['requests'] = [];
}

function deleteSession() : void
{
    $_SESSION['requests'] = [];
}



// main logic
deleteSession();
echo 'pog';
?>
