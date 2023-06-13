<!DOCTYPE html>
<html>
<head>
<title>Employee Confirmation Letter</title>
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

        <b class="font_ze"><?php echo date("d-M-Y", strtotime(date("Y-m-d"))); ?></b><br><br>

        Dear Sir/Madam<br><br>

        Sub: Confirmation of Employment for – <b class="font_ze"><?php echo $res['fname']; ?> <?php echo $res['lname']; ?></b>, <?php echo $res['identification_name']; ?> Number: <b class="font_ze"><?php echo $res['identification_number']; ?></b><br><br>

        This letter serves to confirm that <b class="font_ze"><?php echo $res['fname']; ?> <?php echo $res['lname']; ?></b> is employed with Vibho Technologies as a <b class="font_ze"><?php echo $res['designation_name']; ?></b> with effect from <b class="font_ze"><?php echo date("d-M-Y", strtotime($res['date_of_joining'])); ?></b>.<br><br>

        Kindly contact me should you have any queries.<br><br>

        Kind Regards<br>

        
         <img src="<?php echo base_url(); ?>assets/images/Confirmation_of_Employment.png" style="margin-left:-22px;"><br><br>

        Patricia Meyer<br>
        Human Resources Business Partner<br>
        Vibho Technologies<br>
        Cell: 0615291779<br>
        Email: hr@vibhotech.com<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <div style="text-align: center;color: #1372a2;font-size:bold;">
           Vibho Technologies (Pty) Ltd, Registration Number:<br>
            2016/343979/07 136 5th Rd, Halfway Gardens, Midrand - 1682.<br>
            Phone: 27 11 318 0872, Email: hr@vibhotech.com<br>
            www.vibhotech.com
        </div>
    </div>
</body>
</html>
