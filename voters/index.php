<?php 
    require_once("inc/header.php");
  
?>    

<?php 

                $fetchingActiveElections = mysqli_query($db, "SELECT * FROM election WHERE status = 'Active'") or die(mysqli_error($db));
                $totalActiveElections = mysqli_num_rows($fetchingActiveElections);

if($totalActiveElections > 0) 
                {
                    while($data = mysqli_fetch_assoc($fetchingActiveElections))
                    {
                        $election_id = $data['id'];
                        $election_topic = $data['election_topic'];    
                ?>
    <div class="section" id="projects">
        <div class="container">
            <div class="col-md-12">
                <h4>03</h4>
                <h1 class="size-50">Present<br />Election</h1> 
            </div>
            <!-- main container -->
            <div class="main-container portfolio-inner clearfix">
                <!-- portfolio div -->
                <div class="portfolio-div">
                    <div class="portfolio">
                        <!-- portfolio_filter -->
                        <div class="categories-grid wow fadeInLeft">
                            <nav class="categories">
                                <ul class="portfolio_filter">
                

                                    <li><a href="" data-filter=".photography"><?php echo $election_topic; ?> </a></li>
                        
                                </ul>
                            </nav>
                        </div>
                        <div class="no-padding portfolio_container clearfix" data-aos="fade-up">
                        <!-- portfolio_filter -->


						  <?php 
                                
                                $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate_detail WHERE election_id = '". $election_id ."'") or die(mysqli_error($db));

                                while($candidateData = mysqli_fetch_assoc($fetchingCandidates))
                                {
                                    $candidate_id = $candidateData['id'];
                                    $candidate_photo = $candidateData['candidate_photo'];

                                    // Fetching Candidate Votes 
                                    $fetchingVotes = mysqli_query($db, "SELECT * FROM voting WHERE candidate_id = '". $candidate_id . "'") or die(mysqli_error($db));
                                   

                            ?>

							

                        
                        <!-- portfolio_container -->
                    
                            <!-- single work -->
                            <div class="col-md-4 col-sm-6  fashion logo">
                                <a id="demo01" href="#animatedModal" class="portfolio_item"> <img style="width: 1000px; height:300px; "src="<?php echo $candidate_photo; ?>" alt="image" class="img-responsive" />
                                    <div class="portfolio_item_hover">
                                        <div class="portfolio-border clearfix">
                                            <div class="item_info"> <span>Candidate's Name</span> <em><?php echo $candidateData['candidate_name']; ?> </em> </div>
                                            
                                        </div>
                                    </div>
                                </a>	<?php
                                            $checkIfVoteCasted = mysqli_query($db, "SELECT * FROM voting WHERE voters_id = '". $_SESSION['user_id'] ."' AND election_id = '". $election_id ."'") or die(mysqli_error($db));    
                                            $isVoteCasted = mysqli_num_rows($checkIfVoteCasted);

                                            if($isVoteCasted > 0)
                                            {
                                                $voteCastedData = mysqli_fetch_assoc($checkIfVoteCasted);
                                                $voteCastedToCandidate = $voteCastedData['candidate_id'];

                                                if($voteCastedToCandidate == $candidate_id)
                                                {
                                    ?>
 

                                                    <img src="../assets/images/vote.png" width="100px;">
                                    <?php
                                                }
                                            }else {
                                                
                                              
                                    ?> 
                                                <button class="btn btn-md btn-success" style="margin-left:10px;"onclick="YesVote(<?php echo $election_id; ?>, <?php echo $candidate_id; ?>, <?php echo $_SESSION['user_id']; ?>)"> Yes </button>
                                                <button class="btn btn-md btn-success" style="margin-left:10px;" onclick="NoVote(<?php echo $election_id; ?>, <?php echo $candidate_id; ?>, <?php echo $_SESSION['user_id']; ?>)"> No </button>
                                                <button class="btn btn-md btn-success" style="margin-left:10px;" onclick="NeutralVote(<?php echo $election_id; ?>, <?php echo $candidate_id; ?>, <?php echo $_SESSION['user_id']; ?>)"> Neutral </button>
                                                <button class="btn btn-md btn-success" style="margin-left:10px;" onclick="NoneVote(<?php echo $election_id; ?>, <?php echo $candidate_id; ?>, <?php echo $_SESSION['user_id']; ?>)"> None </button>
                                    <?php
                                            }

                                            
                                    ?>
                                
                            </div>

							
                            <!-- end single work -->
                            <?php 
								}
								?>
                           
                        </div>
                        <!-- end portfolio_container -->
						
                    </div>
                    <!-- portfolio -->
                </div>
                <!-- end portfolio div -->
            </div>
            <!-- end main container -->
        </div>
    </div>
    <!-- ./projects -->
	            
 <?php
                    
                    }
                }else {
                    echo "No any active election.";
                }
            ?>

	<script>
    const YesVote = (election_id, customer_id, voters_id) => 
    {
        $.ajax({
            type: "POST", 
            url: "inc/yesajaxCalls.php",
            data: "e_id=" + election_id + "&c_id=" + customer_id + "&v_id=" + voters_id, 
            success: function(response) {
                
                if(response == "Success")
                {
                    location.assign("index.php?voteCasted=1");
                }else {
                    location.assign("index.php?voteNotCasted=1");
                }
            }
        });
    }

    const NoVote = (election_id, customer_id, voters_id) => 
    {
        $.ajax({
            type: "POST", 
            url: "inc/noajaxCalls.php",
            data: "e_id=" + election_id + "&c_id=" + customer_id + "&v_id=" + voters_id, 
            success: function(response) {
                
                if(response == "Success")
                {
                    location.assign("index.php?voteCasted=1");
                }else {
                    location.assign("index.php?voteNotCasted=1");
                }
            }
        });
    }

    const NeutralVote = (election_id, customer_id, voters_id) => 
    {
        $.ajax({
            type: "POST", 
            url: "inc/neutrakajaxCalls.php",
            data: "e_id=" + election_id + "&c_id=" + customer_id + "&v_id=" + voters_id, 
            success: function(response) {
                
                if(response == "Success")
                {
                    location.assign("index.php?voteCasted=1");
                }else {
                    location.assign("index.php?voteNotCasted=1");
                }
            }
        });
    }

    const NoneVote = (election_id, customer_id, voters_id) => 
    {
        $.ajax({
            type: "POST", 
            url: "inc/noneajaxCalls.php",
            data: "e_id=" + election_id + "&c_id=" + customer_id + "&v_id=" + voters_id, 
            success: function(response) {
                
                if(response = "Success")
                {
                    location.assign("index.php?voteCasted=1");
                }else {
                    location.assign("index.php?voteNotCasted=1");
                }
            }
        });
    }

</script>



<?php
    require_once("inc/footer.php");
?>