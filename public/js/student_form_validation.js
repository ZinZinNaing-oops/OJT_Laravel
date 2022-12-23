$(document).ready(function() {
     //validate special character
    jQuery.validator.addMethod("noSpecialCharacter", function(value, element) { 
        return !(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(value)); 
      }, "特殊文字を入力しないでください。");

    //validate no start with space
    jQuery.validator.addMethod("noSpaceAtStart", function(value, element) {
        return !(/^\s/.test(value));
     }, "スペースから始めないでください。");

     //validate roll no
    jQuery.validator.addMethod("rollNoFormat", function(value, element) {
        return /^[IST][-][0-9-]/.test(value);
     }, "無効なロール番号。");

    $("#form").validate(); 
    $("#name").rules("add", {
        required : true,
        noSpecialCharacter: true,
        noSpaceAtStart:true,
        messages : {
            required : "名前を入力してください。"
        }
    });
    $("#age").rules("add", {
        required : true,
        range:[20,35],
        messages : {
            required : "年齢を入力してください。",
            range: "年齢は範囲外です。"
        }
    });
    $("#roll_no").rules("add", {
        required : true,
        messages : {
            required : "ロール番号を入力してください。",
        }
    });
})