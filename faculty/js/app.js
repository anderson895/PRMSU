$(document).ready(function () {
  var isEditPasswordShow = false;

  const reload = () => {
    setTimeout(() => {
      window.location.reload();
    }, 2000);
  };

  const alert = (alertType, text) => {
    $(".alert").addClass(alertType).css("opacity", "1").text(text);
    setTimeout(() => {
      $(".alert").removeClass(alertType).css("opacity", "0").text("");
    }, 2000);
  };

  const closeModal = (modalId) => {
    $("#" + modalId + " input").val("");
    $("#" + modalId).modal("hide");
  };

  // Message
  $("#frmSendMessage").submit(function (e) {
    e.preventDefault();
    var message = $("#txtSendMessage").val();
    var userId = $("#userId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultySendMessage",
        message: message,
        userId: userId,
      },
      success: function (response) {
        // console.log(response);
        $("#txtSendMessage").val("");
        // if (response != "200") {
        //   alert("alert-danger", "Can't send a message right now.");
        // }
      },
    });
  });

  // File
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
    var fileId = $("#EditFileId").val();
    var name = $("#editFileName").val();
    var notes = $("#editNotes").val();
    var tags = $("#editTags").val();
    var userId = $("#userId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultyEditSharedFiles",
        fileId: fileId,
        userId: userId,
        fileName: name,
        notes: notes,
        tags: tags,
      },
      success: function (response) {
        console.log(response);
        if (response == "200") {
          alert("alert-success", "File edited!");
          reload;
        } else {
          alert("alert-danger", "Something went wrong.");
        }
      },
    });
  });

  // Account
  $("#frmEditUser").submit(function (e) {
    e.preventDefault();
    var userId = $("#userId").val();
    var name = $("#editName").val();

    var email = $("#editEmail").val();
    var fname = $("#editFName").val();
    var lname = $("#editLName").val();
    var mi = $("#editMI").val();
    var suffix = $("#editSuffix").val();

    var username = $("#editUsername").val();
    var password = $("#editPassword").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultyEditAccount",
        userId: userId,
        fname: fname,
        lname: lname,
        mi: mi,
        suffix: suffix,
        email: email,
        username: username,
        password: password,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "Account edited!");
          reload();
        } else {
          alert("alert-danger", "Something went wrong.");
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

  // Folder

  // Add
  $("#btnAddFolder").click(function (e) {
    e.preventDefault();
    $("#addFileFolderModal").modal("show");
  });

  $("#btnCloseAddFileFolderModal").click(function (e) {
    e.preventDefault();
    closeModal("addFileFolderModal");
  });

  $("#frmAddNewFileFolder").submit(function (e) {
    e.preventDefault();
    var userId = $("#userId").val();
    var folderName = $("#AddFileFolderName").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultyAddNewFolder",
        userId: userId,
        folderName: folderName,
      },
      success: function (response) {
        closeModal("addFileFolderModal");
        if (response == "200") {
          alert("alert-success", "Folder Added!");
          reload();
        } else {
          alert("alert-danger", "Something went wrong.");
        }
      },
    });
  });

  // Delete
  $(".btnDeleteFolder").click(function (e) {
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
        submitType: "FacultyDeleteFolder",
        folderId: folderId,
      },
      success: function (response) {
        closeModal("deleteFileFolderModal");
        if (response == "200") {
          alert("alert-success", "Folder Deleted!");
          reload();
        } else {
          alert("alert-danger", "Something went wrong.");
        }
      },
    });
  });

  // Edit
  $(".btnEditFolder").click(function (e) {
    e.preventDefault();
    $("#renameFolderName").val($(this).data("name"));
    $("#renameFolderId").val($(this).data("id"));
    $("#RenameFolderModal").modal("show");
  });

  $("#btnCloseRenameFolderModal").click(function (e) {
    e.preventDefault();
    closeModal("RenameFolderModal");
  });

  $("#frmRenameFolder").submit(function (e) {
    e.preventDefault();
    var name = $("#renameFolderName").val();
    var folderId = $("#renameFolderId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultyRenameFolder",
        folderId: folderId,
        name: name,
      },
      success: function (response) {
        closeModal("RenameFolderModal");
        if (response == "200") {
          alert("alert-success", "Folder Updated!");
          reload();
        } else {
          alert("alert-danger", "Something went wrong.");
        }
      },
    });
  });

  // File
  $("#btnAddFile").click(function (e) {
    e.preventDefault();
    $("#FolderToBeAdd").val($("#currentFolderId").val());
    $("#addFileModal").modal("show");
  });

  //
  $("#btnAddFileOne").click(function (e) {
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
        closeModal("addFileModal");
        if (response == "200") {
          alert("alert-success", "File Added!");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  $(".btnFacultyDeleteFile").click(function (e) {
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
        submitType: "FacultyDeleteFile",
        fileId: fileId,
      },
      success: function (response) {
        closeModal("addFileModal");
        if (response == "200") {
          alert("alert-success", "File Deleted!");
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  $(".btnFacultyEditFile").click(function (e) {
    e.preventDefault();
    $("#FacultyEditFileName").val($(this).data("name"));
    $("#FacultyEditNotes").val($(this).data("notes"));
    $("#FacultyEditTags").val($(this).data("tags"));
    $("#FacultyEditFileId").val($(this).data("id"));
    $("#FacultyEditFileModal").modal("show");
  });

  $("#btnFacultyCloseEditFileModal").click(function (e) {
    e.preventDefault();
    closeModal("FacultyEditFileModal");
  });

  $("#frmFacultyEditFile").submit(function (e) {
    e.preventDefault();

    var name = $("#FacultyEditFileName").val();
    var notes = $("#FacultyEditNotes").val();
    var tags = $("#FacultyEditTags").val();
    var fileId = $("#FacultyEditFileId").val();

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultyEditFile",
        name: name,
        notes: notes,
        tags: tags,
        fileId: fileId,
      },
      success: function (response) {
        closeModal("FacultyEditFileModal");
        if (response == "200") {
          alert("alert-success", "File Edited!");
          reload();
        } else {
          alert("alert-danger", "Something Went Wrong!");
        }
      },
    });
  });

  $(".btnRestoreFile").click(function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    $.ajax({
      type: "POST",
      url: "../../backend/endpoints/admin/post-submit.php",
      data: {
        submitType: "FacultyRestoreFile",
        id: id,
      },
      success: function (response) {
        if (response == "200") {
          alert("alert-success", "File Restored!");
          reload();
        } else {
          alert("alert-danger", "Something Went Wrong!");
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
          submitType: "FacultyGetMessages",
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

  // Tasks
  $("#frmTaskResponse").submit(function (e) {
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
