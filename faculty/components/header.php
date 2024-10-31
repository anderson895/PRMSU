<?php
ob_start();

function backToIndex()
{
    header('Location: ../../index.php');
    exit;
}

function backToAdminMain()
{
    header('Location: faculty.php');
    exit;
}

include('../../backend/db/db_class.php');
$db = new global_class();
$admin_db = new admin_class();

session_start();
if (!isset($_SESSION['user_id'])) {
    backToIndex();
}

$getUser = $db->getUser($_SESSION['user_id']);
if ($getUser->num_rows > 0) {
    $user = $getUser->fetch_assoc();
    $user_id = $_SESSION['user_id'];
} else {
    backToIndex();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PRMSU COE-DMS | Faculty</title>

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/styles.css" />

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <div class="alert">ashdhasfdhg</div>

    <nav class="top-nav bg-dark d-flex align-items-center justify-content-between">
        <h4 class="top-nav-title">PRMSU COE-DMS</h4>
        <!-- <h5 class="text-light txt-welcome-admin">Welcome!</h5> -->
    </nav>
    <aside class="side-bar bg-light text-light">
        <div class="nav-search-bar p-2">
            <input type="search" class="form-control" id="search" placeholder="Search files...">
            <span class="search-suggestion-container container text-dark">
                <ul class="list-group search-items-container" id="search-items-container">
                    <!-- <li class="list-group-item">
                        <a href="#" class="text-dark txt-folder-link">
                            asdjhgsjagd
                        </a>
                    </li> -->
                </ul>
            </span>
        </div>
        <ul class="side-nav-ul list-group p-2">
            <li class="side-nav-li">
                <a href="faculty.php?page=inbox" class="a-inbox <?= (isset($_GET['page']) && $_GET['page'] == 'inbox') ? 'side-nav-active' : '' ?>">
                    <i class="bi bi-chat-dots-fill"></i> Inbox <?= ($user['INBOX'] > 0) ? '<span class="badge badge-light bg-danger m-2" id="notificationCount">' . $user['INBOX'] . '</span>' : '' ?>
                </a>
            </li>
            <li class="side-nav-li">
                <a href="faculty.php?page=notification" class="a-inbox <?= (isset($_GET['page']) && $_GET['page'] == 'notification') ? 'side-nav-active' : '' ?>">
                    Notification <?= ($user['NOTIF'] > 0) ? '<span class="badge badge-light bg-danger m-2" id="notificationCount">' . $user['NOTIF'] . '</span>' : '' ?>
                </a>
            </li>

            <li class="side-nav-li">
                <a href="faculty.php?page=folders" class="a-inbox <?= (isset($_GET['page']) && $_GET['page'] == 'folders') ? 'side-nav-active' : '' ?>">
                    Folders
                </a>
            </li>

            <li class="side-nav-li">
                <a href="faculty.php?page=SharedFiles" class="a-inbox <?= (isset($_GET['page']) && $_GET['page'] == 'SharedFiles') ? 'side-nav-active' : '' ?>">
                    Shared Files
                </a>
            </li>


        </ul>
        <ul class="list-group mt-3 p-2">
            <div class="admin-tools-label">
                <p>Tools</p>
            </div>
            <li class="side-nav-li">
                <a href="faculty.php?page=ManageAccount" class="<?= (isset($_GET['page']) && $_GET['page'] == 'ManageAccount') ? 'side-nav-active' : '' ?>">Manage Account</a>
            </li>
            <li class="side-nav-li">
                <a href="faculty.php?page=RecycleBin" class="<?= (isset($_GET['page']) && $_GET['page'] == 'RecycleBin') ? 'side-nav-active' : '' ?>">Recycle Bin</a>
            </li>
            <li class="side-nav-li">
                <a href="../../logout.php">Log Out</a>
            </li>
        </ul>
    </aside>