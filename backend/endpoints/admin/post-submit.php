<?php
if (isset($_POST['submitType'])) {
    include('../../db/db_class.php');
    $admin_db = new admin_class();
    $db = new global_class();
    $submitType = $_POST['submitType'];

    if ($submitType == 'AddNewSection') {
        $sectionName = $_POST['sectionName'];
        echo $admin_db->addNewSection($sectionName);
    } elseif ($submitType == 'DeleteSection') {
        $sectionId = $_POST['sectionId'];
        echo $admin_db->deleteSection($sectionId);
    } elseif ($submitType == 'RenameSection') {
        $sectionId = $_POST['sectionId'];
        $sectionName = $_POST['sectionName'];
        echo $admin_db->renameSection($sectionId, $sectionName);
    } elseif ($submitType == 'AddNewFaculty') {
        $facultyName = $_POST['facultyName'];
        $sectionId = $_POST['sectionId'];
        echo $admin_db->addNewFaculty($facultyName, $sectionId);
    } elseif ($submitType == 'RenameFaculty') {
        $facultyId = $_POST['facultyId'];
        $facultyName = $_POST['facultyName'];
        echo $admin_db->renameFaculty($facultyId, $facultyName);
    } elseif ($submitType == 'DeleteFaculty') {
        $facultyId = $_POST['facultyId'];
        echo $admin_db->deleteFaculty($facultyId);
    } elseif ($submitType == 'AddNewFileFolder') {
        $folderName = $_POST['folderName'];
        $facultyId = $_POST['facultyId'];
        echo $admin_db->addFileFolder($folderName, $facultyId);
    } elseif ($submitType == 'RenameFileFolder') {
        $folderId = $_POST['folderId'];
        $folderName = $_POST['folderName'];
        echo $admin_db->renameFileFolder($folderId, $folderName);
    } elseif ($submitType == 'DeleteFileFolder') {
        $folderId = $_POST['folderId'];
        echo $admin_db->deleteFileFolder($folderId);
    } elseif ($submitType == 'AddNewFile') {
        $notes = $_POST['notes'];
        $tags = $_POST['tags'];
        echo $admin_db->addNewFile($_POST, $_FILES['file']);
    } elseif ($submitType == 'EditFile') {
        $fileId = $_POST['fileId'];
        $notes = $_POST['notes'];
        $tags = $_POST['tags'];
        $fileName = $_POST['fileName'];
        echo $admin_db->editFile($fileId, $fileName, $tags, $notes);
    } elseif ($submitType == 'DeleteFile') {
        $fileId = $_POST['fileId'];
        echo $admin_db->deleteFile($fileId);
    } elseif ($submitType == 'ShareFile') {
        $userId = $_POST['userId'];
        $fileId = $_POST['fileId'];
        echo $admin_db->shareFile($fileId, $userId);
    } elseif ($submitType == 'sendMessage') {
        $message = $_POST['message'];
        $userId = $_POST['userId'];
        $senderId = $_POST['senderId'];
        echo $admin_db->sendMessage($senderId, $userId, $message);
    } elseif ($submitType == 'EditUser') {
        $fname = $_POST['editFName'];
        $lname = $_POST['editLName'];
        $mi = $_POST['editMI'];
        $suffix = $_POST['editSuffix'];
        $email = $_POST['editEmail'];
        $username = $_POST['editUsername'];
        $password = $_POST['editPassword'];
        $faculty = $_POST['editFacultyId'];
        $userId = $_POST['userId'];
        echo $db->editUser($userId, $fname, $lname, $mi, $suffix, $email, $username, $password, $faculty);
    } elseif ($submitType == 'RestoreFile') {
        $fileId = $_POST['fileId'];
        echo $db->restoreFile($fileId);
    } elseif ($submitType == 'AddNewUser') {
        echo $admin_db->createUser($_POST);
    }

    // Faculty 

    elseif ($submitType == 'FacultySendMessage') {
        $userId = $_POST['userId'];
        $message = $_POST['message'];
        echo $admin_db->facultySendMessage($userId, $message);
    } elseif ($submitType == 'FacultyEditSharedFiles') {
        $userId = $_POST['userId'];
        $fileId = $_POST['fileId'];
        $fileName = $_POST['fileName'];
        $notes = $_POST['notes'];
        $tags = $_POST['tags'];
        $editFile = $admin_db->editFile($fileId, $fileName, $tags, $notes);
        $auditLog = $db->insertAudit($userId, $fileId);
        echo ($editFile == 200 && $auditLog == 200) ? '200' : '404';
    } elseif ($submitType == 'FacultyEditAccount') {
        echo $db->facultyEditAccount($_POST);
    } elseif ($submitType == 'FacultyAddNewFolder') {
        $userId = $_POST['userId'];
        $folderName = $_POST['folderName'];
        echo $db->facultyAddNewFolder($userId, $folderName);
    } elseif ($submitType == 'FacultyDeleteFolder') {
        $folderId = $_POST['folderId'];
        echo $db->facultyDeleteFolder($folderId);
    } elseif ($submitType == 'FacultyRenameFolder') {
        $folderId = $_POST['folderId'];
        $name = $_POST['name'];
        echo $db->facultyEditFolder($folderId, $name);
    } elseif ($submitType == 'FacultyAddNewFile') {
        echo $db->facultyAddNewFile($_POST, $_FILES['file']);
    } elseif ($submitType == 'FacultyDeleteFile') {
        $fileId = $_POST['fileId'];
        echo $db->facultyDeleteFile($fileId);
    } elseif ($submitType == 'FacultyEditFile') {
        echo $db->facultyEditFile($_POST);
    } elseif ($submitType == 'FacultyRestoreFile') {
        $id = $_POST['id'];
        echo $db->facultyRestoreFile($id);
    } elseif ($submitType == 'AddTasks') {
        echo $admin_db->addTasks($_POST, $_FILES['taskFile']);
    } elseif ($submitType == 'AddTasksToAll') {
        echo $admin_db->addTasksToAll($_POST, $_FILES['taskFile']);
    } elseif ($submitType == 'FacultyAddTaskResponse') {
        echo $db->submitResponse($_POST, $_FILES['responseFile']);
    }
}
