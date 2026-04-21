<?php
    session_start();
    require_once('../config/db.php');
    $page_title = $page_title ?? "EventHub CMS";

    if (!defined('APP_BASE_PATH')) {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $basePath = rtrim(str_replace('\\', '/', dirname(dirname($scriptName))), '/');
        define('APP_BASE_PATH', $basePath === '/' ? '' : $basePath);
    }

    if (!function_exists('app_url')) {
        function app_url($path = '')
        {
            $normalizedPath = '/' . ltrim($path, '/');
            return APP_BASE_PATH . ($path === '' ? '' : $normalizedPath);
        }
    }
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

        .alert {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert-danger {
            background: #ffe9e9;
            color: #b42318;
        }

        .alert-success {
            background: #e8f7ee;
            color: #1d6f42;
        }

        .btn,
        .btn-primary,
        .btn-secondary,
        .btn-dark,
        .btn-danger,
        .btn-outline-secondary {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            box-sizing: border-box;
        }

        .btn-primary,
        .btn-dark {
            background: #1e1e2f;
            color: #fff;
        }

        .btn-secondary,
        .btn-outline-secondary {
            background: #e8ebf2;
            color: #1e1e2f;
        }

        .btn-danger {
            background: #dc3545;
            color: #fff;
        }

        .w-100 {
            width: 100%;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e5e5e5;
        }

        .shadow-sm {
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .p-4 {
            padding: 24px;
        }

        .mt-4 {
            margin-top: 24px;
        }

        .mb-3 {
            margin-bottom: 16px;
        }

        .mb-4 {
            margin-bottom: 24px;
        }

        .form-label,
        .form-check-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
        }

        .form-control {
            width: 100%;
            border: 1px solid #d0d5dd;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-text {
            margin-top: 8px;
            color: #666;
            font-size: 13px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-check-input {
            margin: 0;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .gap-2 {
            gap: 12px;
        }
    </style>
</head>
<body>
