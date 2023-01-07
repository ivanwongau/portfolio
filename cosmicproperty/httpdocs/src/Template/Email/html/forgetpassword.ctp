<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <?= $this->Html->css('signup.css');?>
    <title>Sign Up</title>
</head>
<body class="email-box">
    <h3> Hi <?php echo $email?>,</h3>
    <br>
    <p><b>A request has been received to change the password for your Cosmic Property account</b></p>
    <br>
    <?php echo $this->Html->link(
        'Please clink this link to reset your password!',$link); ?>
    <p>If you did not initiate this request, please ignore this request or contact us at damian@cosmicproperty.com.au</p>
    <p>Thank you <br>Regards<br>Cosmic Property Auto-reply</p><br>
<img src="cid:123456">
</body>



