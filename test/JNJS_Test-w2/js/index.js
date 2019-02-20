// JavaScript Document
$(() => {
  var captcha = () => {
    $("#captcha-box, #captcha-img-box").empty();
    for(var w = 0; w < 4; ++w){ 
      var img = $("<img>");
      img.attr("src", "image/captcha.php/?index=" + w);
      img.attr("index", w);
      $("#captcha-img-box").append(img);
      $("#captcha-box").append("<div></div>");
    }
    $("input[name=ccaptcha]").val('');
    $("#captcha-img-box img").draggable({
      revert: 'invalid',
      snap: '#captcha-box div',
      snapMode: 'inner'      
    });
    $("#captcha-box div").droppable({
      drop: function(event, ui) {
        ui.helper.appendTo(this).css({
          top: 0, left: 0
        });
      }
    });
    var code = '';
    $("#submitf").on('click', () => {
      $("#captcha-box img").each(function(){        
        code += $(this).attr("index");
      });
      $("input[name=ccaptcha]").val(code);
      $('#nbox-container').dialog("open");
    });
  }
  $("input[name=recaptcha]").on('click', () => captcha());
  $("#enp").on('click', () => location.href = "enp.php");  
  $("#nbox-container").dialog({
    appendTo: "#login",
    autoOpen: false,
    modal: true,
    height: 680,
    width: 500,
    title: "第二層驗證",
    resizable: false,
    buttons: {
      "送出": () => {
       $("#login").submit();
       $("#nbox-container").dialog("close");
      },
      "取消": () => $("#nbox-container").dialog( "close" )      
    },
    close: () => $(".nbox-input").prop('checked', false)
  });
  captcha();
});