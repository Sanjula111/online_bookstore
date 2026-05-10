<?php 
    $active='Home';
    include("./include/header.php");
?>


   <div id="featured">
       <div class="box">
           <div class="container">
               <div class="col-md-12">
                   <h2>Recently added Books</h2>
               </div>
           </div>
       </div>                
   </div> 
   
   <div id="content" class="container">
       <div class="row">
           <?php 
            
            getPro();

           ?> 
       </div>
        </br>
       <div class="row">
            
       </div> 
   </div>

</br></br>
    <!--including footer-->
   <?php
    include("./include/footer.php");
   ?>
   
   
<script src="./js/jquery-3.7.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
    
</body>
</html>