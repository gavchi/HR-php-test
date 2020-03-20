$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var priceInput = $("input.productPrice");
    var typingOnTimer;
    var doneTypingInterval = 1000;

    priceInput.off('keyup');
    priceInput.on('keyup', function() {
        var element = $(this);
        var price = this.value;
        var productId = $(this).parents('tr').attr('product-id');
        clearTimeout(typingOnTimer);
        typingOnTimer = setTimeout(function () {
            element.attr('disabled', 'disabled');
            $.ajax({
                method: "post",
                url: "/products/" + productId,
                data: {
                    price : price
                },
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                synchronous: true,
                complete: function (res) {
                    element.delay(1000).removeAttr('disabled');
                },
            });
        }, doneTypingInterval);
    });

    priceInput.off('keydown');
    priceInput.on('keydown', function () {
        clearTimeout(typingOnTimer);
    });
});
