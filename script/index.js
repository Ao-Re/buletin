$('#content').click(function(e) {
  $(this).attr('rows', '3').css('overflow', 'hidden').autogrow({horizontal: false});
  $('#post-footer').removeClass('d-none').slideDown();
})
$('#content2').click(function(e) {
  $(this).attr('rows', '3').css('overflow', 'hidden').autogrow({horizontal: false});
}) 

