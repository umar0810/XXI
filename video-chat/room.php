<?php date_default_timezone_set("Asia/Bangkok"); ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Cinema XXI Virtuat</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="./assets/js/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
      <link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.min.css">
      <script src="./assets/js/peerjs.min.js"></script>
      <script src="./assets/js/jquery.min.js"></script>
      <script src="./assets/js/socket.io.js"></script>
      <script src="./assets/js/main.0.4.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
      <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/animate.min.css">
      <link rel="stylesheet" href="../css/magnific-popup.css">
      <link rel="stylesheet" href="../fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../css/dripicons.css">
      <link rel="stylesheet" href="../css/slick.css">
      <link rel="stylesheet" href="../css/default.css">
      <link rel="stylesheet" href="../css/style.0.1.css">
      <link rel="stylesheet" href="../css/responsive.css">
   </head>
   <body>
      <header id="home" class="header-area">
         <div id="header-sticky" class="menu-area">
            <div class="container">
               <div class="second-menu">
                  <div class="row align-items-center">
                     <div class="col-xl-3 col-lg-3">
                        <div class="logo">
                           <a href="index.html"><img src="../img/Cinema_XXI.png" alt="logo" height="60px"></a>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-9">
                        <div class="responsive"><i class="icon dripicons-align-right"></i></div>
                        <div class="main-menu text-right text-xl-center">
                           <nav id="mobile-menu">
                              <ul>
                                 <li class="has-sub">
                                    <a href="../">Home</a>
                                 </li>
                                 <li class="has-sub">
                                    <a href="../about.php">Theaters</a>
                                 </li>
                                 <li class="has-sub">
                                    <a href="/video-chat/">Now Playing</</a>
                                 </li>
                                 <li class="has-sub">
                                    <a href="../shop.php">Shop</a>
                                 </li>
                                 <!--<li class="has-sub">
           												 <a href="../contact.php">Contact</a>
           											</li>-->
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <main>

         <section id="parallax" class="slider-area breadcrumb-area d-flex align-items-center justify-content-center fix"
         <?php
          if($_GET["room"] == "44f59808-f378-4eed-bf0f-c5b13a919183")
          {
            echo 'style="background-image:url(../img/innerpage_bg_img.jpg)"';
          }
          else
          {
            echo 'style="background-image:url(../img/slider_3_bg_img.jpg)"';
          }
         ?>>
            <div class="container">
               <div class="row">
                  <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                     <div class="breadcrumb-wrap text-center">
                        <h1><font id="welcometag" style="display:none; color:#ffffff;">Welcome to Cinema XXI</font>
                        </h1>
                        <h5 style="color:#ffffff;" id="welcometag2">
                           Hi <?php echo $_GET["name"]; ?>! <!-- <span id="copylink" class="badge badge-primary"><i class="fa fa-link" aria-hidden="true"></i></span> -->
                        </h5>
                        <h3>
                        <span class="badge badge-danger" id="hostbadge" style="display:none">HOST</span>
                        </h5>
                        <br>
                     </div>
                  </div>
                  <div class="col-lg-12 text-center" style="display:inline" id="join-webminar">
                    <a class="btn btn-primary" role="button" href="./room.php?name=<?php echo $_GET["name"]; ?>&email=<?php echo $_GET["email"]; ?>&roomname=Webinar&lobby=true&room=44f59808-f378-4eed-bf0f-c5b13a919183">Watch Movie</a>
                  </div>
                   <div class="col-lg-12 text-center" style="display:none" id="join-music">
                     <a class="btn btn-primary" role="button" href="./room.php?name=<?php echo $_GET["name"]; ?>&email=<?php echo $_GET["email"]; ?>&roomname=Live Music&lobby=true&room=e576908c-0b73-4a1c-ab3d-02a02fd74d92">At Theaters</a>
                   </div>
                   <div class="col-lg-12 text-center" style="display:none" id="join-conference">
                     <a class="btn btn-primary" role="button" href="./room.php?name=<?php echo $_GET["name"]; ?>&email=<?php echo $_GET["email"]; ?>&roomname=Ceremony&lobby=true&room=c170f800-b1bd-4a8e-b1a6-bbe495114718">XXI Cafe & Lounge</a>
                   </div>
                  <div class="col-lg-8 mb-40" id="lobbyhide1">
                    <?php
                        if($_GET["room"]=="44f59808-f378-4eed-bf0f-c5b13a919183")
                        {
                          echo '<video id="hostVideoPlayer" style="background-color:black; height:100%; width=100%" controls poster="../img/livestreamposter.jpg"></video>';
                        }
                        else if($_GET["room"]=="e576908c-0b73-4a1c-ab3d-02a02fd74d92")
                        {
                          echo '<iframe style="background-color:black; height:100%; width=100%" src="https://www.youtube.com/embed/hbF5xTP3ROU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        }
                        else
                        {
                          echo '<iframe style="background-color:black; height:100%; width=100%" src="https://www.youtube.com/embed/CmS5rlX9cDA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        }
                     ?>
                  </div>
                  <div class="col-lg-4" id="lobbyhide2">
                     <aside>
                        <div class="widget mb-40" style="background-color:white;">
                           <div class="widget-title text-center">
                              <h4>Live Chat <span class="badge badge-primary" id="usercount"></span></h4>
                           </div>
                           <div class="card-body mb-4" style="overflow-y: auto; height: 20rem;" id="chatbox">
                              <div id="messagebox" style="display: none;">
                                 <div class="text-left mt-2 mb-2 pr-2 ml-n2">
                                    <span class="card p-2">
                                       <div class="row">
                                          <div class="col-sm-12 mt-n2">
                                             <font style="color: black; font-size: 10px;"><b>##name##</b></font>
                                          </div>
                                          <div class="col-sm-12 mt-n1">
                                             <font style="color: black; font-size: 13px;">##message##</font>
                                          </div>
                                          <div class="col-sm-4 text-left mt-n1">
                                             <font style="color: #949494; font-size: 10px;">##time##</font>
                                          </div>
                                          <div class="col-sm-8 text-right mt-n1">
                                             <font style="color: #949494; font-size: 10px;" style="display: none;">##date##</font>
                                          </div>
                                       </div>
                                    </span>
                                 </div>
                              </div>
                              <div id="mymessagebox" style="display: none;">
                                 <div class="text-left mt-2 mb-2 ml-2 mr-n2">
                                    <span class="card p-2">
                                       <div class="row">
                                          <div class="col-sm-12 mt-n2">
                                             <font style="color: black; font-size: 10px;"><b>##name##</b></font>
                                          </div>
                                          <div class="col-sm-12 mt-n1">
                                             <font style="color: black; font-size: 13px;">##message##</font>
                                          </div>
                                          <div class="col-sm-8 text-left mt-n1">
                                             <font style="color: #949494; font-size: 10px;">##date##</font>
                                          </div>
                                          <div class="col-sm-4 text-right mt-n1">
                                             <font style="color: #949494; font-size: 10px;">##time##</font>
                                          </div>
                                       </div>
                                    </span>
                                 </div>
                              </div>
                              <div id="messageuser" style="display: none;">
                                 <div class="text-center mt-2 mb-2">
                                    <span class="badge badge-light"><font style="color: grey; font-size: 10px;">##message##</font></span>
                                 </div>
                              </div>
                           </div>
                           <div class="slidebar__form">
                              <input type="text" placeholder="Enter your message.." id="chat_input"/>
                              <button id="chat_submit"><i class="fa fa-paper-plane"></i></button>
                           </div>
                        </div>
                     </aside>
                  </div>
               </div>
            </div>
         </section>
         <br><br>
         <div class="event fix pb-120"  id="lobbyhide3">
            <div class="container">
               <div class="row">
                 <div class="event col-lg-12 row mb-20"  id="lobbyhide4">
                   <div class="col-lg-12 ">
                      <nav class="wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s">
                         <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                           <a class="nav-item nav-link <?php if($_GET["room"]=="115c7be9-1450-4dc9-b7f5-6c35364bdb8c"){echo 'active'; echo ' show'; }?>" id="nav-home-tab" data-toggle="tab" href="./room.php?name=<?php echo $_GET["name"]; ?>&email=<?php echo $_GET["email"]; ?>&roomname=Lobby&lobby=true&room=115c7be9-1450-4dc9-b7f5-6c35364bdb8c" role="tab" aria-selected="true">
                              <img src="../img/t-icon.png" alt="img" class="drk-icon">
                              <img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
                              <div class="nav-content">
                                 <strong>Lobby</strong>
                              </div>
                           </a>
                            <a class="nav-item nav-link <?php if($_GET["room"]=="44f59808-f378-4eed-bf0f-c5b13a919183"){echo 'active'; echo ' show'; }?>" id="nav-home-tab" data-toggle="tab" href="./room.php?name=<?php echo $_GET["name"]; ?>&email=<?php echo $_GET["email"]; ?>&roomname=Webinar&lobby=true&room=44f59808-f378-4eed-bf0f-c5b13a919183" role="tab" aria-selected="true">
                               <img src="../img/t-icon.png" alt="img" class="drk-icon">
                               <img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
                               <div class="nav-content">
                                 <strong>Now Playing</strong>
								 <h5>Desember 2020</h5>
                               </div>
                            </a>
                            <a class="nav-item nav-link <?php if($_GET["room"]=="e576908c-0b73-4a1c-ab3d-02a02fd74d92"){echo 'active'; echo ' show'; }?>" id="nav-profile-tab" data-toggle="tab" href="./room.php?name=<?php echo $_GET["name"]; ?>&email=<?php echo $_GET["email"]; ?>&roomname=Live Music&lobby=true&room=e576908c-0b73-4a1c-ab3d-02a02fd74d92" role="tab" aria-selected="false">
                               <img src="../img/t-icon.png" alt="img" class="drk-icon">
                               <img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
                               <div class="nav-content">
                                 <strong>Theaters</strong>
								 <h5>Desember 2020</h5>
                               </div>
                            </a>
                            <a class="nav-item nav-link <?php if($_GET["room"]=="c170f800-b1bd-4a8e-b1a6-bbe495114718"){echo 'active'; echo ' show'; }?>" id="nav-contact-tab" data-toggle="tab" href="./room.php?name=<?php echo $_GET["name"]; ?>&email=<?php echo $_GET["email"]; ?>&roomname=Ceremony&lobby=true&room=c170f800-b1bd-4a8e-b1a6-bbe495114718" role="tab" aria-selected="false">
                               <img src="../img/t-icon.png" alt="img" class="drk-icon">
                               <img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
                               <div class="nav-content">
                                <strong>Up Coming</strong>
								<h5>Desember 2020</h5>
                               </div>
                            </a>
                         </div>
                      </nav>
                   </div>
                 </div>
                  <div class="col-lg-12 ">
                     <div class="tab-content py-3 px-3 px-sm-0 wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s" id="nav-tabContent">
                        <div class="tab-pane fade <?php if($_GET["room"]=="44f59808-f378-4eed-bf0f-c5b13a919183"){echo 'active'; echo ' show'; }?>" id="one" role="tabpanel" aria-labelledby="nav-home-tab">
                          <?php
        										include "webminar.php";
        									 ?>
                        </div>
                        <div class="tab-pane fade <?php if($_GET["room"]=="e576908c-0b73-4a1c-ab3d-02a02fd74d92"){echo 'active'; echo ' show'; }?>" id="two" role="tabpanel" aria-labelledby="nav-profile-tab">
                          <?php
        										include "livemusic.php";
        									 ?>
                        </div>
                        <div class="tab-pane fade  <?php if($_GET["room"]=="c170f800-b1bd-4a8e-b1a6-bbe495114718"){echo 'active'; echo ' show'; }?>" id="three" role="tabpanel" aria-labelledby="nav-contact-tab">
                          <?php
                           include "conference.php";
                          ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-8 offset-xl-2 widget" style="background-color:white;">
                     <div class="row">
                        <div class="col-lg-6 mb-4">
                           <h4>Camera Settings</h4>
                           <label for="videoSource">Video Source : </label>
                           <select id="videoSource" class="form-control">
                           </select>
                           <br>
                           <label for="audioSource">Microphone : </label>
                           <select id="audioSource" class="form-control">
                           </select>
                        </div>
                        <div class="col-lg-6">
                           <video muted id="myVideo" width="100%" class="videoDisplay" poster="../img/turnyourcamera.png" style="max-height:12rem;"></video>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 mt-60">
                     <div class="event-list-content mb-40">
                        <div class="widget-title text-center">
                           <h4>Participant's Camera</h4>
                        </div>
                        <div class="row" id="otherVideos">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="event fix pb-120" id="lobbyshow1">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 ">
                     <nav class="wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s">
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                           <a class="nav-item nav-link active show" id="nav-home-tab-lobby" data-toggle="tab" href="#" role="tab" aria-selected="true">
                              <img src="../img/t-icon.png" alt="img" class="drk-icon">
                              <img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
                              <div class="nav-content">
                                 <strong>Now Playing</strong>
								 <h5>Desember 2020</h5>
                              </div>
                           </a>
                           <a class="nav-item nav-link" id="nav-profile-tab-lobby" data-toggle="tab" href="#" role="tab" aria-selected="false">
                              <img src="../img/t-icon.png" alt="img" class="drk-icon">
                              <img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
                              <div class="nav-content">
                                 <strong>Theaters</strong>
								 <h5>Desember 2020</h5>
                              </div>
                           </a>
                           <a class="nav-item nav-link" id="nav-contact-tab-lobby" data-toggle="tab" href="#" role="tab" aria-selected="false">
                              <img src="../img/t-icon.png" alt="img" class="drk-icon">
                              <img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
                              <div class="nav-content">
                                <strong>Up Coming</strong>
								<h5>Desember 2020</h5>
                              </div>
                           </a>
                        </div>
                     </nav>
                  </div>
                  <div class="col-lg-12 ">
                     <div class="tab-content py-3 px-3 px-sm-0 wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="one-lobby" role="tabpanel" aria-labelledby="nav-home-tab-lobby">
                          <?php
                           include "webminar.php";
                          ?>
                        </div>
                        <div class="tab-pane fade" id="two-lobby" role="tabpanel" aria-labelledby="nav-profile-tab-lobby">
                          <?php
                           include "livemusic.php";
                          ?>
                        </div>
                        <div class="tab-pane fade" id="three-lobby" role="tabpanel" aria-labelledby="nav-contact-tab-lobby">
                          <?php
                           include "conference.php";
                          ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>


      </main>
      <?php
        include '../footer.php';
      ?>
      <script src="../js/vendor/modernizr-3.5.0.min.js"></script>
      <script src="../js/vendor/jquery-1.12.4.min.js"></script>
      <script src="../js/popper.min.js"></script>
      <!--<script src="../js/bootstrap.min.js"></script>-->
      <script src="../js/one-page-nav-min.js"></script>
      <script src="../js/slick.min.js"></script>
      <script src="../js/ajax-form.js"></script>
      <script src="../js/paroller.js"></script>
      <script src="../js/wow.min.js"></script>
      <script src="../js/parallax.min.js"></script>
      <script src="../js/jquery.waypoints.min.js"></script>
      <script src="../js/jquery.counterup.min.js"></script>
      <script src="../js/jquery.scrollUp.min.js"></script>
      <script src="../js/jquery.magnific-popup.min.js"></script>
      <script src="../js/element-in-view.js"></script>
      <script src="../js/isotope.pkgd.min.js"></script>
      <script src="../js/imagesloaded.pkgd.min.js"></script>
      <script src="../js/main.js"></script>
   </body>
</html>
