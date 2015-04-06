/*
#################################
##          OneClickMoney      ## 
##    http://oneclickmoney.ru  ##
##     27.03.2015, 17:23:12    ##
##  author: Victor Shumeyko    ##
##  Предназначение :           ##
#################################
*/
$(document).ready(function() {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});
  $('.setAnswer').click(function() {
        var id = $(this).attr('data-id');
        $('#forummessage-answer').val(id);
        $('#forummessage-answer').parent().addClass('has-success');
        $('#answer').removeClass('hidden');
        $('#answer').find('b').text(id);
        $('html, body').stop().animate({
           scrollTop: $('#forummessage-message').offset().top
        }, 1000);
  });
  $('.setQuote').click(function() {
        var id = $(this).attr('data-id');
        var message = $('#message-'+id).find('.panel-body').eq(0).text();
        $('#forummessage-message').val(message);
        $('html, body').stop().animate({
           scrollTop: $('#forummessage-message').offset().top
        }, 1000);
  });
  $('.close').click(function() {
      var id = $(this).attr('data-id');
      var type = $(this).attr('data-type');
      $.ajax({
          url: '/forum/delete/',
          type: 'post',
          data: {
              id:id,
              type:type
          },
          success: function(html) {
              var data = JSON.parse(html);
              if (data.status == 1) {
                  $('#message-'+id).slideUp(500);
                  setSuccess('Удаление прошло успешно!');
              }
          }
      });
  });
$('#login-show').click(function() {
    $('#login-box').fadeIn(1000);
});

function closeAlert() {
    $('.alert').fadeOut(1000);
}
function setSuccess(text) {
    closeAlert();
    $('#success-message-text').text(text);
    $('#success-message').show();
}

function setError(text) {
    closeAlert();
    $('#error-message-text').text(text);
    $('#error-message').show();
}