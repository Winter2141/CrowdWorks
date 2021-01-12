function onRemoveError(){
    $("span.error_text").remove();
}
function addError(ele, msg) {
    ele.after($("<span></span>").addClass('error_text').html(msg))
}

function isNormalInteger(str) {
    var n = Math.floor(Number(str));
    return n !== Infinity && String(n) === str && n >= 0;
}

function checkRequire(ele, field) {
    if($.trim(ele.val()) == "") {
        addError(ele, field + "を入力してください。")
        return false;
    }
    return true;
}

function checkMaxLength(ele, length, field) {
    if($.trim(ele.val()).length > length) {
        addError(ele, field + "を" + length + "文字以下に入力してください。");
        return false;
    }
    return true;
}

function checkUploadRequire(ele, field) {
    if($.trim(ele.val()) == "") {
        addError(ele, field + "をアップロードしてください。")
        return false;
    }
    return true;
}

function checkSelect(ele, field) {
    var v = ele.val();
    if (!$.trim(v)) {
        addError(ele, field + "を選択してください。")
        return false;
    }
    return true;
}

function checkURL(ele, field) {
    var v = ele.val();
    var pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
    if (!pattern.test($.trim(v))) {
        addError(ele, field + "をURL形式で入力してください。");
        return false;
    }
    return true;
}

function checkMultiSelect(ele, field) {
    var v = ele.val();
    if (v == null) {
        addError(ele, field + "を選択してください。");
        return false;
    }
    return true;
}

function checkInteger(ele,field) {
    var v = ele.val();
    if($.trim(v) == "") {
        addError(ele, field + "を入力してください。")
        return false;
    }　else {
        if (!isNormalInteger(v) || parseInt(v) == 0) {
            addError(ele, "数値を正確に入力してください。");
            return false;
        }
    }
    return true;

}
