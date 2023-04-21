let connected = true;
let info_true = true;

var usernameInput = document.getElementById("Email");
var passwordInput = document.getElementById("Password");



function check(username,password){
  if (username=="baha@gmail.com" && password=="baha"){
    return true
  }
  else
  {
    return false 
  }
}



function  Connect(){
  if (info_true == true){
    console.log("clicked !");

    var username = usernameInput.value;
    var password = passwordInput.value;

    if(check(username,password)){
      window.location.href = "index_.html";
    }
    else
    {
      alert("username or password invalid !")
    }

    

  }

}
