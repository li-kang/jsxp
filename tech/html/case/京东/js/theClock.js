var h = document.getElementById("hours");
var m = document.getElementById("minutes");
var s = document.getElementById("seconds");
var today = document.getElementById("today");

function newDate() {
    var myDate, myDate_h, myDate_m, myDate_s;
    myDate = new Date();//获得系统时间
    myDate_h = myDate.getHours();//时
    myDate_m = myDate.getMinutes();//分
    myDate_s = myDate.getSeconds();//秒
    today.innerHTML = myDate_h + " : " + myDate_m + " : " + myDate_s;
    s.style.transition = "all 1ms";
    s.style.transform = "rotate(" + (myDate_s * 6 + 45) + "deg)";
    m.style.transform = "rotate(" + (myDate_m * 6 + myDate_s / 10) + "deg)";
    h.style.transform = "rotate(" + (myDate_h * 30 + myDate_m / 5 ) + "deg)";
}

window.setInterval("newDate()", 1000);

$(".today").hover(function () {
    $("#recommend_today").css({
        "opacity": "0",
        "transform":"scale(2.4,2.4)"
    });
    $("#today").css({
        "opacity": '1',
        "transform":"scale(1,1)"
    });
}, function () {
    $("#today").css({
        "opacity": '0',
        "transform":"scale(2.4,2.4)"
    });
    $("#recommend_today").css({
        "opacity": "1",
        "transform":"scale(1,1)"
    });
});