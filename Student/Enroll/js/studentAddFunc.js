var courseIdInput;

window.onload = function() {
	prepareListeners()
}

function prepareListeners() {
	var submitButton;
	submitButton = document.getElementById("submitButton");
    submitButton.addEventListener("click",submit);
	
	var cancelButton;
	cancelButton = document.getElementById("cancelButton");
    cancelButton.addEventListener("click",cancel);
	
	var searchButton;
	searchButton = document.getElementById("searchButton");
    searchButton.addEventListener("click",search);
}

function search()
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
     xhttp.send('function=get_course_info&course=' + course);

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
     xhttp.send('function=add_taken_courses&course=' + course);
}

function cancel()
{
	
}

