jQuery(document).ready(function($) {

    // Filter toggle
    var form = $('.-koowa-grid'),
        toggles = form.find('[data-filter-toggle]'),
        filters = form.find('[data-filter]');

    form.on('click.koowa', '[data-filter-toggle]', function(event) {
        event.preventDefault();

        var toggle = $(event.target),
            name   = toggle.attr('data-filter-toggle'),
            filter = filters.filter('[data-filter="'+name+'"]'),
            is_visible = filter.is(':visible'),
            visible_filters = filters.filter(':visible');

        toggle.parents('ul').find('li').removeClass('js-is-active');

        if (is_visible) {
            visible_filters.slideToggle();
        }
        else {
            toggle.parent('li').addClass('js-is-active');

            if (visible_filters.length) {
                filters.hide(0, function() {
                    filter.show(0);
                });
            }
            else {
                filter.slideDown();
            }
        }
    });

    // Variables
    var $wrapper = $('.k-content-wrapper'),
        $toolbar = $('.k-toolbar'),
        $content = $('.k-content'),
        $fixedtable = $('.table--fixed'),
        $searchtoggle = $('.k-toggle-search');

    // Sidebar
    if ($wrapper.length && $content.length && $toolbar.length)
    {
        var toggle_button = '<button class="off-canvas-menu-toggle" type="button">' +
                '<span class="bar1"></span>' +
                '<span class="bar2"></span>' +
                '<span class="bar3"></span>' +
                '</button>',
            sidebar_left  = $('#k-sidebar'),
            sidebar_right = $('#k-sidebar-right');

        if (sidebar_left.length) {
            var left_toggle = $(toggle_button);
            $toolbar.prepend(left_toggle);

            sidebar_left.offCanvasMenu({
                menuToggle: left_toggle,
                wrapper: $wrapper,
                container: $content
            });
        }

        if (sidebar_right.length) {
            var right_toggle = $(toggle_button);
            $toolbar.append(right_toggle);

            sidebar_right.offCanvasMenu({
                menuToggle: right_toggle,
                wrapper: $wrapper,
                container: $content,
                position: 'right'
            });
        }
    }

    // Toggle search
    $searchtoggle.click(function() {
        $('.k-scopebar__search').slideToggle('fast');
    });

    // Footable
    $('.footable').footable({
        "breakpoints": {
            phone: 500,
            tablet: 800
        },
        "useParentWidth": true,
        "toggleColumn": "first",
        "toggleSelector": " > tbody > tr > td > span.footable-toggle"
    }).bind('footable_resizing', function() {
        $fixedtable.floatThead('destroy');
    }).bind('footable_resized', function() {
        fixedTable();
    });

    // WP sidebar toggle
    $('#collapse-menu').on('click', function() {
        $fixedtable.floatThead('destroy');
        fixedTable();
    });

    // Sticky table header and footer
    function fixedTable() {
        if ( $fixedtable.length ) {
            $fixedtable.floatThead({
                scrollContainer: function($table){
                    return $table.closest('.k-table');
                },
                enableAria: true
            });
        }
    }

    fixedTable();

    // Fixing bootstrap 2 input groups
    $('.input-append,.input-prepend').each(function() {
        $(this).find('.btn').wrap('<div class="input-group-btn">');
    });
    $('.input-group > .form-control + .btn').each(function() {
        $(this).wrap('<div class="input-group-btn">');
    });


    // Fixing tr highlighting on select
    var optionbox = $('[type="checkbox"], [type="radio"]');

    $('.select-rows tr td').on('click', function(e) {
        if (e.target.nodeName === 'INPUT' || e.target.nodeName === 'A') {
            return;
        }
        var checkbox = $(this).parent('tr').find(optionbox);
        if(checkbox.is(":checked")) {
            checkbox.removeAttr('checked').trigger('change');
        } else {
            checkbox.attr("checked", "checked").trigger('change');
        }
        Joomla.isChecked(checkbox.attr('checked'));
    });

    $('.select-rows tr').find(optionbox).on('change', function() {
        if($(this).is(":checked")) {
            $(this).closest('tr').addClass('selected');
        } else {
            $(this).closest('tr').removeClass('selected');
        }
    });

    // Select next table item when pressing key
    $(document).on('keydown', function(e) {
        if ($('.k-table tr').hasClass('selected') && e.keyCode >= 37 && e.keyCode <= 40) {
            e.preventDefault();
            if (e.keyCode == 38) { // up key
                if ( $('.k-table .selected').prev('tr').hasClass('footable-row-detail') ) {
                    $('.k-table .selected').find(optionbox).removeAttr('checked').trigger('change').closest('tr').prev('tr').prev('tr').find(optionbox).attr("checked", "checked").trigger('change');
                } else if ( $('.k-table .selected').prev('tr').length ) {
                    $('.k-table .selected').find(optionbox).removeAttr('checked').closest('tr').removeClass('selected').prev('tr').find(optionbox).attr("checked", "checked").parent('td').parent('tr').addClass('selected');
                }
            }
            if (e.keyCode == 40) { // down key
                if ( $('.k-table .selected').next('tr').hasClass('footable-row-detail') ) {
                    $('.k-table .selected').find(optionbox).removeAttr('checked').trigger('change').closest('tr').next('tr').next('tr').find(optionbox).attr("checked", "checked").trigger('change');
                } else if ( $('.k-table .selected').next('tr').length ) {
                    $('.k-table .selected').find(optionbox).removeAttr('checked').closest('tr').removeClass('selected').next('tr').find(optionbox).attr("checked", "checked").parent('td').parent('tr').addClass('selected');
                }
            }
        } else {
            return
        }
    });

});

