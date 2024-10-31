<!-- Add New Section Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addSectionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Section</h5>
            </div>
            <form id="frmAddNewSection">
                <div class="modal-body">
                    <div>
                        <label for="sectionName">Section Name:</label>
                        <input type="text" id="sectionName" class="form-control mt-1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddSectionModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New Section Modal -->

<!-- Rename Section Modal -->
<div class="modal" tabindex="-1" role="dialog" id="RenameSectionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Section</h5>
            </div>
            <form id="frmRenameSection">
                <div class="modal-body">
                    <div>
                        <label for="sectionName">Section Name:</label>
                        <input type="text" id="renameSectionName" class="form-control mt-1" required>
                    </div>
                    <input type="hidden" id="renameSectionId" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseRenameSectionModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Rename Section Modal -->

<!-- Delete Section Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteSectionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Section</h5>
            </div>
            <form id="frmDeleteSection">
                <div class="modal-body">
                    <p>Are you sure you want to delete this section?</p>
                    <input type="hidden" id="deleteSectionId" required value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseDeleteSectionModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete Section Modal -->


<!----------------------------------------------------------------------------->

<!-- Add New Faculty Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addFacultyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Folder</h5>
            </div>
            <form id="frmAddNewFaculty">
                <div class="modal-body">
                    <div>
                        <label for="AddFacultyName">Folder Name:</label>
                        <input type="text" id="AddFacultyName" class="form-control mt-1" required>
                        <input type="hidden" id="SectionToBeAdd" class="form-control mt-1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddFacultyModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New Faculty Modal -->

<!-- Delete Faculty Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteFacultyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Folder</h5>
            </div>
            <form id="frmDeleteFaculty">
                <div class="modal-body">
                    <p>Are you sure you want to delete this folder?</p>
                    <input type="hidden" id="deleteFacultyId" required value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseDeleteFacultyModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete Faculty Modal -->

<!-- Rename Faculty Modal -->
<div class="modal" tabindex="-1" role="dialog" id="RenameFacultyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Folder</h5>
            </div>
            <form id="frmRenameFaculty">
                <div class="modal-body">
                    <div>
                        <label for="renameFacultyName">Folder Name:</label>
                        <input type="text" id="renameFacultyName" class="form-control mt-1" required>
                    </div>
                    <input type="hidden" id="renameFacultyId" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseRenameFacultyModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Rename Faculty Modal -->

<!----------------------------------------------------------------------------->

<!-- Add New FileFolder Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addFileFolderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Folder</h5>
            </div>
            <form id="frmAddNewFileFolder">
                <div class="modal-body">
                    <div>
                        <label for="AddFileFolderName">Folder Name:</label>
                        <input type="text" id="AddFileFolderName" class="form-control mt-1" required>
                        <input type="hidden" id="FacultyToBeAdd" class="form-control mt-1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddFileFolderModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New FileFolder Modal -->

<!-- Rename Folder Modal -->
<div class="modal" tabindex="-1" role="dialog" id="RenameFolderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Folder</h5>
            </div>
            <form id="frmRenameFolder">
                <div class="modal-body">
                    <div>
                        <label for="renameFolderName">Folder Name:</label>
                        <input type="text" id="renameFolderName" class="form-control mt-1" required>
                    </div>
                    <input type="hidden" id="renameFolderId" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseRenameFolderModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Rename Folder Modal -->

<!-- Delete FileFolder Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteFileFolderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Folder</h5>
            </div>
            <form id="frmDeleteFileFolder">
                <div class="modal-body">
                    <p>Are you sure you want to delete this folder?</p>
                    <input type="hidden" id="deleteFileFolderId" required value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseDeleteFileFolderModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete FileFolder Modal -->


<!-- ------------------------------------------------------------ -->

<!-- Add New File Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addFileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New File</h5>
            </div>
            <form id="frmAddNewFile">
                <div class="modal-body">
                    <div>
                        <label for="file">File:</label>
                        <input type="file" id="file" name="file" class="form-control mt-1" required>
                        <input type="hidden" id="FolderToBeAdd" name="folderId" class="form-control mt-1" required>
                    </div>
                    <div>
                        <label for="notes">Notes:</label>
                        <input type="text" id="notes" name="notes" class="form-control mt-1" required>
                    </div>
                    <div>
                        <label for="tags">Tags:</label>
                        <input type="text" id="tags" name="tags" class="form-control mt-1" required>
                    </div>
                </div>
                <input type="hidden" name="submitType" value="AddNewFile">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddFileModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New File Modal -->

<!-- Edit File Modal -->
<div class="modal" tabindex="-1" role="dialog" id="editFileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit File</h5>
            </div>
            <form id="frmEditFile">
                <div class="modal-body">
                    <div>
                        <label for="notes">Display Filename:</label>
                        <input type="text" id="editFileName" name="fileName" class="form-control mt-1" required>
                    </div>
                    <div>
                        <label for="notes">Notes:</label>
                        <input type="text" id="editNotes" name="notes" class="form-control mt-1" required>
                    </div>
                    <div>
                        <label for="tags">Tags:</label>
                        <input type="text" id="editTags" name="tags" class="form-control mt-1" required>
                    </div>
                </div>
                <input type="hidden" name="fileId" id="EditFileId" value="">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseEditFileModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit File Modal -->

<!-- Delete File Modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteFileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete File</h5>
            </div>
            <form id="frmDeleteFile">
                <div class="modal-body">
                    <p>Are you sure you want to delete this file?</p>
                    <input type="hidden" id="deleteFileId" required value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseDeleteFileModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Delete File Modal -->

<!-- Add New User Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addNewUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
            </div>
            <form id="frmAddNewUser">
                <input type="hidden" name="submitType" value="AddNewUser">
                <div class="modal-body">
                    <div>
                        <label for="fname">Name:</label>
                        <input type="text" id="fname" name="fname" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname" class="form-control" required>
                    </div>
                    <div class="mt-3 d-flex">
                        <div class="p-0">
                            <label for="mi">MI:</label>
                            <input type="text" id="mi" name="mi" class="form-control" style="width: 80px;">
                        </div>
                        <div class="p-0" style="margin-left: 5px;">
                            <label for="suffix">Suffix:</label>
                            <input type="text" id="suffix" name="suffix" class="form-control" style="width: 100px;">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="newUserFacultyId">Section</label>
                        <select class="form-control" id="newUserFacultyId" name="facultyId" required>
                            <option></option>
                            <?php
                            $getSections = $admin_db->getSections();
                            while ($section = $getSections->fetch_assoc()) {
                            ?>
                                <option value="<?= $section['ID'] ?>"><?= $section['SECTION_NAME'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddNewUserModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add New User Modal -->

<!-- Add Tasks Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addTasksModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Task</h5>
            </div>
            <form id="frmAddTasks">
                <input type="hidden" name="submitType" value="AddTasks">
                <input type="hidden" name="userId" id="addTasksUserId" value="">
                <div class="modal-body">
                    <div>
                        <label for="message">Message:</label>
                        <input type="text" id="message" name="message" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="taskFile">File</label>
                        <input type="file" name="taskFile" id="taskFile" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddTasksModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add Tasks Modal -->

<!-- Add Tasks To All Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addTasksToAllModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Task To All</h5>
            </div>
            <form id="frmAddTasksToAll">
                <input type="hidden" name="submitType" value="AddTasksToAll">
                <!-- <input type="hidden" name="userId" id="addTasksUserId" value=""> -->
                <div class="modal-body">
                    <div>
                        <label for="message">Message:</label>
                        <input type="text" id="message" name="message" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="taskFile">File</label>
                        <input type="file" name="taskFile" id="taskFile" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="reset" class="btn btn-secondary" id="btnCloseAddTasksToAllModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add Tasks To All Modal -->

<!-- User Guide -->
<div class="modal" tabindex="-1" role="dialog" id="UserGuideModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i> User Guide</h5>
            </div>
            <div class="modal-body">
                <div>
                    <h6><i>Main Frame:</i></h6>
                    <div class="container">
                        <img src="../../assets/userguide/mainframe.png" class="mt-2" style="width: 100%">
                    </div>
                </div>
                <hr>
                <div>
                    <h6><i>Login Frame:</i></h6>
                    <div class="container">
                        <img src="../../assets/userguide/loginframe.png" class="mt-2" style="width: 100%">
                    </div>
                    <ul class="mt-2">
                        <li>
                            <p class="text-secondary">this is the login frame of this system where the admin/faculty must enter the
                                required credentials to have access for the admin dashboard.</p>
                        </li>
                    </ul>
                </div>
                <hr>
                <div>
                    <h6><i>Admin Dashboard:</i></h6>
                    <div class="container">
                        <img src="../../assets/userguide/admindashboard.png" class="mt-2" style="width: 100%">
                    </div>
                    <ul>
                        <li>
                            <p class="text-secondary">After login, admin is directed to the main dashboard of this system where admin can perform
                                various operations such as:</p>
                            <ul>
                                <li>
                                    <p class="text-secondary">Chat Functionality: Admin and user chat features are provided for efficient
                                        communication within the system
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/chatfunctionality.png" class="mt-0" style="width: 100%">
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <p class="text-secondary">
                                        Add task: Assign tasks to specific users or distribute tasks to all users when necessary.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/addtask.png" class="m-0" style="width: 100%">
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <p class="text-secondary">
                                        Create New Section: Admins can create new sections to organize documents
                                        effectively. Each section allows for the addition of files and folders to streamline. Also,
                                        files and folders should adhere to naming conventions and relevant categorization.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/createnewsection.png" class="m-0" style="width: 100%">
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <p class="text-secondary">
                                        Manage User: Admins have the authority to manage users, including adding new
                                        users to the system. It can be assigned specific roles and access levels based on their
                                        responsibilities. Also, admin can change their credentials, including name, email,
                                        username, faculty, and password for security and identity management.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/manageuser.png" class="m-0" style="width: 100%">
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <p class="text-secondary">
                                        Recycle Bin: When a file is deleted, it will directly go to the recycle bin, where it can
                                        be retrieved.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/recyclebin.png" class="m-0" style="width: 100%">
                                    </div>
                                </li>
                                <li class="mt-3">
                                    <p class="text-secondary">
                                        Logout Button: This button terminates the current session, returning the user to the
                                        main login frame.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/logoutadmin.png " class="m-0" style="width: 100%">
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <hr>
                <div>
                    <h6><i>Faculty Dashboard:</i></h6>
                    <div class="container">
                        <img src="../../assets/userguide/facultydashboard.png" class="mt-2" style="width: 100%">
                    </div>
                    <ul>
                        <li>
                            <p class="text-secondary">Upon successful login, faculty users are directed to the dashboard, which presents the following
                                functional components:</p>
                            <ul>
                                <li>
                                    <p class="text-secondary">Inbox: This section facilitates seamless communication between faculty and
                                        administrators. Users can compose, send, receive, and manage messages within this
                                        centralized interface.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/facultyinbox.png" class="mt-0" style="width: 100%">
                                    </div>
                                </li>

                                <hr>

                                <li>
                                    <p class="text-secondary"> Folder: This component allows users to create, organize, and manage files and folders.
                                        It has the following buttons for essential actions, including:
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/addnewfolderfac.png" class="mt-0" style="width: 100%">
                                    </div>
                                    <ul class="mt-3">
                                        <li>
                                            <p class="text-secondary">Renaming files and folders</p>
                                            <div class="container">
                                                <img src="../../assets/userguide/facrenamefolder.png" class="mt-0" style="width: 100%">
                                            </div>
                                        </li>
                                        <li>
                                            <p class="text-secondary">Downloading files for offline access</p>
                                        </li>
                                        <li>
                                            <p class="text-secondary">Deleting files and folders (with the option to recover them from the Recycle
                                                Bin)</p>
                                            <div class="container">
                                                <img src="../../assets/userguide/facdeletefile.png" class="mt-0" style="width: 100%">
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <hr>

                                <li>
                                    <p class="text-secondary"> Notifications: This area alerts users of tasks assigned by the administrator ensuring
                                        timely awareness of important actions. users can send attachments as response.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/facnotif.png" class="mt-0" style="width: 100%">
                                    </div>
                                </li>

                                <hr>

                                <li>
                                    <p class="text-secondary"> Recycle Bin: This safety net safeguards against accidental data loss. Users can restore
                                        deleted files and folders from this section, preventing permanent deletion.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/facrecylclebin.png" class="mt-0" style="width: 100%">
                                    </div>
                                </li>

                                <hr>

                                <li>
                                    <p class="text-secondary"> Manage Account: This tab allows users control over their personal information and
                                        account settings. It enables them to
                                    <ul>
                                        <li>View and update their profile details.</li>
                                        <li>Modify their password for enhanced security.</li>
                                    </ul>
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/facmanageaccount.png" class="mt-0" style="width: 100%">
                                    </div>
                                </li>

                                <hr>

                                <li>
                                    <p class="text-secondary"> Logout Button: This button terminates the current session, returning the user to the
                                        main login frame.
                                    </p>
                                    <div class="container">
                                        <img src="../../assets/userguide/faclogout.png" class="mt-0" style="width: 100%">
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" id="btnCloseUserGuideModal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of User Guide -->

<footer class="footer bg-dark p-3 d-flex justify-content-between align-items-center">
    <p class="text-light m-0"><i class="bi bi-c-circle"></i> 2023 - PRMSU COE-DMS - All Rights Reserved.</p>
    <button id="showUserGuide" class="btn text-light"><i class="bi bi-info-circle"></i> User Guide</button>
</footer>

<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/app.js"></script>
</body>

</html>