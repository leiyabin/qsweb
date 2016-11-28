/**
 * Created by lx on 2016/11/20.
 */
var editor;
KindEditor.ready(function (K) {
    editor = K.create('textarea[name="news_content"]', {
        cssPath: '/editor/plugins/code/prettify.css',
        uploadJson: '/editor/php/upload_json.php',
        fileManagerJson: '/editor/php/file_manager_json.php',
        allowFileManager: true,
        afterCreate: function () {
            var self = this;
            K.ctrl(document, 13, function () {
                self.sync();
                K('form[name=example]')[0].submit();
            });
            K.ctrl(self.edit.doc, 13, function () {
                self.sync();
                K('form[name=example]')[0].submit();
            });
        }
    });
    prettyPrint();
});