<?php

$conn = new mysqli("localhost", "root", "", "products");

if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}