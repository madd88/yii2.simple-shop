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
            .on('change', '.cart-product-count', recountCart)

    }

    /**
     * Добавление товара в корзину
     */
    function addToCart(productId, count) {
        if (productId instanceof Object) {
            productId = $(this).data('productId');
            count = 1;
        }

        $.post("/cart/add",
            {
                productId: productId,
                count: count
            },
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
        return false;
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
                        document.location.reload();
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

    function recountCart() {
        var productId = $(this).data('productId');
        var productCount = $(this).val();
        $.get('/cart/recount-cart',
            {
                productId : productId,
                count : productCount
            },
            function (data) {
                document.location.reload();
            }
        );
        console.log(productId , "|", productCount);
    }

    $(function () {
        init();
    });

    return {
        renderCart: renderCart
    }
})();
