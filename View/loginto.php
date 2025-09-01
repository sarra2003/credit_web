<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Controller/utilisateursController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $controller = new UtilisateursController();
        $user = $controller->authenticate($email, $password);

        if ($user && isset($user['id']) && isset($user['role'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['user'] = $user;
            if ($user['role'] === 'admin') {
                header('Location: BackOffice/indexuser.php');
                exit;
            } else {
                if ($user['role'] === 'agent') {
                    header('Location: ../View/FrontOffice/agent_dashboard.php');
                    exit;
                } elseif ($user['role'] === 'client') {
                    header('Location: ../View/FrontOffice/client_dashboard.php');
                    exit;
                }
            }
        } else {
            // Redirect to login.php with error message
            header('Location: login.php?error=Invalid+email+or+password');
            exit;
        }
    } catch (Exception $e) {
        // Redirect to login.php with error message
        header('Location: login.php?error=An+error+occurred+during+login');
        exit;
    }
}
?>