<?php
    session_start();
    require_once('../config/db.php');
    $page_title = $page_title ?? "EventHub CMS";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EventHub CMS</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Basic Styling -->
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f5f6fa;
        }

        .container {
            padding: 20px;
            max-width: 1100px;
            margin: auto;
        }

        h1, h2 {
            font-weight: 600;
        }
    </style>
</head>
<body>
