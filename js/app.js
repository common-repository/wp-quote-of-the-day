function convertHex(hex, opacity) {
    hex = hex.replace("#", "");
    r = parseInt(hex.substring(0, 2), 16);
    g = parseInt(hex.substring(2, 4), 16);
    b = parseInt(hex.substring(4, 6), 16);

    result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
    return result;
}

jQuery(document).ready(function ($) {

    $("head").append('<link rel="stylesheet" type="text/css"' +
        ' href="https://fonts.googleapis.com/css?family=' + quote_vars.author_font_family + '">');

    $("head").append('<link rel="stylesheet" type="text/css"' +
        ' href="https://fonts.googleapis.com/css?family=' + quote_vars.font_family + '">');


    var body = $("body");
    var html = $("html");

    if (!sessionStorage.getItem('quote_seen')) {
        body.css("overflow", "hidden");
        html.css("overflow", "hidden");
        body.prepend('<div class="quote--modal">' +
            '<div class="quote--skip"><a href="#"><button>' +
            '<span class="quote--time-remain"></span></button></a></div>' +
            '<div><div class="quote--circle">' +
            '<div class="quote--circle-inner"><div class="quote--circle-wrapper"><div class="quote--circle-content">' +
            '<div class="quote--text">&#8220;' + quote_vars.quote + '&#8221;</div>' +
            '<div class="quote--author">' + quote_vars.author + '</div>' +
            '</div></div></div></div><div class="quote--banner"></div></div></div>');
    }

    var modal = $(".quote--modal");
    var circle = $(".quote--circle");
    var quote = $(".quote--text");
    var author = $(".quote--author");
    var skip_link = $(".quote--skip>a");
    var skip_button = $(".quote--skip>a>button");
    var skip_button_text = $(".quote--skip>a>button>span");
    var time_remain = $(".quote--time-remain");
    var banner = $(".quote--banner");

    if (quote_vars.banner_is_iframe != '') {
        if (quote_vars.banner_is_iframe == 1) {
            banner.append(quote_vars.iframe_url);
        } else {
            banner.append('<a href="' + quote_vars.banner_redirect_url + '">' +
                '<img class="quote--banner-img" src="' + quote_vars.banner_img_url + '"></a>');
        }

    }
    quote.css("color", quote_vars.quote_color);
    quote.css("font-size", quote_vars.font_size + 'px');
    author.css("color", quote_vars.author_color);
    author.css("font-size", quote_vars.author_font_size + 'px');
    modal.css("background-color", convertHex(quote_vars.background_color, quote_vars.background_opacity));
    skip_button.css("background-color", quote_vars.skip_background_color);
    skip_button.hover(function () {
        $(this).css("background-color", quote_vars.skip_background_hover_color);
    });
    skip_button.mouseleave(function () {
        $(this).css("background-color", quote_vars.skip_background_color);
    });
    skip_button_text.css('font-size', quote_vars.skip_font_size + "px");
    if (quote_vars.circle_enable == 1) {
        circle.css("border", "5px solid " + quote_vars.circle_color);
    }

    var count = parseInt(quote_vars.redirect_delay) + 1;

    skip_link.on('click', function (e) {
        e.preventDefault();
    });

    var interval = setInterval(function () {
        time_remain.html(quote_vars.skip_text + " " + --count);
        if (count == 0 || sessionStorage.getItem('quote_seen')) {
            skip_link.on('click', function (e) {
                e.preventDefault();
                sessionStorage.setItem('quote_seen', true);
                if (quote_vars.redirect != '') {
                    window.location.replace(quote_vars.redirect);
                } else {
                    body.css("overflow", "auto");
                    html.css("overflow", "auto");
                    modal.css('display', 'none');
                    modal.remove();
                }

            });
            time_remain.html(quote_vars.skip_text);
            clearInterval(interval);

        }

    }, 1000);

    function quote_set_font() {

        var font_bold = 'normal';
        if (quote_vars.font_bold == 1) {
            font_bold = 'bold';
        }

        var font_italic = 'normal';
        if (quote_vars.font_italic == 1) {
            font_italic = 'italic';
        }

        quote.css({
            'font-family': quote_vars.font_family,
            'font-weight': font_bold,
            'font-style': font_italic
        });

    }

    function author_set_font() {

        var font_bold = 'normal';
        if (quote_vars.author_font_bold == 1) {
            font_bold = 'bold';
        }

        var font_italic = 'normal';
        if (quote_vars.author_font_italic == 1) {
            font_italic = 'italic';
        }

        author.css({
            'font-family': quote_vars.author_font_family,
            'font-weight': font_bold,
            'font-style': font_italic
        });

    }

    quote_set_font();
    author_set_font();

});


