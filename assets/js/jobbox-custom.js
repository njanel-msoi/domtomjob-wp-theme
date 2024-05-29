(function($) {
    ("use strict");

    /*====== Topbar sticky class ======*/
    var headerElt = document.querySelector("header.header.stickable");
    if (headerElt) {
        var rootElt = document.querySelector(':root');
        addEventListener("scroll", (event) => {
            var stucked = rootElt.scrollTop != 0;
            headerElt.classList.toggle('stuck', stucked);
        });
    }
    /*====== Sidebar menu Active ======*/
    function mobileHeaderActive() {
        var navbarTrigger = $(".burger-icon"),
            endTrigger = $(".mobile-menu-close"),
            container = $(".mobile-header-active"),
            wrapper4 = $("body");
        wrapper4.prepend('<div class="body-overlay-1"></div>');
        navbarTrigger.on("click", function(e) {
            navbarTrigger.toggleClass("burger-close");
            e.preventDefault();
            container.toggleClass("sidebar-visible");
            wrapper4.toggleClass("mobile-menu-active");
        });
        endTrigger.on("click", function() {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
        });
        $(".body-overlay-1").on("click", function() {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
            navbarTrigger.removeClass("burger-close");
        });
    }
    mobileHeaderActive();

    /*====== Select2 for bar search ======*/
    $(".bar-search-form select").select2();

    
    /*====== submit form on filter change (job list) ======*/
    $(".job-list-filters-form select, .job-list-filters-form input").on('change',function(){
        $(".job-list-filters-form").submit();
    });

    /*====== Apply popup ======*/
    $(".popup-container .close-popup").click(function(event){
        $(this).parents('.popup-container').fadeOut('fast');
        return false;
    })
    $(".wpjb-form-job-apply.wpjb-form-toggle")
        .unbind()
        .click(function(event) {
            var id = $(this).data("wpjb-form");
            $("#"+id+"-popup").fadeIn('fast');
            return false;
        });    

    /*====== Clic on container trigger link ======*/
        $(".click-on-link").click(function(event){
            // if a link exists in children, clic on it
            $(event.target).children("a").click();
        })
    
})(jQuery);
