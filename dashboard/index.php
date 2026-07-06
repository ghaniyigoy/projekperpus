<?php
header("Location: login/login.php");
exit;
?><?php
include "../login/cek_login.php";
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-body">

<h2>Dashboard Admin</h2>

<hr>

<h4>Selamat Datang,
<?php echo $_SESSION['nama']; ?>
</h4>

<a href="../login/logout.php"
class="btn btn-danger mt-3">
Logout
</a>

</div>

</div>

</div>

</body>
</html>