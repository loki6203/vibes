<?php if($CRON_TYPE=='Employee'){ ?>
Dear <?php echo $GetEmpDetails['fname']; ?> <?php echo $GetEmpDetails['lname']; ?>(<?php echo $GetEmpDetails['emp_code']; ?>),

Your <b><?php echo $leave_type; ?></b> request is submitted for the duration <b><?php echo date('d-M-Y',strtotime($from_date)); ?></b> To <b><?php echo date('d-M-Y',strtotime($to_date)); ?></b>.
Please contact <a href="mailto:hr@vibhotech.com">hr@vibhotech.com</a> for any questions/concerns.

Regards,
Team Vibho
<?php } else if($CRON_TYPE=='HR'){ ?>
Dear HR,

<?php echo $GetEmpDetails['fname']; ?> <?php echo $GetEmpDetails['lname']; ?>(<?php echo $GetEmpDetails['emp_code']; ?>) has applied the <b><?php echo $leave_type; ?></b> <b><?php echo date('d-M-Y',strtotime($from_date)); ?></b> To <b><?php echo date('d-M-Y',strtotime($to_date)); ?></b>  and it is in your queue.
Please take the necessary action(Approve / Reject) through the link below..

<a href="https://vibeshr.vibhotech.com/master/<?php echo $GetEmpDetails['emp_id']; ?>"
    style="background:#1372a2;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Approve / Reject</a>

Regards,
Team Vibho	
<?php } else if($CRON_TYPE=='LEAD MANAGER'){ ?>
Dear Lead Manager,

<?php echo $GetEmpDetails['fname']; ?> <?php echo $GetEmpDetails['lname']; ?>(<?php echo $GetEmpDetails['emp_code']; ?>) has applied the <b><?php echo $leave_type; ?></b> <b><?php echo date('d-M-Y',strtotime($from_date)); ?></b> To <b><?php echo date('d-M-Y',strtotime($to_date)); ?></b>  and it is in your queue.
Please take the necessary action(Approve / Reject) through the link below..

<a href="https://vibeshr.vibhotech.com/master/<?php echo $GetEmpDetails['emp_id']; ?>"
    style="background:#1372a2;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Approve / Reject</a>

Regards,
Team Vibho	
<?php } ?>


