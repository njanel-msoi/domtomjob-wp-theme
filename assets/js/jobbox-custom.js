(function ($) {
  ("use strict");

  /*====== Topbar sticky class ======*/
  var headerElt = document.querySelector("header.header.stickable");
  if (headerElt) {
    var rootElt = document.querySelector(":root");
    function checkScrollStick() {
      var stucked = rootElt.scrollTop != 0;
      headerElt.classList.toggle("stuck", stucked);
    }
    addEventListener("scroll", () => {
      checkScrollStick();
    });
    checkScrollStick();
  }
  /*====== Sidebar menu Active ======*/
  function mobileHeaderActive() {
    var navbarTrigger = $(".burger-icon"),
      endTrigger = $(".mobile-menu-close"),
      container = $(".mobile-header-active"),
      wrapper4 = $("body");
    wrapper4.prepend('<div class="body-overlay-1"></div>');
    navbarTrigger.on("click", function (e) {
      navbarTrigger.toggleClass("burger-close");
      e.preventDefault();
      container.toggleClass("sidebar-visible");
      wrapper4.toggleClass("mobile-menu-active");
    });
    endTrigger.on("click", function () {
      container.removeClass("sidebar-visible");
      wrapper4.removeClass("mobile-menu-active");
    });
    $(".body-overlay-1").on("click", function () {
      container.removeClass("sidebar-visible");
      wrapper4.removeClass("mobile-menu-active");
      navbarTrigger.removeClass("burger-close");
    });
  }
  mobileHeaderActive();

  /*====== Select2 for bar search ======*/
  $(".bar-search-form select").select2();

  /*====== submit form on filter change (job list) ======*/
  $(".job-list-filters-form select, .job-list-filters-form input").on(
    "change",
    function () {
      $(".job-list-filters-form").submit();
    }
  );

  /*====== Apply popup ======*/
  $(".popup-container .close-popup").click(function (event) {
    $(this).parents(".popup-container").fadeOut("fast");
    return false;
  });
  $(".wpjb-form-job-apply.wpjb-form-toggle")
    .unbind()
    .click(function (event) {
      var id = $(this).data("wpjb-form");
      $("#" + id + "-popup").fadeIn("fast");
      return false;
    });

  /*====== Clic on container trigger link ======*/
  $(".click-on-link").click(function (event) {
    // if a link exists in children, clic on it
    $(event.target).children("a").click();
  });

  /*====== Dashbaord profile on hover ======*/
  $(".to-be-revealed").hide();
  $(".reveal-child-on-hover").mouseenter(function () {
    $(this).find(".to-be-revealed").show();
  });
  $(".reveal-child-on-hover").mouseleave(function () {
    $(this).find(".to-be-revealed").hide();
  });

  /*======== Copy from contact to billing button */
  // ADD BUTTON IN FORM Job-add & Company edit
  var formWithCopyBtn = [
    ".company-edit-form .group-group_2 h6",
    ".job-add-form .group-billing h6",
    ".form_register_company .group-group_2 h6",
  ];

  $(formWithCopyBtn.join(", ")).append(
    '<button type="button" class="btn btn-tags-sm btn-copy-contact-billing">Copier depuis le contact</button>'
  );

  $(".btn-copy-contact-billing").click(function () {
    // mapping
    var fieldMapping = {
      "add-job": {
        company_contact: "billing_contact",
        company_email: "billing_email",
        company_phone: "billing_phone",
        job_address: "billing_address",
        job_zip_code: "billing_zipcode",
        company_city: "billing_city",
        job_country: "billing_country",
      },
      "company-edit": {
        company_contact_name: "billing_contact_name",
        user_email: "billing_email",
        company_phone: "billing_phone",
        company_address: "billing_address",
        company_zip_code: "billing_zipcode",
        company_location: "billing_city",
        company_country: "billing_country",
      },
    };
    var isJobAddForm = $(this).parents(".form").hasClass("job-add-form");
    var fields = isJobAddForm
      ? fieldMapping["add-job"]
      : fieldMapping["company-edit"];
    for (const fromField in fields) {
      const toField = fields[fromField];
      $("[name=" + toField + "]").val($("[name=" + fromField + "]").val());
    }
  });

  /*==== ADD JOB FORM PRE SELECTION ===*/
  $("#job_apply_type-FORM").prop("checked", true).change();

  /*===== SELECT JOB ITEM ON BOX CLIC */
  $(".job-item-box").click(function (event) {
    window.location.href = $(this).find(".job-link").attr("href");
  });
  $(".company-item-box").click(function (event) {
    window.location.href = $(this).find(".company-link").attr("href");
  });

  console.log("bonjour");
  /** WAIT FOR ALERT LOAD */
  setTimeout(function () {
    /** REMOVE USELESS PARAM FROM USER ALERTS IN APPLICANT DASHBOARD */
    var alertParamToDisplay = ["Meta", "Type", "Category"];
    // loop on each alert
    $(".wpjb-manage-alert").each(function (idx, dom) {
      var alertElt = $(dom);
      var paramDisplay = [];
      // loop on params
      alertElt
        .find(".wpjb-alert-params> .wpjb-grid-row> .wpjb-grid-col:first-child")
        .each(function (idx, dom) {
          var elt = $(dom);
          var category = elt.text().trim();
          if (alertParamToDisplay.includes(category)) {
            var value = elt.find("+.wpjb-grid-col").text().trim().split(", ");
            paramDisplay.push(value);
          }
        });
      var title = alertElt.find(".wpjb-manage-title");
      var paramTxt = paramDisplay.length
        ? paramDisplay.join(", ")
        : "Recevoir toutes les nouvelles offres";
      title.after('<span class="alert-params-label">' + paramTxt + "</span>");
    });

    /** SUBMIT ALERT FORM AFTER REMOVE */
    $(".wpjb-alert-detail-remove").click(function () {
      setTimeout(function () {
        //$('#wpjb-save-alerts-form').submit();
      });
    });
  }, 1000);

  /** DATEPICKERS FOR INPUTS */
  $(".daq-date-picker").each(function (index, item) {
    var $item = $(item);
    var yearRange = "c-10:c+10";

    if ($item.data("year-range") && $item.data("year-range").length > 0) {
      yearRange = $item.data("year-range");
    }

    $item.datepicker({
      dateFormat: WpjbData.datepicker_date_format,
      firstDay: 1,
      yearRange: yearRange,
      changeMonth: false,
      changeYear: true,
      dayNames: $.datepicker.regional["fr"].dayNames,
      dayNamesMin: $.datepicker.regional["fr"].dayNamesMin,
      dayNamesShort: $.datepicker.regional["fr"].dayNamesShort,
      monthNames: $.datepicker.regional["fr"].monthNames,
      monthNamesShort: $.datepicker.regional["fr"].monthNamesShort,
    });
    //   $(".daq-date-picker").datepicker();
  });

  /** BLOCK ALL "gateway" UI WHEN A GATEWAY IS SELECTED (payment page) */
  $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    if (!options.data) return;
    // handle "action" for payment form
    if (!options.data.includes("action=wpjb_payment_render")) return;

    var optionsMap = {};
    options.data.split("&").forEach((element) => {
      var parts = element.split("=");
      if (parts.length < 2) return;
      optionsMap[parts[0]] = parts[1];
    });

    // some lines in payment table are visible only with banktransfer gateway
    if ($(".label-banktransfer").length > 0) {
      var showBankTransfer = optionsMap.gateway == "BankTransferPayment";
      $(
        ".label-banktransfer, .value-banktransfer, .value-total-withbanktransfer"
      ).toggle(showBankTransfer);
      $(".value-total").toggle(!showBankTransfer);
    }

    // here we are on "payment gateway UI ajax loading"
    var backdrop = $("#gateway-container");
    backdrop.addClass("loading");
    // on ajax complete, hide backdrop
    options.complete = function () {
      backdrop.removeClass("loading");
    };
  });
})(jQuery);
