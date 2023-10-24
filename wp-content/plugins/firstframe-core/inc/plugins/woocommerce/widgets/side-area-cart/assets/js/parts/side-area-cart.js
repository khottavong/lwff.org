(function ($) {
    'use strict';

    $(window).load(
        function () {
            qodefSideAreaCart.init();
        }
    );

    var qodefSideAreaCart = {
        init: function () {
            var $holder = $('.qodef-widget-side-area-cart-inner');

            if ($holder.length) {
                $holder.off().each(
                    function () {
                        var $thisHolder = $(this);

                        if (qodefCore.windowWidth > 680) {
                            qodefSideAreaCart.trigger($thisHolder);
                            qodefSideAreaCart.start($thisHolder);

                            qodefCore.body.on(
                                'added_to_cart removed_from_cart wc_fragments_refreshed',
                                function () {
                                    qodefSideAreaCart.init();
                                }
                            );

                            qodefCore.body.on(
                                'added_to_cart removed_from_cart',
                                function () {
                                    qodefSideAreaCart.init();
                                }
                            );
                        }
                    }
                );
            }
        },
        trigger: function ($holder) {
            var $items = $holder.find('.qodef-woo-side-area-cart');
            if ($items.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
                qodefCore.qodefPerfectScrollbar.init($items);
            }
        },
        start: function ($holder) {

            $(document).on(
                'click',
                '.qodef-m-opener',
                function (e) {
                    e.preventDefault();

                    if (!$holder.hasClass('qodef--opened')) {
                        qodefSideAreaCart.openSideArea($holder);
                        qodefSideAreaCart.trigger($holder);

                        $(document).keyup(
                            function (e) {
                                if (e.keyCode === 27) {
                                    qodefSideAreaCart.closeSideArea($holder);
                                }
                            }
                        );
                    } else {
                        qodefSideAreaCart.closeSideArea($holder);
                    }
                }
            );

            $(document).on(
                'click',
                '.qodef-m-close',
                function (e) {
                    e.preventDefault();
                    qodefSideAreaCart.closeSideArea($holder);
                }
            );
        },
        openSideArea: function ($holder) {
            qodefCore.qodefScroll.disable();

            $holder.addClass('qodef--opened');
            $('#qodef-page-wrapper').prepend('<div class="qodef-woo-side-area-cart-cover"/>');

            $('.qodef-woo-side-area-cart-cover').on(
                'click',
                function (e) {
                    e.preventDefault();

                    qodefSideAreaCart.closeSideArea($holder);
                }
            );
        },
        closeSideArea: function ($holder) {
            if ($holder.hasClass('qodef--opened')) {
                qodefCore.qodefScroll.enable();

                $holder.removeClass('qodef--opened');
                $('.qodef-woo-side-area-cart-cover').remove();
            }
        }
    };

})(jQuery);
