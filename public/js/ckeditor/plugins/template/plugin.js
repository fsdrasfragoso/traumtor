CKEDITOR.plugins.add("template", {
    icons: "template",
    init: function(editor) {
        editor.addCommand(
            "template",
            new CKEDITOR.dialogCommand("templateDialog")
        );

        editor.ui.addButton("Template", {
            label: "Inserir Modelo",
            command: "template",
            toolbar: "insert"
        });

        CKEDITOR.dialog.add(
            "templateDialog",
            this.path + "dialogs/template.js"
        );
    }
});
