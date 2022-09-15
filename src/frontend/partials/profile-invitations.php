<div class="col-md-6 col-lg-6">
<h5>Invitationer</h5>
<?php 
    if( $invitationsData > 0 ) {
        ?>
            <table class="widefat table table-hover table-striped">
                <thead>
                    <th>invitation</th>
                    <th>type</th>
                    <th>Fra</th>
                </thead>
                <tbody>
                    <?php
                        foreach($invitationsData as $invitation) 
                        {
                            ?>
                                <tr>
                                    <td><?php echo $invitation["invitation_name"]; ?></td>
                                    <td><?php echo $invitation["type"]; ?></td>
                                    <td><?php echo $invitation["name"]; ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    } else {
        ?> 
            <p class="alert alert-primary">Du har ingen invitationer</p>
        <?php
    }
    ?>
</div>