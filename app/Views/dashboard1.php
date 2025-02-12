<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h3>Admin Dashboard</h3>
    <p>Welcome, <?= session()->get('username') ?>!</p>
    <a href="<?= site_url('logout') ?>">Logout</a>
</body>
</html>