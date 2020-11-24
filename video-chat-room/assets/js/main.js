var socketIoConnectionUrl = "https://playbox.biz.id/";
var peerConnectionUrl = "playbox.biz.id";
var rootUrl = "https://livedemo.satupintu.co.id/video-chat-room";

$(function () {

    $("#messagebox").hide();
    $("#mymessagebox").hide();
    $("#messageuser").hide();


    var totalUser = 0;
    // Connection
    var myStream = null;
    var userid = uuidv4();
    var userlist = [];

    if(sessionStorage.getItem("userid") != "null")
        userid = sessionStorage.getItem("userid");

    console.log(userid);

    var socket = io(socketIoConnectionUrl);
    const peer = new Peer(userid, {
        host: peerConnectionUrl,
        path: '/video-server/'
    });

    socket.on("message", function (response) {
        //console.log("MESSAGE");
        //console.log(response);
        switch (response.type) {
            case "new_user_login":
                printMessage(response);
                //console.log(response.name + " has joined the room");
                userlist.push(response);

                totalUser++;
                $("#usercount").html(totalUser);
                break;
            case "user_left":
                printMessage(response);
                totalUser--;
                $("#usercount").html(totalUser);

                var usertokick = 0;
                for (var i = 0; i < userlist.length; i++) {
                  if(userlist[i].userid == response.userid)
                  {
                    usertokick = i;
                    break;
                  }
                }

                userlist.splice(usertokick, i);

                if(response.userid == socket.userid)
                {
                  socket.disconnect();
                  alert("Your email has been used in another device!");
                  location.replace("./");
                }

                //console.log(response.name + " has left the room");
                break;
            case "get_user_list":
                //console.log(" active users", response.data);
                printPreviousMessage(response.messages);
                //console.log(" message history", response.messages);
                totalUser = response.data.length;

                userlist = [];
                for (var i = 0; i < response.data.length; i++) {
                  userlist.push(response.data[i]);
                }

                //console.log(userlist);

                startVideoCall();

                $("#usercount").html(totalUser);
                break;
            case "get_message":
                printMessage(response.data);
                //console.log(" active users", response.data);
                break;

        }
    });

    let params = new URLSearchParams(location.search);

    sessionStorage.setItem("room", params.get('room'));
    sessionStorage.setItem("roomname", params.get('roomname'));

    if(sessionStorage.getItem("userid") == "null")
    {
      sessionStorage.setItem("userid", userid);
      sessionStorage.setItem("name", params.get('name'));
      sessionStorage.setItem("email", params.get('email'));
    }
    else
    {
      if(sessionStorage.getItem("name") != params.get('name') ||
      sessionStorage.getItem("email") != params.get('email'))
      {
          sessionStorage.setItem("userid", userid);
          sessionStorage.setItem("name", params.get('name'));
          sessionStorage.setItem("email", params.get('email'));
      }
    }

    socket.name = sessionStorage.getItem("name");
    socket.email = sessionStorage.getItem("email");
    socket.userid = sessionStorage.getItem("userid");
    socket.room = sessionStorage.getItem("room");
    socket.roomname = sessionStorage.getItem("roomname");

    var isHost = false;

    if(params.get('h') != 'undefined')
    {
      if(params.get('h') == "681c4ba5d874")
      {
        isHost = true;
      }
    };

    if(isHost)
      $("#hostbadge").show();
    else
      $("#hostbadge").hide();

    socket.emit("login", {name: socket.name, email: socket.email, room: socket.room, userid: socket.userid, roomname:socket.roomname, ishost:isHost});
    socket.emit("getRoomMembers");

    //console.log(sessionStorage.getItem("roomname"));

    $("#chat_submit").click(function(){
        sendChat();
    });

    $("#exit").click(function(){
      window.open(
        "./",
        "_self");
    });

    $("#copylink").click(function(){
        var url = rootUrl;
        url = url.concat(
            "?roomname=",encodeURIComponent(params.get('roomname')),
            "&room=",encodeURIComponent(params.get('room'))
        );

        var dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = url;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);

        alert("Room link has been copied!");
    });

    $("#settings").click(function(){
        console.log("settings");
    });

    function sendChat()
    {
        var message = $("#chat_input").val();
        $("#chat_input").val("");

        socket.emit("sendMessage", message);
    }

    var input = document.getElementById("chat_input");

    input.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {

        sendChat();
      }
    });

    function startVideoCall()
    {
      navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
      navigator.getUserMedia({video: true, audio: true}, function(stream) {

        var ishost = false;
        for (var i = 0; i < userlist.length; i++) {
          if(userlist[i].userid == userid && userlist[i].ishost == true)
          {
            ishost = true;
            break;
          }
        }

        //console.log(ishost);
        if(ishost)
        {
          $("#myVideo").remove();
          $("#hostVideo").append(hostVideo(userid));
          playStream(userid, stream);
        }
        else {
          playStream("myVideo", stream);
        }

        socket.on("message", function (response) {
      	  switch (response.type) {
      		  case "new_user_login":
      				console.log("CALLING NEW USER", response);

              callPeer(response.userid, response.name, stream, response.ishost);
      			  break;
      		  case "user_left":
              //console.log("REMOVING USER", response);
              removeStream(response.userid);
      			  break;
      	  }
        });

        callAllPeers(stream, true);

      }, function(err) {
        console.log('Failed to get local stream' ,err);
      });

      peer.on('call', function(call) {
        navigator.getUserMedia({video: true, audio: true}, function(stream) {
      	//console.log("Answer someone's call");
      	call.answer(stream);

        callAllPeers(stream, true);

        }, function(err) {
      	   //console.log('Failed to get local stream' ,err);
        });
      });
    }

    function callPeer(userid, name, stream, ishost) {
      var call = peer.call(userid, stream, { metadata: { name: name, userid:userid } });
      call.on('stream', function(remoteStream) {

        var videobase = document.getElementById(userid.replace('-',''));

        if(videobase == null && ishost != undefined)
        {
          if(!ishost)
          {
            var videobase = document.getElementById('base_' + userid.replace('-',''));
            //console.log(videobase);
            if(videobase == null)
            {
              console.log("Create user's video", userid, ishost);

              $("#otherVideos").append(otherVideos(userid));
              playStream(userid, remoteStream);
            }
          }
          else
          {

            var videobase = document.getElementById(userid.replace('-',''));

            //console.log(videobase);

            if(videobase == null)
            {
              console.log("Create Host video", userid);
              $("#hostVideo").append(hostVideo(userid));
              playStream(userid, remoteStream);
            }
          }
        }
      });
    }

    function callAllPeers(stream, checkexist)
    {
      //console.log("Call all users in the room");

      for (var i = 0; i < userlist.length; i++) {
        if(userlist[i].userid != userid)
        {
          var call = true;
          if(checkexist)
          {
            var videobase = document.getElementById('base_' + userlist[i].userid.replace('-',''));

            if(videobase != null)
              call = false;
          }

          if(call)
          {
              //console.log("Calling", userlist[i].userid);
              callPeer(userlist[i].userid, userlist[i].name, stream, userlist[i].ishost);
          }
        }
      }
    }
});



function uuidv4() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}

function printMessage(message)
{
  var admintag = '';
  if(message.ishost)
  {
    admintag = '<span class="badge badge-primary">HOST</span>';
  }

  console.log(message);

  switch (message.type) {
      case "new_user_login":
          $("#chatbox").append($("#messageuser").html().replace("##message##", message.name + " has joined the room"));
          break;
      case "user_left":
          $("#chatbox").append($("#messageuser").html().replace("##message##", message.name + " has left the room"));
          break;
      case "get_message":
          if(sessionStorage.getItem("userid") != message.userid)
            $("#chatbox").append($("#messagebox").html().replace("##message##", message.message).replace("##date##", message.date).replace("##time##", message.time).replace("##name##", admintag + ' ' + message.name));
          else
            $("#chatbox").append($("#mymessagebox").html().replace("##message##", message.message).replace("##date##", message.date).replace("##time##", message.time).replace("##name##",admintag + ' ' + message.name));
          break;

  }
}

function printPreviousMessage(messages)
{
  for (var i = 0; i < messages.length; i++) {
    printMessage(messages[i]);
  }
}

function playStream(id, stream)
{
  var video = document.getElementById(id.replace("-",''));
  video.srcObject = stream;
  video.play();
}

function removeStream(userid)
{
  var video = document.getElementById(userid.replace('-',''));

  if(video != null)
    video.remove();

  var videobase = document.getElementById('base_' + userid.replace('-',''));

  if(videobase != null)
    videobase.remove();
}

function hostVideo(id)
{
  id = id.replace('-', '');
  return '<video id="'+id+'" width="100%" height="auto" controls></video>';
}

function otherVideos(id)
{
  id = id.replace('-', '');
  return '<div class="col-lg-4 mt-4 videoDisplay" id="base_' + id + '"><video id="' + id + '" width="100%" height="auto"></video></div>';
}
