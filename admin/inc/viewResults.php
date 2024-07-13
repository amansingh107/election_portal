<?php 
    $election_id = $_GET['viewResult'];

?>

<div class="row my-3">
        <div class="col-12">
            <h3> Election Results </h3>

            <?php 
                $fetchingActiveElections = mysqli_query($db, "SELECT * FROM election WHERE id = '". $election_id ."'") or die(mysqli_error($db));
                $totalActiveElections = mysqli_num_rows($fetchingActiveElections);

                if($totalActiveElections > 0) 
                {
                    while($data = mysqli_fetch_assoc($fetchingActiveElections))
                    {
                        $election_id = $data['id'];
                        $election_topic = $data['election_topic'];    
                ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="bg-green text-white"><h5> ELECTION TOPIC: <?php echo strtoupper($election_topic); ?></h5></th>
                                </tr>
                                <tr>
                                    <th> Photo </th>
                                    <th> Candidate Details </th>
                                    <th> No. of Yes </th>
                                    <th> No. of No </th>
                                    <th> No. of Neutral </th>
                                    <th> No. of None </th>
                                    <!-- <th> Action </th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate_detail WHERE election_id = '". $election_id ."'") or die(mysqli_error($db));
                                $maxValue = PHP_INT_MIN;
                                $elected_candidate;
                                while($candidateData = mysqli_fetch_assoc($fetchingCandidates))
                                {
                                    $candidate_id = $candidateData['id'];
                                    $candidate_photo = $candidateData['candidate_photo'];
                                    $candidate_name=$candidateData['candidate_name'];

                                    // Fetching Candidate Votes 
                                    $YesVotes = mysqli_query($db, "SELECT * FROM voting WHERE candidate_id = '". $candidate_id . "' AND voters_option='Yes'" ) or die(mysqli_error($db));
                                    $totalYes = mysqli_num_rows($YesVotes);

                                    $NoVotes = mysqli_query($db, "SELECT * FROM voting WHERE candidate_id = '". $candidate_id . "' AND voters_option='No'" ) or die(mysqli_error($db));
                                    $totalNo = mysqli_num_rows($NoVotes);

                                    $NeutralVotes = mysqli_query($db, "SELECT * FROM voting WHERE candidate_id = '". $candidate_id . "' AND voters_option='Neutral'" ) or die(mysqli_error($db));
                                    $totalNeutral = mysqli_num_rows($NeutralVotes);

                                    $NoneVotes = mysqli_query($db, "SELECT * FROM voting WHERE candidate_id = '". $candidate_id . "' AND voters_option='None'" ) or die(mysqli_error($db));
                                    $totalNone = mysqli_num_rows($NoneVotes);

                                    if ($YesVotes > $maxValue) {
                                        // Update the maximum value
                                        $maxValue = $YesVotes;
                                        $elected_candidate=$candidate_name;
                                    }
                                    
                            ?>
                                    <tr>
                                        <td> <img src="<?php echo $candidate_photo; ?>" class="candidate_photo"> </td>
                                        <td><?php echo "<b>" . $candidateData['candidate_name'] . "</b><br />" . $candidateData['candidate_details']; ?></td>
                                        <td><?php echo $totalYes; ?></td>
                                        <td><?php echo $totalNo; ?></td>
                                        <td><?php echo $totalNeutral; ?></td>
                                        <td><?php echo $totalNone; ?></td>
                                    </tr>
                            <?php
                                }
                            ?>
                            </tbody>

                        </table>
                <?php
                    
                    }
                }else {
                    echo "No any active election.";
                }
            ?>


            <hr>
            <p>The election candidate for this post is <?php echo $elected_candidate; ?></p>
          

            </table>
            
        </div>
    </div>


