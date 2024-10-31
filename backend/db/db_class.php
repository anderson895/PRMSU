<?php
include('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function sendMessage($senderId, $userId, $message)
    {
        $dateTime = $this->dateTime();
        $query = $this->conn->prepare("INSERT INTO `message`(`SENDER_ID`, `RECEIVER_ID`, `MESSAGE`, `DATE_TIME`) VALUES (?, ?, ?, ?)");
        $query->bind_param('ssss', $senderId, $userId, $message, $dateTime);
        $addNotif = $this->conn->prepare("UPDATE `users` SET `INBOX`= `INBOX` + 1 WHERE `ID` = '$userId'");

        if ($query->execute() && $addNotif->execute()) {
            return 200;
        }
    }

    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function dateTime()
    {
        $timezone = new DateTimeZone('Asia/Manila');
        $dateTime = new DateTime('now', $timezone);
        return $dateTime->format('Y-m-d H:i:s');
    }

    public function login($username, $password, $userType)
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password' AND `USER_TYPE` = '$userType'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getUser($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFacultyUsers()
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `USER_TYPE` = 'faculty' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function editUser($userId, $fname, $lname, $mi, $suffix, $email, $username, $password, $faculty)
    {
        $query = $this->conn->prepare("UPDATE `users` SET `F_NAME`='$fname',`L_NAME`='$lname',`MI`='$mi',`SUFFIX`='$suffix' ,`EMAIL`='$email',`USERNAME`='$username',`PASSWORD` = '$password',`FACULTY_ID`='$faculty' WHERE `ID` = '$userId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function facultyEditAccount($post)
    {
        $userId = $post['userId'];

        $fname = $post['fname'];
        $lname = $post['lname'];
        $mi = $post['mi'];
        $suffix = $post['suffix'];

        $email = $post['email'];
        $username = $post['username'];
        $password = $post['password'];

        $query = $this->conn->prepare("UPDATE `users` SET `F_NAME`='$fname',`L_NAME`='$lname',`MI`='$mi',`SUFFIX`='$suffix' ,`EMAIL`='$email',`USERNAME`='$username',`PASSWORD` = '$password' WHERE `ID` = '$userId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getDeletedFiles()
    {
        $query = $this->conn->prepare("SELECT * FROM `files` WHERE `STATUS` = 'deleted'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function restoreFile($fileId)
    {
        $query = $this->conn->prepare("UPDATE `files` SET `STATUS`='active' WHERE `ID` = '$fileId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Audit
    public function insertAudit($userId, $fileId)
    {
        $dateTime = $this->dateTime();
        $query = $this->conn->prepare("INSERT INTO `audit_log`(`USER_ID`, `FILE_ID`, `DATE_TIME`, `ACTION`) VALUES (?, ?, ?, 'Edit file')");

        $query->bind_param("sss", $userId, $fileId, $dateTime);

        if ($query->execute()) {
            return 200;
        }
    }

    public function getFolders($userId)
    {
        $query = $this->conn->prepare("SELECT * FROM `user_faculty_folder` WHERE `USER_ID` = '$userId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFacultyFolderUsingFolderId($folderId)
    {
        $query = $this->conn->prepare("SELECT * FROM `user_faculty_folder` WHERE `ID` = '$folderId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function facultyAddNewFolder($userId, $folderName)
    {
        $dateTime = $this->dateTime();
        $query = $this->conn->prepare("INSERT INTO `user_faculty_folder`(`USER_ID`, `FOLDER_NAME`, `DATETIME`, `STATUS`) VALUES ('$userId','$folderName','$dateTime','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function facultyDeleteFolder($folderId)
    {
        $query = $this->conn->prepare("UPDATE `user_faculty_folder` SET `STATUS`='deleted' WHERE `ID` = '$folderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function facultyEditFolder($folderId, $name)
    {
        $query = $this->conn->prepare("UPDATE `user_faculty_folder` SET `FOLDER_NAME`='$name' WHERE `ID` = '$folderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getFilesUsingFolderId($folderId)
    {
        $query = $this->conn->prepare("SELECT * FROM `user_faculty_files` WHERE `FOLDER_ID` = '$folderId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFilesUsingFileId($fileId)
    {
        $query = $this->conn->prepare("SELECT * FROM `user_faculty_files` WHERE `ID` = '$fileId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFilesUsingFileName($fileName)
    {
        $query = $this->conn->prepare("SELECT * FROM `user_faculty_files` WHERE `FILE_NAME` = '$fileName'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFilesUsingDisplayFileNameSearch($fileName)
    {
        $query = $this->conn->prepare("SELECT * FROM `user_faculty_files` WHERE `DISPLAY_FILE_NAME` LIKE '%$fileName%'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function facultyAddNewFile($post, $file)
    {
        $folderId = $post['folderId'];
        $notes = $post['notes'];
        $tags = $post['tags'];

        $dateTime = $this->dateTime();

        do {
            $fileId = 'FILE_' . str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkFileId = $this->getFilesUsingFileId($fileId);
        } while ($checkFileId->num_rows > 0);

        do {
            $fileName = 'prmsu_' . $this->generateRandomString(12);
            $checkFileName = $this->getFilesUsingFileName($fileName);
        } while ($checkFileName->num_rows > 0);

        if (!empty($_FILES['file']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/../filesFolder/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $query = $this->conn->prepare("INSERT INTO `user_faculty_files`(`ID`, `FOLDER_ID`, `FILE_NAME`, `DISPLAY_FILE_NAME`, `NOTES`, `TAGS`, `DATETIME`, `STATUS`) 
                                                                            VALUES ('$fileId','$folderId','$newFileName','$file_name','$notes','$tags','$dateTime','active')");
                    if ($query->execute()) {
                        return 200;
                    }
                } else {
                    // return 'Uploading file unsuccessfull';
                    return $destination;
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }

    public function facultyDeleteFile($fileId)
    {
        $query = $this->conn->prepare("UPDATE `user_faculty_files` SET `STATUS`='deleted' WHERE `ID` = '$fileId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function facultyEditFile($post)
    {
        $dateTime = $this->dateTime();
        $fileName = $post['name'];
        $notes = $post['notes'];
        $tags = $post['tags'];
        $fileId = $post['fileId'];
        $query = $this->conn->prepare("UPDATE `user_faculty_files` SET `DISPLAY_FILE_NAME`='$fileName',`NOTES`='$notes',`TAGS`='$tags',`DATETIME`='$dateTime' WHERE `ID` = '$fileId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function facultyGetDeletedFiles()
    {
        $query = $this->conn->prepare("SELECT * FROM `user_faculty_files` WHERE `STATUS` = 'deleted'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function facultyRestoreFile($id)
    {
        $query = $this->conn->prepare("UPDATE `user_faculty_files` SET `STATUS`='active' WHERE `ID` = '$id'");
        if ($query->execute()) {
            return 200;
        }
    }


    // Tasks
    public function getUserTasks($userId)
    {
        $query = $this->conn->prepare("SELECT * FROM `tasks` WHERE `FOR_USER_ID` = '$userId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function checkFileName($fileName)
    {
        $query = $this->conn->prepare("SELECT * FROM `tasks` WHERE `RESPONSE_FILE_NAME` = '$fileName'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function checkTask($taskId)
    {
        $query = $this->conn->prepare("SELECT * FROM `tasks` WHERE `ID` = '$taskId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function submitResponse($post, $file)
    {

        $taskId = $post['taskId'];
        $comment = $post['comment'];

        $dateTime = $this->dateTime();

        // $task = $this->checkTask($taskId);
        // if ($task->num_rows > 0) {
        //     $taskResult = $task->fetch_assoc();
        //     $userId = $taskResult['FOR_USER_ID'];
        // }

        do {
            $fileName = 'prmsu_' . $this->generateRandomString(12);
            $checkFileName = $this->checkFileName($fileName);
        } while ($checkFileName->num_rows > 0);

        if (!empty($_FILES['responseFile']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/../TaskResponse/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $query = $this->conn->prepare("UPDATE `tasks` SET `RESPONSE_COMMENT`='$comment',`RESPONSE_FILE_NAME`='$newFileName',`RESPONSE_DISPLAY_FILE_NAME`='$file_name',`RESPONSE_DATETIME`='$dateTime' WHERE `ID` = '$taskId'");
                    if ($query->execute()) {
                        // send message
                        $getTask = $this->checkTask($taskId);
                        if ($getTask->num_rows > 0) {
                            $task = $getTask->fetch_assoc();
                            $userId = $task['FOR_USER_ID'];
                            $sentNotif = $this->conn->prepare("UPDATE `users` SET `SENT_NOTIF`= `SENT_NOTIF` + 1 WHERE `ID` = '$userId'");
                            $this->sendMessage($userId, 'ADMIN_1', 'Sent an attachment in tasks.');
                            $sentNotif->execute();
                        }
                        return 200;
                    }
                } else {
                    // return 'Uploading file unsuccessfull';
                    return $destination;
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }

    // Turn Notif Or Message To 0
    public function readNotif($column, $userId)
    {
        $query = $this->conn->prepare("UPDATE `users` SET `$column`='0' WHERE `ID` = '$userId'");
        if ($query->execute()) {
            return 200;
        }
    }
}


class admin_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function getFacultyUsers()
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `USER_TYPE` = 'faculty' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function dateTime()
    {
        $timezone = new DateTimeZone('Asia/Manila');
        $dateTime = new DateTime('now', $timezone);
        return $dateTime->format('Y-m-d H:i:s');
    }

    // Section
    public function getSections()
    {
        $query = $this->conn->prepare("SELECT * FROM `section` WHERE `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getSectionsId($sectionId)
    {
        $query = $this->conn->prepare("SELECT * FROM `section` WHERE `ID` = '$sectionId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewSection($sectionName)
    {
        do {
            $sectionId = 'SECTION_' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkSectionId = $this->conn->prepare("SELECT * FROM `section` WHERE `ID` = ?");
            $checkSectionId->bind_param('s', $sectionId);
        } while ($checkSectionId->execute() && $checkSectionId->get_result()->num_rows > 0);

        $query = $this->conn->prepare("INSERT INTO `section`(`ID`, `SECTION_NAME`, `STATUS`) VALUES ('$sectionId','$sectionName','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteSection($sectionId)
    {
        $query = $this->conn->prepare("UPDATE `section` SET `STATUS`='deleted' WHERE `ID` = '$sectionId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function renameSection($sectionId, $sectionName)
    {
        $query = $this->conn->prepare("UPDATE `section` SET `SECTION_NAME`='$sectionName' WHERE `ID` = '$sectionId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Faculty ---------------------------------
    public function getFaculty($facultyId)
    {
        $query = $this->conn->prepare("SELECT * FROM `faculty_folder` WHERE `ID` = '$facultyId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFacultyUsingSectionId($sectionId)
    {
        $query = $this->conn->prepare("SELECT * FROM `faculty_folder` WHERE `SECTION_ID` = '$sectionId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewFaculty($facultyName, $sectionId)
    {
        $dateTime = $this->dateTime();
        do {
            $facultyId = 'FAC_' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkFacultyId = $this->getFaculty($facultyId);
        } while ($checkFacultyId->num_rows > 0);

        $query = $this->conn->prepare("INSERT INTO `faculty_folder`(`ID`, `SECTION_ID`, `FACULTY_NAME`, `DATETIME`, `STATUS`) VALUES ('$facultyId','$sectionId','$facultyName','$dateTime','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteFaculty($facultyId)
    {
        $query = $this->conn->prepare("UPDATE `faculty_folder` SET `STATUS`='deleted' WHERE `ID` = '$facultyId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function renameFaculty($facultyId, $facultyName)
    {
        $query = $this->conn->prepare("UPDATE `faculty_folder` SET `FACULTY_NAME`='$facultyName' WHERE `ID` = '$facultyId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Files Folder ----------------------------------

    public function getFilesFolderUsingFacultyId($facultyId)
    {
        $query = $this->conn->prepare("SELECT * FROM `files_folder` WHERE `FACULTY_ID` = '$facultyId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFileFolder($folderId)
    {
        $query = $this->conn->prepare("SELECT * FROM `files_folder` WHERE `ID` = '$folderId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addFileFolder($folderName, $facultyId)
    {
        $dateTime = $this->dateTime();
        do {
            $folderId = 'FF_' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkFolderId = $this->getFileFolder($folderId);
        } while ($checkFolderId->num_rows > 0);

        $query = $this->conn->prepare("INSERT INTO `files_folder`(`ID`, `FACULTY_ID`, `FOLDER_NAME`, `DATETIME`, `STATUS`) VALUES ('$folderId','$facultyId','$folderName','$dateTime','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function renameFileFolder($folderId, $folderName)
    {
        $query = $this->conn->prepare("UPDATE `files_folder` SET `FOLDER_NAME`='$folderName' WHERE `ID` = '$folderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteFileFolder($folderId)
    {
        $query = $this->conn->prepare("UPDATE `files_folder` SET `STATUS`='deleted' WHERE `ID` = '$folderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Files  ----------------------------------

    public function getFileUsingFolderId($folderId)
    {
        $query = $this->conn->prepare("SELECT * FROM `files` WHERE `FOLDER_ID` = '$folderId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFile($fileId)
    {
        $query = $this->conn->prepare("SELECT * FROM `files` WHERE `ID` = '$fileId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFileName($fileName)
    {
        $query = $this->conn->prepare("SELECT * FROM `files` WHERE `FILE_NAME` = '$fileName'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewFile($post, $file)
    {
        $folderId = $post['folderId'];
        $notes = $post['notes'];
        $tags = $post['tags'];

        $dateTime = $this->dateTime();

        do {
            $fileId = 'FILE_' . str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkFileId = $this->getFile($fileId);
        } while ($checkFileId->num_rows > 0);

        do {
            $fileName = 'prmsu_' . $this->generateRandomString(12);
            $checkFileName = $this->getFileName($fileName);
        } while ($checkFileName->num_rows > 0);

        if (!empty($_FILES['file']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/../filesFolder/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $query = $this->conn->prepare("INSERT INTO `files`(`ID`, `FOLDER_ID`, `FILE_NAME`, `DISPLAY_FILE_NAME`, `NOTES`, `TAGS`, `DATETIME`, `STATUS`) VALUES ('$fileId','$folderId','$newFileName','$file_name','$notes','$tags','$dateTime','active')");
                    if ($query->execute()) {
                        return 200;
                    }
                } else {
                    // return 'Uploading file unsuccessfull';
                    return $destination;
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }

    public function editFile($fileId, $fileName, $tags, $notes)
    {
        $query = $this->conn->prepare("UPDATE `files` SET `DISPLAY_FILE_NAME`='$fileName',`NOTES`='$notes',`TAGS`='$tags' WHERE `ID` = '$fileId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteFile($fileId)
    {
        $query = $this->conn->prepare("UPDATE `files` SET `STATUS`='deleted' WHERE `ID` = '$fileId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Shares Files
    public function checkSharedFiled($facultyPersonId, $fileId)
    {
        $query = $this->conn->prepare("SELECT * FROM `shared_files` WHERE `USER_ID` = '$facultyPersonId' AND `FILE_ID` = '$fileId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getSharedFilesJoinUsers($fileId)
    {
        $query = $this->conn->prepare("SELECT u.* FROM `shared_files` as sf JOIN users as u ON sf.USER_ID = u.ID WHERE sf.FILE_ID = '$fileId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function shareFile($fileId, $userId)
    {
        $query = $this->conn->prepare("INSERT INTO `shared_files`(`USER_ID`, `FILE_ID`, `STATUS`) VALUES ('$userId','$fileId','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getSharedFiles($userId)
    {
        $query = $this->conn->prepare("SELECT f.* FROM `shared_files` as sf JOIN `files` as f ON sf.FILE_ID = f.ID WHERE sf.USER_ID = '$userId' AND sf.STATUS = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    // Audit Log
    public function getAuditLog($fileId)
    {
        $query = $this->conn->prepare("SELECT * FROM `audit_log` WHERE `FILE_ID` = '$fileId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Message
    public function getMessages($userId)
    {
        $query = $this->conn->prepare("SELECT * FROM `message` WHERE `RECEIVER_ID` = '$userId' OR `SENDER_ID` = '$userId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function sendMessage($senderId, $userId, $message)
    {
        $dateTime = $this->dateTime();
        $query = $this->conn->prepare("INSERT INTO `message`(`SENDER_ID`, `RECEIVER_ID`, `MESSAGE`, `DATE_TIME`) VALUES (?, ?, ?, ?)");
        $query->bind_param('ssss', $senderId, $userId, $message, $dateTime);
        $addNotif = $this->conn->prepare("UPDATE `users` SET `INBOX`= `INBOX` + 1 WHERE `ID` = '$userId'");

        if ($query->execute() && $addNotif->execute()) {
            return 200;
        }
    }

    public function facultySendMessage($userId, $message)
    {
        $dateTime = $this->dateTime();
        $adminId = 'ADMIN_1';
        $query = $this->conn->prepare("INSERT INTO `message`(`SENDER_ID`, `RECEIVER_ID`, `MESSAGE`, `DATE_TIME`) VALUES (?, ?, ?, ?)");
        $query->bind_param('ssss', $userId, $adminId, $message, $dateTime);

        $addNotif = $this->conn->query("UPDATE `users` SET `SENT_INBOX` = `SENT_INBOX` + '1' WHERE `ID` = '$userId'");
        // $addNotif->bind_param('s', $userId);

        if ($query->execute() && $addNotif->execute()) {
            return 200;
        }
    }

    // Manage User
    public function getUser($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function createUser($post)
    {
        do {
            $userId = 'FACULTY_' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkUserId = $this->getUser($userId);
        } while ($checkUserId->num_rows > 0);

        $fname = $post['fname'];
        $lname = $post['lname'];
        $mi = $post['mi'];
        $suffix = $post['suffix'];
        $facultyId = $post['facultyId'];
        $email = $post['email'];
        $username = $post['username'];
        $password = $post['password'];

        $query = $this->conn->prepare("INSERT INTO `users`(`ID`, `F_NAME`,`L_NAME`,`MI`,`SUFFIX`,`EMAIL`, `USERNAME`, `PASSWORD`, `FACULTY_ID`, `USER_TYPE`, `STATUS`) 
                                                    VALUES ('$userId','$fname','$lname','$mi','$suffix','$email','$username','$password','$facultyId','faculty','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function searchFileName($search)
    {
        $query = $this->conn->prepare("SELECT * FROM `files` WHERE `DISPLAY_FILE_NAME` LIKE '%$search%'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addTasks($post, $file)
    {
        $userId = $post['userId'];
        $message = $post['message'];

        $dateTime = $this->dateTime();

        do {
            $fileName = 'prmsu_' . $this->generateRandomString(12);
            $checkFileName = $this->getFileName($fileName);
        } while ($checkFileName->num_rows > 0);

        if (!empty($_FILES['taskFile']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/../TaskFiles/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $query = $this->conn->prepare("INSERT INTO `tasks`(`FOR_USER_ID`, `TASK_MESSAGE`, `TASK_FILE_NAME`, `TASK_DISPLAY_FILE_NAME`, `TASK_DATETIME`) VALUES ('$userId','$message','$newFileName','$file_name','$dateTime')");
                    $addNotif = $this->conn->prepare("UPDATE `users` SET `NOTIF`= `NOTIF` + 1 WHERE `ID` = '$userId'");
                    if ($query->execute() && $addNotif->execute()) {
                        return 200;
                    }
                } else {
                    // return 'Uploading file unsuccessfull';
                    return $destination;
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }

    public function addTasksToAll($post, $file)
    {
        $message = $post['message'];
        $dateTime = $this->dateTime();
        $fileName = 'prmsu_' . $this->generateRandomString(12);

        if (!empty($_FILES['taskFile']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/../TaskFiles/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $returnCode = 200; // Assume success by default

                    $getUsers = $this->getFacultyUsers();
                    while ($user = $getUsers->fetch_assoc()) {
                        $userId = $user['ID'];
                        $query = $this->conn->prepare("INSERT INTO `tasks`(`FOR_USER_ID`, `TASK_MESSAGE`, `TASK_FILE_NAME`, `TASK_DISPLAY_FILE_NAME`, `TASK_DATETIME`) 
                                                                    VALUES ('$userId', '$message', '$newFileName', '$file_name', '$dateTime')");

                        // $query->bind_param("issss", $userId, $message, $newFileName, $file_name, $dateTime);

                        if (!$query->execute()) {
                            $returnCode = 500;
                            error_log("Error in query: " . $query->error);
                            break;
                        }
                        $query->close();
                    }

                    $addNotif = $this->conn->prepare("UPDATE `users` SET `NOTIF`= `NOTIF` + 1 WHERE `USER_TYPE` = 'faculty' AND `STATUS` = 'active'");
                    $addNotif->execute();
                    return $returnCode;
                } else {
                    return 'Uploading file unsuccessfull';
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }

    // Notification
    public function getNotificationCount($column)
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as total FROM `users` WHERE `$column` > 0");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }
}
