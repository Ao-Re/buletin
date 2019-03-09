var postvalid = {
  content: false,
  captcha: false
};
$('.trigger-post').click(function(e) {
  $('#content').focus();
});
$('#content')
  .one('focus', function(e) {
    $(this)
      .attr('rows', '3')
      .css('overflow', 'hidden')
      .autogrow({ horizontal: false });
    $('#post-footer').removeClass('d-none');
  })
  .on('input', e => validateContent());
function validateContent() {
  var selector = '#content';
  var content = $(selector).val();
  var err = null;
  if (content.length > 300) {
    $(selector).addClass('is-invalid');
    err = 'Post cannot exceed 300 characters';
    $(selector + '-invalid').html(err);
    setPostValid('content', false);
    return;
  }
  $(selector).removeClass('is-invalid');
  setPostValid('content', content.length !== 0);
}
function postCaptcha() {
  setPostValid('captcha', grecaptcha.getResponse().length !== 0);
}
function setPostValid(key, flag) {
  postvalid[key] = flag;
  $('#post-submit').prop('disabled', !(postvalid.content && postvalid.captcha));
}
