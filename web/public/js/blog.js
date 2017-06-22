/**
 * Created by Samuel Besnier on 22/06/2017.
 */

$(document).ready(function () {
    // Add a category selector in form
    $("#add-category").click(function () {
        var cat = $(".form-category");
        $("#categories_list").append($(".form-category").html());
    });
    // Delete a category selector in form
    $("#categories_list").on("click", ".delete", function () {
        $(this).parent().parent().remove();
    });
});