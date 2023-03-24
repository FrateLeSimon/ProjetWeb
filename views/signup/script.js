$(document).ready(function() {
    $('#page1 form').submit(function(event) {
      event.preventDefault(); // empêcher le comportement par défaut de l'envoi du formulaire

      $("#page1").hide(); // cacher le formulaire
      $("#page2").show(); // afficher la page 2
    });
  });



  
$('.return').click(function() {
    $("#page2").hide(); 
    $("#page1").show(); 
});
