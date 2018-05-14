$(".public .nav li a").hover(
    function () {
        $(".public .nav li").removeClass("active");
        $(".public .nav").find("li:eq(0)").addClass("active");
        $(this).parent().parent().find("li:eq(0)").removeClass("active");
        $(this).parent().addClass("active");
        $(".public .main .main_wrap .li").css("display", "none");
        $(".public .main .main_wrap .li").eq(0).css("display", "inline-block");
    }, function () {

    });

//public - icon 鼠标悬停图片上移
$(".public .icon li a").hover(function () {
    // transform: translateY(-8px);;
    $(this).find("img").css("transform", "translateY(-8px)");
}, function () {
    $(this).find("img").css("transform", "translateY(0)");
});

// page1 nav li 关联 m_inner 与 m_list 的动态切换
$(".page1 .nav li").each(function (index) {
    $(this).hover(function () {
        console.log("page1 ");
        $(".page1 .main .main_wrap .li").css("display", "none");
        $(".page1 .main .main_wrap .li").eq(index).css("display", "inline-block");
    });
});

//锚链接过渡动画
$(document).ready(function () {
    $('a[href*=#]').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
            if ($target.length) {
                var targetOffset = $target.offset().top;
                $('html,body').animate({
                        scrollTop: targetOffset
                    },
                    1000);
                return false;
            }
        }
    });
});