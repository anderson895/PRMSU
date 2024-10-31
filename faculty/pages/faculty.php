<?php
include('../components/header.php');
?>
<main class="main-container container bg-light">
    <?php
    if (isset($_GET['page'])) {
    ?>
        <input type="hidden" id="userId" value="<?= $user_id ?>">
        <?php
        if ($_GET['page'] == 'inbox') {
            $db->readNotif('INBOX', $user_id);
        ?>
            <div class="container message-content-container">
                <div class="message-content-container-iside container" id="messageContainer">

                </div>
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
            </div>
            <?php
        } elseif ($_GET['page'] == 'SharedFiles') {
            if (isset($_GET['file'])) {
                $checkFile = $admin_db->getFile($_GET['file']);
                if ($checkFile->num_rows > 0) {
                    $file = $checkFile->fetch_assoc();
                    $dateTimeString = $file['DATETIME'];
                    $dateTime = new DateTime($dateTimeString);
                    $formattedDateTime = $dateTime->format('F j, Y g:i a');
            ?>
                    <!-- End Page Title -->
                    <div class="pagetitle mt-3 d-flex justify-content-between">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="faculty.php?page=SharedFiles">Shared Files</a></li>
                                <li class="breadcrumb-item"><?= $file['DISPLAY_FILE_NAME'] ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End Page Title -->
                    <div class="">
                        <div class="container file-main-container p-3 pt-5 pb-5 card">
                            <div class="d-flex justify-content-between">
                                <h4 class="hightlight-color"><i class="bi bi-file-earmark-fill"></i><?= $file['DISPLAY_FILE_NAME'] ?></h4>
                                <div>
                                    <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
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
                        </div>
                    </div>
                <?php
                } else {
                    header('Location: faculty.php?page=SharedFiles');
                }
            } else {
                ?>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="">Name</th>
                                <th class="">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getSharedFiles = $admin_db->getSharedFiles($user_id);
                            if ($getSharedFiles->num_rows > 0) {
                                while ($file = $getSharedFiles->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><i class="bi bi-file-earmark"></i> <a href="faculty.php?page=SharedFiles&file=<?= $file['ID'] ?>" class="text-dark txt-folder-link"><?= $file['DISPLAY_FILE_NAME'] ?></a></td>
                                        <td><?= $file['DATETIME'] ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">
                                        <center>No shared files.</center>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
        } elseif ($_GET['page'] == 'ManageAccount') {
            ?>
            <div class="edit-user-container container">
                <?php
                $checkUser = $db->getUser($user_id);
                if ($checkUser->num_rows > 0) {
                    $user = $checkUser->fetch_assoc();
                ?>
                    <form id="frmEditUser">
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
                ?>
            </div>
            <?php
        } elseif ($_GET['page'] == 'folders') {
            if (isset($_GET['folder'])) {
                $folderId = $_GET['folder'];
                $getFacultyFolders = $db->getFacultyFolderUsingFolderId($folderId);
                if ($getFacultyFolders->num_rows > 0) {
                    $folder = $getFacultyFolders->fetch_assoc();
                    if (isset($_GET['file'])) {
                        $getFile = $db->getFilesUsingFileId($_GET['file']);
                        if ($getFile->num_rows > 0) {
                            $file = $getFile->fetch_assoc();
                            $dateTimeString = $file['DATETIME'];
                            $dateTime = new DateTime($dateTimeString);
                            $formattedDateTime = $dateTime->format('F j, Y g:i a');
            ?>
                            <div class="pagetitle mt-3 d-flex justify-content-between">
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="faculty.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="faculty.php?page=folders">Folders</a></li>
                                        <li class="breadcrumb-item"><a href="faculty.php?page=folders&folder=<?= $folderId ?>"><?= $folder['FOLDER_NAME'] ?></a></li>
                                        <li class="breadcrumb-item"><?= $file['DISPLAY_FILE_NAME'] ?></li>
                                    </ol>
                                </nav>
                                <!-- <button class="btn btn-dark" id="btnAddFile" data-id="<?= $folderId ?>">New File</button> -->
                                <input type="hidden" id="currentFolderId" value="<?= $folderId ?>">
                            </div>
                            <div class="">
                                <div class="container file-main-container p-3 pt-5 pb-5 card">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="hightlight-color"><i class="bi bi-file-earmark-fill"></i><?= $file['DISPLAY_FILE_NAME'] ?></h4>
                                        <div>
                                            <button class="btn btnFacultyEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btnFacultyDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
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
                                </div>
                            </div>
                        <?php
                        } else {
                            backToAdminMain();
                        }
                    } else {
                        ?>
                        <!-- End Page Title -->
                        <div class="pagetitle mt-3 d-flex justify-content-between">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="faculty.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="faculty.php?page=folders">Folders</a></li>
                                    <li class="breadcrumb-item"><?= $folder['FOLDER_NAME'] ?></li>
                                </ol>
                            </nav>
                            <button class="btn btn-dark" id="btnAddFile" data-id="<?= $folderId ?>">New File</button>
                            <input type="hidden" id="currentFolderId" value="<?= $folderId ?>">
                        </div>
                        <!-- End Page Title -->
                        <div class="">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                $checkFiles = $db->getFilesUsingFolderId($folderId);
                                if ($checkFiles->num_rows > 0) {
                                    while ($file = $checkFiles->fetch_assoc()) {
                                        $dateTimeString = $folder['DATETIME'];
                                        $dateTime = new DateTime($dateTimeString);
                                        $formattedDateTime = $dateTime->format('F j, Y g:i a');
                                ?>
                                        <tr>
                                            <td><i class="bi bi-file-earmark"></i> <a href="faculty.php?page=folders&folder=<?= $folderId ?>&file=<?= $file['ID'] ?>" class="text-dark txt-folder-link"><?= $file['DISPLAY_FILE_NAME'] ?></a></td>
                                            <td><?= $formattedDateTime ?></td>
                                            <td>
                                                <button class="btn btnFacultyEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btnFacultyDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                                                <a class="btn" href="../../backend/filesFolder/<?= $file['FILE_NAME'] ?>" download><i class="bi bi-box-arrow-down"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">
                                            <center>No File Found.</center>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    <?php
                    }
                } else {
                    backToAdminMain();
                }
            } else {
                if (isset($_GET['file'])) {
                    $getFile = $db->getFilesUsingFileId($_GET['file']);
                    if ($getFile->num_rows > 0) {
                        $file = $getFile->fetch_assoc();
                        $dateTimeString = $file['DATETIME'];
                        $dateTime = new DateTime($dateTimeString);
                        $formattedDateTime = $dateTime->format('F j, Y g:i a');

                    ?>
                        <div class="pagetitle mt-3 d-flex justify-content-between">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="faculty.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="faculty.php?page=folders">Folders</a></li>
                                    <li class="breadcrumb-item"><?= $file['DISPLAY_FILE_NAME'] ?></li>
                                </ol>
                            </nav>
                            <!-- <button class="btn btn-dark" id="btnAddFile" data-id="<?= $folderId ?>">New File</button> -->
                            <input type="hidden" id="currentFolderId" value="<?= $folderId ?>">
                        </div>
                        <div class="">
                            <div class="container file-main-container p-3 pt-5 pb-5 card">
                                <div class="d-flex justify-content-between">
                                    <h4 class="hightlight-color"><i class="bi bi-file-earmark-fill"></i><?= $file['DISPLAY_FILE_NAME'] ?></h4>
                                    <div>
                                        <button class="btn btnFacultyEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btnFacultyDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
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
                            </div>
                        </div>
                    <?php
                    } else {
                        backToAdminMain();
                    }
                } else {
                    ?>
                    <!-- End Page Title -->
                    <div class="pagetitle mt-3 d-flex justify-content-between">
                        <nav>
                            <ol class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="Faculty.php">Home</a></li> -->
                            </ol>
                        </nav>
                        <div>
                            <button class="btn btn-dark" id="btnAddFileOne" data-id="<?= $user_id ?>">New File</button>
                            <button class="btn btn-dark" id="btnAddFolder" data-id="<?= $folderId ?>">New Folder</button>
                        </div>
                    </div>
                    <!-- End Page Title -->
                    <div class="">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $getFacultyFolders = $db->getFolders($user_id);
                            while ($folder = $getFacultyFolders->fetch_assoc()) {
                                $dateTimeString = $folder['DATETIME'];
                                $dateTime = new DateTime($dateTimeString);
                                $formattedDateTime = $dateTime->format('F j, Y g:i a');
                            ?>
                                <tr>
                                    <td><i class="bi bi-files-alt"></i> <a href="faculty.php?page=folders&folder=<?= $folder['ID'] ?>" class="text-dark txt-folder-link"><?= $folder['FOLDER_NAME'] ?></a></td>
                                    <td><?= $formattedDateTime ?></td>
                                    <td>
                                        <button class="btn btnEditFolder" data-id="<?= $folder['ID'] ?>" data-name="<?= $folder['FOLDER_NAME'] ?>"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btnDeleteFolder" data-id="<?= $folder['ID'] ?>"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            <?php
                            }


                            $checkFiles = $db->getFilesUsingFolderId($user_id);
                            while ($file = $checkFiles->fetch_assoc()) {
                                $dateTimeString = $file['DATETIME'];
                                $dateTime = new DateTime($dateTimeString);
                                $formattedDateTime = $dateTime->format('F j, Y g:i a');
                            ?>
                                <tr>
                                    <td><i class="bi bi-file-earmark"></i> <a href="faculty.php?page=folders&file=<?= $file['ID'] ?>" class="text-dark txt-folder-link"><?= $file['DISPLAY_FILE_NAME'] ?></a></td>
                                    <td><?= $formattedDateTime ?></td>
                                    <td>
                                        <button class="btn btnFacultyEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btnFacultyDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                                        <a class="btn" href="../../backend/filesFolder/<?= $file['FILE_NAME'] ?>" download><i class="bi bi-box-arrow-down"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
            <?php
                }
            }
        } elseif ($_GET['page'] == 'RecycleBin') {
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
                        $getDeletedFiles = $db->facultyGetDeletedFiles();
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
        } elseif ($_GET['page'] == 'Search') {
            if (isset($_GET['file'])) {
                $fileId = $_GET['file'];
                $getFile = $db->getFilesUsingFileId($fileId);
                if ($getFile->num_rows > 0) {
                    $file = $getFile->fetch_assoc();
                    $dateTimeString = $file['DATETIME'];
                    $dateTime = new DateTime($dateTimeString);
                    $formattedDateTime = $dateTime->format('F j, Y g:i a');
            ?>
                    <!-- End Page Title -->
                    <div class="pagetitle mt-3 d-flex justify-content-between">
                        <nav>
                            <ol class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="faculty.php?page=SharedFiles">Shared Files</a></li> -->
                                <li class="breadcrumb-item">
                                    <h6>Your search</h6>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End Page Title -->
                    <div class="">
                        <div class="container file-main-container p-3 pt-5 pb-5 card">
                            <div class="d-flex justify-content-between">
                                <h4 class="hightlight-color"><i class="bi bi-file-earmark-fill"></i><?= $file['DISPLAY_FILE_NAME'] ?></h4>
                                <div>
                                    <button class="btn btnFacultyEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
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
                        </div>
                    </div>
            <?php
                } else {
                    backToAdminMain();
                }
            } else {
                backToAdminMain();
            }
        } elseif ($_GET['page'] == 'notification') {
            $db->readNotif('NOTIF', $user_id);
            ?>
            <div class="tasks-container">
                <?php
                $getTasks = $db->getUserTasks($user_id);
                if ($getTasks->num_rows > 0) {
                    while ($task = $getTasks->fetch_assoc()) {
                        $dateTimeString = $task['TASK_DATETIME'];
                        $dateTime = new DateTime($dateTimeString);
                        $formattedDateTime = $dateTime->format('F j, Y g:i a');

                        $resDateTimeString = $task['RESPONSE_DATETIME'];
                        $resDateTime = new DateTime($resDateTimeString);
                        $resFormattedDateTime = $resDateTime->format('F j, Y g:i a');
                ?>
                        <div class="card container p-3 mt-3">
                            <div class="d-flex justify-content-between">
                                <h6>Your Task</h6>
                                <p><?= $formattedDateTime ?></p>
                            </div>
                            <h5><?= $task['TASK_MESSAGE'] ?></h5>
                            <a href="../../backend/TaskFiles/<?= $task['TASK_FILE_NAME'] ?>" class="text-dark txt-folder-link" download="">
                                <i class="bi bi-paperclip"></i>
                                <?= $task['TASK_DISPLAY_FILE_NAME'] ?>
                            </a>
                            <hr>
                            <div>
                                <?php
                                if ($task['RESPONSE_COMMENT'] == '' && $task['RESPONSE_FILE_NAME'] == '') {
                                ?>
                                    <div class="container">
                                        <h6>Upload Response</h6>
                                        <form id="frmTaskResponse">
                                            <input type="hidden" name="submitType" value="FacultyAddTaskResponse">
                                            <input type="hidden" name="taskId" value="<?= $task['ID'] ?>">
                                            <input type="text" class="form-control" name="comment" placeholder="Add Comment Here..." required>
                                            <input type="file" class="form-control mt-2" name="responseFile" required>
                                            <button type="submit" class="btn btn-dark mt-2">Submit</button>
                                        </form>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="d-flex justify-content-between">
                                        <h6>Your Response</h6>
                                        <p><?= ($resDateTimeString != '0000-00-00 00:00:00') ? $resFormattedDateTime : '' ?></p>
                                    </div>
                                    <div class="">
                                        <p>Comment: <?= ($task['RESPONSE_COMMENT'] != '') ? $task['RESPONSE_COMMENT'] : 'Waiting...' ?></p>
                                        <a>File: <?= ($task['RESPONSE_COMMENT'] != '') ? $task['RESPONSE_FILE_NAME'] : 'No File Found.' ?></a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <center>No Task Found.</center>
                <?php
                }
                ?>
            </div>
    <?php
        }
    }
    ?>
</main>
<?php
include('../components/footer.php');
