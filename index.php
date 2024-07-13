<?php 
    require_once("admin/inc/config.php");

    $fetchingElections = mysqli_query($db, "SELECT * FROM election") OR die(mysqli_error($db));
    while($data = mysqli_fetch_assoc($fetchingElections))
    {
        $stating_date = $data['starting_date'];
        $ending_date = $data['ending_date'];
        $curr_date = date("Y-m-d");
        $election_id = $data['id'];
        $status = $data['status'];

        // Active = Expire = Ending Date
        // InActive = Active = Starting Date

        if($status == "Active")
        {
            $date1=date_create($curr_date);
            $date2=date_create($ending_date);
            $diff=date_diff($date1,$date2);
            
            if((int)$diff->format("%R%a") < 0)
            {
                // Update! 
                mysqli_query($db, "UPDATE election SET status = 'Expired' WHERE id = '". $election_id ."'") OR die(mysqli_error($db));
            }
        }else if($status == "InActive")
        {
            $date1=date_create($curr_date);
            $date2=date_create($stating_date);
            $diff=date_diff($date1,$date2);
            

            if((int)$diff->format("%R%a") <= 0)
            {
                // Update! 
                mysqli_query($db, "UPDATE election SET status = 'Active' WHERE id = '". $election_id ."'") OR die(mysqli_error($db));
            }
        }
        

    }
?>

<?php
$tryuser_role;
if(isset($_GET['voter-login'])){
    $tryuser_role = "Voter"; 
}

elseif(isset($_GET['candidate-login'])){
    $tryuser_role = "Candidate"; 
}
elseif(isset($_GET['admin-login'])){
    $tryuser_role = "Admin"; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V4</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="allfile/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="allfile/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="allfile/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="allfile/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="allfile/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="allfile/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="allfile/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="allfile/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="allfile/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="allfile/css/util.css">
	<link rel="stylesheet" type="text/css" href="allfile/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	

                <?php 
                    if(isset($_GET['sign-up']))
                    {
                ?>  
              <!DOCTYPE html>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('allfile/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
					 Sign Up
					</span>
					<div class="wrap-input100 validate-input m-b-23" >
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="su_username" placeholder="Type your contact no">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" >
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="su_contact_no" placeholder="Type your contact no.">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="su_password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Re-type Password</span>
						<input class="input100" type="password" name="su_retype_password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<!-- <div class="text-right p-t-8 p-b-31">
						<a href="#">
							Forgot password?
						</a>
					</div> -->
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="sign_up_btn">
								Sign Up
							</button>
						</div>
					</div>

					<!-- <div class="txt1 text-center p-t-54 p-b-20">
						<span>
							Or Sign
						</span>
					</div>

					<div class="flex-c-m">
						<a href="#" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="login100-social-item bg2">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="#" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>
					</div> -->

					<div class="flex-col-c p-t-20">
						<span class="txt1 p-b-17">
							Already Have a Account
						</span> 

						<a href="index.php" class="txt2">
							Login
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	


          
                <?php
                    }else {
                ?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('allfile/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
                     Login
					</span>

					<div class="wrap-input100 validate-input m-b-23" >
						<span class="label-input100">Contact</span>
						<input class="input100" type="text" name="contact_no" placeholder="Type your contact no">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31">
						<a href="#">
							Forgot password?
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" name="loginBtn">
								Login
							</button>
						</div>
					</div>

				

					<div class="flex-col-c p-t-30">
						<span class="txt1 p-b-17">
							Don't Have a Account?
						</span>

						<a href="?sign-up=1&<?php echo $tryuser_role;?>=1" class="txt2">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

                <?php
                    }
                    
                ?>


<div id="dropDownSelect1"></div>
	
    <!--===============================================================================================-->
        <script src="allfile/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script src="allfile/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
        <script src="allfile/vendor/bootstrap/js/popper.js"></script>
        <script src="allfile/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script src="allfile/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
        <script src="allfile/vendor/daterangepicker/moment.min.js"></script>
        <script src="allfile/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
        <script src="allfile/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
        <script src="allfile/js/main.js"></script>
    
    </body>
    </html>
                    


    <!-- <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script> -->



                    

                
           

<?php 
    require_once("admin/inc/config.php");

    if(isset($_POST['sign_up_btn']))
    {
        $su_username = mysqli_real_escape_string($db, $_POST['su_username']);
        $su_contact_no = mysqli_real_escape_string($db, $_POST['su_contact_no']);
        $su_password = mysqli_real_escape_string($db, sha1($_POST['su_password']));
        $su_retype_password = mysqli_real_escape_string($db, sha1($_POST['su_retype_password']));
        
        if(isset($_GET['Voter'])){
            $user_role = "Voter"; 
        }

        elseif(isset($_GET['Candidate'])){
            $user_role = "Candidate"; 
        }
        elseif(isset($_GET['Admin'])){
            $user_role = "Admin"; 
        }
       

        if($su_password == $su_retype_password)
        {
            // Insert Query 

            mysqli_query($db, "INSERT INTO user(username, contact_no, password, user_role) VALUES('". $su_username ."', '". $su_contact_no ."', '". $su_password ."', '". $user_role ."')") or die(mysqli_error($db));

        ?>
            <script> location.assign("index.php?sign-up=1&registered=1"); </script>
        <?php

        }else {
    ?>
            <script> location.assign("index.php?sign-up=1&invalid=1"); </script>
    <?php
        }
             
    }else if(isset($_POST['loginBtn'])){
    
        $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
        $password = mysqli_real_escape_string($db, sha1($_POST['password']));

        

        // Query Fetch / SELECT
        $fetchingData = mysqli_query($db, "SELECT * FROM user WHERE contact_no = '". $contact_no ."'") or die(mysqli_error($db));

        
        if(mysqli_num_rows($fetchingData) > 0)
        {
            $data = mysqli_fetch_assoc($fetchingData);

            if($contact_no == $data['contact_no'] AND $password == $data['password'])
            {
                session_start();
                $_SESSION['user_role'] = $data['user_role'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['user_id'] = $data['id'];
                
                if($data['user_role'] == "Candidate")
                {
                    $_SESSION['key'] = "CandidateKey";
                   
            ?>
                     <script> location.assign("candidate/index.php?homepage=1"); </script>

                    <?php }else if($data['user_role'] == "Admin")
                {
                    $_SESSION['key'] = "AdminKey";
                
            ?>
                    <script> location.assign("admin/index.php?homepage=1");</script>
            
            <?php
                }else {
                    $_SESSION['key'] = "VotersKey";
            ?>
                    <script> location.assign("voters/index.php"); </script>
            <?php
                }

            }else {
        ?>
                <script> location.assign("index.php?invalid_access=1"); </script>
        <?php
            }


        }else {
    ?>
            <script> location.assign("index.php?sign-up=1&not_registered=1"); </script>
    <?php

        }

    }


?>



