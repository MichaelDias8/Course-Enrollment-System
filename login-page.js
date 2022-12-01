const studentLogin = document.querySelector("#studentLogin");
const adminLogin = document.querySelector("#adminLogin");

//Student variables
const studentLoginButton = document.getElementById('studentLoginButton');
const studentUsername = document.querySelector("#studentUsername");
const studentPassword = document.querySelector("#studentPassword");

//Admin variables
const adminLoginButton = document.getElementById('adminLoginButton');
const adminUsername = document.querySelector("#adminUsername");
const adminPassword = document.querySelector("#adminPassword");


//Verify the student login credentials -- if successful, connect to the student page
checkStudentInfo = function() {
    var username = document.getElementById('studentUsername').value;
    var password = document.getElementById('studentPassword').value;
    
    //Values used to connect to the pgp page that checks credentials
    var http = new XMLHttpRequest();
    var url = 'verifyStudentLogin.php';
    var method = 'POST';

    http.open(method, url, true);
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            var studentID = JSON.parse(this.responseText);
            
            if(studentID) {
                //Connect to Tommy's php file
                window.localStorage.setItem("studentID", `${studentID}`) 
                window.location.replace("studentMain.html");
            } else {
                //Update the error message to say Login Unsuccessful
                document.querySelector("#studentError").textContent = "Login Unsuccessful: Enter a valid username and password.";
            }
        }
    };

    http.send(`username=${username}&password=${password}`);

};

//Verify the admin login credentials -- if successful, connect to the admin page
checkAdminInfo = function() {
    var username = document.getElementById('adminUsername').value;
    var password = document.getElementById('adminPassword').value;
    
    //Values used to connect to the php page that checks credentials
    var http = new XMLHttpRequest();
    var url = 'verifyAdminLogin.php';
    var method = 'POST';

    http.open(method, url, true);
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            var adminID = JSON.parse(this.responseText);
            
            if(adminID) {
                //Connect to the admin php file
                window.localStorage.setItem("adminID", `${adminID}`) 
                window.location.replace("adminMain.html"); // Change this to Zhuyan's filename
            } else {
                //Update the error message to say Login Unsuccessful
                document.querySelector("#adminError").textContent = "Login Unsuccessful: Enter a valid username and password.";
            }
        }
    };

    http.send(`username=${username}&password=${password}`);

};

//Switch to the student view when the link is clicked
document.querySelector("#adminLoginView").addEventListener("click", e => {
    e.preventDefault();
    studentLogin.classList.add("form--hidden");
    adminLogin.classList.remove("form--hidden");
});

//Switch to the admin view when the link is clicked
document.querySelector("#studentLoginView").addEventListener("click", e => {
    e.preventDefault();
    studentLogin.classList.remove("form--hidden");
    adminLogin.classList.add("form--hidden");
});

//Listen to the login button click and call that respective check credentials function
studentLoginButton.addEventListener('click', checkStudentInfo);
adminLoginButton.addEventListener('click', checkAdminInfo);





