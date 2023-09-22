<?php 
    include 'database.php';
        $nameError = $emailError = $contact_numberError = $messageError = '';
        $fullname = $email = $contact_number = $user_message = '';
        $successMsg ='';

      

    if(isset($_POST['submit'])){

        // $name = $_POST['name'];
        // $email = $_POST['email'];
        // $contact_number = $_POST['contact_number'];
        // $message = $_POST['message'];

        // VALIDATE USER INPUT
        if(empty($_POST['fullname']) ){
            $nameError = 'Name is Required!';

        }else{
            $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);      
        }
        if(empty($_POST['email'])){
            $emailError = 'Email is Required!';

        }else{
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        }
        if(empty($_POST['contact_number'])){
            $contact_numberError = 'Contact number is Required!';

        }else{
            $contact_number = filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_NUMBER_INT);
        }
        if(empty($_POST['user_message'])){
            $messageError = 'Message is Required!';

        }else{
            $user_message = filter_input(INPUT_POST, 'user_message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if(!empty($fullname) && !empty($email) && !empty($contact_number) && !empty($user_message)){
            $sql = 'INSERT INTO tbl_contact_form (fullname, email, contact_number, user_message)
            VALUES ("' . $fullname . '", "' . $email . '", "' . $contact_number . '", "' . $user_message . '")';
    
            $sqlQuery = mysqli_query($conn, $sql);  

            //Clear the input value after successful submission
            // Set it to an empty string
            $fullname = $email = $contact_number = $user_message = '';

            $successMsg = 'Your message is sent!';

            
           
            
        }

    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    


</head>
<body class="bg-secondary">


    <div class="container mt-5  rounded-4 " id="container">


        <form class="p-5" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="post">
        <div class="d-flex justify-content-end ">
        <span class=" text-success" id="successMsg" ><?php echo $successMsg; ?></span>
        </div>
      




        <div class="mb-3">
                <label for="name" class="form-label ">Name</label>
                <input  class="form-control <?php echo !$nameError ? : 'is-invalid'; ?>" name="fullname" id="name" placeholder="John Doe" value="<?php echo $fullname; ?>">
                    <div class="invalid-feedback">
                        <?php echo $nameError?>
                    </div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control  <?php echo !$emailError ? : 'is-invalid'; ?>" name="email" id="email" placeholder="johndoe@email.com" value="<?php echo $email; ?>">
                    <div class="invalid-feedback">
                        <?php echo $emailError?>
                    </div>
            </div>

            <div class="mb-3">
                <label for="contactnumber" class="form-label">Contact Number</label>
                <input type="number" class="form-control <?php echo !$contact_numberError ? : 'is-invalid'; ?>"  name="contact_number" id="contactnumber" placeholder="+639123456789" value="<?php echo $contact_number; ?>">
                    <div class="invalid-feedback">
                        <?php echo $contact_numberError?>
                    </div>
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control <?php echo !$messageError ? : 'is-invalid'; ?>" name="user_message" id="message"  placeholder="Your message here!" rows="3" ></textarea>
                    <div class="invalid-feedback">
                        <?php echo $messageError?>
                    </div>
            </div>

            <div class=" d-flex justify-content-end ">
              <input type="submit" value="Submit" name="submit" class="btn btn-primary mt-4">
            </div>

        </form>
    </div>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;800;900&display=swap');
        *{
            font-family: 'Poppins', sans-serif;
        }
        #container{
        background: rgba(255,255,255,0.45);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.225);

        }
       
    </style>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <script>
    // Wait for a certain amount of time (in milliseconds) before hiding the message
    setTimeout(function() {
        var successMsg = document.getElementById("successMsg");
        if (successMsg) {
        successMsg.style.display = "none";
        }
    }, 3000); // 5000 milliseconds (5 seconds) delay, you can adjust this as needed
    </script>






</body>
</html>