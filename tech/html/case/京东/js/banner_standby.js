$(document).ready(function () {
    slider('#slider');
});

function slider(id) {
    fir = $(id + ' li:first');
    fir.addClass("active");
    $(id + ' li').not(':first').hide();
    setInterval(function () {
        act = $(id + ' li.active');
        if (act.next().val() !== undefined) {
            act.fadeOut(0, function () {
                act.next().fadeIn();
                act.removeClass("active");
                act.next().addClass("active");
            });
        } else {
            act.hide(0, function () {
                fir.show();
                act.removeClass("active");
                fir.addClass("active");
            });
        }
    }, 2000);
}