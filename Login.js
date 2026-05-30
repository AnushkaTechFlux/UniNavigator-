$(document).ready(function(){
  // Smoothly transition from Login to Sign Up
  $('#oksignup').click(function(e){
    e.preventDefault();
    $('#login').fadeOut(250, function(){
      $('#signup').removeClass("reg").hide().fadeIn(250);
      $('#login').addClass("reg");
    });
  });

  // Smoothly transition from Sign Up to Login
  $('#oklogin').click(function(e){
    e.preventDefault();
    $('#signup').fadeOut(250, function(){
      $('#login').removeClass("reg").hide().fadeIn(250);
      $('#signup').addClass("reg");
    });
  });
});
