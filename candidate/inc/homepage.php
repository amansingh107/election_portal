<div class="col-8">
        <h3>Candidate Details</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Details</th>
                    <th scope="col">Election</th>
                   
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    $fetchingData = mysqli_query($db, "SELECT * FROM candidate_detail") or die(mysqli_error($db)); 
                    $isAnyCandidateAdded = mysqli_num_rows($fetchingData);

                    if($isAnyCandidateAdded > 0)
                    {
                        $sno = 1;
                        while($row = mysqli_fetch_assoc($fetchingData))
                        {
                            $election_id = $row['election_id'];
                            $fetchingElectionName = mysqli_query($db, "SELECT * FROM election WHERE id = '". $election_id ."'") or die(mysqli_error($db));
                            $execFetchingElectionNameQuery = mysqli_fetch_assoc($fetchingElectionName);
                            $election_name = $execFetchingElectionNameQuery['election_topic'];

                            $candidate_photo = $row['candidate_photo'];

                ?>
                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td> <img style="border-radius:50%; width: 50px; height:50px;" src="<?php echo $candidate_photo; ?>" class="candidate_photo" />    </td>
                                <td><?php echo $row['candidate_name']; ?></td>
                                <td><?php echo $row['candidate_details']; ?></td>
                                <td><?php echo $election_name; ?></td>
                            </tr>   
                <?php
                        }
                    }else {
            ?>
                        <tr> 
                            <td colspan="7"> No any candidate is added yet. </td>
                        </tr>
            <?php
                    }
                ?>
            </tbody>    
        </table>
    </div>
</div>

