$(document).ready(function () {
  $("#frmLogin").submit(function (e) {
    e.preventDefault();
    var username = $("#username").val();
    var password = $("#password").val();
    var userType = $("#userType").val();
    $.ajax({
      type: "POST",
      url: "backend/endpoints/global/login.php",
      data: {
        userType: userType,
        username: username,
        password: password,
      },
      success: function (response) {
        console.log(response);
        if (response == "admin") {
          window.location.href = "admin/pages/admin.php";
        } else if (response == "faculty") {
          window.location.href = "faculty/pages/faculty.php";
        } else {
          alert("Login failed!");
        }
      },
    });
  });
});
