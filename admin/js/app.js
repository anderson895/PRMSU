$(document).ready(function () {
  var isEditPasswordShow = false;

  $(document).on("click", function (e) {
    // Check if the clicked element is not a .btn-toggle-section-menu
    if (!$(e.target).closest(".btn-toggle-section-menu").length) {
      $(".section-menu-container").hide();
    }
  });

  const alert = (alertType, text) => {
    $(".alert").addClass(alertType).css("opacity", "1").text(text);
    setTimeout(() => {
      $(".alert").removeClass(alertType).css("opacity", "0").text("");
    }, 2000);
  };

  const closeModal = (modalId) => {
    $("#" + modalId + " textarea").val("");
    $("#" + modalId + " input").val("");
    $("#" + modalId).modal("hide");
  };

  // Section
  $("#btnCreateNewSection").click(function (e) {
    e.preventDefault();
    $("#addSectionModal").modal("show");
  });

  $("#btnCloseAddSectionModal").click(function (e) {
    e.preventDefault();
    closeModal("addSectionModal");
  });

  $("#frmAddNewSection").submit(function (e) {
    e.preventDefault();
    var sectionName = $("#sectionName").val();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "AddNewSection",
        sectionName: sectionName,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "Section Added!");
          closeModal("addSectionModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //   Section Menu
  $(".btn-toggle-section-menu").click(function (e) {
    e.preventDefault();
    $(".section-menu-container").hide();
    $(this).closest(".side-nav-li").find(".section-menu-container").toggle();
  });

  //   Delete Section
  $(".btnDelete").click(function (e) {
    e.preventDefault();
    $("#deleteSectionId").val($(this).data("id"));
    $("#deleteSectionModal").modal("show");
  });

  $("#btnCloseDeleteSectionModal").click(function (e) {
    e.preventDefault();
    closeModal("deleteSectionModal");
  });

  $("#frmDeleteSection").submit(function (e) {
    e.preventDefault();
    var sectionId = $("#deleteSectionId").val();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "DeleteSection",
        sectionId: sectionId,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Section Deleted!");
          closeModal("deleteSectionModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //   Rename Section
  $(".btnRename").click(function (e) {
    e.preventDefault();
    var sectionId = $(this).data("id");
    var sectionName = $(this).data("name");

    $("#renameSectionName").val(sectionName);
    $("#renameSectionId").val(sectionId);

    $("#RenameSectionModal").modal("show");
  });

  $("#btnCloseRenameSectionModal").click(function (e) {
    e.preventDefault();
    closeModal("RenameSectionModal");
  });

  $("#frmRenameSection").submit(function (e) {
    e.preventDefault();
    var sectionId = $("#renameSectionId").val();
    var sectionName = $("#renameSectionName").val();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "RenameSection",
        sectionId: sectionId,
        sectionName: sectionName,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Section Updated!");
          closeModal("RenameSectionModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //   Faculty
  //   Delete Faculty
  $(".btnDeleteFaculty").click(function (e) {
    e.preventDefault();
    var facultyId = $(this).data("id");
    $("#deleteFacultyId").val(facultyId);
    $("#deleteFacultyModal").modal("show");
  });

  $("#btnCloseDeleteFacultyModal").click(function (e) {
    e.preventDefault();
    closeModal("deleteFacultyModal");
  });

  $("#frmDeleteFaculty").submit(function (e) {
    e.preventDefault();
    var facultyId = $("#deleteFacultyId").val();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "DeleteFaculty",
        facultyId: facultyId,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Folder Deleted!");
          closeModal("deleteFacultyModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //   Edit Faculty
  $(".btnEditFaculty").click(function (e) {
    e.preventDefault();
    $("#renameFacultyName").val($(this).data("name"));
    $("#renameFacultyId").val($(this).data("id"));
    $("#RenameFacultyModal").modal("show");
  });

  $("#btnCloseRenameFacultyModal").click(function (e) {
    e.preventDefault();
    closeModal("RenameFacultyModal");
  });

  $("#frmRenameFaculty").submit(function (e) {
    e.preventDefault();
    var facultyName = $("#renameFacultyName").val();
    var facultyId = $("#renameFacultyId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "RenameFaculty",
        facultyId: facultyId,
        facultyName: facultyName,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Folder Updated!");
          closeModal("RenameFacultyModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  $("#btnAddFacultyFolder").click(function (e) {
    e.preventDefault();
    $("#SectionToBeAdd").val($(this).data("id"));
    $("#addFacultyModal").modal("show");
  });

  $("#btnCloseAddFacultyModal").click(function (e) {
    e.preventDefault();
    closeModal("addFacultyModal");
  });

  $("#frmAddNewFaculty").submit(function (e) {
    e.preventDefault();
    var facultyName = $("#AddFacultyName").val();
    var sectionId = $("#SectionToBeAdd").val();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "AddNewFaculty",
        facultyName: facultyName,
        sectionId: sectionId,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Folder Added!");
          closeModal("addFacultyModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //File Folder
  //   Add New File Folder
  $("#btnAddFileFolder").click(function (e) {
    e.preventDefault();
    $("#FacultyToBeAdd").val($(this).data("id"));
    $("#addFileFolderModal").modal("show");
  });

  $("#btnCloseAddFileFolderModal").click(function (e) {
    e.preventDefault();
    closeModal("addFileFolderModal");
  });

  $("#frmAddNewFileFolder").submit(function (e) {
    e.preventDefault();
    var folderName = $("#AddFileFolderName").val();
    var facultyId = $("#FacultyToBeAdd").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "AddNewFileFolder",
        folderName: folderName,
        facultyId: facultyId,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "Folder Added!");
          closeModal("addFileFolderModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //   Rename File Folder
  $(".btnEditFileFolder").click(function (e) {
    e.preventDefault();
    $("#renameFolderId").val($(this).data("id"));
    $("#renameFolderName").val($(this).data("name"));
    $("#RenameFolderModal").modal("show");
  });

  $("#btnCloseRenameFolderModal").click(function (e) {
    e.preventDefault();
    closeModal("RenameFolderModal");
  });

  $("#frmRenameFolder").submit(function (e) {
    e.preventDefault();
    var folderId = $("#renameFolderId").val();
    var folderName = $("#renameFolderName").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "RenameFileFolder",
        folderId: folderId,
        folderName: folderName,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "Folder Updated!");
          closeModal("RenameFolderModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  //   Delete File Folder
  $(".btnDeleteFileFolder").click(function (e) {
    e.preventDefault();
    $("#deleteFileFolderId").val($(this).data("id"));
    $("#deleteFileFolderModal").modal("show");
  });

  $("#btnCloseDeleteFileFolderModal").click(function (e) {
    e.preventDefault();
    closeModal("deleteFileFolderModal");
  });

  $("#frmDeleteFileFolder").submit(function (e) {
    e.preventDefault();
    var folderId = $("#deleteFileFolderId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "DeleteFileFolder",
        folderId: folderId,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "Folder Deleted!");
          closeModal("deleteFileFolderModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  // File

  // New File
  $("#btnAddFile").click(function (e) {
    e.preventDefault();
    $("#FolderToBeAdd").val($(this).data("id"));
    $("#addFileModal").modal("show");
  });

  $("#btnCloseAddFileModal").click(function (e) {
    e.preventDefault();
    closeModal("addFileModal");
  });

  $("#frmAddNewFile").submit(function (e) {
    e.preventDefault();

    var formData = new FormData($(this)[0]);
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "File Added!");
          closeModal("addFileModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  // Edit File
  $(".btnEditFile").click(function (e) {
    e.preventDefault();
    $("#editFileName").val($(this).data("name"));
    $("#editNotes").val($(this).data("notes"));
    $("#editTags").val($(this).data("tags"));
    $("#EditFileId").val($(this).data("id"));
    $("#editFileModal").modal("show");
  });

  $("#btnCloseEditFileModal").click(function (e) {
    e.preventDefault();
    closeModal("editFileModal");
  });

  $("#frmEditFile").submit(function (e) {
    e.preventDefault();
    var fileName = $("#editFileName").val();
    var notes = $("#editNotes").val();
    var tags = $("#editTags").val();
    var fileId = $("#EditFileId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "EditFile",
        fileId: fileId,
        fileName: fileName,
        notes: notes,
        tags: tags,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "File Details Edited!");
          closeModal("editFileModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  // Delete File
  $(".btnDeleteFile").click(function (e) {
    e.preventDefault();
    $("#deleteFileId").val($(this).data("id"));
    $("#deleteFileModal").modal("show");
  });

  $("#btnCloseDeleteFileModal").click(function (e) {
    e.preventDefault();
    closeModal("deleteFileModal");
  });

  $("#frmDeleteFile").submit(function (e) {
    e.preventDefault();
    var fileId = $("#deleteFileId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "DeleteFile",
        fileId: fileId,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "File Deleted!");
          closeModal("deleteFileModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  // Shared Files
  $("#btnShareFile").click(function (e) {
    e.preventDefault();
    var shareTo = $("#sharedFileTo").val();
    var fileId = $("#hiddenFileId").val();

    if (fileId != "" && shareTo != "") {
      $.ajax({
        type: "POST",
        url: "../../backend/endpoints/admin/post-submit.php",
        data: {
          submitType: "ShareFile",
          userId: shareTo,
          fileId: fileId,
        },
        success: function (response) {
          if (response == "200") {
            alert("alert-success", "File shared!");
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          } else {
            alert("alert-danger", "Something Went Wrong!");
          }
        },
      });
    } else {
      alert("alert-danger", "Something Went Wrong!");
    }
  });

  // Message
  $("#frmSendMessage").submit(function (e) {
    e.preventDefault();
    var message = $("#txtSendMessage").val();
    var userId = $("#userId").val();
    var senderId = $("#adminId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "sendMessage",
        message: message,
        userId: userId,
        senderId: senderId,
      },
      success: function (response) {
        // console.log(response);
        $("#txtSendMessage").val("");
        if (response != "200") {
          alert("alert-danger", "Can't send a message right now.");
        }
      },
    });
  });

  // Edit User
  $("#frmEditUser").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: formData,
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "User Edited!");
        } else {
          alert("alert-danger", "Something went wrong");
        }
      },
    });
  });

  $("#showPasswordFrmEdit").click(function (e) {
    e.preventDefault();
    if (isEditPasswordShow) {
      $("#editPassword").attr("type", "password");
      $("#btnShowPasswordIcon").removeClass("bi-eye-fill");
      $("#btnShowPasswordIcon").addClass("bi-eye-slash-fill");
    } else {
      $("#editPassword").attr("type", "text");
      $("#btnShowPasswordIcon").removeClass("bi-eye-slash-fill");
      $("#btnShowPasswordIcon").addClass("bi-eye-fill");
    }
    isEditPasswordShow = !isEditPasswordShow;
  });

  // Restore File
  $(".btnRestoreFile").click(function (e) {
    e.preventDefault();
    var fileId = $(this).data("id");
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "RestoreFile",
        fileId: fileId,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "File Restored!");
          window.location.reload();
        } else {
          alert("alert-danger", "Something went wrong");
        }
      },
    });
  });

  // Add New User
  $("#btnOpenAddNewUserModal").click(function (e) {
    e.preventDefault();
    $("#addNewUserModal").modal("show");
  });

  $("#btnCloseAddNewUserModal").click(function (e) {
    e.preventDefault();
    closeModal("addNewUserModal");
  });

  $("#frmAddNewUser").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: formData,
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "User Added");
          window.location.reload();
        } else {
          alert("alert-danger", "Something went wrong");
        }
      },
    });
  });

  // search
  $("#search").keydown(function (e) {
    var search = $(this).val();
    if (search.length > 1) {
      $.ajax({
        type: "GET",
        url: "../../backend/endpoints/admin/get-request.php",
        data: {
          submitType: "GetMessages",
          search: search,
        },
        success: function (response) {
          console.log(response);
          $("#search-items-container").html(response);
        },
      });
    } else {
      $("#search-items-container").empty();
    }
  });

  // Add Tasks
  $("#btnOpenAddTask").click(function (e) {
    e.preventDefault();
    console.log($(this).data("id"));
    $("#addTasksUserId").val($(this).data("id"));
    $("#addTasksModal").modal("show");
  });

  $("#btnCloseAddTasksModal").click(function (e) {
    e.preventDefault();
    closeModal("addTasksModal");
  });

  $("#frmAddTasks").submit(function (e) {
    e.preventDefault();

    var formData = new FormData($(this)[0]);

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Task Added!");
          closeModal("addTasksModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  $("#btnOpenAddTaskToAll").click(function (e) {
    e.preventDefault();
    $("#addTasksToAllModal").modal("show");
  });

  $("#btnCloseAddTasksToAllModal").click(function (e) {
    e.preventDefault();
    closeModal("addTasksToAllModal");
  });

  $("#frmAddTasksToAll").submit(function (e) {
    e.preventDefault();

    var formData = new FormData($(this)[0]);

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "Task Added!");
          closeModal("addTasksModal");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  $("#showUserGuide").click(function (e) {
    e.preventDefault();
    console.log("clicked");
    $("#UserGuideModal").modal("show");
  });

  $("#btnCloseUserGuideModal").click(function (e) {
    e.preventDefault();
    closeModal("UserGuideModal");
  });
});
