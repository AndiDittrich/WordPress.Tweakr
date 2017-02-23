/*  AUTO GENERATED FILE - DO NOT EDIT !!
    WP-SKELEKTON | MIT X11 License | https://github.com/AndiDittrich/WP-Skeleton
    ------------------------------------
    Corporate Plugin Settings Page Functions
*/
jQuery(document).ready(function(){

    // hide update message
    // --------------------------------------------------------
    var msg = jQuery('#setting-error-settings_updated');
    if (msg) {
        msg.delay(1500).fadeOut(500);
    }

    // Tabs/Sections
    // --------------------------------------------------------
    // try to restore last tab
    var lastActiveTab = Cookies.get('tweakr-tabnav');

    // container actions
    var currentTab = (lastActiveTab ? jQuery("#tweakr-tabnav a[data-tab='" + lastActiveTab + "']") : jQuery('#tweakr-tabnav a:first-child'));
    jQuery('#tweakr-tabnav a').each(function () {
        // get current element
        var el = jQuery(this);

        // hide content container
        jQuery('#' + el.attr('data-tab')).hide();

        // click event
        el.click(function () {
            // remove highlight
            currentTab.removeClass('nav-tab-active');

            // hide container
            jQuery('#' + currentTab.attr('data-tab')).hide();

            // store current active tab
            currentTab = el;
            currentTab.addClass('nav-tab-active');

            // show container
            jQuery('#' + currentTab.attr('data-tab')).show();

            // store current tab as cookie - 1 day lifetime
            Cookies.set('tweakr-tabnav', currentTab.attr('data-tab'), {expires: 1});
        });
    });

    // show first container
    currentTab.click();

    // show navbar
    jQuery('#tweakr-tabnav').show();

});