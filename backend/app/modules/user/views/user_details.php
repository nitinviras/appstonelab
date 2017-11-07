<?php
//echo '<pre>';
//print_r($User_products);
//exit;
include APPPATH . '/modules/views/header.php';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-md-12">
            <?php $this->load->view('message') ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>User Details</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">User Name</label>
                                            <input id="Firstname" name="Firstname" maxlength="50" required=""  type="text" readonly="" class="readonly form-control" value="<?php echo isset($User->user_login) ? $User->user_login : 'Username'; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">Fist Name</label>
                                            <input id="Firstname" name="Firstname" maxlength="50" required=""  type="text" readonly="" class="readonly form-control" value="<?php echo isset($User_details->first_name) ? $User_details->first_name : ''; ?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">Last Name</label>
                                            <input id="Lastname" name="Lastname" maxlength="50" required="" type="text"  readonly="" class="readonly form-control"  value="<?php echo isset($User_details->last_name) ? $User_details->last_name : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">Email</label>
                                            <input id="Email" name="Email" maxlength="100" required="" type="email"  readonly="" class="readonly form-control" value="<?php echo isset($User->user_email) ? $User->user_email : ''; ?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">Mobile No</label>
                                            <input id="Phone" name="Phone" maxlength="13" required=""  readonly="" class="readonly form-control" value="<?php echo isset($User_details->mobile_no) ? $User_details->mobile_no : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">Alternate Mobile No</label>
                                            <input id="Phone" name="Phone" maxlength="13" required=""  readonly="" class="readonly form-control" value="<?php echo isset($User_details->alternate_mobile_no) ? $User_details->alternate_mobile_no : ''; ?>">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">D.O.B.</label>
                                            <input id="Email" name="date" maxlength="100" required="" type="date"  readonly="" class="readonly form-control" value="<?php echo date('d-F-Y', strtotime(isset($User->date_of_birth) ? $User->date_of_birth : '')); ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">Gender</label>
                                            <input id="Phone" name="Phone" maxlength="13" required=""  readonly="" class="readonly form-control" value="<?php echo isset($User_details->gender) ? $User_details->gender : ''; ?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">Company Name</label>
                                            <input id="Phone" name="Phone" maxlength="13" required=""  readonly="" class="readonly form-control" value="<?php echo isset($User_details->company_name) ? $User_details->company_name : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">Adress 1</label>
                                            <input id="AddressLine1" name="AddressLine1" maxlength="200" type="text"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->address_one) ? $User_details->address_one : ''; ?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">Adress 2</label>
                                            <input id="AddressLine1" name="AddressLine1" maxlength="200" type="text"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->address_two) ? $User_details->address_two : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">Web site</label>
                                            <input id="AddressSuitUnit" name="AddressSuitUnit" maxlength="100" type="text"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->personal_website) ? $User_details->personal_website : ''; ?>">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">Country</label>
                                            <input id="AddressSuitUnit" name="AddressSuitUnit" maxlength="100" type="text"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->countryname) ? $User_details->countryname : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">State</label>
                                            <input id="State" name="State" type="text" maxlength="50"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->statename) ? $User_details->statename : ''; ?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">City</label>
                                            <input id="City" name="City" type="text" maxlength="50"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->cityname) ? $User_details->cityname : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">Adress 1</label>
                                            <input id="AddressLine1" name="AddressLine1" maxlength="200" type="text"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->address_one) ? $User_details->address_one : ''; ?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4 b-r">
                                    <form role="form">
                                        <div class="form-group">
                                            <label class="control-label readonly">Adress 2</label>
                                            <input id="AddressLine1" name="AddressLine1" maxlength="200" type="text"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->address_two) ? $User_details->address_two : ''; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label readonly">Web site</label>
                                            <input id="AddressSuitUnit" name="AddressSuitUnit" maxlength="100" type="text"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->personal_website) ? $User_details->personal_website : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label readonly">Zip Code</label>
                                            <input id="ZipCode" name="ZipCode" type="text" maxlength="6"  readonly="" class="readonly form-control" value="<?php echo isset($User_details->zipcode) ? $User_details->zipcode : ''; ?>">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>User Product</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Product Name</th>
                                    <th>Product Category</th>
                                    <th>Product File</th>
                                    <th>Product Price</th>
                                    <th>Product Status</th>
                                    <th>Created Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            if (isset($User_products) && count($User_products) > 0) {
                                foreach ($User_products as $row) {
                                    ?>
                                    <tbody>
                                        <tr class="gradeC">
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td><?php echo $row->item_name; ?></td>
                                            <td><?php echo $row->item_category; ?></td>
                                            <td><?php echo $row->item_file; ?></td>
                                            <td><?php echo $row->item_price; ?></td>
                                            <td><?php echo isset($row->item_status) && $row->item_status == 'A' ? 'Approve' : 'Pending'; ?></td>
                                            <td><?php echo $row->created_date; ?></td>
                                            <td class="td-actions text-center">
                                                <?php if ($row->item_status == 'P') { ?>
                                                    <a href="<?php echo base_url('pending') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-info btn-round" data-original-title="" title="">
                                                        <i class="material-icons">person</i>
                                                    </a>
                                                <?php } ?>
                                                <a href="<?php echo base_url('delete_product') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                                                    <i class="material-icons">close</i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>  
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="8" align="center" style="color: red"><h4>No User Products Found</h4></td>
                                </tr>
                                <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
            </div>

            <hr/>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>User Service</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Service Name</th>
                                    <th>Service Category</th>
                                    <th>Service Price</th>
                                    <th>Service Status</th>
                                    <th>Created Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            if (isset($User_services) && count($User_services) > 0) {
                                foreach ($User_services as $row) {
                                    ?>
                                    <tbody>
                                        <tr class="gradeC">
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td><?php echo $row->service_name; ?></td>
                                            <td><?php echo $row->service_category; ?></td>
                                            <td><?php echo $row->service_price; ?></td>
                                            <td><?php echo isset($row->service_status) && $row->service_status == 'A' ? 'Approve' : 'Pending'; ?></td>
                                            <td><?php echo $row->created_date; ?></td>
                                            <td class="td-actions text-center">
                                                <?php if ($row->item_status == 'P') { ?>
                                                    <a href="<?php echo base_url('service_pending') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-info btn-round" data-original-title="" title="">
                                                        <i class="material-icons">person</i>
                                                    </a>
                                                <?php } ?>
                                                <a href="<?php echo base_url('delete_service') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                                                    <i class="material-icons">close</i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>  
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="9" align="center" style="color: red"><h4>No User Services Found</h4></td>
                                </tr>
                                <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include APPPATH . '/modules/views/footer.php';
?>