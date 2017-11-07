<?php
// current login user details
$user_id = $this->session->userdata('user_id');
$foldername = sha1("profile_" . $user_id);
$this->db->select('*');
$this->db->where('user_id', $user_id);
$result = $this->db->get('theme_user_details')->row_array();
$profile_image = isset($result['profile_photo']) ? $result['profile_photo'] : "";
$this->db->set('status', 'R')->where(array("msg_from_id" => $other_id, "msg_to_id" => $user_id))->update('theme_messages');
if (file_exists(FCPATH . uploads_path . '/profiles/' . $foldername . '/' . $profile_image) && $profile_image != "") {
    $profile_image_url = base_url() . uploads_path . '/profiles/' . $foldername . '/' . $profile_image;
} else {
    $profile_image_url = base_url() . img_path . "/user.png";
}
?>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE -->
        <div class="headline inbox buttons two primary">
            <h4>Message Details</h4>
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
                                    $msg_user_id = isset($value['msg_from_id']) ? $value['msg_from_id'] : 0;
                                    $msg_user_foldername = sha1("profile_" . $msg_user_id);
                                    $msg_user_profile_image = isset($value['profile_photo']) ? trim($value['profile_photo']) : "";

                                    if (file_exists(FCPATH . uploads_path . '/profiles/' . $msg_user_foldername . '/' . $msg_user_profile_image) && $msg_user_profile_image != "") {
                                        $msg_user_profile_image_url = base_url() . uploads_path . '/profiles/' . $msg_user_foldername . '/' . $msg_user_profile_image;
                                    } else {
                                        $msg_user_profile_image_url = base_url() . img_path . "/user.png";
                                    }

                                    if ($user_id == $value['msg_from_id']) {
                                        ?>

                                        <div class="comment-wrap">
                                            <!-- USER AVATAR -->
                                            <a href="<?php echo base_url('profile') . "/" . $value['user_login']; ?>">
                                                <figure class="user-avatar medium">
                                                    <img src="<?php echo $msg_user_profile_image_url; ?>" alt="Profile Image">
                                                </figure>
                                            </a>
                                            <!-- /USER AVATAR -->
                                            <div class="comment">
                                                <p class="text-header"><?php echo isset($value['first_name']) ? ucfirst($value['first_name']) . " " . ucfirst($value['last_name']) : ''; ?></p>
                                                <p class="timestamp"><?php echo date("F d,Y | H:i A", strtotime(isset($value['created_on']) ? $value['created_on'] : '')); ?></p>
                                                <p><?php echo isset($value['message_text']) ? nl2br($value['message_text']) : ''; ?></p>
                                            </div>
                                        </div>
                                        <hr class="line-separator">                            
                                    <?php } else { ?>
                                        <div class="comment-wrap">
                                            <!-- USER AVATAR -->
                                            <a href="<?php echo base_url('profile') . "/" . $value['user_login']; ?>">
                                                <figure class="user-avatar medium">
                                                    <img src="<?php echo $msg_user_profile_image_url; ?>" alt="Profile Image">
                                                </figure>
                                            </a>
                                            <!-- /USER AVATAR -->
                                            <div class="comment">
                                                <p class="text-header"><?php echo isset($value['first_name']) ? ucfirst($value['first_name']) . " " . ucfirst($value['last_name']) : ''; ?></p>
                                                <p class="timestamp"><?php echo date("F d,Y | H:i A", strtotime(isset($value['created_on']) ? $value['created_on'] : '')); ?></p>
                                                <p><?php echo isset($value['message_text']) ? nl2br($value['message_text']) : ''; ?></p>
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
                            $pro_user_id = isset($other_id) ? $other_id : 0;


                            $message_from_encry = $this->encryption->encrypt($send_user_id);
                            $msg_from_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $message_from_encry);

                            $message_to_encry = $this->encryption->encrypt($pro_user_id);
                            $msg_to_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $message_to_encry);

                            $hidden = array('token_from' => trim($msg_from_id), 'token_to' => trim($msg_to_id), 'msg_perent_id' => 0);
                            $attributes = array('id' => 'private_message_from', "required" => true, 'name' => 'private_message_from', 'method' => "post", "class" => "comment-reply-form");
                            echo form_open('send_message_replay', $attributes, $hidden);
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
        $("#private_message_from").submit(function () {
            if ($("#private_message_from").valid()) {
                $('#loadingmessage').show();
            }
        });
    });
</script>
