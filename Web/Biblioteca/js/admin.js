$( document ).ready(function(){

  $(".button-collapse").sideNav();
  $('select').material_select();
  $('.modal').modal();

  $("#form_sendContent").on('submit',(function(e) {

    e.preventDefault();

    initLoadData();

    var request = $.ajax({
      url: "./routes/uploadFile.php", // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false,       // The content type used when sending data to the server.
      cache: false,             // To unable request pages to be cached
      processData:false         // To send DOMDocument or non processed data file it is set to false
    });

    request.done(function(msg) {

      if (msg == "ok"){

        finishLoadData();

      } else {

        Materialize.toast(msg, 4000, 'rounded red lighten-2');
        resetView();

      }

    });

    request.fail(function( jqXHR, textStatus ) {

      //alert( "Request failed: " + textStatus );
      Materialize.toast("Se ha producido un error desconocido.", 6000, 'rounded red lighten-2');

    });

  }));


  $("#form_addUser").on('submit',(function(e) {

    e.preventDefault();

    var request = $.ajax({
      url: "./routes/addUser.php", // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false,       // The content type used when sending data to the server.
      cache: false,             // To unable request pages to be cached
      processData:false         // To send DOMDocument or non processed data file it is set to false
    });

    request.done(function(msg) {

      msg = JSON.parse(msg);

      if (msg["success"] == "ok"){

        Materialize.toast('El usuario fue añadido con éxito.', 4000, 'rounded teal');
        $("#usernames").append('<div class="height-45"><span id="span'+ msg["username"] +'" class="user-text">'+ msg["username"] +'</span></div>');
        $("#deleteButtons").append('<div class="height-45"><a id="a'+ msg["username"] +'" onclick="deleteUser(\''+ msg["username"] +'\');" class="btn-floating btn-delete red lighten-2"><i class="material-icons">delete_forever</i></a></div>');

      }else {

        Materialize.toast(msg["error"], 4000, 'rounded red lighten-2');

      }

    });

    request.fail(function( jqXHR, textStatus ) {

      //alert( "Request failed: " + textStatus );
      Materialize.toast("Se ha producido un error desconocido.", 6000, 'rounded red lighten-2');

    });

  }));

});


function deleteContent() {

  var request = $.ajax({
    url: "./routes/deleteContent.php", // Url to which the request is send
    type: "POST",             // Type of request to be send, called as method
    cache: false,             // To unable request pages to be cached
    processData:false         // To send DOMDocument or non processed data file it is set to false
  });

  request.done(function(msg) {

    if (msg == "ok") Materialize.toast("Se eliminó el contenido con éxito.", 6000, 'rounded red lighten-2');

  });

  request.fail(function( jqXHR, textStatus ) {

    Materialize.toast("Se ha producido un error desconocido.", 6000, 'rounded red lighten-2');
    //alert( "Request failed: " + textStatus );

  });

}

function deleteUser(id) {

  var msg = "¿Estás seguro de que quieres eliminar el usuario " + id + "?";

  if (confirm(msg)) {

    var request = $.ajax({
      url: "./routes/deleteUser.php", // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: {username: id},     // ID del usuario que elimino
      cache: false              // To unable request pages to be cached
    });

    request.done(function(msg) {

      if (msg == "ok"){

        Materialize.toast("El usuario fue eliminado con éxito.", 4000, 'rounded teal');
        $("#a"+id).parent().remove();
        $("#span"+id).parent().remove();

      } else {

        Materialize.toast(msg, 4000, 'rounded red lighten-2');

      }
    });

    request.fail(function( jqXHR, textStatus ) {

      //alert( "Request failed: " + textStatus );
      Materialize.toast("Se ha producido un error desconocido.", 6000, 'rounded red lighten-2');

    });

  }

}

function initLoadData() {

  $('#preloader').hide();
  $('#form_sendContent').hide();
  $('#preloader').show();

}

function finishLoadData() {

  $('#finishUpload').show();
  $('#form_sendContent').hide();
  $('#preloader').hide();

}

function resetView(){

  $('#preloader').hide();
  $('#finishUpload').hide();
  $('#form_sendContent').show();

}
