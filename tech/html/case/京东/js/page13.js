//13F鼠标悬停商品摆动
$("#page13_ul").find("li").hover(function () {
    $(this).find("a .pic img").css("-webkit-transform","scale(1.3)");
    $(this).find("a .pic img").css("-moz-transform","scale(1.3)");
    $(this).find("a .pic img").css("-ms-transform","scale(1.3)");
    $(this).find("a .pic img").css("-o-transform","scale(1.3)");
    $(this).find("a .pic img").css("transform","scale(1.3)");
},function () {
    $(this).find("a .pic img").css("-webkit-transform","scale(1)");
    $(this).find("a .pic img").css("-moz-transform","scale(1)");
    $(this).find("a .pic img").css("-ms-transform","scale(1)");
    $(this).find("a .pic img").css("-o-transform","scale(1)");
    $(this).find("a .pic img").css("transform","scale(1)");
});

//最左侧的大图悬停动画
$("#page13_pic").hover(function () {
    // console.log("sos");
    $(this).find("img").css("-webkit-transform","scale(1.2)");
    $(this).find("img").css("-moz-transform","scale(1.2)");
    $(this).find("img").css("-ms-transform","scale(1.2)");
    $(this).find("img").css("-o-transform","scale(1.2)");
    $(this).find("img").css("transform","scale(1.2)");
},function () {
    $(this).find("img").css("-webkit-transform","scale(1)");
    $(this).find("img").css("-moz-transform","scale(1)");
    $(this).find("img").css("-ms-transform","scale(1)");
    $(this).find("img").css("-o-transform","scale(1)");
    $(this).find("img").css("transform","scale(1)");
});

//上下轮播评论  鼠标悬停暂停/运行 animation
$("#page13_sCon").hover(function () {
    $(this).css("animation-play-state","paused");//暂停
},function () {
    $(this).css("animation-play-state","running");//运行
});