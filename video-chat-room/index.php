<!DOCTYPE html>
<html>
<head>
  <title>Video Chat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="./assets/js/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
  <script src="./assets/js/login.js"></script>

</head>
<body>


    <div class="container">
      <div class="card mt-5" style="width: 28rem;">
        <div class="card-body">
          <form action="stage.php" method="GET">
              <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" id="loginName" name="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Email : </label>
                <input type="text" id="loginEmail" name="email" class="form-control">
              </div>

              <input type="text" id="roomname" name="roomname" class="form-control" value="<?php
                if(isset($_GET["roomname"]))
                {
                  echo $_GET["roomname"];
                }
                else
                {
                  echo "Lobby";
                }
              ?>" hidden>
              <input type="text" id="room" name="room" class="form-control" value="<?php
                if(isset($_GET["room"]))
                {
                  echo $_GET["room"];
                }
                else
                {
                  echo "115c7be9-1450-4dc9-b7f5-6c35364bdb8c";
                }
              ?>" hidden>
              <input type="text" id="loginIsLobby" name="lobby" class="form-control" value="<?php
                if(isset($_GET["roomname"]))
                {
                  echo "false";
                }
                else
                {
                  echo "true";
                }
              ?>" hidden>
              <button type="button" id="loginToRoom" class="btn btn-primary">Go To <?php
                if(isset($_GET["roomname"]))
                {
                  echo $_GET["roomname"];
                }
                else
                {
                  echo "Lobby";
                }
              ?></button>
              <?php
                if(!isset($_GET["room"]))
                {
                  echo '<button type="button" id="loginToNewRoom" class="btn btn-primary">New Room</button>';
                }
              ?>
          </form>
        </div>
      </div>
    </div>

    <div class="modal" id="newRoomModal" role="dialog" aria-labelledby="newRoomModalLabel" aria-hidden="true" style="background-color:rgba(0, 0, 0, 0.6);">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newRoomModalLabel">Create New Room</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="email">Room Name : </label>
              <input type="text" id="newRoomNameInput" name="newroom" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
            <button type="button" class="btn btn-primary" id="loginCreateRoom">Create</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<script src="./assets/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="./assets/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="./assets/js/jquery.min.js"></script>
