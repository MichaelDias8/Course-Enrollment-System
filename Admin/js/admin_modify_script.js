document.querySelector(".modify-btn").onclick = () => {
   document.querySelectorAll('.data-row').forEach((item) => {
      if (item.querySelector('input').checked) {
         //If the user clicks the modify button, run php script and pass the adminID and courseID
         var courseID = item.querySelector("input").value;
         var adminID = window.localStorage.getItem("adminID");

         window.location.replace(`/Admin/php/ModifyCourse/modify.php?id=${courseID}&adm=${adminID}&modify=false`);
      }
   });
}