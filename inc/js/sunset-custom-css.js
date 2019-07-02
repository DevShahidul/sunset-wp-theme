(function($){
    $(function(){
        var updateCss = function(){
            $("#custom_css").val(editor.getSession().getValue());
        }
        $('#save-custom-css-form').submit(updateCss);
    })
})(jQuery)

var editor = ace.edit("customCsseditor");
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/css");
editor.session.setUseWrapMode(true);