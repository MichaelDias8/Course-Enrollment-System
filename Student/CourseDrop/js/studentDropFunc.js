var courseIdInput;

window.onload = function() {
	fillCourse();
	prepareListeners();
}

function prepareListeners() {
    var dropButton;
	dropButton = document.getElementById("dropButton");
    dropButton.addEventListener("click", drop);

	var submitButton;
	submitButton = document.getElementById("infoButton");
    submitButton.addEventListener("click",info);
	
	var cancelButton;
	cancelButton = document.getElementById("cancelButton");
    cancelButton.addEventListener("click",cancel);

}

function fillCourse()
{
	 var xhttp = new XMLHttpRequest();
     xhttp.open("POST", "../../CourseDrop/php/studentDropDB.php", true);
     xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     xhttp.onreadystatechange = function() {
		 if (this.readyState === 4 || this.status === 200){
			 document.getElementById("dis").innerHTML = this.responseText;
         }
     };
     xhttp.send(`function=print_courses&person=${window.localStorage.getItem("studentID")}`);
}

function test()
{
    console.log("test");
}

function drop()
{
	var xhttp = new XMLHttpRequest();
    var course = document.getElementById("courseidt").value;
    xhttp.open("POST", "../../CourseDrop/php/studentDropDB.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
	 if (this.readyState === 4 || this.status === 200){
		 document.getElementById("dis").innerHTML = this.responseText;
        }
    };
    xhttp.send(`function=drop_course&course=${course}&person=${window.localStorage.getItem("studentID")}`);

}

document.querySelector("#infoButton").addEventListener(("click"), function() {
    alert("First Semester and Full year courses must be dropped before Sep 16th. Second Semester Courses must be dropped before Jan 17.");
});