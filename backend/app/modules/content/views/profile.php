<?php include APPPATH . '/modules/views/header.php'; ?>
<?php
$Firstname = isset($admin_data->Firstname) ? trim($admin_data->Firstname) : "";
$Lastname = isset($admin_data->Lastname) ? trim($admin_data->Lastname) : "";
$Email = isset($admin_data->Email) ? trim($admin_data->Email) : "";
$Phone = isset($admin_data->Phone) ? trim($admin_data->Phone) : "";
$State = isset($admin_data->State) ? trim($admin_data->State) : "";
$City = isset($admin_data->City) ? trim($admin_data->City) : "";
$ZipCode = isset($admin_data->ZipCode) ? trim($admin_data->ZipCode) : "";
$Status = isset($admin_data->Status) ? trim($admin_data->Status) : "";
$ProfileImage = isset($admin_data->ProfileImage) ? trim($admin_data->ProfileImage) : "";

?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Edit Profile</h4>
                        <p class="category">Complete your profile</p>
                    </div>
                    <div class="card-content">
                        <?php
                        $attributes = array('id' => 'UpdateProfile', 'name' => 'UpdateProfiles', 'method' => "post");
                        echo form_open('profile_save', $attributes);
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Fist Name</label>
                                    <input id="Firstname" name="Firstname" maxlength="50" required="" type="text" class="form-control">
                                    <span class="material-input"></span></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Last Name</label>
                                    <input id="Lastname" name="Lastname" maxlength="50" required="" type="text" class="form-control">
                                    <span class="material-input"></span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Email address</label>
                                    <input id="Email" name="Email" maxlength="100" required="" type="email" class="form-control">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Phone</label>
                                    <input id="Phone" type="number" name="Phone" maxlength="13" required="" class="form-control">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Adress 1</label>
                                    <input id="AddressLine1" name="AddressLine1" maxlength="200" type="text" class="form-control">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Suit/Unit</label>
                                    <input id="AddressSuitUnit" name="AddressSuitUnit" maxlength="100" type="text" class="form-control">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">City</label>
                                    <input id="City" name="City" type="text" maxlength="50" class="form-control">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">State</label>
                                    <input id="State" name="State" type="text" maxlength="50" class="form-control">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Zip Code</label>
                                    <input id="ZipCode" name="ZipCode" type="number" maxlength="6" class="form-control">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Me</label>
                                    <div class="form-group label-floating is-empty">
                                        <textarea id="AboutMe" name="AboutMe" class="form-control" rows="2"></textarea>
                                        <span class="material-input"></span></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="#pablo">
                            <img class="img" src="<?php echo $this->config->item('images_url'); ?>marc.jpg">
                        </a>
                    </div>
                    <div class="content">
                        <h6 class="category text-gray">CEO / Co-Founder</h6>
                        <h4 class="card-title">Alec Thompson</h4>
                        <p class="card-content">
                            Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                        </p>
                        <a href="#pablo" class="btn btn-primary btn-round">Follow</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include APPPATH . '/modules/views/footer.php';
