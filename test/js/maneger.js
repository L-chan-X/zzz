$(() => {
  var setTime = 60, time = setTime, timespan = $("#time-span");
  var stopwatch = setTimeout(function count(){
    --time;
    timespan.text(time);
    if(time <= 0){
      clearTimeout(stopwatch);
      $("#time-check-box").dialog("open");
    }else{
      stopwatch = setTimeout(count, 1000);
    }
  }, 1000);
  $("#add-user, #edit-user, #recordlog-box, #time-check-box, #time-set").dialog({
    autoOpen: false,
    modal: true,
    height: 275,
    width: 370,
    buttons: {
      "確定": function () {
        $(this).submit();
      },
      "取消": function () {
        $(this).dialog("close");
      }
    }
  });
  $("#add-user-btn").on('click', function () {
    $("#add-user").dialog("open");
  });
  $("#time-check-reset").on('click',function(){
    time = setTime;
    timespan.text(time);
  })
  var timeDialogBox = $('<div><input type="text" id="time-set"></div>').dialog({
    autoOpen: false,
    modal: true,
    title: "設定時長",
    buttons: {
      "確定": function () {
        time = setTime = $("#time-set").val();
        timespan.text(time);
        $(this).dialog("close");
      },
      "取消": function () {
        $(this).dialog("close");
      }
    }
  });
  $("#time-check-set").on('click', function(){
    timeDialogBox.dialog("open");
  });
  $(".edit-user-btn").on('click', function () {
    var data = $(this).eq(0).siblings().slice(1).map(function () {
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
  $("#srch-btn").on('click', function () {
    if ($("#srch-txt").val() != "")
      location.href = "maneger.php?srch-txt=" + $("#srch-txt").val();
  });
  $("#logout").on('click', function () {
    $.ajax("logout.php");
    location.href = "index.php";
  });
  $("#recordlog-btn").on('click', function () {
    $.get('log.ini', function (data) {
      $("#recordlog-box p").html(data.replace(/\n/g, "<br/>"));
    }, 'text');
    $("#recordlog-box").dialog("open");
  });
  $("#user-data th:gt(1):lt(3)").on('click', function () {
    var table = $(this).parents("table");
    var rows = table.find("tr:gt(0)").toArray().sort(cmp($(this).index()));
    if (this.less == undefined)
      $(this).children("span").removeClass("ui-icon-triangle-2-n-s").toggleClass("ui-icon-triangle-1-s");
    this.less = !this.less;
    $(this).children("span").toggleClass("ui-icon-triangle-1-n").toggleClass("ui-icon-triangle-1-s");
    if (!this.less) {
      rows.reverse();
    }
    for (row of rows) {
      table.append(row);
    }
  })
  function cmp(index) {
    return function (x, y) {
      x = getculumn(x, index); y = getculumn(y, index);
      return $.isNumeric(x) && $.isNumeric(y) ? (x - y) : (x.toString().localeCompare(y.toString(), "zh-Hant"));
    }
  }
  function getculumn(row, index) {
    return $(row).children("td").eq(index).text();
  }
  $("#add-user").dialog({
    title: "新增使用者"
  });
  $("#edit-user").dialog({
    title: "修改使用者",
    height: 300,
    buttons: {
      "確定": function () {
        $("#edit-id").prop("disabled", false);
        $(this).submit();
      },
      "取消": function () {
        $(this).dialog("close");
      }
    }
  });
  $("#recordlog-box").dialog({
    title: "紀錄",
    height: 600,
    width: 1000,
    buttons: {
      "確定": function () {
        $(this).dialog("close");
      }
    }
  });
  var stopwatch2;
  $("#time-check-box").dialog({
    title: "是否繼續操作?",
    buttons: {
      "是": function () {
        $("#time-p").hide();
        clearTimeout(stopwatch2);
        $("#time-check-box").dialog("close");
      },
      "否": function () {
        $("#logout").click();
      }
    },
    open: function(){
      var time = 5, timespan = $("#time-check-span");
      stopwatch2 = setTimeout(function count(){
        --time;
        timespan.text(time);
        if(time <= 0){          
          $("#logout").click();
        }else{
          stopwatch2 = setTimeout(count, 1000);
        }
      }, 1000);
    }    
  });  
  $(".del-user-btn").on('click', function () {
    $.post({
      url: "del-user.php",
      data: {
        "del-id": $(this).parents("tr").attr("pid")
      }
    }).done(function (url) {
      location.href = url;
    })
  });
});