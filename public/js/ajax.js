$(document).ready(function () {
    $(".closeModal").on("click", function (e) {
        let modalName = $(this).attr("id");
        e.preventDefault();
        console.log(modalName);
        $("#" + modalName).modal("hide");
    });
    $(".editadmin").on("click", function (e) {
        let adminId = $(this).attr("id");
        $("#addAdminModal").modal("show");
        e.preventDefault();
        $.ajax({
            url: "/admin/" + adminId,
            method: "get",
            success: function (result) {
                console.log(result);
                $("#titleModal").text("Edit Admin");
                $("#username").val(result.username);
                $("#email").val(result.email);
                $("#admin_type").val(result.admin_type);
            },
        });
    });
    $(".editcategory").on("click", function (e) {
        let category = $(this).attr("id");
        $("#addCategoryModal").modal("show");
        e.preventDefault();
        const userId = location.pathname.split("/")[1];
        $.ajax({
            url: 'user/'+category,
            method: "get",
            success: function (result) {
                console.log(result);
                $("#titleModal").text("Edit Admin");
                $("#name").val(result.name);
                $("#description").val(result.description);
                $("#show_nav").val(result.show_nav);
                $("#btnSubmitCat").text("Update");
                $("#addCategoryForm").attr(
                    "action",
                    "/user/" + userId + "/" + category + "/update"
                );
            },
        });
    });

    $(".editproduct").on("click", function (e) {
        let product = $(this).attr("id");
        e.preventDefault();
        const userId = location.pathname.split("/")[1];
        $.ajax({
            url: "/user/" + userId + "/products/" + product,
            method: "get",
            success: function (result) {
                console.log(result);
                $("#titleModal").text("Edit Product");
                $("#name").val(result.name);
                $("#description").val(result.description);
                $("#price").val(result.price);
                $("#quantity").val(result.quantity);
                // $("#image").val(result.image);
                $("#tags").val(result.tags);

                $("#btnSubmitProduct").text("Update");
                $("#addProductForm").attr(
                    "action",
                    "/user/" + userId + "/products/" + product + "/update"
                );
                $("#addProductModal").modal("show");
            },
        });
    });

    $(".addtocart").on("click", function (e) {
        let product = $(this).attr("id");
        let userId = $("#userId").val();
        if (!userId) {
            $("#addToCartModal").modal("show");
            $("#exampleModalLabel").text("Please Login First");
            return;
        }
        console.log(userId);
        e.preventDefault();
        console.log(product);
        $.ajax({
            url: "/user/" + userId + "/cart/" + product,
            method: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (result) {
                console.log(result);
                if (result.quantity > 1) {
                    $("#quantity").val(result.quantity);
                    $("#totalPrice").text(
                        parseInt($("#priceProduct").text() * result.quantity)
                    );
                    $("#exampleModalLabel").text("Your Shopping Cart");
                    $("#addToCartModal").modal("show");
                } else if (result[0].error) {
                    $("#message")
                        .html(`<div class="alert alert-primary" role="alert">
                    ${result[0].error}
                         </div>`);
                    setTimeout(function () {
                        $("#message").html("");
                    }, 4000);
                } else {
                    $("#addToCartModal").modal("show");
                    $("#exampleModalLabel").text("Added to Cart");
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
    $(".updateQuantity").on("click", function (e) {
        e.preventDefault();
        let quantity = $("#quantityUpdate").val();
        let userId = $("#userId").val();
        let cart = $(this).attr("id");

        if (!userId) {
            $("#addToCartModal").modal("show");
            $("#exampleModalLabel").text("Please Login First");
            return;
        }
        let data = { quantity: quantity };
        $.ajax({
            url: "/user/" + userId + "/cart/" + cart,
            method: "put",
            contentType: "application/json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: JSON.stringify(data),
            dataType: "json",
            success: function (result) {
                if (result[0].success) {
                    $("#totalPrice").text(
                        parseInt($("#priceProduct").text() * quantity)
                    );
                    $("#message")
                        .html(`<div class="alert alert-success" role="alert">
                ${result[0].success}
              </div>`);
                    let id = setTimeout(function () {
                        $("#message").html("");
                        clearInterval(id);
                    }, 4000);
                } else {
                    $("#message")
                        .html(`<div class="alert alert-warning" role="alert">
                    ${result[0].error}
                  </div>`);
                    let id = setTimeout(function () {
                        $("#message").html("");
                        clearInterval(id);
                    }, 4000);
                }
            },
            error: function (error) {
                $("#message").html(
                    '<div class="alert alert-warning" role="alert"> Sorry Error Occured </div>'
                );
                let id = setTimeout(function () {
                    $("#message").html("");
                    clearInterval(id);
                }, 4000);
            },
        });
    });

    // });
});