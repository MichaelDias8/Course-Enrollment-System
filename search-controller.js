window.onload = function() {
    //Fill the page with content from the database
    fillDropdowns();
    fillCourses();
    setUpEventListeners();
}

//Fills the module dropdown with the data from the database
function fillDropdowns()
{ 
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "courseDBService.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".select-module select").insertAdjacentHTML("beforeend", this.responseText);
        }
    };
    xhttp.send('function=get_module_options');
}

//Fills the courses table with the data from the database
function fillCourses()
{
    var module = document.querySelector(".select-module select").value;
    var semester = document.querySelector(".select-semester select").value;
    var year;
    document.querySelectorAll(".select-year input").forEach((element) => {
        if(element.checked)
        {
            year = element.value;
        }
    });
    var courseName = document.querySelector("#search-by-name input").value;

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "courseDBService.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".results-container").innerHTML = this.responseText;
        }
    };
    xhttp.send(`function=get_courses&module=${module}&semester=${semester}&year=${year}&courseName=${courseName}`);
}

function setUpEventListeners()
{
    //Set up event listener for the module dropdown
    document.querySelector(".select-module select").addEventListener("change", function() {
        fillCourses();
    });

     //Set up event listener for the semester dropdown
     document.querySelector(".select-semester select").addEventListener("change", function() {
        fillCourses();
    });

    //Set up event listeners for the search boxes
    document.querySelectorAll(".search-by-box input").forEach((element) => {
        element.addEventListener("keyup", function() {
            fillCourses();
        });
    });
}