<?php

$conn = new mysqli(
    '',
    '',
    '',
    ''
);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

function show_items($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
