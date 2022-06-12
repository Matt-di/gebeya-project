$(function(){
    $(".edit").on('click', function(event){
    event.stopPropagation();
    event.stopImmediatePropagation();
    
    let id = $(this).attr('id');
    //(... rest of your JS code)
    $.ajax({
        type: "get",
        url: "/category/"+id,
        success: function(category){
           console.log(category);
           $("#titleModal").val("Update Category");
           $("#name").val(category.name);
           $("#description").val(category.description);
           $("#shownav").val(category.show_nav==1?'checked':"");
           $("#btnSubmitCat").val("Update");
           $("#addCategoryForm").attr("action","/category/"+id+"/update");
           $('#addCategoryModal').modal('show');
        }
      });
});
$(".editProduct").on('click', function(event){
  event.stopPropagation();
  event.stopImmediatePropagation();
  let id = $(this).attr('id');
  //(... rest of your JS code)
  $.ajax({
      type: "get",
      url: "/products/"+id+"/get",
      success: function(product){
         console.log(product);
         $("#titleModal").val("Update Product");
         $("#name").val(product.name);
         $("#description").val(product.description);
         $("#category_id").val(product.category_id);
         $("#price").val(product.price);
         $("#quantity").val(product.quantity);
         $("#btnSubmitCat").val("Update");
         $("#addProductForm").attr("action","/products/"+id+"/update");
         $('#addProductModal').modal('show');
      }
    });
});
$(".showCategory").on('click', function(event){
  event.stopPropagation();
  event.stopImmediatePropagation();
  let id = $(this).attr('id');
  //(... rest of your JS code)
  $.ajax({
      type: "get",
      url: "/category/"+id,
      success: function(category){
         console.log(category);
         $("#myModalLabel").text(category.name);
         $("#cardBody").text(category.description);
         $("#cardBody2").text(category.created_at);
         $('#showCategoryModal').modal('show');
      }
    });
});
$(".closeProductModal").on('click', function(event){
  $('#addProductModal').modal('hide');
});
});