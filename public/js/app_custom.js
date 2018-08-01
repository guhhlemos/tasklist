function slider_avaliacao() {

    var handle = $("#custom-handle");
    $("#slider").slider({
        range: "max",
        min: 1,
        max: 10,
        value: 5,
        create: function () {
            handle.text($(this).slider("value"));
        },
        slide: function (event, ui) {
            handle.text(ui.value);
            $("#amount").val(ui.value);
        }
    });
    $("#amount").val($("#slider").slider("value"));
}