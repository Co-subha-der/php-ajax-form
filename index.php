<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ROLE </title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: arial;
      background: #ffffff;
      padding: 0;
      margin: 0;
    }

    #main {
      width: 1200px;
      margin: 0 auto;
      background: white;
      font-size: 19px;
    }

    #modal-form {
      background: #fff;
      width: 40%;
      height: 800PX;
      position: relative;
      top: 10%;
      left: calc(50% - 15%);
      padding: 15px;
      border-radius: 4px;
    }
  </style>
</head>

<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>ROLE & PRIVILEGED</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          UserName : <input type="text" id="username">&nbsp;&nbsp;&nbsp;
          Password : <input type="text" id="password">&nbsp;&nbsp;&nbsp;
          Role : <input type="text" id="role">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      // Load Table Records
      function loadTable() {
        $.ajax({
          url: "ajax-load.php",
          type: "POST",
          success: function(data) {
            $("#table-data").html(data);
          }
        });
      }
      loadTable(); // Load Table Records on Page Load

      // Insert New Records
      $("#save-button").on("click", function(e) {
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var role = $("#role").val();
        if (username == "" && password == "" && role == "") {
          $("#error-message").html("All fields are required.").slideDown();
          $("#success-message").slideUp();
        } else {
          $.ajax({
            url: "ajax-insert.php",
            type: "POST",
            data: {
              user_name: username,
              pass_word: password,
              rol_n: role
            },
            success: function(data) {
              if (data == 1) {
                loadTable();
                $("#addForm").trigger("reset");
                $("#success-message").html("Data Inserted Successfully.").slideDown();
                $("#error-message").slideUp();
              } else {
                $("#error-message").html("Can't Save Record.").slideDown();
                $("#success-message").slideUp();
              }

            }
          });
        }

      });

      //Delete Records
      $(document).on("click", ".delete-btn", function() {
        if (confirm("Do you really want to delete this record ?")) {
          var adminId = $(this).data("id");
          var element = this;

          $.ajax({
            url: "ajax-delete.php",
            type: "POST",
            data: {
              id: adminId
            },
            success: function(data) {
              if (data == 1) {
                $(element).closest("tr").fadeOut();
              } else {
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
            }
          });
        }
      });

      //Show Modal Box
      $(document).on("click", ".edit-btn", function() {
        $("#modal").show();
        var studentId = $(this).data("eid");

        $.ajax({
          url: "load-update-form.php",
          type: "POST",
          data: {
            id: userId
          },
          success: function(data) {
            $("#modal-form table").html(data);
          }
        })
      });

      //Hide Modal Box
      $("#close-btn").on("click", function() {
        $("#modal").hide();
      });

      //Save Update Form
      $(document).on("click", "#edit-submit", function() {
        var userId = $("#edit-id").val();
        var username = $("#edit-username").val();
        var password = $("#edit-password").val();
        var role = $("#edit-role").val();

        $.ajax({
          url: "ajax-update-form.php",
          type: "POST",
          data: {
            id: userId,
            Username: username,
            Password: password,
            Role: role
          },
          success: function(data) {
            if (data == 1) {
              $("#modal").hide();
              loadTable();
            }
          }
        })
      });

      // Live Search
      $("#search").on("keyup", function() {
        var search_term = $(this).val();

        $.ajax({
          url: "ajax-live-search.php",
          type: "POST",
          data: {
            search: search_term
          },
          success: function(data) {
            $("#table-data").html(data);
          }
        });
      });
    });
  </script>
</body>





</html>