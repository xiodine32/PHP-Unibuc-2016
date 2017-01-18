/**
 * Created by xiodine on 1/18/2017.
 */
(function () {
    var lastX = 0;
    var lastY = 0;
    $("body").mousemove(function (e) {
        lastX = e.pageX;
        lastY = e.pageY;
    });
    var code = function () {
        $.ajax('/admin/stats?x=' + lastX + "&y=" + lastY, {
            method: "PUT",
            success: function (e) {
                if (window.hookedUp)
                    window.hookedUp(e);
            }
        });
    };
    setInterval(code, window.timeInterval);
    setTimeout(code, 13);
})();
