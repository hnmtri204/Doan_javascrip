$(document).ready(function () {
    $('.quantity-input').on('input', function () {
        var quantity = $(this).val();
        var price = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());
        var total = quantity * price;
        $(this).closest('tr').find('.product-total').text('$' + total);

        // Tính tổng số tiền của tất cả sản phẩm khi có sự thay đổi số lượng
        var totalAmount = 0;
        $('.product-total').each(function () {
            totalAmount += parseFloat($(this).text().replace('$', ''));
        });
        $('#total-value').text('$' + totalAmount);
    });
});