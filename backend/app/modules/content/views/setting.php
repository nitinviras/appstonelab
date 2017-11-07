<?php
include APPPATH . '/modules/views/header.php';

if (isset($User) && !empty($User)) {

    $name = isset($User->name) ? $User->name : "";
    $email = isset($User->email) ? $User->email : "";
    $phone = isset($User->phone) ? $User->phone : "";
    $address = isset($User->address) ? $User->address : "";
    $facebook = isset($User->facebook) ? $User->facebook : "";
    $google = isset($User->google) ? $User->google : "";
    $linkedin = isset($User->linkedin) ? $User->linkedin : "";
    $instagram = isset($User->instagram) ? $User->instagram : "";
    $logo_image = isset($User->logo_image) ? $User->logo_image : "";
    $twitter = isset($User->twitter) ? $User->twitter : "";
    $user_id = isset($User->user_id) ? $User->user_id : "";
} else {
    
}
//echo '<pre>';
//echo admin_url . 'assets/images/background/register_background.jpg';
?>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
<?php $this->load->view('message') ?>
            <div class="ibox float-e-margins">
                
                <div class="ibox-title">
                    <h5>Setting Details </h5>
                </div>
                <div class="ibox-content">
                    <div class="row"><?php
                        $attributes = array('id' => 'UpdateProfile', 'name' => 'UpdateProfiles', 'method' => "post");
                        echo form_open_multipart('profile_save', $attributes);
                        echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id', 'value' => isset($User->user_id) && $User->user_id != '' ? $User->user_id : 0));
                        ?>
                        <div class="col-sm-8 b-r">

                            <div class="form-group">
                                <?php echo form_label('', 'Name', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'Firstname', 'type' => 'text', 'class' => 'form-control', 'name' => 'Firstname', 'placeholder' => "Enter  Name", 'value' => $name)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('Firstname'); ?>
                            </div>

                            <div class="form-group">
                                <?php echo form_label('', 'Email', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'Email', 'type' => 'email', 'class' => 'form-control', 'name' => 'Email', 'placeholder' => "Enter Email", 'value' => $email)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('Email'); ?>
                            </div>

                            <div class="form-group">
                                <?php echo form_label('', 'Phone', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'Phone', 'type' => 'number', 'maxlength' => 13, 'class' => 'form-control', 'name' => 'Phone', 'placeholder' => "Enter Phone", 'value' => $phone)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('Phone'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('', 'Address', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'Address', 'type' => 'text', 'class' => 'form-control', 'name' => 'Address', 'placeholder' => "Enter Address", 'value' => $address)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('Address'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('', 'Facebook', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'Facebook', 'type' => 'text', 'class' => 'form-control', 'name' => 'Facebook', 'placeholder' => "Enter Facebook Link", 'value' => $facebook)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('Facebook'); ?>
                            </div>
                             <div class="form-group">
                                <?php echo form_label('', 'Google', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'Google', 'type' => 'text', 'class' => 'form-control', 'name' => 'Google', 'placeholder' => "Enter Google Link", 'value' => $google)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('Google'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('', 'Twitter', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'Twitter', 'type' => 'text', 'class' => 'form-control', 'name' => 'Twitter', 'placeholder' => "Enter Twitter Link", 'value' => $twitter)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('Twitter'); ?>
                            </div>

                            <div class="form-group">
                                <?php echo form_label('', 'Instagram', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'Instagram', 'type' => 'text', 'class' => 'form-control', 'name' => 'Instagram', 'placeholder' => "Enter Instagram Link", 'value' => $instagram)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('Instagram'); ?>
                            </div>


                            <div class="form-group">
                                <?php echo form_label('', 'LinkedIn', array('class' => 'control-label')); ?>
                                <?php echo form_input(array('id' => 'LinkedIn', 'type' => 'text', 'class' => 'form-control', 'name' => 'LinkedIn', 'placeholder' => "Enter LinkedIn Link", 'value' => $linkedin)); ?>
                                <span class="material-input"></span>
                                <?php echo form_error('LinkedIn'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row" >     
                        <div class="col-md-4 p_0">
                            <label class="control-label">Profile Image</label>
                            <div class="form-group label-floating is-empty has-error">

                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">

                                        <img src="<?php echo $this->config->item('upload_url') . $User->logo_image; ?>" alt="Image">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="select_img_lbl">
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            
                                            <input type="file" name="Logo_image" id="Logo_image"  aria-required="true"  accept="image/*">
                                        </span>
                                        
                                        <?php echo form_error('Logo_image'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 p_0">
                            <label class="control-label">Login Image</label>
                            <div class="form-group label-floating is-empty has-error">

                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <?php
                                        if (in_array('login_background.jpg', $image)) {
                                            $image_url_details = admin_url . 'assets/images/background/login_background.jpg';
                                        } else {
                                            $image_url_details = base_url() . img_path . "/image_placeholder.jpg";
                                        }
                                        ?>
                                        <img src="<?php echo $image_url_details; ?>"  alt="Image">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="select_img_lbl">
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            
                                            <input type="file" name="Login_image" id="Login_image"  aria-required="true"  accept="image/*">
                                        </span>
                                        
                                        <?php echo form_error('Login_image'); ?>
                                    </div>
                                </div>
                            </div>
                        </div></div>  
                    <div class="row" >  
                        <div class="col-md-4 p_0">
                            <label class="control-label">Forgot Image</label>
                            <div class="form-group label-floating is-empty has-error">

                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <?php
                                        if (in_array('forgot_background.jpg', $image)) {
                                            $image_url_details = admin_url . 'assets/images/background/forgot_background.jpg';
                                        } else {
                                            $image_url_details = base_url() . img_path . "/image_placeholder.jpg";
                                        }
                                        ?>
                                        <img src="<?php echo $image_url_details; ?>"  alt="Image">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="select_img_lbl">
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Select image</span>
                                           
                                            <input type="file" name="Forgot_image" id="Forgot_image"  aria-required="true"  accept="image/*">
                                        </span>
                                        
                                        <?php echo form_error('Forgot_image'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p_0">
                            <label class="control-label">Register Image</label>
                            <div class="form-group label-floating is-empty has-error">

                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">

                                        <?php
                                        if (in_array('register_background.jpg', $image)) {
                                            $image_url_details = admin_url . 'assets/images/background/register_background.jpg';
                                        } else {
                                            $image_url_details = base_url() . img_path . "/image_placeholder.jpg";
                                        }
                                        ?>
                                        <img src="<?php echo $image_url_details; ?>"  alt="Image">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="select_img_lbl">
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            
                                            <input type="file" name="Register_image" id="Register_image"  aria-required="true"  accept="image/*">
                                        </span>
                                        
                                        <?php echo form_error('Register_image'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  text-center">
                        <button type="submit" class="  btn btn-success btn-wd btn-lg">UpdateInfo</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include APPPATH . '/modules/views/footer.php';
?>