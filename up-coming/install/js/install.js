$(document).ready(function() {

    $('.config_addons ').remove();

    endInstall = function() {
        window.location.reload();
    }

    callSaved = function(text, type) {
        if (type == 1) {
            $('.saved_data').removeClass('saved_warn saved_error').addClass('saved_ok');

        }
        if (type == 2) {
            $('.saved_data').removeClass('saved_ok saved_error').addClass('saved_warn');
        }
        if (type == 3) {
            $('.saved_data').removeClass('saved_warn saved_ok').addClass('saved_error');
        }
        $('.saved_span').text(text);
        $('.saved_data').fadeIn(300).delay(3000).fadeOut();
    }
    installThisAddon = function(item, aname) {
        $(item).hide();
        $(item).parent().children('.work_button').show();
        $.post('system_addons.php', {
            activate_addons: 1,
            addon_name: aname,
        }, function(response) {
            document.getElementById("result_prog").innerHTML = '<br><i style="color:green;" class="fa fa-check"></i> <b style="color:green;">تم تنصيب الاضافة</b>';
            endInstall();
        });
    }
    removeAddons = function(item, aname) {
        if (confirm('هل أنت متأكد أنك تريد إزالة هذه الاضافة ؟')) {
            $(item).hide();
            $(item).parent().children('.work_button').show();
            $.post('system_addons.php', {
                remove_addons: 1,
                addon_name: aname,
            }, function(response) {
                endInstall();
            });
        } else {
            return false;
        }
    }

});