/**
 *
 *
 */

var Cart = (function () {

    var topCartClass = '.top-cart';

    /**
     * init
     */
    function init() {
        bindEvents();
    }

    /**
     * bindEvents
     */
    function bindEvents() {
        $(document)
            .on('click', '.add-to-cart', addToCart)
            .on('click', '.remove-from-cart', removeFromCart)

    }

    /**
     * Добавление товара в корзину
     */
    function addToCart() {
        $.post("/cart/add",
            {productId: $(this).data('productId')},
            function (data) {
                $.get(
                    '/site/get-flash/' + data,
                    function (data) {
                        Notify.generate(data.message, 'Корзина', data.type);
                    },
                    'json'
                );
                renderCart();
            }, "text");
    }

    function removeFromCart() {

        var productId = null;

        if (undefined !== $(this).data('productId')) {
            productId = $(this).data('productId');
        }

        $.post("/cart/remove",
            {productId: productId},
            function (data) {
                $.get(
                    '/site/get-flash/' + data,
                    function (data) {
                        Notify.generate(data.message, 'Корзина', data.type);
                    },
                    'json'
                );
                renderCart();
            }, "text");
    }

    /**
     *  Отрисовка корзины
     */
    function renderCart() {
        $.get('/cart/render-cart',
            function (data) {
                var tpl = '';
                if (parseInt(data.productsTotal) > 0) {
                    tpl = '<i class="fas fa-shopping-cart"></i><span class="cart-total-products badge badge-secondary">' + data.productsTotal + '</span>' + data.cost + 'р.';
                } else {
                    tpl = '<i class="fas fa-shopping-cart"></i>&nbsp;Корзина';
                }
                $(topCartClass).html(tpl);
            }
        );
    }

    $(function () {
        init();
    });

    return {
        renderCart: renderCart
    }
})();
