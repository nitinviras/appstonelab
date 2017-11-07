
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <?php $this->load->view('templates/message') ?>
        <!-- HEADLINE -->
        <div class="headline buttons two primary fixed-box">
            <h4>Your Support Ticket</h4>
            <a href="<?php echo base_url('add_support.jsf'); ?>" class="button mid-short primary">New Ticket</a>
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
                    $ticket_id = $this->encryption->encrypt($value['ticket_id']);
                    $encrypted_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $ticket_id);
                    ?>
                    <div class="inbox-message">
                        <a href="<?php echo base_url('support_details.jsf?token=' . $encrypted_from_id) ?>">
                            <div class="inbox-message-author">

                                <figure class="user-avatar">
                                    <img src="<?php echo $profile_image_url_details; ?>" alt="user-img">
                                </figure>
                                <p class="text-header">
                                    <?php echo ucfirst($value['from_first_name']) . " " . ucfirst($value['from_last_name']); ?>
                                    <span class="message-icon icon-envelope secondary"></span>
                                </p>
                            </div>
                            <div class="inbox-message-content support-content">
                                <p class="text-header">Ticket ID </p>
                                <p class="description"><?php echo $value['ticket_id']; ?></p>
                            </div>
                            <div class="inbox-message-content support-content">
                                <p class="text-header">Topic </p>
                                <p class="description"><?php echo $this->general->add3dots($value['topic'], "...", 50); ?></p>
                            </div>
                            <?php if ($value['status'] == 'U') { ?>
                            <span class="message-icon icon-envelope secondary"></span>
                            <?php } else { ?>
                            <span  class="message-icon icon-envelope-open"></span>
                            <?php } ?>
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
                            You have no created any support ticket yet.
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
