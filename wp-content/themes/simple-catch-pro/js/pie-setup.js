jQuery(function() {
    if (window.PIE) {
        jQuery(' .custom-tagcloud a').each(function() {
            PIE.attach(this);
        });
    }
});