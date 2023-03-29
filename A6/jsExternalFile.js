
//required field
function requiredElement(){
    user = document.getElementById('user').value;
    key = document.getElementById('password').value;
    fullname = document.getElementById('fullname').value;
    info = document.getElementById('info').value;
    math = document.getElementById('math').value;
    if(user == "" || key == "" || fullname == "" || info == "" || math == ""){
        document.getElementById('identifmg').style.color = "black";
        return -1;
    }
    else return 1;
}



// validate field. It must only contains numbers 
function validateIdentif(){
    user = document.getElementById('user').value;
    if(!isNaN(user)){
        document.getElementById('identifmg').style.color = "green";
    }
    else document.getElementById('identifmg').style.color = "red";
}



// validate password
function validateKey(){
    key = document.getElementById('password').value;
    if(key.length < 8){
        document.getElementById('keymg').style.color = "red";
    }
    else document.getElementById('keymg').style.color = "green";
}



//validate full name
function validateName(){
    text = /^[a-zA-Z\s]+$/;
    fname = document.getElementById('fname');

    if(fname.value.match(text)){
        document.getElementById('identifmg').style.color = "red";
    }
    else document.getElementById('identifmg').style.color = "green";
}




//validate form
function validateForm(){
    if (requiredElement() == -1){
        alert ("All fields are required.");
    }
    else return true;
}