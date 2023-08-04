$(function () {
    $(".column").sortable({
        stop: function (event, ui) {
            $("ul#todo-container>li").each(function (index, element) {
                // element == this
                let newIndex = index + 1;
                $(element).find("input[name='level[]']").val(newIndex);
                $(element).find("#todo-id").html(newIndex);
            });

            $.ajax({
                type: "PUT",
                url: "/api/todo",
                data: $('#todo-container-form').serialize() + "&type=sort",
                success: function (response) {
                    console.log(response);
                }
            });
        },
    });
    $("#done-container").droppable({
        drop: {


        }
    })
});