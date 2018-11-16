
$(function () {
    //vertical menu selected
    $('ul.vertical_menu li a').click(
        function (e) {
            e.preventDefault(); // prevent the default action
            e.stopPropagation; // stop the click from bubbling
            $(this).closest('ul').find('.selected').removeClass('selected');
            $(this).parent().addClass('selected');
        });

//amination for mega menu
    $('#nav-icon4').click(function () {
        $('#mega').slideToggle("slow");
    });

    $('#nav-icon4').click(function () {
        $(this).toggleClass('open');
    });

    //display and hide text
    var showChar = 193;
    var ellipsestext = "...";
    var moretext = "more>>";
    var lesstext = "less";
    $('.more').each(function () {
        var content = $(this).html();

        if (content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar - 1, content.length - showChar);

            var html = c + '<span class="moreelipses">' + ellipsestext + '</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }
    });

    //sticky header
    $window = $(window);
    $window.scroll(function () {
        $scroll_position = $window.scrollTop();
        if ($scroll_position > 120) { // if body is scrolled down by 300 pixels
            $('.header-middle').addClass('sticky');

            // to get rid of jerk
            header_height = $('.header-middle').innerHeight();
            $('body').css('padding-top', header_height);
        } else {
            $('body').css('padding-top', '0');
            $('.header-middle').removeClass('sticky');
        }
    });

    //scroll top
    $('#scroll_top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 500);
    });

});

function showSubCat(ele) {
    var cat_div = $(ele).find('.CategorySub');
    $(cat_div).removeClass('hide_sub-cat');
    cat_div.addClass('show_sub-cat');
}

function hideSubCat(ele) {
    var cat_div = $(ele).find('.CategorySub');
    $(cat_div).removeClass('show_sub-cat');
    cat_div.addClass('hide_sub-cat');
}

function startHomeSlider() {
    nslider.init();
}

function startThumbnailSlider() {
    mcThumbnailSlider.init();
}


function setLimit(){
    
    alert('Its Me');
}
