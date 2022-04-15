function toSlug(str)
{
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñçệđạăặọẳớ·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuuncedaaaoao------";

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
}

$(function () {
    $("#changeReadonly").click(function (event)
    {
        if(document.getElementById("readonly").readOnly == true)
        {
            document.getElementById("readonly").readOnly = false;
        }
        else
        {
            document.getElementById("readonly").readOnly = true
        }

    })


    $(".inputForm").keyup( function (event) {
        $(".inputTo").val(toSlug($(this).val()));
    })
})

function formatNumner(number)
{
    // ham dung de formath gia tri tien
    var str = number.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ".") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
                output.push(".");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return(" ($): " + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
}

$(".inputFormPrice").keyup( function() {
    $numerPrice = $(this).val();
    if($numerPrice != '')
    {
        $(".inputToPrice").html(formatNumner(parseInt($numerPrice) + 'VNĐ'));
    }
    else
    {
        $(".inputToPrice").html("Mời bạn điền giá");
    }

})
$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });
});

$(function () {
    let $action = $(".actionscoll");
    $action.off('click').click(function(event)
    {
        event.preventDefault();
        let target = $(this).attr("href");

        if($(target).length  >0)
        {
            console.log($(target).offset());
            $('body, html').stop().animate({scrollTop:$(target).offset().top}, 600, 'swing');
        }
    });
})