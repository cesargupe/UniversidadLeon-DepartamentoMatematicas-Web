$( document ).ready(function(){

  $(".button-collapse").sideNav();
  $('select').material_select();

  $("#form").on('submit',(function(e) {

    e.preventDefault();

    if(!$('#file').prop('files')[0]){
      Materialize.toast('No hay seleccionado ningún archivo', 5000, 'rounded red');
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

      //alert(msg);
      if(msg == "ok") finishLoadData();

    });

    request.fail(function( jqXHR, textStatus ) {

      alert( "Request failed: " + textStatus );

    });

  }));

});

function printLoadData() {

  $('#form').hide();
  $('#preloader').show();

}

function finishLoadData() {

  $('#finishUpload').show();
  $('#preloader').hide();

}

function resetView(){

  $('#form').show();
  $('#preloader').hide();
  $('#finishUpload').hide();

}
