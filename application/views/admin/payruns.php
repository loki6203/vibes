<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                    <h4 class="font-size-18"> Payroll</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active"> Payruns</li>
                    </ol>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_client" ><i class="mdi mdi-plus mr-2"></i>
                                 Add Payrun
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Period </th>
                                    <th>Employee Cost</th>
                                    <th>Employer Cost</th>
                                    <th>Total Payroll Cost</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row_">
                                    <td>30-11-2022</td>
                                    <td>30-11-2022 - 30-11-2022</td>
                                    <td>₹ 2,33,222</td>
                                    <td>₹ 222</td>
                                    <td>₹ 2,33,222</td>
                                    <td>Processing</td>
                                    <td>Payment Failed</td>
                                    <td>
                                        <button class="btn btn-info waves-effect waves-light"><i class="fa fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div>
    </div>  
