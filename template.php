<!-- <tr>
    <td colspan="3">
        <center>No File Found.</center>
    </td>
</tr> -->

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