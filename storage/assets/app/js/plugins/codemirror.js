$(document).ready(function(){

    var editor = CodeMirror.fromTextArea(document.getElementById("codemirror"), {
        mode: "php",
        extraKeys: {
            "Ctrl-J": "toMatchingTag",
            "F11": function(cm) {
                cm.setOption("fullScreen", !cm.getOption("fullScreen"));
            },
            "Esc": function(cm) {
                if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
            },
            "Ctrl-Space": "autocomplete"
        },
        theme: "github",
        lineWrapping: true,
        cursorBlinkRate: 200,
        setSize: ['200','200'],
        autocorrect: true,
        autofocus: true,
        lineNumbers: true,
        gutters: ["CodeMirror-linenumbers"],
        styleActiveLine: true,
        autoCloseBrackets: true,
        autoCloseTags: true,
        readOnly: $("#codemirror").data('readonly')
        // scrollbarStyle:"simple",
    });    
    editor.setSize("100%", "100%");    

    $(".link").on("click", function() {
        var href = $(this).data("href");

        editor.getDoc().setValue('');

        $.ajax({
            url: $(this).data('action'),
            method: "POST",
            data: {'filename':href},
            success: function(data) {

                editor.getDoc().setValue(data);
                editor.setSize("100%", "100%");
                editor.setOption("readOnly", false);

                $("input[name='filename']").val(href);

                $('.modal').each(function() {
                    $(this).modal('hide');
                });
            }
        });

    });
});