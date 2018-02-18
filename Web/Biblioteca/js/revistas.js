$( document ).ready(function(){

  $(".button-collapse").sideNav();
  $('.modal').modal();

});

function moreSize(id) {

  $('#' + id).removeClass('truncate');

  $('#moreSize' + id).hide();
  $('#lessSize' + id).show();

}

function lessSize(id) {

  $('#' + id).addClass('truncate');

  $('#lessSize' + id).hide();
  $('#moreSize' + id).show();

}
