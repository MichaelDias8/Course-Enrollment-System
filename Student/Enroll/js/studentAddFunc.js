/* This file implements the functionality of student add course page.
It implements the actions triggered by clicking on buttons and requests sent to the database.
*/

var courseIdInput;

window.onload = function() {
	prepareListeners();
}

function prepareListeners() {
	var submitButton;
	submitButton = document.getElementById("submitButton");		// button to enroll the chosen course
    submitButton.addEventListener("click",submit);
	
	var searchButton;
	searchButton = document.getElementById("searchButton");		// button to add course in the enrolled list and show information
    searchButton.addEventListener("click",search);
}

function search()
{
	 var xhttp = new XMLHttpRequest();
     var course = document.getElementById("courseidt").value;	// get content input by user
     xhttp.open("POST", "../php/studentAddDB.php", true);
     xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     xhttp.onreadystatechange = function() {
		 if (this.readyState === 4 || this.status === 200){
			 document.getElementById("dis").innerHTML = this.responseText;	// fill in the "dis" place with returned content by php file
         }
     };
     xhttp.send('function=get_course_info&course=' + course);	// the input course ID is sent as a parameter with function name

}

function submit()
{
	var xhttp = new XMLHttpRequest();
	var course = document.getElementById("courseidt").value;
    xhttp.open("POST", "../php/studentAddDB.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
	 if (this.readyState === 4 || this.status === 200){
		 document.getElementById("dis").innerHTML = this.responseText;
        }
    };
    xhttp.send(`function=add_taken_courses&course=${course}&person=${window.localStorage.getItem("studentID")}`);	// the input course ID is sent as a parameter with function name

}

