kQuery(document).ready(function($) {

    // Select2 for single select
    $(':not(.module-ajax-ordering) select:not([multiple])').select2({
        theme: "bootstrap",
        minimumResultsForSearch: Infinity
    });

    $('#jform_params_catid, #jform_params_created_by, #jform_params_created_by_alias, #jform_params_featured_categories').select2({
        theme: "bootstrap",
        minimumResultsForSearch: Infinity
    });

    // Chosen for multiple select (tags, modules etc.)
    // Remove single chosen
    setTimeout(function() {
        $(':not(.module-ajax-ordering) .chzn-container-single').each(function() {
            $(this).remove();
        });
    }, 1000);


    // Optionlist builder
    var $input = $('.k-optionlist-trigger');
    if ( $input.length ) {

        // Rename and add markup
        $input.closest('.controls').removeClass('controls').addClass('k-optionlist__content').append('<div class="k-optionlist__focus"></div>').wrap('<div class="k-optionlist" style="margin-top: 8px;"></div>');

        // Run for each option
        $input.each(function() {
            // Variables
            var $item = $(this),
                $label = $item.parent();

            // Move the input outside of the label
            $label.before($item);
        });
    }
});

