<?php
$user_id = (int) trim($this->session->userdata('user_id'));
$this->db->where('ID !=', $user_id);
$this->db->where('profile_completed', 1);
$this->db->where('user_status', 'A');
$result = $this->db->get('theme_users')->result();
$options[''] = "Select From User";
if (isset($result) && !empty($result)) {
    foreach ($result as $row) {
        $options[$row->ID] = $row->user_login;
    }
}
?>
<!-- FORM POPUP -->
<div id="send_message_popup" class="form-popup new-message mfp-hide">
    <!-- FORM POPUP CONTENT -->
    <div class="form-popup-content">
        <h4 class="popup-title">Write a New Message</h4>
        <!-- LINE SEPARATOR -->
        <hr class="line-separator">
        <!-- /LINE SEPARATOR -->
        <?php
        $message_from_encry = $this->encryption->encrypt($user_id);
        $msg_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $message_from_encry);

        $hidden = array('token_from' => trim($msg_from_id));
        $attributes = array('id' => 'private_message_from', 'name' => 'private_message_from', 'method' => "post", "class" => "");
        echo form_open('send_message', $attributes, $hidden);
        ?>
        <!-- INPUT CONTAINER -->
        <div class="input-container field-add">
            <?php echo form_label('To:', 'token_to', array('class' => 'rl-label required')); ?>
            <label for="token_to" class="select-block">
                <?php echo form_dropdown('token_to', $options, '', 'id="token_to" required =""'); ?>
                <!-- SVG ARROW -->
                <svg class="svg-arrow">
                <use xlink:href="#svg-arrow"></use>
                </svg>
                <!-- /SVG ARROW -->
            </label>
        </div>
        <!-- /INPUT CONTAINER -->

        <!-- INPUT CONTAINER -->
        <div class="input-container">
            <label for="message_text" class="rl-label">Message*</label>
            <textarea id="message_text" placeholder="Message" required="" name="message_text" maxlength="144" style="height: 125px"></textarea>
            <p id="textarea_feedback"></p>
            <button type="button" id="private_msg_Send" class="button mid dark">Send <span class="primary">Now!</span></button>
            <?php echo form_close(); ?>
        </div>
        <!-- INPUT CONTAINER -->
    </div>
    <!-- /FORM POPUP CONTENT -->
</div>
<!-- /FORM POPUP -->
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <?php $this->load->view('templates/message') ?>
        <!-- HEADLINE -->
        <div class="headline buttons two primary fixed-box">
            <h4>Your Messages</h4>
<!--            <a href="#send_message_popup" class="button mid-short secondary open-new-message send_message_popup">New Message</a>-->
        </div>
        <!-- /HEADLINE -->

        <!-- INBOX MESSAGES -->
        <div class="inbox-messages">
            <!-- INBOX MESSAGE -->
            <?php
            if (count($message_data) > 0):

                foreach ($message_data as $value):

                    $profile_user_id = isset($value['from_user_id']) ? $value['from_user_id'] : 0;
                    $details_user_fol_nm = sha1("profile_" . $profile_user_id);
                    $profile_image_details = isset($value['from_profile_photo']) ? trim($value['from_profile_photo']) : "";

                    if (file_exists(FCPATH . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details) && $profile_image_details != "") {
                        $profile_image_url_details = base_url() . uploads_path . '/profiles/' . $details_user_fol_nm . '/' . $profile_image_details;
                    } else {
                        $profile_image_url_details = base_url() . img_path . "/user.png";
                    }
                    $from_user_id = $this->encryption->encrypt($profile_user_id);
                    $encrypted_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $from_user_id);
                    ?>
                    <div class="inbox-message">
                        <a href="<?php echo base_url('message_details?token=' . $encrypted_from_id) ?>">
                            <div class="inbox-message-author">

                                <figure class="user-avatar">
                                    <img src="<?php echo $profile_image_url_details; ?>" alt="user-img">
                                </figure>
                                <p class="text-header">
                                    <?php echo ucfirst($value['from_first_name']) . " " . ucfirst($value['from_last_name']); ?>
                                    <span class="message-icon icon-envelope secondary"></span>
                                </p>
                            </div>
                            <div class="inbox-message-content">
                                <p class="text-header">Message </p>
                                <p class="description"><?php echo $this->general->add3dots($value['message_text'], "...", 50); ?></p>
                            </div>
                            <div class="inbox-message-type">

                                <?php if ($value['status'] == 'U') { ?>
                                    <span class="message-icon icon-envelope secondary"></span>
                                <?php } else { ?>
                                    <span  class="message-icon icon-envelope-open"></span>
                                <?php } ?>

                            </div>
                            <div class="inbox-message-date">
                                <p><?php echo date("F d,Y", strtotime($value['created_on'])); ?> | <b><?php echo date("H:i A", strtotime($value['created_on'])); ?></b> </p>
                            </div>
                        </a>
                    </div>
                    <!-- INBOX MESSAGE -->
                    <?php
                endforeach;
            else:
                ?>
                <div class="inbox-message">
                    <div class="inbox-message-author not_inquiry" style="width: 100%;text-align: center">
                        <p class="text-header">
                            Your message box is empty.
                        </p>
                    </div>
                </div>
            <?php endif; ?>

        </div>
        <!-- /INBOX MESSAGES -->
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->
