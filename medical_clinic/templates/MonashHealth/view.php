<?php
    use Cake\ORM\TableRegistry;

    echo $this->Html->css('monashHealth-styles');

?>

<head>
    <link rel="stylesheet" href= "monashHealth-styles.css" />
</head>


<h1>Welcome,
    <?php

    $userId = $this->Identity->get('id');

    $userQuery = TableRegistry::getTableLocator()->get('Users');
    $userFirstName = $userQuery->find()->select(['first_name'])->where(['id' => $userId])->firstOrFail()->first_name;
    $userSurname = $userQuery->find()->select(['surname'])->where(['id' => $userId])->firstOrFail()->surname;

    echo $userFirstName.' '.$userSurname;
        ?>
    !
</h1>

<br>

<?php if($this->Identity->get('role') === '3') {
?>
<div class="container">
    <div class="row" style="padding: 0%">
        <div class="col-sm grayDiv" >
            <h2>My Clinician</h2>

            <?php
            // Searches for the clinician the user is assigned to
            $clientsQuery = TableRegistry::getTableLocator()->get('Clients');
            $userClient = $clientsQuery->find()->select([])
                ->where(['user_id' => $this->Identity->get('id')])
                ->first();

            if ($userClient != null) {

                $clientsCliniciansQuery = TableRegistry::getTableLocator()->get('ClientsClinicians');
                $clientsClinicians = $clientsCliniciansQuery->find()->select([])->where(['client_id' => $userClient->id])->first();

                if ($clientsClinicians != null) {
                    $cliniciansQuery = TableRegistry::getTableLocator()->get('Clinicians');

                    $clinicianUser = $cliniciansQuery->find()->select([])->where(['id' => $clientsClinicians->clinician_id])->first();

                    if ($clinicianUser != null) {

                        ?>
                        <p>View the information of your clinician here!
                        </p>
                        <br>

                        <div class="linksDiv" style="float: right">
                            <a href=<?= $this->Url->build(['controller' => 'Users', 'action' => 'view', $clinicianUser->user_id]); ?> class="button btn-md greenButtons">View</a>
                        </div>
                    <?php } else { ?>
                        <p>Your clinician has not yet been set in our databases.  Please contact an admin to inquire about this issue.
                        </p>
                        <br>

                        <div class="linksDiv" style="float: right">
                            <a href="" class="button btn-md greenButtons" disabled="true">View</a>
                        </div>
                    <?php }
                } else { ?>
                    <p>Your clinician has not yet been set in our databases.  Please contact an admin to inquire about this issue.
                    </p>
                    <br>

                    <div class="linksDiv" style="float: right">
                        <a href="" class="button btn-md greenButtons" disabled="true">View</a>
                    </div>
                <?php }
            } else {
                ?>
                <p>Your clinician has not yet been set in our databases.  Please contact an admin to inquire about this issue.
                </p>
                <br>

                <div class="linksDiv" style="float: right">
                    <a href="" class="button btn-md greenButtons" disabled="true">View</a>
                </div>
                <?php
            } ?>
        </div>

        <div class="col-sm blueDiv">
            <h2 style="color: white">Log your intakes</h2>
            <p>Logging your daily intakes is crucial in helping us monitor your health!  Please log them according to the times prescribed
                by your clinician.</p>
            <br>

            <div class="linksDiv" style="position: center">
                <center>
                    <a href=<?= $this->Url->build(['controller' => 'ClientConditions', 'action' => 'index']); ?> class="button btn-sm pinkButtons" >Current status</a>
                    <a href=<?= $this->Url->build(['controller' => 'FoodIntakes', 'action' => 'index']); ?> class="button btn-sm pinkButtons">Food intake</a>
                </center>
            </div>
        </div>
        <div class="col-sm grayDiv">
            <h2>View your goals</h2>
            <p>See the goals you've set with your clinician!
            </p>
            <br>
            <br>
            <div class="linksDiv" style="float: right">
                <center>
                    <a href=<?= $this->Url->build(['controller' => 'Goals', 'action' => 'index']); ?> class="button btn-md greenButtons" >View</a>
                </center>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row" style="padding: 0%">
        <div class="col-sm blueDiv">
            <h2 style="color: white">My Profile</h2>
            View and update your profile.
            <br>
            <br>

            <div class="linksDiv" style="float: right;">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile', $this->Identity->get('id')]); ?>" class="button btn-md pinkButtons" >View</a>
            </div>
        </div>

        <div class="col-sm grayDiv" >
            <h2>Access our educational platform</h2>
            <p>Our educational platform provides a treasure trove of information which can help you navigate your pregnancy more confidently.</p>
            <div class="linksDiv" style="float: right">
                <a href="<?= $this->Url->build(['controller' => 'Education', 'action' => 'index']); ?>" class="button btn-md greenButtons" type="button">View</a>
            </div>
        </div>


        <div class="col-sm whiteDiv">
        </div>
    </div>
</div>
<?php
}
?>

<?php if($this->Identity->get('role') === '1') {
    ?>
    <h2>Managerial Tools</h2>
    <div class="container">
        <div class="row" style="padding: 0%">
            <div class="col-sm grayDiv" >
                <h2>Users</h2>
                <p>See an overview of all the important information for users here.
                </p>
                <br>

                <div class="linksDiv" style="float: right">
                    <a href=<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?> class="button btn-md greenButtons" >View</a>
                </div>
            </div>
            <div class="col-sm blueDiv">
                <h2 style="color: white">Clients</h2>
                <p>See all information pertaining to a client, including their food and condition logs.</p>
                <br>

                <div class="linksDiv" style="float: right">
                    <a href=<?= $this->Url->build(['controller' => 'Clients', 'action' => 'overview']); ?> class="button btn-md pinkButtons" >View</a>
                </div>
            </div>
            <div class="col-sm grayDiv">
                <h2>Clinicians</h2>
                <p>See all information pertaining to a clinician, including their qualifications.
                </p>
                <br>
                <div class="linksDiv" style="float: right">
                    <center>
                        <a href=<?= $this->Url->build(['controller' => 'Clinicians', 'action' => 'index']); ?> class="button btn-md greenButtons" >View</a>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>
    <h2>Clinician Duties</h2>

    <?php
}
?>


<?php if($this->Identity->get('role') === '2' || $this->Identity->get('role') === '1') {
    ?>
    <div class="container">
        <div class="row" style="padding: 0%">
            <div class="col-sm grayDiv" >
                <h2>Clients</h2>
                <p>See all your assigned clients here.
                </p>
                <br>

                <div class="linksDiv" style="float: right">
                    <a href=<?= $this->Url->build(['controller' => 'Clients', 'action' => 'index']); ?> class="button btn-md greenButtons" >View</a>
                </div>
            </div>

            <div class="col-sm blueDiv">
                <h2 style="color: white">Define goals</h2>
                <p>View and create goals for your clients.
                </p>
                <br>
                <div class="linksDiv" style="float: right">
                        <a href=<?= $this->Url->build(['controller' => 'Goals', 'action' => 'index']); ?> class="button btn-md pinkButtons" >View</a>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row" style="padding: 0%">
            <div class="col-sm blueDiv">
                <h2 style="color: white">My Profile</h2>
                View and update your profile.
                <br>
                <br>

                <div class="linksDiv" style="float: right;">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile', $this->Identity->get('id')]); ?>" class="button btn-md pinkButtons" >View</a>
                </div>
            </div>

            <div class="col-sm grayDiv" >
                <h2>Access our educational platform</h2>
                <p>Peruse, edit, and write your own blog article.</p>
                <div class="linksDiv" style="float: right">
                    <a href="<?= $this->Url->build(['controller' => 'Education', 'action' => 'index']); ?>" class="button btn-md greenButtons" type="button">View</a>
                </div>
            </div>

        </div>
    </div>
    <?php
}
?>
