let connected = true;
let info_true = true;

var usernameInput = document.getElementById("Email");
var passwordInput = document.getElementById("Password");



function check(account){
  
    fetch('../server/login.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(account)
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      // handle the response data
      window.location.href = "index_.html";
      //yhezk lil homepage
    })
    .catch(error => {
      console.error(error);
      // handle the error
    });
}



function  Connect(){
  if (info_true == true)
  {
    console.log("clicked !");

    var username = usernameInput.value;
    var password = passwordInput.value;
    const account = {
      email:username,
      password:password
    }
    check(account)
  }

}
