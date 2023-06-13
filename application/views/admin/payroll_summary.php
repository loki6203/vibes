<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                <h4 class="font-size-18"> Payroll</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"> Employee List</li>
                    <li class="breadcrumb-item active"> Payment Summary</li>
                </ol>
                </div>
            </div>
        </div>
        <div class="payroll-payment-summary">
            <ul>
                <li>
                    <h3>₹ 2,33,222</h3>
                    <p>Total Payroll Cost</p>
                </li>
                <li>
                    <h3>₹ 2,33,222</h3>
                    <p>Employee Cost</p>
                </li>
                <li>
                    <h3>₹ 720</h3>
                    <p>Employee Cost</p>
                </li>
                <li>
                    <h3>30-11-2022</h3>
                    <p>Payrun Date</p>
                </li>
            </ul>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Overtime (OT x Hrs x Rate = Amount)</th>
                            <th>Unpaid Days</th>
                            <th>Additional Earnings</th>
                            <th>Deductions</th>
                            <th>Employer Contribution</th>
                            <th>Net Pay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row_">
                            <td>
                                <h6 class="mb-1">Suresh amara</h6>
                                <p class="card-title-desc mb-0"><b>₹ 14,800</b>per payrun</p>
                                <p class="card-title-desc mb-0">Regular days: <b>22</b></p>
                                <p class="card-title-desc mb-0">Payment <b>UPI</b></p>
                                <p class="card-title-desc mb-0">Employee Id <b>P00023</b></p>
                            </td>
                            <td>
                                <ul class="ot-heading">
                                    <li>OT</li>
                                    <li>Hrs</li>
                                    <li>Rate</li>
                                    <li>Amount</li>
                                </ul>
                                <ul class="ot-input-wrapper">
                                    <li><input class="form-control" type="number"/> x</li>
                                    <li><input class="form-control" type="number"/> x</li>
                                    <lI><p class="card-title-desc mb-0">₹ 75.90 = </p></lI>
                                    <lI><p class="card-title-desc mb-0">₹ 0.00</p></lI>
                                </ul>
                                <ul class="ot-input-wrapper">
                                    <li><input class="form-control" type="number"/> x</li>
                                    <li><input class="form-control" type="number"/> x</li>
                                    <lI><p class="card-title-desc mb-0">₹ 75.90 = </p></lI>
                                    <lI><p class="card-title-desc mb-0">₹ 0.00</p></lI>
                                </ul>
                            </td>
                            <td><input class="form-control" type="number"/></td>
                            <td>
                                <p class="card-title-desc mb-0">Conveyance Allowance<b>₹ 0</b></p>
                                <p class="card-title-desc mb-0">HRA<b>₹ 0</b></p>
                                <p class="card-title-desc mb-0">Fixed Allowance<b>₹ 0</b></p>
                            </td>
                            <td>
                                <p class="card-title-desc mb-0">Income Tax<b>₹ 0</b></p>
                                <p class="card-title-desc mb-0">Professional Tax<b>₹ 200</b></p>
                            </td>
                            <td>
                                <p class="card-title-desc mb-0"> EPF<b>₹ 220.20</b></p>
                                <p class="card-title-desc mb-0">EPS<b>₹ 499</b></p>
                            </td>
                            <td>
                                <p class="card-title-desc mb-0"> 14280</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>