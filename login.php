<?php
include('components/header.php');
if (isset($_GET['user'])) {
    if ($_GET['user'] != 'admin' && $_GET['user'] != 'faculty') {
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>
<main class="container d-flex flex-column align-items-center">
    <form id="frmLogin" class="container frm-login">
        <div class="login-input-container m-3">
            <label for="username">Username</label>
            <input type="text" id="username" class="form-control" required>
        </div>
        <div class="login-input-container m-3">
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control" required>
        </div>
        <input type="hidden" id="userType" value="<?= $_GET['user'] ?>">
        <center>
            <button type="submit" id="btnLogin" class="btn btn-dark m-2 btn-pick-user-type">Log In</button>
        </center>
    </form>
</main>
<?php
include('components/footer.php');
