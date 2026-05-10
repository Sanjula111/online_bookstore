<?php 
    $active='Contact';
    include("./include/header.php");
?>
    
    <div id="content">
       <div class="container-fluid">
           <div class="col-md-12">
               <ul class="breadcrumb">
                   <li><a href="index.php">Home</a></li>
                   <li>Contact</li>
               </ul>
           </div>
           <!--Including sidebar-->
           <div class="col-md-3">
               <?php include("./include/sidebar.php"); ?>   
            </div>

            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <center>
                            <h2>Share Your Feedback</h2>
                            <p class="text-muted">Your feedback matters! Please take a moment to share your thoughts, questions, or concerns with us. We value your input and are here to assist you. Leave a message, and our team will get back to you as soon as possible.</p>
                        </center>
                        <form action="contact.php" method="post">
                            <div class="form-group">
                                <label>
                                    Name
                                </label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>
                                    Email
                                </label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>
                                    Message
                                </label>
                                <textarea name="message" class="form-control" style="resize: none; height: 80px;" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                        <?php 

                            if(isset($_POST['submit'])){
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $message = $_POST['message'];
                                $insert_message = "insert into customer_messages(name, email, message) values('$name', '$email', '$message')";
                                $run_message = mysqli_query($con,$insert_message);
                                echo "<h2>Thank you for contacting us. We will get back to you soon.</h2>";

                            }
                        ?>
                    </div>
                </div>
            </div>
       </div>
    </div>   


    <?php 
    
    include("./include/footer.php");
    
    ?>
 
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>   
</body>
</html>