<?php if($CRON_TYPE=='Employee'){ ?>
Dear <?php echo $GetEmpDetails['fname']; ?> <?php echo $GetEmpDetails['lname']; ?>(<?php echo $GetEmpDetails['emp_code']; ?>),

Your <b><?php echo $leave_type; ?></b> request is cancelled by yourself for the duration <b><?php echo date('d-M-Y',strtotime($from_date)); ?></b> To <b><?php echo date('d-M-Y',strtotime($to_date)); ?></b>.
Please contact <a href="mailto:hr@vibhotech.com">hr@vibhotech.com</a> for any questions/concerns.

Regards,
Team Vibho
<?php } else if($CRON_TYPE=='HR'){ ?>
Dear HR,

<?php echo $GetEmpDetails['fname']; ?> <?php echo $GetEmpDetails['lname']; ?>(<?php echo $GetEmpDetails['emp_code']; ?>) has cancelled the <b><?php echo $leave_type; ?></b> <b><?php echo date('d-M-Y',strtotime($from_date)); ?></b> To <b><?php echo date('d-M-Y',strtotime($to_date)); ?></b>.

Regards,
Team Vibho	
<?php } else if($CRON_TYPE=='LEAD MANAGER'){ ?>
Dear Lead Manager,

<?php echo $GetEmpDetails['fname']; ?> <?php echo $GetEmpDetails['lname']; ?>(<?php echo $GetEmpDetails['emp_code']; ?>) has cancelled the <b><?php echo $leave_type; ?></b> <b><?php echo date('d-M-Y',strtotime($from_date)); ?></b> To <b><?php echo date('d-M-Y',strtotime($to_date)); ?></b>.

Regards,
Team Vibho
<?php } ?>


