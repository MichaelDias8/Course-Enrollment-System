var courseIdInput;

window.onload = function() {
	fillCourse();
	prepareListeners()
}

function prepareListeners() {
	var infoButton;
	submitButton = document.getElementById("infoButton");
    submitButton.addEventListener("click",info);
	
	var cancelButton;
	cancelButton = document.getElementById("cancelButton");
    cancelButton.addEventListener("click",cancel);
	
	var dropButton;
	searchButton = document.getElementById("dropButton");
    searchButton.addEventListener("click",drop);
}

function fillCourse()
{
	 var xhttp = new XMLHttpRequest();
     xhttp.open("POST", "../php/studentDropDB.php", true);
     xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     xhttp.onreadystatechange = function() {
		 if (this.readyState === 4 || this.status === 200){
			 document.getElementById("dis").innerHTML = this.responseText;
         }
     };
     xhttp.send('function=print_courses');
}

function drop()
{
	 var xhttp = new XMLHttpRequest();
     var course = document.getElementById("courseidt").value;
     xhttp.open("POST", "../../Enroll/php/studentAddDB.php", true);
     xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     xhttp.onreadystatechange = function() {
		 if (this.readyState === 4 || this.status === 200){
			 document.getElementById("dis").innerHTML = this.responseText;
         }
     };
     xhttp.send('function=drop_course&course=' + course);

}

function info()
{
	
}

function cancel()
{
	
}
