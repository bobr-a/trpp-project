var page = 1;
var position = 1;
var isAnim = true;


var heroArray = [
    '../img/bg_play.png',
    '../img/bg_play2.png',
    '../img/bg_play3.png'
]
function preCacheHeros(){
  $.each(heroArray, function(){
      var img = new Image();
      img.src = this;
  });
};

$(window).on('load', function(){
    preCacheHeros();
});

var marginLeft = parseFloat($('.footering').css('margin-top'));

var contentHeight = window.outerHeight - getFooterHeading();
console.log(contentHeight);

window.onresize = function (event) {
    var contentHeight = window.outerHeight - getFooterHeading();
    if (contentHeight <= 799 && contentHeight > 0) {
        $('section').css('height', contentHeight);
    }
};

if (contentHeight <= 799 && contentHeight > 0) {
    $('section').css('height', contentHeight);
}
setTimeout(function () { isAnim = false; }, 1500);
startAnim();
$(this).on('mousewheel', function (e) {
    if (!isAnim) {
        $(".download_container").ready(function () {
            if (e.deltaY > 0) {
                if (position > 1) {
                    isAnim = true;
                    if (position == 2) {
                        position -= 1;
                        pageOptions(position, ".download_container");
                    }
                    else if (position == 3) {
                        position -= 1;
                        pageOptions(position, ".setup_container");
                    }
                    setTimeout(function () { isAnim = false; }, 2200);
                }
            } else {
                if (position < 3) {
                    isAnim = true;
                    if (position == 1) {
                        position += 1;
                        pageOptions(position, ".video_container");
                    }
                    else if (position == 2) {
                        position += 1;
                        pageOptions(position, ".download_container");
                    }
                    setTimeout(function () { isAnim = false; }, 2200);
                }
            }
        });
    }
});

$("section").swipe({
    swipeStatus: function (event, phase, direction) {
        if (!isAnim) {
            $(".download_container").ready(function () {
                if (phase == "end") {
                    if (direction == 'left') {
                        if (position < 3) {
                            isAnim = true;
                            if (position == 1) {
                                position += 1;
                                pageOptions(position, ".video_container");
                            }
                            else if (position == 2) {
                                position += 1;
                                pageOptions(position, ".download_container");
                            }
                            setTimeout(function () { isAnim = false; }, 2200);
                        }
                    }
                    if (direction == 'right') {
                        if (position > 1) {
                            isAnim = true;
                            if (position == 2) {
                                position -= 1;
                                pageOptions(position, ".download_container");
                            }
                            else if (position == 3) {
                                position -= 1;
                                pageOptions(position, ".setup_container");
                            }
                            setTimeout(function () { isAnim = false; }, 2200);
                        }
                    }
                }
            });
        }
    },
    threshold:10
});
function getFooterHeading() {
    if (window.outerWidth <= 780) {
        var heightFoot = 59;
    }
    else {
        var heightFoot = 39;
    }
    var marginTopFoot = parseFloat($('.footering').css('margin-top'));
    var marginBottomFoot = parseFloat($('.footering').css('margin-bottom'));
    var heading = $(".heading").outerHeight(true);
    return heightFoot + heading + marginBottomFoot + marginTopFoot;
}

function pageOptions(page, classEl) {
    if (page == 1) {
        $(".bg").css({
            "background": "url(../img/bg_play.png) no-repeat center top / auto black",
            "background-size": "cover",
            "background-position": "50% 50%"
        });
        $(classEl).fadeOut(1000);
        setTimeout(download, 1000, ".video_container");
        $(".round_one").css("left", "6.77vw");
        $(".round_two").css("right", "22.34vw");

        $(".line_one").css("background-color", "#999");
        $(".two").css({ "color": "#999", "background-color": "transparent", "border": "solid #999" });
    }
    else if (page == 2) {
        $(".bg").css({
            "background": "url(../img/bg_play2.png) no-repeat center top / auto black",
            "background-size": "cover",
            "background-position": "50% 50%"
        });
        $(classEl).fadeOut(1000);
        setTimeout(download, 1000, ".download_container");
        $(".round_one").css("left", "58.7vw");
        $(".round_two").css("right", "61.09vw");

        $(".line_one").css("background-color", "white");
        $(".two").css({ "color": "#222C71", "background-color": "white", "border": "solid transparent" });

        $(".line_two").css("background-color", "#999");
        $(".three").css({ "color": "#999", "background-color": "transparent", "border": "solid #999" });
    }
    else if (page == 3) {
        $(".bg").css({
            "background": "url(../img/bg_play3.png) no-repeat center top / auto black",
            "background-size": "cover",
            "background-position": "50% 50%"
        });
        $(classEl).fadeOut(1000);
        setTimeout(download, 1000, ".setup_container");
        $(".round_one").css("left", "6.77vw");
        $(".round_two").css("right", "22.34vw");

        $(".line_two").css("background-color", "white");
        $(".three").css({ "color": "#222C71", "background-color": "white", "border": "solid transparent" });
    }
}

function download(classEl) {
    $(classEl).fadeIn(1000);
}

function startAnim() {
    $(".video_container").css("display", "none");
    $(".download_container").css("display", "none");
    $(".setup_container").css("display", "none");
    $(".video_container").fadeIn(1000);

    $(".round_one").css("top", "16.94vh");
    $(".round_two").css("top", "48.98vh");
}
