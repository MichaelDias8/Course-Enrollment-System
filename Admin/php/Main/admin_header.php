<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="/Admin/php/Main/admin_page.php" class="logo">Admin<span>Center</span></a>

      <nav class="navbar">
         <a href="/Admin/php/Main/admin_page.php">Home</a>
         <a href="/Admin/php/AddCourse/add_new_course.php">CourseAdd</a>
         <a href="/Admin/php/ModifyCourse/modify_course.php">CourseModify</a>
         <a href="/Admin/php/DeleteCourse/delete_course.php">CourseDelete</a>      
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="account-box">
         <p></p>
         <div><a href="/Login/html/login.html">Log Out</a></div>
      </div>
   </div>

</header>
 