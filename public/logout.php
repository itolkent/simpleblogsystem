<?php
require_once __DIR__ . '/../app/Controllers/AuthController.php';
AuthController::logout();
session_destroy();
header("Location: /login.php");
exit;
