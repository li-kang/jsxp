// 漂浮挂件 js 部分

// 1.楼层导航
// 需求1：active 根据屏幕滚轮动态变化 class 所属索引
// 需求2：active 的事件为 a 标签显示，span 标签隐藏
$("#floorNavs").find("ul li").hover(function () {
    $("#floorNavs").find("ul li").removeClass("active");
    $(this).addClass("active");
});

function showFloorNavs(index) {
    $("#floorNavs").find("ul li").removeClass("active");
    $("#floorNavs").find("ul li").eq(index).addClass("active");
}

function missFloorNavs(boolean) {
    if (boolean === true) {
        $("#floorNavs").css("display", "none");
    } else {
        $("#floorNavs").css("display", "inline-block");
    }
}

//屏幕窗口  ---  鼠标滚动监控
$(document).ready(function () {
    var y;// y 轴偏移量
    var grace = 200;//预留偏移量
    var myIndex = [1735, 2503, 3249, 3857, 4465, 5211,
        5819, 6427, 7035, 7781, 8389, 8997];
    $(window).scroll(function () {
        y = $(window).scrollTop();
        missFloorNavs(false);
        if (y <= 950) {
            missFloorNavs(true);
        } else if (y <= myIndex[0] + grace) {
            showFloorNavs(0);
        } else if (y <= myIndex[1] + grace) {
            showFloorNavs(1);
        } else if (y <= myIndex[2] + grace) {
            showFloorNavs(2);
        } else if (y <= myIndex[3] + grace) {
            showFloorNavs(3);
        } else if (y <= myIndex[4] + grace) {
            showFloorNavs(4);
        } else if (y <= myIndex[5] + grace) {
            showFloorNavs(5);
        } else if (y <= myIndex[6] + grace) {
            showFloorNavs(6);
        } else if (y <= myIndex[7] + grace) {
            showFloorNavs(7);
        } else if (y <= myIndex[8] + grace) {
            showFloorNavs(8);
        } else if (y <= myIndex[9] + grace) {
            showFloorNavs(9);
        } else if (y <= myIndex[10] + grace) {
            showFloorNavs(10);
        } else {
            showFloorNavs(11);
        }
    });
});

//右侧六倍图标悬停事件
$("#iconNavs").find("ul li").hover(function () {
    console.log("sos");
    $(this).find("a").css("background-color", "#c81623");
    $(this).find("span").css("background-color", "#c81623");
    $(this).find("span").css("transform","translate(-65px,0)");
}, function () {
    $(this).find("a").css("background-color", "#7a6e6e");
    $(this).find("span").css("background-color", "#7a6e6e");
    $(this).find("span").css("transform","translate(0,0)");
});
$("#someNavs").find("ul li").hover(function () {
    console.log("sos");
    $(this).find("a").css("background-color", "#c81623");
    $(this).find("span").css("background-color", "#c81623");
    $(this).find("span").css("transform","translate(-50px,0)");
}, function () {
    $(this).find("a").css("background-color", "#7a6e6e");
    $(this).find("span").css("background-color", "#7a6e6e");
    $(this).find("span").css("transform","translate(0,0)");
    $("#someNavsLast").css("background","#c81623");
});