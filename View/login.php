<?php
session_start();
require_once __DIR__ . '/../config.php'; // Adjust path as needed
require_once __DIR__ . '/../Controller/utilisateursController.php'; // Corrected filename

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $controller = new UtilisateursController();
        $user = $controller->authenticate($email, $password);

        if ($user && isset($user['id']) && isset($user['role'])) {
            $_SESSION['id'] = $user['id'];

            if ($user['role'] === 'admin') {
                header('Location: /gestiondenquete/View/BackOfiice/indexuser.php');
                exit;
            } else {
                header('Location: /gestiondenquete/View/user_dashboard.php');
                exit;
            }
        } else {
            $error = "Invalid email or password.";
        }
    } catch (Exception $e) {
        $error = "An error occurred during login. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { max-width: 400px; margin: 60px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);}
        .error { color: red; margin-bottom: 15px; }
        input[type="email"], input[type="password"] { width: 100%; padding: 10px; margin: 8px 0 16px; border: 1px solid #ccc; border-radius: 4px;}
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;}
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
