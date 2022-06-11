$(document).ready(function(){
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
});