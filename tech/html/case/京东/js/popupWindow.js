//一二三级导航
$(".nav_list  ul li").each(function (index) {
    $(this).hover(function () {
        if ($("#popup").is(":hidden")) {
            $("#popup").show();
        }
        $(".section").removeClass("active");

        $(".section").eq(index).addClass("active");
        console.log(index);
    }, function () {
        $("#popup").hide();
    });
});
$(".popup .section").hover(function () {
    $("#popup").show();
}, function () {
    $("#popup").hide();
});

// 红灰色二级标题
$(".brands a").hover(function () {
    $(".brands a").removeClass("active");
    $(this).addClass("active");
});

//配送城市显示与隐藏 --- 鼠标悬停事件
$("#city").hover(function () {
    $(".someCity").show();
}, function () {
    $(".someCity").hide();
});
$(".someCity").hover(function () {
    $(this).show();
}, function () {
    $(this).hide();
});

//配送城市选择下拉列表点击事件
$(".someCity ul li a").click(function () {
    // 送至：北京<span>◇</span>
    console.log("sos");
    $("#city").html("<i class='fa fa-map-marker'></i>" + $(this).html() + "<span>◇</span>");
    $(".someCity").hide();
});

