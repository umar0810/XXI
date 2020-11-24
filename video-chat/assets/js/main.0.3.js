var socketIoConnectionUrl = "https://playbox.biz.id/";
var peerConnectionUrl = "playbox.biz.id";
var rootUrl = "https://livedemo.satupintu.co.id/video-chat";

$(function () {

    $("#messagebox").hide();
    $("#mymessagebox").hide();
    $("#messageuser").hide();

    let params = new URLSearchParams(location.search);

    if(params.get('room')=="115c7be9-1450-4dc9-b7f5-6c35364bdb8c")
    {
      $("#lobbyhide1").hide();
      $("#lobbyhide2").hide();
      $("#lobbyhide3").hide();
      $("#lobbyhide4").hide();
      $("#welcometag").show();
      $("#welcometag2").show();
      $("#lobbyshow1").show();
    }
    else
    {
      $("#lobbyhide1").show();
      $("#lobbyhide2").show();
      $("#lobbyhide3").show();
      $("#lobbyhide4").show();
      $("#welcometag").hide();
      $("#welcometag2").hide();
      $("#lobbyshow1").hide();

      $("#join-webminar").hide();
      $("#join-music").hide();
      $("#join-conference").hide();

      if(params.get('room') != 'c170f800-b1bd-4a8e-b1a6-bbe495114718')
      {
        var videoSrc = 'https://goantri.com/hls/' + params.get("room") + '.m3u8';

        UrlExists(videoSrc, function(status){
          if(status === 200)
          {
            playLiveStreamVideo(videoSrc);
            console.log("playLiveStreamVideo");
          }
          else if(status === 404)
          {
            console.log("Live stream link video unavailable");
            //playLiveStreamVideo(videoSrc);
          }
        });
      }
    }

    var totalUser = 0;
    // Connection
    var myStream = null;
    var userid = uuidv4();
    var userlist = [];
    var calllist = [];
    var constraints = null;
    var track = null;
    var isMeHost = false;

    if (sessionStorage.getItem("userid") != "null")
        userid = sessionStorage.getItem("userid");

    console.log(userid);

    const socket = io(socketIoConnectionUrl);
    const peer = new Peer(userid, {
        host: peerConnectionUrl,
        path: '/video-server/'
    });
    const audioSelect = document.querySelector('select#audioSource');
    const videoSelect = document.querySelector('select#videoSource');

    navigator.mediaDevices.enumerateDevices().then(gotDevices);

    audioSelect.onchange = changeStream;
    videoSelect.onchange = changeStream;


    function changeStream() {
        console.log("changeStream");

        socket.emit("changeStream", {
            name: socket.name,
            email: socket.email,
            room: socket.room,
            userid: socket.userid,
            roomname: socket.roomname,
            ishost: isHost
        });
        startVideoCall();
    }

    function gotDevices(deviceInfos) {

        const optionAudioOff = document.createElement('option');
        const optionVideoOff = document.createElement('option');

        optionAudioOff.text = 'Off';
        optionVideoOff.text = 'Off';

        audioSelect.appendChild(optionAudioOff);
        videoSelect.appendChild(optionVideoOff);

        for (let i = 0; i !== deviceInfos.length; ++i) {
            const deviceInfo = deviceInfos[i];
            const option = document.createElement('option');

            option.value = deviceInfo.deviceId;
            if (deviceInfo.kind === 'audioinput') {
                option.text = deviceInfo.label || 'microphone ' + (audioSelect.length + 1);
                audioSelect.appendChild(option);
            } else if (deviceInfo.kind === 'videoinput') {
                option.text = deviceInfo.label || 'camera ' + (videoSelect.length + 1);
                videoSelect.appendChild(option);
            } else {
                //console.log('Found another kind of device: ', deviceInfo);
            }
        }
    }

    peer.on('call', onCall);

    function onCall(call)
    {
      console.log("Someone calling!");

      if(track != null)
      {
        console.log("Answer the call");
        call.answer(track);
      }
      else {
        call.close();
        console.log("Reject the call");
      }
    }

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
                    if (userlist[i].userid == response.userid) {
                        usertokick = i;
                        break;
                    }
                }

                userlist.splice(usertokick, i);

                var calltoremove = 0;
                for (var i = 0; i < calllist.length; i++) {
                    if (calllist[i].userid == response.userid) {
                        calltoremove = i;
                        break;
                    }
                }

                calllist.splice(calltoremove, i);

                console.log("CALL UPDATE", calllist);

                if (response.userid == socket.userid) {
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
                isMeHost = false;

                for (var i = 0; i < response.data.length; i++) {
                    userlist.push(response.data[i]);

                    if(userid == response.data[i].userid)
                    {
                      isMeHost = response.data[i].ishost;
                    }

                }

                console.log("User List", userlist);

                startVideoCall();

                $("#usercount").html(totalUser);
                break;
            case "get_message":
                printMessage(response.data);
                //console.log(" active users", response.data);
                break;

        }
    });

    sessionStorage.setItem("room", params.get('room'));
    sessionStorage.setItem("roomname", params.get('roomname'));

    if (sessionStorage.getItem("userid") == "null") {
        sessionStorage.setItem("userid", userid);
        sessionStorage.setItem("name", params.get('name'));
        sessionStorage.setItem("email", params.get('email'));
    } else {
        if (sessionStorage.getItem("name") != params.get('name') ||
            sessionStorage.getItem("email") != params.get('email')) {
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

    if (params.get('h') != 'undefined') {
        if (params.get('h') == "681c4ba5d874") {
            isHost = true;
        }
    };

    socket.emit("login", {
        name: socket.name,
        email: socket.email,
        room: socket.room,
        userid: socket.userid,
        roomname: socket.roomname,
        ishost: isHost
    });
    socket.emit("getRoomMembers");



    //console.log(sessionStorage.getItem("roomname"));

    $("#chat_submit").click(function () {
        sendChat();
    });

    $("#exit").click(function () {
        window.open(
            "./",
            "_self");
    });

    $("#copylink").click(function () {
        var url = rootUrl;
        url = url.concat(
            "?roomname=", encodeURIComponent(params.get('roomname')),
            "&room=", encodeURIComponent(params.get('room'))
        );

        var dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = url;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);

        alert("Room link has been copied!");
    });

    $("#settings").click(function () {
        console.log("settings");
    });

    function sendChat() {
        var message = $("#chat_input").val();
        $("#chat_input").val("");

        socket.emit("sendMessage", message);
    }

    var input = document.getElementById("chat_input");

    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {

            sendChat();
        }
    });

    function startVideoCall(dontrecall) {
        constraints = {
            video: {
                deviceId: {
                    exact: videoSelect.value
                }
            },
            audio: {
                deviceId: {
                    exact: audioSelect.value
                }
            }
        };


        if(!isMeHost)
        {
          constraints = {
              video: {
                  deviceId: {
                      exact: videoSelect.value
                  },
                  width: { min: 256, ideal: 256, max: 256 },
                  height: { min: 144, ideal: 144, max: 144 }
              },
              audio: {
                  deviceId: {
                      exact: audioSelect.value
                  }
              }
          };

          console.log("Not Host", constraints);
        }

        if(videoSelect.value == "Off")
        {
          constraints.video = false;

          $("#myVideoBase").hide();

          $("#settingsCenter1").show();
          $("#settingsCenter2").show();

          console.log("Hide my video");

          if (track != null)
              track.getTracks().forEach(function (t) {
                  t.stop();
              });

          var myVideoPlayer = document.getElementById('myVideo');
          myVideoPlayer.srcObject = null;

          for (var i = 0; i < calllist.length; i++) {
            calllist[i].close();
          }

          console.log(constraints);
        }
        else {
          $("#myVideoBase").show();

          $("#settingsCenter1").hide();
          $("#settingsCenter2").hide();

          console.log("Show my video");
        }

        if(audioSelect.value == "Off")
        {
          constraints.audio = false;
        }

        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        navigator.mediaDevices.getUserMedia(constraints).then(gotStream).catch(handleError);
/*
        peer.on('call', function(call) {
          navigator.getUserMedia(
            constraints
            , function(stream) {

        	console.log("Answer someone's call");
        	call.answer(stream);

          if(!dontrecall)
            callAllPeers(stream, true);

          }, function(err) {
        	   console.log('Failed to get local stream' ,err);
          });
        });
        */
    }

    function callPeer(userid, name, stream, ishost) {
        var call = peer.call(userid, stream, {
            metadata: {
                name: name,
                userid: userid
            }
        });

        call.on('stream', function (remoteStream) {

            //calllist.push(call);

            console.log("CALL LIST", calllist);

            var videobase = document.getElementById(userid.replace('-', ''));

            if (videobase == null && ishost != undefined) {
                if (!ishost) {
                    var videobase = document.getElementById(userid.replace('-', ''));
                    //console.log(videobase);
                    if (videobase == null) {
                        console.log("Create user's video", userid, ishost);

                        $("#otherVideos").append(otherVideos(userid));
                        playStream(userid, remoteStream);
                    }
                } else {

                    var videobase = document.getElementById(userid.replace('-', ''));

                    //console.log(videobase);

                    if (videobase == null) {
                        console.log("Create Host video", userid);
                        $("#hostVideoPlayer").remove();
                        $("#hostVideo").append(hostVideo(userid));
                        playStream(userid, remoteStream);
                    }
                }
            }
        });

        call.on('close', function (data) {
            console.log("Disconnected", data);
        });
    }

    function callAllPeers(stream, checkexist) {
        //console.log("Call all users in the room");

        for (var i = 0; i < userlist.length; i++) {
            if (userlist[i].userid != userid) {
                var call = true;
                if (checkexist) {
                    var videobase = document.getElementById(userlist[i].userid.replace('-', ''));

                    if (videobase != null)
                        call = false;
                }

                if (call) {
                    //console.log("Calling", userlist[i].userid);
                    callPeer(userlist[i].userid, userlist[i].name, stream, userlist[i].ishost);
                }
            }
        }
    }

    function gotStream(stream) {

        if (track != null)
            track.getTracks().forEach(function (t) {
                t.stop();
            });

        track = stream;

        var ishost = false;
        for (var i = 0; i < userlist.length; i++) {
            if (userlist[i].userid == userid && userlist[i].ishost == true) {
                ishost = true;
                break;
            }
        }

        if (ishost)
            $("#hostbadge").show();
        else
            $("#hostbadge").hide();

        if(ishost &&
              (
                params.get("room") == "44f59808-f378-4eed-bf0f-c5b13a919183" ||
                params.get("room") == "e576908c-0b73-4a1c-ab3d-02a02fd74d92" ||
                params.get("room") == "c170f800-b1bd-4a8e-b1a6-bbe495114718" ||
                params.get("room") == "604a7cf4-0bb8-43a9-8e7d-681c4ba5d874"
              )
           )
           {
             ishost = false;
           }

        console.log("HOST", ishost);

        if (ishost) {
            removeStream(userid);

            $("#yourCamera").remove();
            $("#hostVideoPlayer").hide();
            $("#myVideo").remove();
            $("#hostVideo").append(hostVideo(userid, true));
            playStream(userid, stream);
        } else {
            $("#hostVideoPlayer").show();
            playStream("myVideo", stream);
        }

        socket.on("message", function (response) {
            switch (response.type) {
                case "change_stream":
                    console.log("Change Stream", response);

                    removeStream(response.userid);

                    var calltoremove = -1;
                    for (var i = 0; i < calllist.length; i++) {
                        if (calllist[i].userid == response.userid) {
                            calltoremove = i;
                            break;
                        }
                    }

                    if(calltoremove != -1)
                    {
                      calllist[calltoremove].close();
                      calllist.splice(calltoremove, i);
                    }

                    console.log("CALL LIST AFTER REMOVE", calllist);

                    callPeer(response.userid, response.name, stream, response.ishost);
                    break;
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

    }

    function handleError(error) {

    }

    function playLiveStreamVideo(videoSrc)
    {
      try {
        var video = document.getElementById('hostVideoPlayer');

        if (Hls.isSupported())
        {
          var hls = new Hls();
          hls.loadSource(videoSrc);
          hls.attachMedia(video);
          hls.on(Hls.Events.MANIFEST_PARSED, function() {
            video.play();
          });
        }
        else if (video.canPlayType('application/vnd.apple.mpegurl')) {
          video.src = videoSrc;
          video.addEventListener('loadedmetadata', function() {
            video.play();
          });
        }
      } catch (e) {
        console.log(e);
      } finally {
        console.log("Done");
      }

    }

    $("#nav-home-tab-lobby").click(function () {
        $("#one-lobby").addClass("active").addClass("show");
        $("#two-lobby").removeClass("active").removeClass("show");
        $("#three-lobby").removeClass("active").removeClass("show");


        $("#nav-home-tab-lobby").addClass("active").addClass("show");
        $("#nav-profile-tab-lobby").removeClass("active").removeClass("show");
        $("#nav-contact-tab-lobby").removeClass("active").removeClass("show");


        $("#join-webminar").show();
        $("#join-music").hide();
        $("#join-conference").hide();
    });

    $("#nav-profile-tab-lobby").click(function () {
        $("#two-lobby").addClass("active").addClass("show");
        $("#one-lobby").removeClass("active").removeClass("show");
        $("#three-lobby").removeClass("active").removeClass("show");

        $("#nav-profile-tab-lobby").addClass("active").addClass("show");
        $("#nav-home-tab-lobby").removeClass("active").removeClass("show");
        $("#nav-contact-tab-lobby").removeClass("active").removeClass("show");

        $("#join-webminar").hide();
        $("#join-music").show();
        $("#join-conference").hide();
    });

    $("#nav-contact-tab-lobby").click(function () {
        $("#three-lobby").addClass("active").addClass("show");
        $("#two-lobby").removeClass("active").removeClass("show");
        $("#one-lobby").removeClass("active").removeClass("show");

        $("#nav-contact-tab-lobby").addClass("active").addClass("show");
        $("#nav-profile-tab-lobby").removeClass("active").removeClass("show");
        $("#nav-home-tab-lobby").removeClass("active").removeClass("show");

        $("#join-webminar").hide();
        $("#join-music").hide();
        $("#join-conference").show();
    });
});


function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = Math.random() * 16 | 0,
            v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

function printMessage(message) {
    var admintag = '';
    if (message.ishost) {
        admintag = '<span class="badge badge-primary">HOST</span>';
    }

    //console.log(message);

    switch (message.type) {
        case "new_user_login":
            $("#chatbox").append($("#messageuser").html().replace("##message##", message.name + " has joined the room"));
            break;
        case "user_left":
            $("#chatbox").append($("#messageuser").html().replace("##message##", message.name + " has left the room"));
            break;
        case "get_message":
            if (sessionStorage.getItem("userid") != message.userid)
                $("#chatbox").append($("#messagebox").html().replace("##message##", message.message).replace("##date##", message.date).replace("##time##", message.time).replace("##name##", admintag + ' ' + message.name));
            else
                $("#chatbox").append($("#mymessagebox").html().replace("##message##", message.message).replace("##date##", message.date).replace("##time##", message.time).replace("##name##", admintag + ' ' + message.name));
            break;

    }

    $("#chatbox").animate({
        scrollTop: $('#chatbox').prop("scrollHeight")
    }, 100);
}

function printPreviousMessage(messages) {
    for (var i = 0; i < messages.length; i++) {
        printMessage(messages[i]);
    }
}

function playStream(id, stream) {
    var video = document.getElementById(id.replace("-", ''));
    video.srcObject = stream;
    video.play();
}

function removeStream(userid) {
    var video = document.getElementById(userid.replace('-', ''));

    if (video != null)
        video.remove();

    var videobase = document.getElementById(userid.replace('-', ''));

    if (videobase != null)
        videobase.remove();
}

function hostVideo(id, muted) {
    id = id.replace('-', '');
    var mute = "controls";
    if (muted)
        mute += " muted";

    return '<video id="' + id + '" style="background-color:black; max-height: 90rem;" ' + mute + '></video>';
}

function otherVideos(id) {
    id = id.replace('-', '');
    return '<video class="col-lg-3" id="' + id + '" style="max-height: 10rem; max-width: 15rem;" muted poster="../img/participantscamera.png" controls></video>';
}

function UrlExists(url, cb){
    jQuery.ajax({
        url:      url,
        dataType: 'text',
        type:     'GET',
        complete:  function(xhr){
            if(typeof cb === 'function')
               cb.apply(this, [xhr.status]);
        }
    });
}
