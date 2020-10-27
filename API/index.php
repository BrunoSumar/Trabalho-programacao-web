<!DOCTYPE html>
<html>
 <head>
  <title>PHP Mysql REST API CRUD</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">
   <br />

   <h3 align="center">PHP Mysql REST API CRUD</h3>
   <br />
   <div align="right" style="margin-bottom:5px;">
    <button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addUser">Add</button>
   </div>

   <div class="table-responsive">
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>First Name</th>
       <th>Last Name</th>
       <th>Edit</th>
       <th>Delete</th>
      </tr>
     </thead>
     <tbody></tbody>
    </table>
   </div>


   <div class="modal fade modal-dialog modal-dialog-centered modal-dialog-scrollable" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <form id="api_crud_form" method="post">
                    <div class="form-group">
                      <label class="col-form-label">Nickname:</label>
                      <input type="text" name="nickname" id="nickname" class="form-control" placeholder="Nickname">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email:</label>
                      <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Password:</label>
                      <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id" value="">
                    <input type="hidden" name="action" id="action" value="insert">
                    <button type="submit" name="button_action" id="button_action" value="Insert" class="btn btn-info">Save</button>
                </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
          </div>
        </div>
        </div>
</div>
  </div>













  <script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(event) {
    function listUsers() {
          let xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementsByTagName("tbody")[0].innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET", "fetch.php", true);
          xmlhttp.send();
    }

    function loop() {
        setTimeout(function() {
            console.log('.');
            listUsers();
            loop();
        }, 5000)
    }

    function sendData() {
        const XHR = new XMLHttpRequest();
        const FD = new FormData(form);
        //console.log(FD);
        XHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log('xxx');
                console.log(XHR.response);
                console.log('xxx');
            }
        }
        XHR.open("POST", "action.php");
        XHR.send(FD);
    }



    const form = document.getElementById("api_crud_form");
    form.addEventListener("submit", function(event) {
      event.preventDefault();
      sendData();
    });




    const addButton = document.getElementById('add_button');
    addButton.onclick = function() {
        document.getElementsByName('nickname')[0].placeholder='Escolha seu Nickname';
        document.getElementsByName('email')[0].placeholder='Escolha seu email';
        document.getElementsByName('password')[0].placeholder='Escolha seu password';
        return false;
    };
    listUsers();
    loop();
    });
  </script>
 </body>
</html>







































<?php //nada?>
