<!DOCTYPE html>
<html>
<head>
<title>Certificate Of Service Letter</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
    .font_ze{
        font-weight:bold;
    }
</style>
</head>
<body>
    <div class="container">
        <img src="<?php echo base_url(); ?>assets/images/Vibho-old_logo.png" width="230px" height="70px" style="float:right;margin-top:-20px;"><br><br><br><br><br><br><br>

    <div class="text-center">
        <h2 style="font-family: italic;">Certification of Service</h2>
    </div><br>
    <div class="text-center" style="margin-left: -160px;">
        <p>Employee Name : <?php echo $res['fname']; ?> <?php echo $res['lname']; ?></p>

        <p>Employee Number : <?php echo $res['emp_code']; ?></p>

        <p>Job Title : <?php echo $res['designation_name']; ?></p>

        <p>Start Date : <?php echo DD_M_YY($res['date_of_joining']); ?></p>

        <p>Termination Date : <?php echo DD_M_YY($res['termination_date']); ?></p>

        <p>Reason for leaving : <?php echo $res['comments']; ?></p>
    </div>
        
        <img src="<?php echo base_url(); ?>assets/images/Confirmation_of_Employment.png" style="margin-left:-22px;"><br><br>

        Patricia Meyer<br>
        Human Resources Business Partner<br>
        Vibho Technologies<br>
        Cell: 0615291779<br>
        Email: hr@vibhotech.com<br><br><br><br><br><br><br><br><br><br><br><br>

        <div style="text-align: center;color: #1372a2;font-size:bold;">
           Vibho Technologies (Pty) Ltd, Registration Number:<br>
            2016/343979/07 136 5th Rd, Halfway Gardens, Midrand - 1682.<br>
            Phone: 27 11 318 0872, Email: hr@vibhotech.com<br>
            www.vibhotech.com
        </div>
    </div>
</body>
</html>
