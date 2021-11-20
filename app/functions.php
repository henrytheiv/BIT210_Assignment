<?php

function redirect($url) {
    header("Location: $url");
    die();
}

// Check if the request methos is 'GET'
function is_get() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

// Check if the request methos is 'POST'
function is_post() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
