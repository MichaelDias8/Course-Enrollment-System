document.querySelector(".delete-btn").onclick = () => {
    document.querySelectorAll('.data-row').forEach((item) => {
       if (item.querySelector('input').checked) {
          //If the user clicks the modify button, run php script and pass the courseID to delete
          var courseID = item.querySelector("input").value;
          var adminID = window.localStorage.getItem("adminID");
 
          window.location.replace(`/Admin/php/DeleteCourse/delete.php?courseID=${courseID}&delete=false`);
       }
    });
 }