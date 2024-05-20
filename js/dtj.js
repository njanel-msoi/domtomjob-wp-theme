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
});
