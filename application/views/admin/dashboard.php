<link href="<?php echo base_url(); ?>assets/admin/libs/chartist/chartist.min.css" rel="stylesheet">
<style>
   .highcharts-figure,
   .highcharts-data-table table {
   min-width: 310px;
   max-width: 800px;
   margin: 1em auto;
   }
   .highcharts-data-table table {
   font-family: Verdana, sans-serif;
   border-collapse: collapse;
   border: 1px solid #ebebeb;
   margin: 10px auto;
   text-align: center;
   width: 100%;
   max-width: 500px;
   }
   .highcharts-data-table caption {
   padding: 1em 0;
   font-size: 1.2em;
   color: #555;
   }
   .highcharts-data-table th {
   font-weight: 600;
   padding: 0.5em;
   }
   .highcharts-data-table td,
   .highcharts-data-table th,
   .highcharts-data-table caption {
   padding: 0.5em;
   }
   .highcharts-data-table thead tr,
   .highcharts-data-table tr:nth-child(even) {
   background: #f8f8f8;
   }
   .highcharts-data-table tr:hover {
   background: #f1f7ff;
   }
   .highcharts-credits, .highcharts-legend-item{
   display: none;
   }
</style>
<div class="main-content">
<div class="page-content dashboard-background">
   <div class="container-fluid">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18">Dashboard</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item active">Welcome to Vibho Employee Solutions Dashboard</li>
               </ol>
            </div>
         </div>
      </div>
      <div class="app-new-count-cards">
         <div class="row">
            <?php if($this->session->userdata('role_id')=='Admin'){ ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
               <div class="app-new-count-card-item mb-3">
                  <h5>Total Employees</h5>
                  <h1><?php echo $all_employees; ?></h1>
                  <img src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/total-employees.svg"/>
               </div>
            </div>
            <?php } ?>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
               <div class="app-new-count-card-item mb-3">
                  <h5>On Leaves</h5>
                  <h1>
                     <?php 
                        if($today_leave_empys!=''){
                           echo $today_leave_empys;
                        }else{
                           echo 0;
                        }
                        ?>
                  </h1>
                  <img src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/on-leave.svg"/>
               </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
               <div class="app-new-count-card-item mb-3">
                  <h5>Total Clients</h5>
                  <h1>
                     <?php 
                        if($total_clients!=''){
                           echo $total_clients;
                        }else{
                           echo 0;
                        }
                        ?>
                  </h1>
                  <img src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/total-clients.svg"/>
               </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
               <div class="app-new-count-card-item mb-3">
                  <h5>Total Tasks</h5>
                  <h1><?php echo $total_tasks; ?></h1>
                  <img src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/total-tasks.svg"/>
               </div>
            </div>
         </div>
      </div>
      <?php if($this->session->userdata('role_id')=='Admin'){ ?>
      <div class="app-new-dashboard-graphs">
         <div class="row">
            <div class="col-12 col-md-6">
               <div class="app-new-dashboard-attendance">
                  <h4>Attendance Report</h4>
                  <div class="app-new-dashboard-attendance-content">
                     <div class="app-new-dashboard-attendance-chart">
                        <div id="ct-donut" class="ct-chart wid"></div>
                        <div class="app-new-dashboard-attendance-chart-count">
                           <h5>Total Emp</h5>
                           <h3><?php echo $all_employees; ?></h3>
                        </div>
                     </div>
                     <div class="app-new-dashboard-attendance-info">
                        <h6><?php echo date('M 01'); ?> - <?php echo date('M t'); ?></h6>
                        <ul>
                           <li>
                              <span class="attendance-chart-color1"></span>
                              <p>Total Emp</p>
                           </li>
                           <li>
                              <span class="attendance-chart-color2"></span>
                              <p>Present Today</p>
                           </li>
                           <li>
                              <span class="attendance-chart-color3"></span>
                              <p>On Leave</p>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="app-dashboard-holidays">
                  <h5 class="app-new-dashboard-more-info-title">Holidays</h5>
                  <div class="app-dashboard-holidays-content">
                     <h4><?php echo ucfirst($holidays['name']); ?></h4>
                     <p><?php echo date('D, d M, Y', strtotime($holidays['date'])); ?></p>
                  </div>
                  <a class="app-dashboard-holidays-view-all" href="<?php echo base_url(); ?>admin/public_holidays">View All</a>
                  <img class="app-dashboard-holidays-chevron holiday-image" src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/holiday.svg"/>
               </div>
               <div class="app-new-dashboard-inbox mt-3">
                  <h5 class="app-new-dashboard-more-info-title">Inbox</h5>
                  <a class="app-dashboard-holidays-view-all" href="<?php echo base_url(); ?>admin/notifications">View All</a>
                  <div class="app-new-dashboard-inbox-content">
                     <?php if(!empty($notifications)){foreach ($notifications as $notification) { ?>
                     <h6><?php echo ucfirst($notification['title']); ?></h6>
                     <p><?php echo ucfirst($notification['message']); ?></p>
                     <?php } } else { ?>
                     <h6>Great Work!</h6>
                     <p>You have no pending actions</p>
                     <?php } ?>
                  </div>
                  <img class="d-none d-md-block" src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/inbox-vector.svg">
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="app-new-dashboard-salary">
                  <div class="access-toggle-btn float-right">
                     <input class="access-toggle-input" type="checkbox" class="d-none" id="read_id" onClick="Access();" value="0" />
                     <label class="access-toggle-label access-toggle-label-no">&nbsp;</label>
                     <label class="access-toggle-label access-toggle-label-yes" for="read_id">&nbsp;</label>
                  </div>
                  <br>
                  <div class="app-new-dashboard-salary-graph" style="visibility: hidden;">
                     <script src="<?php echo base_url(); ?>assets/admin/js/highcharts.js"></script>
                     <script src="<?php echo base_url(); ?>assets/admin/js/series-label.js"></script>
                     <!-- <script src="<?php echo base_url(); ?>assets/admin/js/exporting.js"></script>
                        <script src="<?php echo base_url(); ?>assets/admin/js/export-data.js"></script>
                        <script src="<?php echo base_url(); ?>assets/admin/js/accessibility.js"></script> -->
                     <figure class="highcharts-figure">
                        <div id="container"></div>
                     </figure>
                     <div class="app-new-dashboard-salary-chart">
                        <div class="row justify-content-center">
                           <div class="col-md-6 col-lg-3">
                              <div class="app-new-dashboard-salary-chart-item">
                                 <div class="app-new-dashboard-salary-chart-item-pie">
                                    <span class="peity-donut" data-peity='{ "fill": ["#E2906D", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">5/5</span>
                                    <p class="chart-item-pie-count"><?php echo cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y')); ?><br>Days</p>
                                 </div>
                                 <div class="app-new-dashboard-salary-chart-item-info">
                                    <h6><?php echo date('M'); ?>’<?php echo date('Y'); ?></h6>
                                    <h3>ZAR<?php echo number_format(round((float)$current_mnth_amt['amt'],2),2); ?></h3>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-3">
                              <div class="app-new-dashboard-salary-chart-item">
                                 <div class="app-new-dashboard-salary-chart-item-pie">
                                    <span class="peity-donut" data-peity='{ "fill": ["#E2906D", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">5/5</span>
                                    <p class="chart-item-pie-count"><?php echo cal_days_in_month(CAL_GREGORIAN,date('m')-1,date('Y')); ?><br>Days</p>
                                 </div>
                                 <div class="app-new-dashboard-salary-chart-item-info">
                                    <h6>Last month</h6>
                                    <h3>ZAR<?php echo number_format(round((float)$last_mnth_amt['amt'],2),2); ?></h3>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-3">
                              <div class="app-new-dashboard-salary-chart-item">
                                 <div class="app-new-dashboard-salary-chart-item-pie">
                                    <span class="peity-donut" data-peity='{ "fill": ["#E2906D", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">5/5</span>
                                    <p class="chart-item-pie-count">365<br>Days</p>
                                 </div>
                                 <div class="app-new-dashboard-salary-chart-item-info">
                                    <h6>Yearly</h6>
                                    <h3>ZAR<?php echo number_format(round((float)$year_amt['amt'],2),2); ?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php }else if($this->session->userdata('role_id')==1){ ?>
      <div class="app-new-dashboard-graphs">
         <div class="row">
            <div class="col-12 col-md-6">
               <div class="app-new-dashboard-attendance">
                  <h4>Attendance Report</h4>
                  <div class="app-new-dashboard-attendance-content">
                     <div class="app-new-dashboard-attendance-chart">
                        <div id="ct-donut" class="ct-chart wid"></div>
                        <div class="app-new-dashboard-attendance-chart-count">
                           <h5>Total Emp</h5>
                           <h3><?php echo $all_employees; ?></h3>
                        </div>
                     </div>
                     <div class="app-new-dashboard-attendance-info">
                        <h6><?php echo date('M 01'); ?> - <?php echo date('M t'); ?></h6>
                        <ul>
                           <li>
                              <span class="attendance-chart-color1"></span>
                              <p>Total Emp</p>
                           </li>
                           <li>
                              <span class="attendance-chart-color2"></span>
                              <p>Present Today</p>
                           </li>
                           <li>
                              <span class="attendance-chart-color3"></span>
                              <p>On Leave</p>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="app-dashboard-holidays">
                  <h5 class="app-new-dashboard-more-info-title">Holidays</h5>
                  <div class="app-dashboard-holidays-content">
                     <h4><?php echo ucfirst($holidays['name']); ?></h4>
                     <p><?php echo date('D, d M, Y', strtotime($holidays['date'])); ?></p>
                  </div>
                  <a class="app-dashboard-holidays-view-all" href="<?php echo base_url(); ?>admin/public_holidays">View All</a>
                  <img class="app-dashboard-holidays-chevron" src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/right-chevron.svg"/>
              </div>
              <div class="app-new-dashboard-inbox h-100 mt-3">
                <h5 class="app-new-dashboard-more-info-title">Inbox</h5>
                <?php if(!empty($notifications)){ ?>
                  <a style="float: right;" href="<?php echo base_url(); ?>admin/notifications">View All</a>
                <?php } ?>
                <div class="app-new-dashboard-inbox-content">
                   <?php if(!empty($notifications)){foreach ($notifications as $notification) { ?>
                   <h6><?php echo ucfirst($notification['title']); ?></h6>
                   <p><?php echo ucfirst($notification['message']); ?></p>
                   <?php } } else { ?>
                   <h6>Great Work!</h6>
                   <p>You have no pending actions</p>
                   <?php } ?>
                </div>
                <img class="d-none d-md-block" src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/inbox-vector.svg">
             </div>
           </div>
         </div>
      </div>
    <?php }else{ ?>
        <div class="app-new-dashboard-graphs">
         <div class="row">
            <div class="col-12 col-md-6">
               <div class="app-dashboard-holidays">
                  <h5 class="app-new-dashboard-more-info-title">Holidays</h5>
                  <div class="app-dashboard-holidays-content">
                     <h4><?php echo ucfirst($holidays['name']); ?></h4>
                     <p><?php echo date('D, d M, Y', strtotime($holidays['date'])); ?></p>
                  </div>
                  <a class="app-dashboard-holidays-view-all" href="<?php echo base_url(); ?>admin/public_holidays">View All</a>
                  <img class="app-dashboard-holidays-chevron" src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/right-chevron.svg"/>
               </div>
             </div>
              <div class="col-12 col-md-6">
               <div class="app-new-dashboard-inbox h-100 mt-3">
                  <h5 class="app-new-dashboard-more-info-title">Inbox</h5>
                  <?php if(!empty($notifications)){ ?>
                    <a style="float: right;" href="<?php echo base_url(); ?>admin/notifications">View All</a>
                  <?php } ?>
                  <div class="app-new-dashboard-inbox-content">
                     <?php if(!empty($notifications)){foreach ($notifications as $notification) { ?>
                     <h6><?php echo ucfirst($notification['title']); ?></h6>
                     <p><?php echo ucfirst($notification['message']); ?></p>
                     <?php } } else { ?>
                     <h6>Great Work!</h6>
                     <p>You have no pending actions</p>
                     <?php } ?>
                  </div>
                  <img class="d-none d-md-block" src="<?php echo base_url(); ?>assets/dashboard-cards-vectors/inbox-vector.svg ">
               </div>
            </div>
         </div>
      </div>
    <?php } ?>
   </div>
</div>
<script>
   var all_employees = <?php echo $all_employees; ?>;
   var present_today = 
    <?php 
      if($today_leave_empys!=''){
         echo $all_employees-$today_leave_empys;
      }else{
         echo $all_employees-0;
      }
      ?>;
    var on_leave = 
    <?php 
      if($today_leave_empys!=''){
         echo $today_leave_empys;
      }else{
         echo 0;
      }
      ?>
   
   function Access()
   {
    switch_val = $('#read_id').is(':checked')?'yes':'no';
    if(switch_val=='yes'){
       $('.app-new-dashboard-salary-graph').removeAttr('style');
    }else{
       $('.app-new-dashboard-salary-graph').attr("style", "visibility: hidden");
    }
   }
</script>
<!-- Peity chart-->
<script src="<?php echo base_url(); ?>assets/admin/libs/peity/jquery.peity.min.js"></script>
<!-- Plugin Js-->
<script src="<?php echo base_url(); ?>assets/admin/libs/chartist/chartist.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/pages/dashboard.init.js"></script>
<script>
   Highcharts.chart('container', {
     chart: {
       type: 'spline'
     },
     title: {
       text: 'Monthly Payroll'
     },
     xAxis: {
       categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
         'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
       accessibility: {
         description: 'Months of the year'
       }
     },
     yAxis: {
       title: {
         text: 'Percentage ( % )'
       },
       labels: {
         formatter: function () {
           return this.value+'%';
         }
       }
     },
     plotOptions: {
       spline: {
         marker: {   
           radius: 4,
           lineColor: '#666666',
           lineWidth: 1
         }
       }
     },
     series: [{
       data: [100, 90]
     }]
   });
</script>