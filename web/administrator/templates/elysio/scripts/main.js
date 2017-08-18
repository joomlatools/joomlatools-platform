kQuery(document).ready(function($) {

    // Select2
    $('select').select2({
        theme: "bootstrap",
        minimumResultsForSearch: Infinity
    });

    // Tabs overrides
    var $tabsScroller = $('.k-js-tabs-scroller'),
        $tabs = $('.k-js-tabs');

    function scrollToTab(element) {
        if (element.parent('li').parent('ul').parent().hasClass('k-js-tabs-scroller')) {
            var positionLeft = element.parent().position().left,
                positionRight = positionLeft + element.parent().outerWidth(),
                parentPaddingLeft = parseInt($tabs.css('padding-left'), 10),
                parentPaddingRight = parseInt($tabs.css('padding-right'), 10),
                scrollerOffset = $tabsScroller.scrollLeft(),
                scrollerWidth = $tabsScroller.innerWidth(),
                scroll;

            // When item falls of on the right side
            if ( positionRight > (scrollerOffset + scrollerWidth) ) {
                scroll = scrollerOffset + ((positionRight - (scrollerWidth + scrollerOffset)) + (parentPaddingRight * 2));
            }

            // When item falls of on the left side
            if ( positionLeft < scrollerOffset ) {
                scroll = scrollerOffset - ((scrollerOffset - positionLeft) + (parentPaddingLeft * 2));
            }

            // Animate the scroll
            $tabsScroller.animate({
                scrollLeft: scroll
            }, 200);
        }
    }

    setTimeout(function() {
        scrollToTab($tabsScroller.find('.active a'));
    }, 700); // Wait for animation to be finished

});


