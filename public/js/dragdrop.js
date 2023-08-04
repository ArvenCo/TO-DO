
function updateLevel() {
    $("ul#todo-container>li").each(function (index, element) {
        // element == this
        let newIndex = index + 1;
        $(element).find("input[name='level[]']").val(newIndex);
        $(element).find("#todo-id").html(newIndex);
        if (newIndex == 1) {
            $(element).find("div.status").html("Ongoing");
        } else {
            $(element).find("div.status").html("Pending");
        }

        $.ajax({
            type: "PUT",
            url: "/api/todo",
            data: $('#todo-container-form').serialize() + "&type=sort",
            success: function (response) {
                console.log(response);
            }
        });
    });
}

$(function () {
    $(".column").sortable({
        stop: function (event, ui) {

            updateLevel();
        },
    });
    $("ul#todo-container>li").draggable();
    $("#done-container").droppable({
        accept: "ul#todo-container>li",
        drop: function (event, ui) {
            let id = ui.draggable.find("input[name='id[]']").val()

            console.log(id);
            $.ajax({
                type: "PUT",
                url: "/api/todo",
                data: { id, type: "done" },
                success: function (response) {
                    console.log(response);
                    location.reload();
                }
            });

        }
    })
    $("ul#done-container>li").draggable();
    $("#todo-container").droppable({
        accept: "ul#done-container>li",
        drop: function (event, ui) {
            let id = ui.draggable.find("input[name='id[]']").val()
            console.log(id);
            $.ajax({
                type: "PUT",
                url: "/api/todo",
                data: { id, type: "undone" },
                success: function (response) {
                    console.log(response);
                    location.reload();
                }
            });

        }
    })
});
