function required(){

var name = document.forms["register"]["name"].value;
var email = document.forms["register"]["email"].value;
var pwd = document.forms["register"]["pwd"].value;
var confirm = document.form["register"]["confirm"].value;

if (name_confirm(name)) {
    if (email_confrim(email)) {
        if (pwd_confirm(pwd)) {
            if (conf_confirm(confirm)) {
            }
        }
    }
}

return false;
}

function name_confirm(name){
    var name_len = name.value.length;
    if (name_len == 0) {
        alert("Username should not be empty");
        name.focus();
        return false;
    }
}

function email_confirm(email){
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email.value.match(mailformat)){
        return true;
    } else {
        alert("You have entered an invalid email address!");
        email.focus();
        return false;
    }
}

function pwd_confirm(pwd){
    var pwd_len = pwd.value.length;
    if (pwd_len == 0){
        alert("Password should not be empty")
        pwd.focus();
        return false;
    }

}

function conf_confirm(confirm){
    if(confirm.value.match(pwd)){
        return true;
    } else {
        alert("Passwords do not match")
        confirm.focus();
        return false;
    }
}