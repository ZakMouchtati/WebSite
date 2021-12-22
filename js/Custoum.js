$(document).ready(function() {
    $(".icon-menu").click(function(e) {
        $("header .link").toggle();
    });
    $('.Btn-toggle-search').click(function(e) {
        $('.search').toggle();
    });
    ///ChecKout Page
    $(".cart").hide();
    $(".paypal").hide();
    $("#creditcard").click(function(e) {
        $(".paypal").hide();
        $(".cart").slideToggle();

    });
    $('#cod').click(function (e) {
        $('.cart').hide();
      });
    //Contact Page
    if ($("#alert").css("display") == 'block') {
        setTimeout(() => {
            $("#alert").css("display", "none");
        }, 1500);
    }
    //Panier Page
        $(".plus").click(function() {
            qte = Number($(this).prev().attr('value')) + 1;
            $(this).prev().attr("value", qte);

        }),

        $(".moins").click(function() {
            if (Number($(this).next().attr('value')) > 1) {
                r = Number($(this).next().attr('value')) - 1;
                $(this).next().attr("value", r);
            }
        }),
        $('#passchekout').click(function() {
            $("#chekoutform").submit();
        }),
        //Profile Page
        $('.modifier-info').click(function() {
            $('.show-updated').hide();
            $('.showuser').show();
            $(this).parent().siblings().slideDown();
            $(this).parent().hide();
        }),
        $('.btn-cancel').click(function() {
            $('.show-updated').slideUp(200, function() {
                $('.showuser').show();
            });
        }),
        $(".editProfile").click(function() {
            $(this).attr("type", 'file');
            $('.btnprofile').show();
            $('.cancelprofile').show();
        }),
        $('.cancelprofile').click(function() {
            $('.editProfile').attr("type", 'button');
            $('.btnprofile').hide();
            $('.cancelprofile').hide();

        })
        //Show Product Page
        $("#plus").click(function() {
            qte = Number($("#qte").attr("value")) + 1;
            $("#qte").attr("value", qte);

        }),
        $("#moins").click(function() {
            if (Number($("#qte").attr("value")) > 1) {
                r = Number($("#qte").attr("value")) - 1;
                $("#qte").attr("value", r);
            }
        }),
        $('.secondimg').click(function() {
            firstimg = $("#firstimg").attr('src');
            secondimg = $(this).attr('src');
            $("#firstimg").attr('src', secondimg);
            $(this).addClass("imgselected").parent().siblings().children().removeClass('imgselected');
        })
        ///Header page
        $('#user').click(function() {
            window.location = 'login.php';
        }),
        $('#userConnecter').click(function() {
            $(".choix-user").slideToggle();
        })
        //Alert 
        window.setTimeout(function() {
            $("#alert").alert('close');
        }, 5000);

});
