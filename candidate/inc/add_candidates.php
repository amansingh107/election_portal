<?php 
    if(isset($_GET['added']))
    {
?>
<script>location.assign("../homepage.php")</script>

<?php 
    }else if(isset($_GET['largeFile'])) {
?>
        <div class="alert alert-danger my-3" role="alert">
            Candidate image is too large, please upload small file (you can upload any image upto 2mbs.).
        </div>
<?php
    }else if(isset($_GET['invalidFile']))
    {
?>
        <div class="alert alert-danger my-3" role="alert">
            Invalid image type (Only .jpg, .png files are allowed) .
        </div>
<?php
    }else if(isset($_GET['failed']))
    {
?>
        <div class="alert alert-danger my-3" role="alert">
            Image uploading failed, please try again.
        </div>
<?php
    }

?>


<div class="row my-3">
    <div class="col-4">
        <h3>Add New Candidates</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="election_id" required> 
                    <option value=""> Select Election </option>
                    <?php 
                        $fetchingElections = mysqli_query($db, "SELECT * FROM election") OR die(mysqli_error($db));
                        $isAnyElectionAdded = mysqli_num_rows($fetchingElections);
                        if($isAnyElectionAdded > 0)
                        {
                            while($row = mysqli_fetch_assoc($fetchingElections))
                            {
                                $election_id = $row['id'];
                                $election_name = $row['election_topic'];
                                $allowed_candidates = $row['no_of_candidates'];

                                // Now checking how many candidates are added in this election 
                                $fetchingCandidate = mysqli_query($db, "SELECT * FROM candidate_detail WHERE election_id = '". $election_id ."'") or die(mysqli_error($db));
                                $added_candidates = mysqli_num_rows($fetchingCandidate);

                                if($added_candidates < $allowed_candidates)
                                {
                        ?>
                                <option value="<?php echo $election_id; ?>"><?php echo $election_name; ?></option>
                        <?php
                                }
                            }
                        }else {
                    ?>
                            <option value=""> Please add election first </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="candidate_name" placeholder="Candidate Name" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="file" name="candidate_photo" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="text" name="candidate_details" placeholder="Candidate Details" class="form-control" required />
            </div>
            <input type="submit" value="Add Candidate" name="addCandidateBtn" class="btn btn-success" />
        </form>
    </div>   



<?php 

    if(isset($_POST['addCandidateBtn']))
    {
        $election_id = mysqli_real_escape_string($db, $_POST['election_id']);
        $candidate_name = mysqli_real_escape_string($db, $_POST['candidate_name']);
        $candidate_details = mysqli_real_escape_string($db, $_POST['candidate_details']);
        $inserted_by = $_SESSION['username'];
        $inserted_on = date("Y-m-d");

        // Photograph Logic Starts
        $targetted_folder = "../assets/images/candidate_photos/";
        $candidate_photo = $targetted_folder . rand(111111111, 99999999999) . "_" . rand(111111111, 99999999999) . $_FILES['candidate_photo']['name'];
        $candidate_photo_tmp_name = $_FILES['candidate_photo']['tmp_name'];
        $candidate_photo_type = strtolower(pathinfo($candidate_photo, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "png", "jpeg");        
        $image_size = $_FILES['candidate_photo']['size'];

        if($image_size < 2000000) // 2 MB
        {
            if(in_array($candidate_photo_type, $allowed_types))
            {
                if(move_uploaded_file($candidate_photo_tmp_name, $candidate_photo))
                {
                    // inserting into db
                    mysqli_query($db, "INSERT INTO candidate_detail(election_id, candidate_name, candidate_details, candidate_photo, inserted_by, inserted_on) VALUES('". $election_id ."', '". $candidate_name ."', '". $candidate_details ."', '". $candidate_photo ."', '". $inserted_by ."', '". $inserted_on ."')") or die(mysqli_error($db));

                    echo "<script> location.assign('index.php?addCandidatePage=1&added=1'); </script>";


                }else {
                    echo "<script> location.assign('index.php?addCandidatePage=1&failed=1'); </script>";                    
                }
            }else {
                echo "<script> location.assign('index.php?addCandidatePage=1&invalidFile=1'); </script>";
            }
        }else {
            echo "<script> location.assign('index.php?addCandidatePage=1&largeFile=1'); </script>";
        }

        // Photograph Logic Ends
        




        
    ?>
      <?php

    }






?>