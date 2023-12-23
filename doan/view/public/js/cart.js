$(document).ready(function () {
    $(".addToCartBtn").on("click", function () {
        var Id = $(this).data("product-id");
        var Name = $(this).data("product-name");
        var Price = $(this).data("product-price");
        var quantity = $(this).closest('.details').find("input[name='quantity']").val();

        $.ajax({
            url: 'http://localhost/doan/view/cart.php?id=',
            method: "POST",
            data: {
                Id: Id,
                Name: Name,
                Price: Price,
                quantity: quantity
            },
            success: function (response) {
                console.log(response);
                if (response === 'success') {
                    alert("Product added to cart!");
                } else {
                    alert("Error adding product to cart!");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
$(document).ready(function () {
    $('.delete-product').click(function () {
        var index = $(this).data('index');
        var action = 'delete';

        $.ajax({
            type: 'POST',
            url: 'http://localhost/doan/view/cart.php?id=',
            data: { action: action, delete_index: index },
            success: function (response) {
                if (response === 'success') {
                    location.reload();
                } else {
                    console.log('Error deleting product');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
$(document).ready(function () {
    $('.update-quantity').click(function () {
        var index = $(this).data('index');
        var newQuantity = $(this).closest('tr').find('.quantity-input').val();
        var action = 'update_quantity';

        $.ajax({
            type: 'POST',
            url: 'http://localhost/doan/view/cart.php',
            data: {
                action: action,
                update_index: index,
                new_quantity: newQuantity
            },
            success: function (response) {
                if (response === 'success') {
                    alert('Quantity updated successfully!');
                } else {
                    console.log('Error updating quantity');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
