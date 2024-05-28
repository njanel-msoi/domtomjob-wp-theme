jQuery(function($) {

    $(".popup .close-popup").click(function(event){
        
        $(this).parents('.popup').fadeOut();
        return false;
    })

    $(".wpjb-form-job-apply.wpjb-form-toggle")
        .unbind()
        .click(function(event) {
            var id = $(this).data("wpjb-form");
            $("#"+id+"-popup").fadeIn();
            return false;
        });    
        
        // overlay subscribe
        $(".wpjb-subscribe").click(function() {

            $("#wpjb-overlay").show();
            
            $("#wpjb-overlay").css("height", $(document).height());
            $("#wpjb-overlay").css("width", $(document).width());
            
            var c = $("#wpjb-overlay > div");
            c.css("position","absolute");
            c.css("top", Math.max(0, (($(window).height() - c.outerHeight()) / 2) + $(window).scrollTop()) + "px");
            c.css("left", Math.max(0, (($(window).width() - c.outerWidth()) / 2) +  $(window).scrollLeft()) + "px");
            
            return false;
        });
        
        $(".wpjb-overlay-close").click(function() {
            $(this).closest(".wpjb-overlay").hide();
            return false;
        });
        $(".wpjb-overlay").click(function() {
            $(this).hide();
            return false;
        });
        $(".wpjb-overlay > div").click(function(e) {
            e.stopPropagation();
        });
        $(".wpjb-subscribe-save").click(function() {
            
            var data = {
                action: "wpjb_main_subscribe",
                email: $("#wpjb-subscribe-email").val(),
                frequency: $(".wpjb-subscribe-frequency:checked").val(),
                criteria: WPJB_SEARCH_CRITERIA
            };
            
            $(".wpjb-subscribe-save").hide();
            $(".wpjb-subscribe-load").show();
            
            $.post(ajaxurl, data, function(response) {
                
                $(".wpjb-subscribe-load").hide();
                
                var span = $(".wpjb-subscribe-result");
                
                span.css("display", "block");
                span.text(response.msg);
                span.removeClass("wpjb-subscribe-success");
                span.removeClass("wpjb-subscribe-fail");
                
                if(response.result == "1") {
                    span.addClass("wpjb-subscribe-success");
                    $("#wpjb-subscribe-email").hide();
                } else {
                    span.addClass("wpjb-subscribe-fail"); 
                    $(".wpjb-subscribe-save").show();
                    
                }
            }, "json");
            
            return false;
        });
});
