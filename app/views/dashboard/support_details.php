<?php
$user_id = $this->session->userdata('user_id');
$foldername = sha1("profile_" . $user_id);
$this->db->select('*');
$this->db->where('user_id', $user_id);
$result = $this->db->get('theme_user_details')->row_array();
$profile_image = isset($result['profile_photo']) ? $result['profile_photo'] : "";

if (file_exists(FCPATH . uploads_path . '/profiles/' . $foldername . '/' . $profile_image) && $profile_image != "") {
    $profile_image_url = base_url() . uploads_path . '/profiles/' . $foldername . '/' . $profile_image;
} else {
    $profile_image_url = base_url() . img_path . "/user.png";
}

//echo "<pre>";
//print_r($message_data);exit;
?>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline inbox buttons two primary">
            <h4>Ticket Details</h4>
        </div>
        <!-- /HEADLINE -->

        <!-- INBOX MESSAGES PREVIEW -->
        <div class="inbox-messages-preview full">
            <!-- INBOX MESSAGE PREVIEW -->
            <div class="inbox-message-preview">
                <div class="inbox-message-preview-body">
                    <!-- COMMENT LIST -->
                    <div class="comment-list">
                        <!-- LINE SEPARATOR -->
                        <hr class="line-separator">

                        <div class="comment-list">


                            <!-- /LINE SEPARATOR -->
                            <?php
                            if (count($message_data) > 0) {
                                foreach ($message_data as $value) {

                                    $ticket_id = $value['ticket_id'];
                                    $supportfolder = sha1("support_" . $ticket_id);
                                    $main_image = isset($value['image']) ? $value['image'] : "";
                                    $support_img = '';
                                    if (file_exists(FCPATH . uploads_path . '/support/' . $supportfolder . '/' . $main_image) && $main_image != '') {
                                        $support_img = base_url() . uploads_path . '/support/' . $supportfolder . '/' . $main_image;
                                    }


                                    if ($value['type'] == 1) {
                                        ?>

                                        <div class="comment-wrap">
                                            <!-- USER AVATAR -->
                                            <a href="<?php echo base_url('profile') . "/" . $value['user_login']; ?>">
                                                <figure class="user-avatar medium">
                                                    <img src="<?php echo $profile_image_url; ?>" alt="Profile Image">
                                                </figure>
                                            </a>
                                            <!-- /USER AVATAR -->
                                            <div class="comment">
                                                <p class="text-header"><?php echo isset($value['first_name']) ? ucfirst($value['first_name']) . " " . ucfirst($value['last_name']) : ''; ?></p>
                                                <p class="timestamp"><?php echo date("F d,Y | H:i A", strtotime(isset($value['created_on']) ? $value['created_on'] : '')); ?></p>
                                                <p><?php echo isset($value['summary']) ? nl2br($value['summary']) : ''; ?></p>
                                                <?php if (isset($support_img) && $support_img != '') { ?> <p> 
                                                    <a class="attachement_color" href="<?php echo $support_img; ?>" download><span class="icon-paper-clip"></span>Attachemnt</a>
                                                    </p>  <?php } ?>
                                            </div>
                                        </div>
                                        <hr class="line-separator">                            
                                    <?php } else { ?>
                                        <div class="comment-wrap">
                                            <!-- USER AVATAR -->

                                            <figure class="user-avatar medium">
                                                <img src="<?php echo base_url() . img_path . "/user.png"; ?>" alt="Profile Image">
                                            </figure>

                                            <!-- /USER AVATAR -->
                                            <div class="comment">
                                                <p class="text-header"><?php echo isset($admin_data['Firstname']) ? ucfirst($admin_data['Firstname']) . " " . ucfirst($admin_data['Lastname']) : ''; ?></p>
                                                <p class="timestamp"><?php echo date("F d,Y | H:i A", strtotime(isset($value['created_on']) ? $value['created_on'] : '')); ?></p>
                                                <p><?php echo isset($value['summary']) ? nl2br($value['summary']) : ''; ?></p>
                                            </div>
                                        </div>
                                        <hr class="line-separator">
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <!-- LINE SEPARATOR -->
                            <!--  <hr class="line-separator"> -->
                            <!-- /LINE SEPARATOR -->

                            <!-- COMMENT REPLY -->
                        </div>
                        <div class="comment-wrap comment-reply">
                            <!-- USER AVATAR -->
                            <a href="<?php echo base_url('profile') . "/" . $this->session->userdata("username"); ?>">
                                <figure class="user-avatar medium">
                                    <img src="<?php echo $profile_image_url ?>" alt="">
                                </figure>
                            </a>
                            <!-- /USER AVATAR -->


                            <!-- COMMENT REPLY FORM -->
                            <?php
                            $send_user_id = (int) trim($this->session->userdata('user_id'));
//                            $pro_user_id = 1;


                            $message_from_encry = $this->encryption->encrypt($send_user_id);
                            $msg_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $message_from_encry);

//                            $message_ticket_encry = $this->encryption->encrypt(isset($ticket_id) ? $ticket_id : 0);
//                            $ticket_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $message_ticket_encry);

                            $hidden = array('token_from' => trim($msg_from_id), 'msg_ticket_id' => isset($ticket_id) ? $ticket_id : 0);
                            $attributes = array('id' => 'private_message_from', "required" => true, 'name' => 'private_message_from', 'method' => "post", "class" => "comment-reply-form");
                            echo form_open('send_ticket_replay', $attributes, $hidden);
                            ?>

                            <?php echo form_textarea(array('rows' => "15", 'id' => 'message_text', 'name' => 'message_text', 'class' => 'lr_input', 'placeholder' => "Enter To Replay Message")); ?>
                            <?php echo form_error('message_text'); ?>

                            <button id="private_msg_Send" type="submit" class="button secondary">Reply</button>
                            <?php echo form_close(); ?>
                            <!-- /COMMENT REPLY FORM -->
                        </div>
                        <!-- /COMMENT REPLY -->
                    </div>
                    <!-- /COMMENT LIST -->
                </div>
            </div>
            <!-- /INBOX MESSAGE PREVIEW -->
        </div>
        <!-- /INBOX MESSAGES PREVIEW -->
    </div>
    <!-- /CONTAINER FLUID -->
</div>
<!-- /DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->
<script>
    $(document).ready(function (e) {
        var $target = $('html,body');
        $target.animate({scrollTop: $target.height()}, 5000);
        $("#private_message_from").validate({
            rules: {
                message_text: {
                    required: true,
                }
            },
        });
    });
</script>
