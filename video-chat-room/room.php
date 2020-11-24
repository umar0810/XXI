<!DOCTYPE html>
<html>
<head>
  <title>Video Chat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="./assets/js/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.min.css">
  <script src="./assets/js/peerjs.min.js"></script>
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/socket.io.js"></script>
  <script src="./assets/js/main.js"></script>
  <style>
  .videoDisplay {
     position: relative;
     width: 100%;
     height: auto;
  }
  </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 row">
          <?php
            if($_GET["lobby"] == "true")
            {
              include 'roombutton.html';
            }
          ?>
          <div class="col-12">
            <div class="mt-5 mb-3">
              <h1>Welcome to <?php echo $_GET["roomname"]; ?> <span class="badge badge-secondary" id="usercount"></span>
                <button id="settings" type="button" class="btn btn-warning"><i class="fa fa-cog" aria-hidden="true"></i></button>
                <button id="copylink" type="button" class="btn btn-warning"><i class="fa fa-link" aria-hidden="true"></i></button>
              </h1>
              <span class="badge badge-warning" id="hostbadge" style="display:none">HOST</span> Hi <?php echo $_GET["name"]; ?>!
            </div>
          </div>
          <div class="col-lg-8">
            <div id="hostVideo">

            </div>
            <div class="row" id="otherVideos">

            </div>
          </div>
          <div class="col-lg-4">
            <video muted id="myVideo" width="100%" class="videoDisplay mb-4">
            </video>
            <div class="card mb-2" style="height: 30rem;">
                <div class="card-header">
                    Live Chat
                </div>
                <div class="card-body" style="overflow-y: auto" id="chatbox">

                  <div id="messagebox" style="display:none">
                    <div class="text-left mt-2 mb-2 pr-2">
                      <span class="card p-2">
                          <div class="row">
                            <div class="col-sm-12 mt-n2">
                              <font style="color:black; font-size:10px"><b>##name##</b></font>
                            </div>
                            <div class="col-sm-12 mt-n1">
                              <font style="color:black; font-size:13px">##message##</font>
                            </div>
                            <div class="col-sm-4 text-left mt-n1">
                              <font style="color:#949494; font-size:10px">##time##</font>
                            </div>
                            <div class="col-sm-8 text-right mt-n1">
                              <font style="color:#949494; font-size:10px" style="display:none">##date##</font>
                            </div>
                          </div>
                      </span>
                    </div>
                  </div>

                  <div id="mymessagebox" style="display:none">
                    <div class="text-left mt-2 mb-2 ml-2">
                      <span class="card p-2">
                          <div class="row">
                            <div class="col-sm-12 mt-n2">
                              <font style="color:black; font-size:10px"><b>##name##</b></font>
                            </div>
                            <div class="col-sm-12 mt-n1">
                              <font style="color:black; font-size:13px">##message##</font>
                            </div>
                            <div class="col-sm-8 text-left mt-n1">
                              <font style="color:#949494; font-size:10px">##date##</font>
                            </div>
                            <div class="col-sm-4 text-right mt-n1">
                              <font style="color:#949494; font-size:10px">##time##</font>
                            </div>
                          </div>
                      </span>
                    </div>
                  </div>

                  <div  id="messageuser" style="display:none">
                    <div class="text-center mt-2 mb-2">
                        <span class="badge badge-light"><font style="color:grey; font-size:10px">##message##</font></span>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input class="form-control" type="text" id="chat_input" name="chat" placeholder="Enter your message..">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="chat_submit">Send</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
        </div>
        <div class="col-lg-12">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </div>
    </div>
</div>
</body>
</html>
