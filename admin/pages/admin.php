<?php
include('../components/header.php');
?>
<main class="main-container container bg-light">
    <?php
    if (isset($_GET['file'])) {
        $fileId = $_GET['file'];
        if (isset($_GET['folder'])) {
            $folderId = $_GET['folder'];
            $getFilesFolder = $admin_db->getFileFolder($folderId);
            if ($getFilesFolder->num_rows > 0) {
                $filesFolder = $getFilesFolder->fetch_assoc();
            } else {
                backToAdminMain();
            }
        }
        if (isset($_GET['faculty'])) {
            $facultyId = $_GET['faculty'];
            $getFaculty = $admin_db->getFaculty($facultyId);
            if ($getFaculty->num_rows > 0) {
                $faculty = $getFaculty->fetch_assoc();
            } else {
                backToAdminMain();
            }
        }

        if (isset($_GET['section'])) {
            $sectionId = $_GET['section'];
            $getSections = $admin_db->getSectionsId($sectionId);
            if ($getSections->num_rows > 0) {
                $section = $getSections->fetch_assoc();
            } else {
                backToAdminMain();
            }
        }

        $getFile = $admin_db->getFile($fileId);
        if ($getFile->num_rows > 0) {
            $file = $getFile->fetch_assoc();
            $dateTimeString = $file['DATETIME'];
            $dateTime = new DateTime($dateTimeString);
            $formattedDateTime = $dateTime->format('F j, Y g:i a');

    ?>
            <!-- File -->
            <!-- End Page Title -->
            <div class="pagetitle mt-3 d-flex justify-content-between">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                        <?= (isset($_GET['section']) ? '<li class="breadcrumb-item"><a href="admin.php?section=' . $sectionId . '">' . $section['SECTION_NAME'] . '</a></li>' : '') ?>
                        <?= (isset($_GET['faculty']) ? '<li class="breadcrumb-item"><a href="admin.php?section=' . $sectionId . '&faculty=' . $facultyId . '">' . $faculty['FACULTY_NAME'] . '</a></li>' : '') ?>
                        <?= (isset($_GET['folder']) ? '<li class="breadcrumb-item"><a href="admin.php?section=' . $sectionId . '&faculty=' . $facultyId . '&folder=' . $folderId . '">' . $filesFolder['FOLDER_NAME'] . '</a></li>' : '') ?>
                        <li class="breadcrumb-item"><?= $file['DISPLAY_FILE_NAME'] ?></li>
                    </ol>
                </nav>
                <!-- <button class="btn btn-dark" id="btnAddFile" data-id="<?= $folderId ?>">New File</button> -->
            </div>
            <!-- End Page Title -->
            <div class="">
                <div class="container file-main-container p-3 pt-5 pb-5 card">
                    <div class="d-flex justify-content-between">
                        <h4 class="hightlight-color"><i class="bi bi-file-earmark-fill"></i><?= $file['DISPLAY_FILE_NAME'] ?></h4>
                        <div>
                            <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                            <button class="btn btnDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                            <a class="btn" href="../../backend/filesFolder/<?= $file['FILE_NAME'] ?>" download><i class="bi bi-box-arrow-down"></i></a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6 class="hightlight-color">Notes:</h6>
                        <textarea class="form-control" readonly><?= $file['NOTES'] ?></textarea>
                    </div>
                    <div class="mt-3">
                        <h6 class="hightlight-color">Tags:</h6>
                        <textarea class="form-control" readonly><?= $file['TAGS'] ?></textarea>
                    </div>

                    <div class="d-flex mt-3">
                        <div class="">
                            <h6 class="hightlight-color">Document ID</h6>
                            <input type="text" class="form-control" value="<?= $file['ID'] ?>">
                        </div>
                        <div class="file-date-container">
                            <h6 class="hightlight-color">Date</h6>
                            <input type="text" class="form-control" value="<?= $formattedDateTime ?>">
                        </div>
                    </div>

                    <hr class="mt-5">

                    <div class="mt-4">
                        <h6 class="hightlight-color">Shared To</h6>
                        <ul class="list-group">
                            <?php
                            $getSharedFiles = $admin_db->getSharedFilesJoinUsers($fileId);
                            if ($getSharedFiles->num_rows > 0) {
                                while ($sharedFile = $getSharedFiles->fetch_assoc()) {
                            ?>
                                    <li class="list-group-item"><?= $sharedFile['F_NAME'] . ' ' . $sharedFile['MI'] . ' ' . $sharedFile['L_NAME'] . ' ' . $sharedFile['SUFFIX'] ?></li>
                                <?php
                                }
                            } else {
                                ?>
                                <li class="list-group-item">You don't share this files to anyone.</li>
                            <?php
                            }
                            ?>
                            <li class="list-group-item">
                                <h6>Share This File: </h6>
                                <div class="d-flex">
                                    <input type="hidden" id="hiddenFileId" value="<?= $fileId ?>">
                                    <select id="sharedFileTo" class="form-control m-1">
                                        <option value=""></option>
                                        <?php
                                        $getFaculty = $db->getFacultyUsers();
                                        if ($getFaculty->num_rows > 0) {
                                            while ($facultyPerson = $getFaculty->fetch_assoc()) {
                                                $facultyPersonId = $facultyPerson['ID'];
                                                $checkSharedFiled = $admin_db->checkSharedFiled($facultyPersonId, $fileId);
                                                echo ($checkSharedFiled->num_rows > 0) ? '' : '<option value="' . $facultyPerson['ID'] . '">' . $facultyPerson['F_NAME'] . ' ' . $facultyPerson['MI'] . ' ' . $facultyPerson['L_NAME'] . ' ' . $facultyPerson['SUFFIX'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <button type="button" class="btn btn-dark m-1" id="btnShareFile">Share</button>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <hr class="mt-5">

                    <div class="mt-4">
                        <h6 class="hightlight-color">Audit Log</h6>
                        <table class="table">
                            <tr>
                                <th>Time</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <?php
                                $getAuditLog = $admin_db->getAuditLog($fileId);
                                if ($getAuditLog->num_rows > 0) {
                                    while ($audit = $getAuditLog->fetch_assoc()) {
                                ?>
                            <tr>
                                <td><?= $audit['DATE_TIME'] ?></td>
                                <td><?= $audit['USER_ID'] ?></td>
                                <td><?= $audit['ACTION'] ?></td>
                            </tr>
                        <?php
                                    }
                                } else {
                        ?>
                        <tr>
                            <td colspan="3">
                                <center>No Audit Yet</center>
                            </td>
                        </tr>
                    <?php
                                }
                    ?>
                    </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End of File -->
            <?php
        } else {
            backToAdminMain();
        }
    } elseif (isset($_GET['folder'])) {
        if (isset($_GET['faculty'])) {
            if (isset($_GET['section'])) {
                $folderId = $_GET['folder'];
                $facultyId = $_GET['faculty'];
                $sectionId = $_GET['section'];

                $checkSectionId = $admin_db->getSectionsId($sectionId);
                if ($checkSectionId->num_rows > 0) {
                    $section = $checkSectionId->fetch_assoc();
                    $checkFacultyId = $admin_db->getFaculty($facultyId);
                    if ($checkFacultyId->num_rows > 0) {
                        $faculty = $checkFacultyId->fetch_assoc();
                        $getFilesFolder = $admin_db->getFileFolder($folderId);
                        if ($getFilesFolder->num_rows > 0) {
                            $filesFolder = $getFilesFolder->fetch_assoc();
            ?>
                            <!-- Files Folder -->
                            <!-- End Page Title -->
                            <div class="pagetitle mt-3 d-flex justify-content-between">
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>"><?= $section['SECTION_NAME'] ?></a></li>
                                        <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $facultyId ?>"><?= $faculty['FACULTY_NAME'] ?></a></li>
                                        <li class="breadcrumb-item"><?= $filesFolder['FOLDER_NAME'] ?></li>
                                    </ol>
                                </nav>
                                <button class="btn btn-dark" id="btnAddFile" data-id="<?= $folderId ?>">New File</button>

                            </div>
                            <!-- End Page Title -->

                            <div class="">
                                <table class="table">
                                    <tr>
                                        <th class="">Name</th>
                                        <th class="">Date</th>
                                        <th class="">Action</th>
                                    </tr>
                                    <?php
                                    $getFiles = $admin_db->getFileUsingFolderId($folderId);
                                    if ($getFiles->num_rows > 0) {
                                        while ($file = $getFiles->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $facultyId ?>&folder=<?= $folderId ?>&file=<?= $file['ID'] ?>" class="text-dark txt-folder-link">
                                                        <i class="bi bi-file-earmark"></i> <?= $file['DISPLAY_FILE_NAME'] ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $dateTimeString = $file['DATETIME'];
                                                    $dateTime = new DateTime($dateTimeString);
                                                    $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"

                                                    echo $formattedDateTime;
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                                    <button class="btn btnDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                                                    <a class="btn" href="../../backend/filesFolder/<?= $file['FILE_NAME'] ?>" download><i class="bi bi-box-arrow-down"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                                <center>No File Found</center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>

                            <!-- End of Files Folder  -->
                    <?php
                        } else {
                            backToAdminMain();
                        }
                    } else {
                        backToAdminMain();
                    }
                } else {
                    backToAdminMain();
                }
            } else {
                backToAdminMain();
            }
        } else {
            backToAdminMain();
        }
    } elseif (isset($_GET['faculty'])) {
        if (isset($_GET['section'])) {
            $sectionId = $_GET['section'];
            $facultyId = $_GET['faculty'];
            $checkSectionId = $admin_db->getSectionsId($sectionId);
            if ($checkSectionId->num_rows > 0) {
                $section = $checkSectionId->fetch_assoc();
                $getFaculty = $admin_db->getFaculty($facultyId);
                if ($getFaculty->num_rows > 0) {
                    $faculty = $getFaculty->fetch_assoc();
                    ?>
                    <!-- Faculty -->
                    <!-- End Page Title -->
                    <div class="pagetitle mt-3 d-flex justify-content-between">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>"><?= $section['SECTION_NAME'] ?></a></li>
                                <li class="breadcrumb-item"><?= $faculty['FACULTY_NAME'] ?></li>
                            </ol>
                        </nav>
                        <div>
                            <button class="btn btn-dark" id="btnAddFile" data-id="<?= $facultyId ?>">New File</button>
                            <button class="btn btn-dark" id="btnAddFileFolder" data-id="<?= $facultyId ?>">New Folder</button>
                        </div>
                    </div>
                    <!-- End Page Title -->

                    <div class="">
                        <table class="table">
                            <tr>
                                <th class="">Name</th>
                                <th class="">Date</th>
                                <th class="">Action</th>
                            </tr>
                            <?php
                            $getFilesFolder = $admin_db->getFilesFolderUsingFacultyId($facultyId);
                            while ($filesFolder = $getFilesFolder->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>
                                        <a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $faculty['ID'] ?>&folder=<?= $filesFolder['ID'] ?>" class="text-dark txt-folder-link">
                                            <i class="bi bi-files-alt"></i> <?= $filesFolder['FOLDER_NAME'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        $dateTimeString = $filesFolder['DATETIME'];
                                        $dateTime = new DateTime($dateTimeString);
                                        $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"

                                        echo $formattedDateTime;
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btnEditFileFolder" data-id="<?= $filesFolder['ID'] ?>" data-name="<?= $filesFolder['FOLDER_NAME'] ?>"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btnDeleteFileFolder" data-id="<?= $filesFolder['ID'] ?>"><i class="bi bi-trash"></i></button>
                                        <!-- <button class="btn btnDownloadFileFolder"><i class="bi bi-box-arrow-down"></i></button> -->
                                    </td>
                                </tr>
                            <?php
                            }

                            $getFiles = $admin_db->getFileUsingFolderId($facultyId);
                            while ($file = $getFiles->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>
                                        <a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $facultyId ?>&file=<?= $file['ID'] ?>" class="text-dark txt-folder-link">
                                            <i class="bi bi-file-earmark"></i> <?= $file['DISPLAY_FILE_NAME'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        $dateTimeString = $file['DATETIME'];
                                        $dateTime = new DateTime($dateTimeString);
                                        $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"

                                        echo $formattedDateTime;
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btnDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                                        <a class="btn" href="../../backend/filesFolder/<?= $file['FILE_NAME'] ?>" download><i class="bi bi-box-arrow-down"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }

                            if ($getFilesFolder->num_rows == 0 && $getFiles->num_rows == 0) {
                            ?>
                                <tr>
                                    <td colspan="3">
                                        <center>No File Found</center>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>

                    <!-- End of Faculty  -->
            <?php
                } else {
                    backToAdminMain();
                }
            } else {
                backToAdminMain();
            }
        } else {
            backToAdminMain();
        }
    } elseif (isset($_GET['section'])) {
        $sectionId = $_GET['section'];
        $result = $admin_db->getSectionsId($sectionId);
        if ($result->num_rows > 0) {
            $section = $result->fetch_assoc();
            ?>
            <!-- Section  -->

            <!-- End Page Title -->
            <div class="pagetitle mt-3 d-flex justify-content-between">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                        <li class="breadcrumb-item"><?= $section['SECTION_NAME'] ?></li>
                    </ol>
                </nav>
                <div>
                    <button class="btn btn-dark" id="btnAddFile" data-id="<?= $sectionId ?>">New File</button>
                    <button class="btn btn-dark" id="btnAddFacultyFolder" data-id="<?= $sectionId ?>">New Folder</button>
                </div>
            </div>
            <!-- End Page Title -->

            <div class="">
                <table class="table">
                    <tr>
                        <th class="">Name</th>
                        <th class="">Date</th>
                        <th class="">Action</th>
                    </tr>
                    <?php
                    $getFaculty = $admin_db->getFacultyUsingSectionId($sectionId);
                    while ($faculty = $getFaculty->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $faculty['ID'] ?>" class="text-dark txt-folder-link">
                                    <i class="bi bi-files-alt"></i> <?= $faculty['FACULTY_NAME'] ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                $dateTimeString = $faculty['DATETIME'];
                                $dateTime = new DateTime($dateTimeString);
                                $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"

                                echo $formattedDateTime;
                                ?>
                            </td>
                            <td>
                                <button class="btn btnEditFaculty" data-id="<?= $faculty['ID'] ?>" data-name="<?= $faculty['FACULTY_NAME'] ?>"><i class="bi bi-pencil"></i></button>
                                <button class="btn btnDeleteFaculty" data-id="<?= $faculty['ID'] ?>"><i class="bi bi-trash"></i></button>
                                <!-- <button class="btn btnDownloadFaculty"><i class="bi bi-box-arrow-down"></i></button> -->
                            </td>
                        </tr>
                    <?php
                    }

                    $getFiles = $admin_db->getFileUsingFolderId($sectionId);
                    while ($file = $getFiles->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <a href="admin.php?section=<?= $sectionId ?>&file=<?= $file['ID'] ?>" class="text-dark txt-folder-link">
                                    <i class="bi bi-file-earmark"></i> <?= $file['DISPLAY_FILE_NAME'] ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                $dateTimeString = $file['DATETIME'];
                                $dateTime = new DateTime($dateTimeString);
                                $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"

                                echo $formattedDateTime;
                                ?>
                            </td>
                            <td>
                                <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                <button class="btn btnDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                                <a class="btn" href="../../backend/filesFolder/<?= $file['FILE_NAME'] ?>" download><i class="bi bi-box-arrow-down"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    if ($getFaculty->num_rows == 0 && $getFiles->num_rows == 0) {
                    ?>
                        <tr>
                            <td colspan="3">
                                <center>No File Found</center>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <!-- End of Section  -->
        <?php
        } else {
            backToAdminMain();
        }
    } elseif (isset($_GET['page']) && $_GET['page'] == 'inbox') {
        ?>
        <div class="d-flex">
            <div class="message-sender-container card">
                <ul class="list-group">
                    <?php
                    $getUsers = $db->getFacultyUsers();
                    if ($getUsers->num_rows > 0) {
                        while ($user = $getUsers->fetch_assoc()) {
                    ?>
                            <li class="list-group-item <?= (isset($_GET['user']) && $_GET['user'] == $user['ID']) ? 'message-user-active-li' : '' ?>"><a href="admin.php?page=inbox&user=<?= $user['ID'] ?>" class="<?= (isset($_GET['user']) && $_GET['user'] == $user['ID']) ? 'message-user-active-a' : '' ?>"><?= $user['F_NAME'] . ' ' . $user['MI'] . ' ' . $user['L_NAME'] . ' ' . $user['SUFFIX'] ?></a>
                                <?=
                                ($user['SENT_INBOX'] > 0) ? '<span class="badge badge-light bg-danger" id="notificationCount">' . $user['SENT_INBOX'] . '</span>' : ''
                                ?>
                            </li>
                        <?php
                        }
                    } else {
                        ?>
                        <li class="list-group-item">No User Found</li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="card p-2 message-content-container">
                <div class="message-content-container-iside container" id="messageContainer">

                </div>
                <?php
                if (isset($_GET['user'])) {
                    $checkUser = $db->getUser($_GET['user']);
                    if ($checkUser->num_rows > 0) {
                        $db->readNotif('SENT_INBOX', $_GET['user'])
                ?>
                        <input type="hidden" id="adminId" value="<?= $_SESSION['user_id'] ?>">
                        <input type="hidden" id="userId" value="<?= $_GET['user'] ?>">
                        <script>
                            const getMessages = () => {
                                var userId = $("#userId").val();
                                console.log(userId);
                                $.ajax({
                                    type: "GET",
                                    url: "../../backend/endpoints/admin/get-request.php",
                                    data: {
                                        submitType: "getMessages",
                                        userId: userId,
                                    },
                                    success: function(response) {
                                        $("#messageContainer").html(response);
                                    },
                                });
                            }

                            setInterval(getMessages, 100);
                        </script>
                        <form class="container mt-2 d-flex" id="frmSendMessage">
                            <input type="text" id="txtSendMessage" class="form-control m-1" required>
                            <button type="submit" class="btn btn-dark m-1">Send</button>
                        </form>
                    <?php
                    }
                } else {
                    ?>
                    <center class="mt-3">
                        <h5> Please select user. </h5>
                    </center>
                <?php
                }
                ?>
            </div>
        <?php
    } elseif (isset($_GET['page']) && $_GET['page'] == 'ManageUsers') {
        ?>
            <div class="d-flex">
                <div class="message-sender-container card">
                    <ul class="list-group">
                        <?php
                        $getUsers = $db->getFacultyUsers();
                        if ($getUsers->num_rows > 0) {
                            while ($user = $getUsers->fetch_assoc()) {
                        ?>
                                <li class="list-group-item <?= (isset($_GET['user']) && $_GET['user'] == $user['ID']) ? 'message-user-active-li' : '' ?>"><a href="admin.php?page=ManageUsers&user=<?= $user['ID'] ?>" class="<?= (isset($_GET['user']) && $_GET['user'] == $user['ID']) ? 'message-user-active-a' : '' ?>"><?= $user['F_NAME'] . ' ' . $user['MI'] . ' ' . $user['L_NAME'] . ' ' . $user['SUFFIX']  ?></a></li>
                            <?php
                            }
                        } else {
                            ?>
                            <li class="list-group-item">No User Found</li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="edit-user-container container">
                    <?php
                    if (isset($_GET['user'])) {
                        $userId = $_GET['user'];
                        $checkUser = $db->getUser($userId);
                        if ($checkUser->num_rows > 0) {
                            $user = $checkUser->fetch_assoc();
                    ?>
                            <form id="frmEditUser">
                                <input type="hidden" name="submitType" value="EditUser">
                                <input type="hidden" name="userId" value="<?= $userId ?>">
                                <div class="mt-5 d-flex">
                                    <div class="container-fluid p-0">
                                        <label for="editFName">First Name:</label>
                                        <input type="text" class="form-control" id="editFName" name="editFName" value="<?= $user['F_NAME'] ?>">
                                    </div>
                                    <div class="container-fluid p-0" style="margin-left: 10px;">
                                        <label for="editLName">Last Name:</label>
                                        <input type="text" class="form-control" id="editLName" name="editLName" value="<?= $user['L_NAME'] ?>">
                                    </div>
                                    <div class="container-fluid p-0" style="margin-left: 10px; width: 100px;">
                                        <label for="editMI">MI:</label>
                                        <input type="text" class="form-control" id="editMI" name="editMI" value="<?= $user['MI'] ?>">
                                    </div>
                                    <div class="container-fluid p-0" style="margin-left: 10px; width: 150px;">
                                        <label for="editSuffix">Suffix:</label>
                                        <input type="text" class="form-control" id="editSuffix" name="editSuffix" value="<?= $user['SUFFIX'] ?>">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label for="editEmail">Email:</label>
                                    <input type="text" class="form-control" id="editEmail" name="editEmail" value="<?= $user['EMAIL'] ?>">
                                </div>
                                <div class="mt-3">
                                    <label for="editUsername">Username:</label>
                                    <input type="text" class="form-control" id="editUsername" name="editUsername" value="<?= $user['USERNAME'] ?>">
                                </div>
                                <div class="mt-3">
                                    <label for="editPassword">Password:</label>
                                    <div class="password-button-container">
                                        <input type="password" class="form-control" id="editPassword" name="editPassword" value="<?= $user['PASSWORD'] ?>">
                                        <button type="button" id="showPasswordFrmEdit" class="btn"><i class="bi bi-eye-slash-fill" id="btnShowPasswordIcon"></i></button>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="editFaculty">Faculty:</label>
                                    <select class="form-control" id="editFacultyId" name="editFacultyId">
                                        <?php
                                        $getSections = $admin_db->getSections();
                                        if ($getSections->num_rows > 0) {
                                            while ($section = $getSections->fetch_assoc()) {
                                        ?>
                                                <option value="<?= $section['ID'] ?>" <?= ($user['FACULTY_ID'] == $section['ID']) ? 'selected' : '' ?>><?= $section['SECTION_NAME'] ?></option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option disabled selected>No option found</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-dark">Save Changes</button>
                                </div>
                            </form>
                        <?php
                        } else {
                        ?>
                            <center class="mt-3">
                                <h5> Please select user. </h5>
                            </center>
                        <?php
                        }
                    } else {
                        ?>
                        <center class="mt-3">
                            <h5> Please select user. </h5>
                        </center>
                    <?php
                    }
                    ?>
                </div>
                <button class="btn btn-primary btn-add-new-user" id="btnOpenAddNewUserModal"><i class="bi bi-bookmark-plus"></i> Add New User</button>
            </div>
        <?php
    } elseif (isset($_GET['page']) && $_GET['page'] == 'RecycleBin') {
        ?>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Restore</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getDeletedFiles = $db->getDeletedFiles();
                        if ($getDeletedFiles->num_rows > 0) {
                            while ($deletedFile = $getDeletedFiles->fetch_assoc()) {
                                $dateTimeString = $deletedFile['DATETIME'];
                                $dateTime = new DateTime($dateTimeString);
                                $formattedDateTime = $dateTime->format('F j, Y g:i a');
                        ?>
                                <tr>
                                    <td><?= $deletedFile['DISPLAY_FILE_NAME'] ?></td>
                                    <td><?= $formattedDateTime ?></td>
                                    <td><button class="btn btn-dark btnRestoreFile" data-id="<?= $deletedFile['ID'] ?>"><i class="bi bi-arrow-clockwise"></i> Restore</button></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
    } elseif (isset($_GET['page']) && $_GET['page'] == 'addTask') {
        ?>
            <div class="d-flex">
                <div class="message-sender-container card">
                    <ul class="list-group">
                        <?php
                        $getUsers = $db->getFacultyUsers();
                        if ($getUsers->num_rows > 0) {
                            while ($user = $getUsers->fetch_assoc()) {
                        ?>
                                <li class="list-group-item <?= (isset($_GET['user']) && $_GET['user'] == $user['ID']) ? 'message-user-active-li' : '' ?>"><a href="admin.php?page=addTask&user=<?= $user['ID'] ?>" class="<?= (isset($_GET['user']) && $_GET['user'] == $user['ID']) ? 'message-user-active-a' : '' ?>"><?= $user['F_NAME'] . ' ' . $user['MI'] . ' ' . $user['L_NAME'] . ' ' . $user['SUFFIX'] ?></a>
                                    <?=
                                    ($user['SENT_NOTIF'] > 0) ? '<span class="badge badge-light bg-danger" id="notificationCount">' . $user['SENT_NOTIF'] . '</span>' : ''
                                    ?>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li class="list-group-item">No User Found</li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="container">
                    <button class="btn btn-dark" id="btnOpenAddTaskToAll"><i class="bi bi-bookmark-plus"></i> Add Task To All</button>
                    <?php
                    if (isset($_GET['user'])) {
                        $userId = $_GET['user'];
                        $checkUser = $db->getUser($userId);
                        if ($checkUser->num_rows > 0) {
                            $db->readNotif('SENT_NOTIF', $userId);
                    ?>
                            <button class="btn btn-primary btn-add-new-user" id="btnOpenAddTask" data-id="<?= $userId ?>"><i class="bi bi-bookmark-plus"></i> Add Task</button>
                            <div class="tasks-container container mt-2">
                                <?php
                                $getUserTasks = $db->getUserTasks($userId);
                                if ($getUserTasks->num_rows > 0) {
                                    while ($task = $getUserTasks->fetch_assoc()) {
                                        $dateTimeString = $task['TASK_DATETIME'];
                                        $dateTime = new DateTime($dateTimeString);
                                        $formattedDateTime = $dateTime->format('F j, Y g:i a');

                                        $resDateTimeString = $task['RESPONSE_DATETIME'];
                                        $resDateTime = new DateTime($resDateTimeString);
                                        $resFormattedDateTime = $resDateTime->format('F j, Y g:i a');
                                ?>
                                        <div class="container card mt-3 p-3">
                                            <div class="container">
                                                <div class="d-flex justify-content-between">
                                                    <h5>Task</h5>
                                                    <p><?= $formattedDateTime ?></p>
                                                </div>
                                                <div class="task-message">
                                                    <input type="text" readonly value="<?= $task['TASK_MESSAGE']; ?>" class="form-control">
                                                </div>
                                                <div class="task-message mt-3">
                                                    <p><i class="bi bi-file-earmark-fill"></i> <?= $task['TASK_DISPLAY_FILE_NAME']; ?></p>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="container">
                                                <div class="d-flex justify-content-between">
                                                    <h5>Response</h5>
                                                    <p><?= ($resDateTimeString != '0000-00-00 00:00:00') ? $resFormattedDateTime : '' ?></p>
                                                </div>
                                                <div class="">
                                                    <p>Comment: <?= ($task['RESPONSE_COMMENT'] != '') ? $task['RESPONSE_COMMENT'] : 'Waiting...' ?></p>
                                                    <p>File:
                                                        <?php
                                                        if ($task['RESPONSE_COMMENT'] != '') {
                                                        ?>
                                                            <a href="../../backend/TaskResponse/<?= $task['RESPONSE_FILE_NAME'] ?>" class="text-dark txt-folder-link" download>
                                                                <i class="bi bi-paperclip"></i> <?= $task['RESPONSE_DISPLAY_FILE_NAME'] ?>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <center class="mt-3">
                                        <h5> No task found. </h5>
                                    </center>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <center class="mt-3">
                                <h5> Please select user. </h5>
                            </center>
                        <?php
                        }
                    } else {
                        ?>
                        <center class="mt-3">
                            <h5> Please select user. </h5>
                        </center>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        } elseif (isset($_GET['page']) && $_GET['page'] == 'Search') {
            if (isset($_GET['fileSearch'])) {
                $fileId = $_GET['fileSearch'];
                $getFile = $admin_db->getFile($fileId);
                if ($getFile->num_rows > 0) {
                    $file = $getFile->fetch_assoc();
                    $dateTimeString = $file['DATETIME'];
                    $dateTime = new DateTime($dateTimeString);
                    $formattedDateTime = $dateTime->format('F j, Y g:i a');
            ?>
                    <!-- File -->
                    <!-- End Page Title -->
                    <div class="pagetitle mt-3 d-flex justify-content-between">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                                <li class="breadcrumb-item">Your search</li>
                            </ol>
                        </nav>
                        <!-- <button class="btn btn-dark" id="btnAddFile" data-id="<?= $folderId ?>">New File</button> -->
                    </div>
                    <!-- End Page Title -->
                    <div class="">
                        <div class="container file-main-container p-3 pt-5 pb-5 card">
                            <div class="d-flex justify-content-between">
                                <h4 class="hightlight-color"><i class="bi bi-file-earmark-fill"></i><?= $file['DISPLAY_FILE_NAME'] ?></h4>
                                <div>
                                    <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btnDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                                    <a class="btn" href="../../backend/filesFolder/<?= $file['FILE_NAME'] ?>" download><i class="bi bi-box-arrow-down"></i></a>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h6 class="hightlight-color">Notes:</h6>
                                <textarea class="form-control" readonly><?= $file['NOTES'] ?></textarea>
                            </div>
                            <div class="mt-3">
                                <h6 class="hightlight-color">Tags:</h6>
                                <textarea class="form-control" readonly><?= $file['TAGS'] ?></textarea>
                            </div>

                            <div class="d-flex mt-3">
                                <div class="">
                                    <h6 class="hightlight-color">Document ID</h6>
                                    <input type="text" class="form-control" value="<?= $file['ID'] ?>">
                                </div>
                                <div class="file-date-container">
                                    <h6 class="hightlight-color">Date</h6>
                                    <input type="text" class="form-control" value="<?= $formattedDateTime ?>">
                                </div>
                            </div>

                            <hr class="mt-5">

                            <div class="mt-4">
                                <h6 class="hightlight-color">Shared To</h6>
                                <ul class="list-group">
                                    <?php
                                    $getSharedFiles = $admin_db->getSharedFilesJoinUsers($fileId);
                                    if ($getSharedFiles->num_rows > 0) {
                                        while ($sharedFile = $getSharedFiles->fetch_assoc()) {
                                    ?>
                                            <li class="list-group-item"><?= $sharedFile['NAME'] ?></li>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <li class="list-group-item">You don't share this files to anyone.</li>
                                    <?php
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <h6>Share This File: </h6>
                                        <div class="d-flex">
                                            <input type="hidden" id="hiddenFileId" value="<?= $fileId ?>">
                                            <select id="sharedFileTo" class="form-control m-1">
                                                <option value=""></option>
                                                <?php
                                                $getFaculty = $db->getFacultyUsers();
                                                if ($getFaculty->num_rows > 0) {
                                                    while ($facultyPerson = $getFaculty->fetch_assoc()) {
                                                        $facultyPersonId = $facultyPerson['ID'];
                                                        $checkSharedFiled = $admin_db->checkSharedFiled($facultyPersonId, $fileId);
                                                        echo ($checkSharedFiled->num_rows > 0) ? '' : '<option value="' . $facultyPerson['ID'] . '">' . $facultyPerson['NAME'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <button type="button" class="btn btn-dark m-1" id="btnShareFile">Share</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <hr class="mt-5">

                            <div class="mt-4">
                                <h6 class="hightlight-color">Audit Log</h6>
                                <table class="table">
                                    <tr>
                                        <th>Time</th>
                                        <th>User</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        $getAuditLog = $admin_db->getAuditLog($fileId);
                                        if ($getAuditLog->num_rows > 0) {
                                            while ($audit = $getAuditLog->fetch_assoc()) {
                                        ?>
                                    <tr>
                                        <td><?= $audit['DATE_TIME'] ?></td>
                                        <td><?= $audit['USER_ID'] ?></td>
                                        <td><?= $audit['ACTION'] ?></td>
                                    </tr>
                                <?php
                                            }
                                        } else {
                                ?>
                                <tr>
                                    <td colspan="3">
                                        <center>No Audit Yet</center>
                                    </td>
                                </tr>
                            <?php
                                        }
                            ?>
                            </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End of File -->
        <?php
                } else {
                    backToAdminMain();
                }
            } else {
                backToAdminMain();
            }
        }
        ?>
</main>
<?php
include('../components/footer.php');
