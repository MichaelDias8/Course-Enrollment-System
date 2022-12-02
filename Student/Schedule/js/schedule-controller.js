var toggle = 1; // 0 When semester lists showing, 1 when schedule showing
var semester1Schedule;
var semester2Schedule;
var semester1List;
var semester2List;

window.onload = function() {
    //Initialise the element variables
    semester1Schedule = document.querySelectorAll(".schedule-container")[0];
    semester2Schedule = document.querySelectorAll(".schedule-container")[1];
    semester1List = document.querySelectorAll(".schedule-list")[0];
    semester2List = document.querySelectorAll(".schedule-list")[1];

    //Fill course views with data from the database
    fillLists();
    fillSchedules();

    //Remove the schedule view from the page
    semester1Schedule.remove();
    semester2Schedule.remove();

    
}

//Called when toggle view button pressed
function toggleView()
{
    if(toggle == 0)
    {
        //Update toggle and button text
        toggle = 1;
        document.querySelector(".toggle-btn").textContent = "Switch to schedule view";
        //Add the semester views back to the page
        document.querySelector(".main-content").appendChild(semester1List);
        document.querySelector(".main-content").appendChild(semester2List);
        //Remove the calendar view from the page
        semester1Schedule.remove();
        semester2Schedule.remove();
    }else
    {
        //Update toggle and button text
        toggle = 0;
        document.querySelector(".toggle-btn").textContent = "Switch to list view";
        //Add the calendar view back to the page
        document.querySelector(".main-content").appendChild(semester1Schedule);
        document.querySelector(".main-content").appendChild(semester2Schedule);
        //Remove the semester views from the page
        semester1List.remove();
        semester2List.remove();
    }
    
}

//Fills the list views with data from the database
function fillLists()
{
    //Get the student ID from local storage
    var studentID = window.localStorage.getItem("studentID");
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../php/scheduleDBService.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var results = (JSON.parse(this.responseText));   
            semester1List.querySelector(".courses").insertAdjacentHTML("beforeend", results[0]);
            semester2List.querySelector(".courses").insertAdjacentHTML("beforeend", results[1]);
        }
    };
    xhttp.send(`function=get_course_list&studentID=${studentID}`);
}

//Fills the calendar views with data from the database
function fillSchedules()
{
    //Get the student ID from local storage
    var studentID = window.localStorage.getItem("studentID");
   
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../php/scheduleDBService.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var results = (JSON.parse(this.responseText));
            semester1Schedule.querySelectorAll(".scheduled-classes").forEach((element, index) => {
                element.insertAdjacentHTML("beforeend", results[0][index]);
            });
            semester2Schedule.querySelectorAll(".scheduled-classes").forEach((element, index) => {
                element.insertAdjacentHTML("beforeend", results[1][index]);
            });
            //Organise the added classes into the correct time slots
            semester1Schedule.querySelectorAll(".scheduled-classes").forEach((element) => {
                organiseClasses(element);
            });
            semester2Schedule.querySelectorAll(".scheduled-classes").forEach((element) => {
                organiseClasses(element);
            });
        }
    };
    xhttp.send(`function=get_schedule&studentID=${studentID}`);
}

//Organises the classes in the given element into the correct time slots
function organiseClasses(dayOfClasses)
{ 
    dayOfClasses.querySelectorAll(".class-time-block").forEach((timeBlock) => {
        //Remove a placeholder so there is space for the class to be added
        var time = timeBlock.querySelector(".class-time").textContent;
        var startHour = time.split(" - ")[0].slice(0,2);
        var endHour = time.split(" - ")[1].slice(0,2);
        //Based on the class length, remove the correct number of placeholder blocks, and style class block to correct height
        var classLength = endHour - startHour;
        switch(classLength){
            case 2:
                timeBlock.style.height = "82px";
                break;
            case 3:
                timeBlock.style.height = "133px";
                break;
        }
        for(var i = 0; i < classLength; i++)
        {
            dayOfClasses.querySelector(".placeholder-time-block").remove();
        }
        //Based on the time, move the class to the correct time slot
        console.log(startHour);
        dayOfClasses.querySelectorAll(".placeholder-time-block")[startHour-8].insertAdjacentElement("beforebegin", timeBlock);
        //Change the outline color of classes so they are easier to see
        timeBlock.style.borderColor = intToRGB(hashCode((timeBlock.querySelector("p").textContent)));
    });

    function hashCode(str) {
        var hash = 0;
        for (var i = 0; i < str.length; i++) {
           hash = str.charCodeAt(i) + ((hash << 5) - hash);
        }
        return hash;
    } 
    
    function intToRGB(i){
        var c = (i & 0x00FFFFFF)
            .toString(16)
            .toUpperCase();
    
        return "#" + "00000".substring(0, 6 - c.length) + c;
    }
}