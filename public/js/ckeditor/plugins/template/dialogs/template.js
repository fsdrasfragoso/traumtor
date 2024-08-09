CKEDITOR.dialog.add("templateDialog", function(editor) {
    var config = editor.config.template || {};
    var templates = config.templates || [];
    var templateItems = [];
    var t = {};
    for (var i = 0; i < templates.length; ++i) {
        t = templates[i];
        templateItems.push([t.label, t.name]);
    }
    var items = [["Selecione", ""]];
    Array.prototype.push.apply(items, templateItems);

    selectedTemplate = "";

    return {
        title: "Configurações do Modelo",
        minWidth: 400,
        minHeight: 10,

        contents: [
            {
                elements: [
                    {
                        id: "template",
                        type: "select",
                        label: "Modelo",
                        items: items,
                        validate: CKEDITOR.dialog.validate.notEmpty(
                            "Modelo não pode ser vazio."
                        ),
                        commit: function() {
                            var templateId = this.getValue();
                            var t = {};
                            for (var i = 0; i < templates.length; ++i) {
                                t = templates[i];
                                if (t.name == templateId) {
                                    selectedTemplate = t;
                                    break;
                                }
                            }
                        }
                    }
                ]
            }
        ],

        onOk: function() {
            this.commitContent();
            editor.insertHtml(selectedTemplate.template);
        }
    };
});
