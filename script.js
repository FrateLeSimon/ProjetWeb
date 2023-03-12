
$('#btn_contact1, #btn_contact2').click(function(event) {
      // Empêcher le comportement de lien par défaut pour éviter que la page ne se recharge
    event.preventDefault();
  
    // Supprimer la classe "highlight" de toutes les sections
    $('section').removeClass('highlight');
  
    // Ajouter la classe "highlight" à la section correspondante
    const targetId = $(this).attr('href');
    $(targetId).addClass('highlight');

    $('html, body').scrollTop($(targetId).offset().top);
    event.stopPropagation();
    
    $(document).on('click', function() {
        $(targetId).removeClass('highlight');
    });

});




$('#btn_popup1, #btn_popup2').click(function() {
    event.stopPropagation();
    $('.overlay').fadeIn();
    $('.popup').fadeIn();
  });
  
  $('.close-popup').click(function() {
    $('.overlay').fadeOut();
    $('.popup').fadeOut();
  });

$(document).on('click', function(event) {
    if (!$(event.target).closest('.popup').length) {
        $('.overlay').fadeOut();
        $('.popup').fadeOut();
    }
  });