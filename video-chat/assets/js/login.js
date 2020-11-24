var socketIoConnectionUrl = "https://playbox.biz.id/";

$(function () {
  sessionStorage.setItem("userid",null);

  $("#loginToRoom").click(function(){

      if($("#loginName").val().length < 2 || $("#loginEmail").val().length < 2)
      {
          alert("Please fill name and email");
      }
      else
      {
          var url = './room.php';
          window.open(
            url.concat(
              "?name=",$("#loginName").val(),
              "&email=",$("#loginEmail").val(),
              "&roomname=",$("#roomname").val(),
              "&room=",$("#room").val(),
              "&lobby=",$("#loginIsLobby").val(),
          ),
          "_self");
      }
  });

  $("#loginToNewRoom").click(function(){

      if($("#loginName").val().length < 2 || $("#loginEmail").val().length < 2)
      {
          alert("Please fill name and email");
      }
      else
      {
          $("#newRoomModal").show();
      }
  });

  $("#loginCreateRoom").click(function(){
      if($("#newRoomNameInput").val().length < 2)
      {
          alert("Room name must be more than 3 character");
      }
      else
      {
        $.get(
            socketIoConnectionUrl + 'new',
            function(data, status){

              console.log(data);

              var url = './room.php';
              url = url.concat(
                "?roomname=",$("#newRoomNameInput").val(),
                "&h=",'681c4ba5d874',
                "&room=",data.roomID,
                "&name=",$("#loginName").val(),
                "&email=",$("#loginEmail").val(),
                "&lobby=",'false',
              );

              console.log(url);

              window.open(
                url,
              "_self");
        });
      }
  });
});

function closeModal()
{
  $("#newRoomModal").hide();
}
