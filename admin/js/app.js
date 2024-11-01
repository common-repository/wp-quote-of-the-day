jQuery(document).ready(function ($) {

    $(".tablinks").on("click", function(){
        var target = $(this).data("tabname");
        if (window.sessionStorage) {
            sessionStorage.setItem('currentTab', target);
        }
        $(".tabcontent").hide();
        $("#"+target).show();
        $(".tablinks").removeClass("active");
        $(this).addClass("active");
    });

    if(sessionStorage.getItem("currentTab") !== null) {
        $("#tab_"+sessionStorage.getItem("currentTab")).click();
    }

    if ($("#banner_is_iframe").val() == '0') {
        $(".image-row").show();
        $(".iframe-row").hide();
    }
    else if ($("#banner_is_iframe").val() == '1') {
        $(".iframe-row").show();
        $(".image-row").hide();
    }
    else {
        $(".iframe-row").hide();
        $(".image-row").hide();
    }

    $("#banner_is_iframe").on('change', function () {
        if ($("#banner_is_iframe").val() == '0') {
            $(".image-row").show();
            $(".iframe-row").hide();
        }
        else if ($("#banner_is_iframe").val() == '1') {
            $(".iframe-row").show();
            $(".image-row").hide();
        } else {
            $(".iframe-row").hide();
            $(".image-row").hide();
        }
    });

    function set_font_example() {
        var font_style = 'normal';
        var font_weight = 'normal';

        if ($("#font_italic").attr("checked") == 'checked') {
            font_style = 'italic';
        }

        if ($("#font_bold").attr("checked") == 'checked') {
            font_weight = 'bold';
        }

        var font = $("#font_selector").val();

        if (font != 1) {
            $("head").append('<link rel="stylesheet" type="text/css"' +
                ' href="https://fonts.googleapis.com/css?family=' + font + '">');
        }

        $(".font_example").css({
            'font-family': font,
            'font-weight': font_weight,
            'font-style': font_style
        });
    }

    set_font_example();

    function set_author_font_example() {
        var font_style = 'normal';
        var font_weight = 'normal';

        if ($("#author_font_italic").attr("checked") == 'checked') {
            font_style = 'italic';
        }

        if ($("#author_font_bold").attr("checked") == 'checked') {
            font_weight = 'bold';
        }

        var font = $("#author_font_selector").val();

        if (font != 1) {
            $("head").append('<link rel="stylesheet" type="text/css"' +
                ' href="https://fonts.googleapis.com/css?family=' + font + '">');
        }

        $(".author_font_example").css({
            'font-family': font,
            'font-weight': font_weight,
            'font-style': font_style
        });
    }

    set_author_font_example();

    $("#font_selector, #font_italic, #font_bold").on("change", set_font_example);

    $("#author_font_selector, #author_font_italic, #author_font_bold").on("change", set_author_font_example);

    var mediaUploader;

    $('#upload-button').click(function(e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false });


        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#image-url').val(attachment.url);
        });

        mediaUploader.open();
    });

});