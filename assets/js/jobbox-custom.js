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

        /*==== Add css to payment btn */
        $("a.wpjb-button.wpjb-place-order")
        .addClass("btn btn-default hover-up submit-btn mb-50").parent().addClass("text-center");

    /*====== Dashbaord profile on hover ======*/
    $(".to-be-revealed").hide();
    $(".reveal-child-on-hover").mouseenter(function(){
        $(this).find(".to-be-revealed").show();
    })
    $(".reveal-child-on-hover").mouseleave(function(){
        $(this).find(".to-be-revealed").hide();
    })

    /*======== Copy from contact to billing button */
    // ADD BUTTON IN FORM Job-add & Company edit
    var formWithCopyBtn = [".company-edit-form .group-group_2 h6",".job-add-form .group-billing h6"];
    
    $(formWithCopyBtn.join(', '))
        .append('<button type="button" class="btn btn-tags-sm btn-copy-contact-billing">Copier depuis le contact</button>');
    
    $(".btn-copy-contact-billing").click(function() {

        // mapping
        var fieldMapping = {
                "add-job":{
                company_contact:"billing_contact",
                company_email:"billing_email",
                company_phone:"billing_phone",
                job_address:"billing_address",
                job_zip_code:"billing_zipcode",
                company_city:"billing_city",
                job_country:"billing_country"
            },
            "company-edit":{
                company_contact_name:"billing_contact_name",
                user_email:"billing_email",
                company_phone:"billing_phone",
                company_address:"billing_address",
                company_zip_code:"billing_zipcode",
                company_location:"billing_city",
                company_country:"billing_country"
            }
        };
        var isJobAddForm = $(this).parents(".form").hasClass("job-add-form");
        var fields = isJobAddForm ? fieldMapping["add-job"] : fieldMapping["company-edit"];
        for (const fromField in fields) {
            const toField = fields[fromField];
            $("[name="+toField+"]").val($("[name="+fromField+"]").val())
        }
    })

    /*==== ADD JOB FORM PRE SELECTION ===*/
    $("#job_apply_type-0").prop("checked", true).change();

    /*===== SELECT JOB ITEM ON BOX CLIC */
    $(".job-item-box").click(function(event) {
        window.location.href = $(this).find('.job-link').attr('href')
    });
    $(".company-item-box").click(function(event) {
        window.location.href = $(this).find('.company-link').attr('href')
    });
})(jQuery);
