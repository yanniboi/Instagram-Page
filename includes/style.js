jQuery(document).ready(function() {

    jQuery("#main")
    .mouseenter(function () {
      jQuery('#main .hidden').show(600);
    });

    jQuery("#main")
    .mouseleave(function () {
      jQuery('#main .hidden').hide(600);
    });
});

