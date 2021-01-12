/* str to split*/
function helper_confirm(id, title, content, width, btnConfirm, btnClose, successCallback, failCallBack) {
    var dialog = $( "#"+id );

    dialog.attr('title', title);
    $("#confirm_text", dialog).html(content);
    var confirm_buttons = {};
    if(btnConfirm){
        confirm_buttons[btnConfirm] = function() {
            if(successCallback)
                successCallback();
            $( this ).dialog( "close" );
        };
    }
    if(btnClose){
        confirm_buttons[btnClose] = function() {
            if(failCallBack)
                failCallBack();
            $( this ).dialog( "close" );
        };
    }

    dialog.dialog({
        resizable: false,
        height: "auto",
        width: width,
        modal: true,
        buttons: confirm_buttons
    });
}