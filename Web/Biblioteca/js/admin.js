$( document ).ready(function(){

  $(".button-collapse").sideNav();
  $('select').material_select();
  $('.modal').modal();

  $("#form_sendContent").on('submit',(function(e) {

    e.preventDefault();

    if(!$('#file').prop('files')[0]){
      Materialize.toast('No hay seleccionado ningún archivo', 5000, 'rounded red lighten-2');
      return;
    }

    printLoadData();

    var request = $.ajax({
      url: "./routes/uploadFile.php", // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false,       // The content type used when sending data to the server.
      cache: false,             // To unable request pages to be cached
      processData:false         // To send DOMDocument or non processed data file it is set to false
    });

    request.done(function(msg) {

      if (msg == "ok") finishLoadData();

    });

    request.fail(function( jqXHR, textStatus ) {

      alert( "Request failed: " + textStatus );

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
        $("#sendUser").before('<p class="user-text">'+ msg["username"] +' <a id="'+ msg["username"] +'" onclick="deleteUser(this.id);" class="btn-floating btn-delete red lighten-1"><i class="material-icons">delete_forever</i></a></p>');

      }else {

        Materialize.toast(msg["error"], 4000, 'rounded red lighten-2');

      }

    });

    request.fail(function( jqXHR, textStatus ) {

      alert( "Request failed: " + textStatus );

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

    alert( "Request failed: " + textStatus );

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
        $("#"+id).parent().remove();

      } else {

        Materialize.toast(msg, 4000, 'rounded red lighten-2');

      }
    });

    request.fail(function( jqXHR, textStatus ) {

      alert( "Request failed: " + textStatus );

    });

  }


}

function printLoadData() {

  $('#form_sendContent').hide();
  $('#preloader').show();

}

function finishLoadData() {

  $('#finishUpload').show();
  $('#preloader').hide();

}

function resetView(){

  $('#form_sendContent').show();
  $('#preloader').hide();
  $('#finishUpload').hide();

}
