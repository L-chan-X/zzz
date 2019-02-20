$(() => {
  $("#add-user-btn").on('click', function(){
    $("#add-user").dialog("open");
  });
  $(".edit-user-btn").on('click', function(){
    var data = $(this).eq(0).siblings().slice(1).map(function() {
      return $(this).text();
    });
    $("#edit-id").val(data[0]);
    $("#edit-name").val(data[1]);
    $("#edit-account").val(data[2]);
    $("#edit-password").val(data[3]);    
    $("#edit-admin").prop("checked", data[4] == 2);
    $("#edit-userx").prop("checked", data[4] == 1);
    $("#edit-user").dialog("open");
    
  });
  $("#srch-btn").on('click', function(){
    if($("#srch-txt").val() != "")
      location.href = "maneger.php?srch-txt=" + $("#srch-txt").val();
  });
  $("#logout").on('click', function(){
    $.ajax("logout.php");
    location.href = "index.php";
  });
  $("#recordlog-btn").on('click',function(){
    $.get('log.ini', function(data) {
      $("#recordlog-box p").html(data.replace(/\n/g,"<br/>"));
    }, 'text');
    $("#recordlog-box").dialog("open");
  });
  $("#user-data th:gt(1):lt(3)").on('click', function(){
    var table = $(this).parents("table");
    var rows = table.find("tr:gt(0)").toArray().sort(cmp($(this).index()));    
    if(this.less == undefined)
      $(this).children("span").removeClass("ui-icon-triangle-2-n-s").toggleClass("ui-icon-triangle-1-s");
    this.less = !this.less;
    $(this).children("span").toggleClass("ui-icon-triangle-1-n").toggleClass("ui-icon-triangle-1-s");
    if(!this.less) {
      rows.reverse();      
    }
    for(row of rows){
      table.append(row);
    }
  })
  function cmp(index){
    return function(x, y){
      x = getculumn(x, index); y = getculumn(y, index);
      return $.isNumeric(x) && $.isNumeric(y) ? (x - y) : (x.toString().localeCompare(y.toString(), "zh-Hant"));
    }
  }
  function getculumn(row, index){
    return $(row).children("td").eq(index).text();
  }  
  $("#add-user, #edit-user, #recordlog-box").dialog({
    autoOpen: false,
    modal: true,
    height: 275,
    width: 370,
    buttons: {
      "確定": function(){
        $(this).submit();
      },
      "取消": function(){
        $(this).dialog("close");
      }
    }
  });  
  $("#add-user").dialog({    
    title: "新增使用者"
  });
  $("#edit-user").dialog({    
    title: "修改使用者",
    height: 300,
    buttons: {
      "確定": function(){
        $("#edit-id").prop("disabled", false);
        $(this).submit();
      },
      "取消": function(){
        $(this).dialog("close");
      }
    }
  });
  $("#recordlog-box").dialog({    
    title: "紀錄",
    height: 600,
    width: 1000,
    buttons: {
      "確定": function(){
        $(this).dialog("close");
      }
    }
  });
  $(".del-user-btn").on('click', function(){
    $.post({
      url:"del-user.php",
      data:{
        "del-id": $(this).parents("tr").attr("pid")
      }
    }).done(function(url){
      location.href = url;
    })
  });
});