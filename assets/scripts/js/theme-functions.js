(function($){

    // Mobile menu
    $('.header-menu').on('click keypress', function(){
        $(this).toggleClass('open')
        $('.mobile_menu').toggleClass('active')
    })

    $('.search-button').on('click keypress', function(){
        $('.search-bar').toggleClass('active')
    })
    


    // Cookie banner functions
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(";");
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==" ") c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    function eraseCookie(name) {   
        document.cookie = name+"=; Max-Age=-99999999;";  
    }

    if(getCookie("atCookieConsent") != "on") {
        setTimeout(function(){
            $(".cookie_consent_container").addClass("active");
        }, 1000);
    }

    $(".cookieConsent").on("click", function(){
        setCookie("atCookieConsent","on",30);
        $(".cookie_consent_container").removeClass("active");
        setTimeout(function(){
            $(".cookie_consent_container").remove();
        }, 1000);
    });

    if(getCookie("atCookieConsent") == "on") {
        setTimeout(function(){
            $(".cookie_consent_container").remove();
        }, 1000);
    }






})(jQuery);