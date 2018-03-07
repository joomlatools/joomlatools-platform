/**
 * Go through all loaded jQuery instances and assign the first one on the page with a version >=1.8.0 to kQuery
 */
if (typeof window.kQuery === 'undefined' && typeof window.jQuery !== 'undefined') {
    var kQuery,
        tmp,
        version,
        // Save current global references
        old_$ = window.$,
        old_jQuery = window.jQuery;

    while (typeof window.jQuery !== 'undefined') {
        version = window.jQuery.fn.jquery.split('.');
        tmp = window.jQuery.noConflict(true);

        // Do not use versions older than 1.8
        if (!(version[0] == '1' && parseInt(version[1], 10) < 8)) {
            kQuery = tmp;
            break;
        }
    }

    // Revert references
    window.$ = old_$;
    window.jQuery = old_jQuery;

    window.kQuery = kQuery;
}