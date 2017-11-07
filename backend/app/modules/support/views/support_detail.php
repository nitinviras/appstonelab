<?php
include APPPATH . '/modules/views/header.php';
?>
<style>
    .media-body.text-right {
    padding-right: 10px;
}
</style>
<!-- DASHBOARD CONTENT -->
<div class="dashboard-content">
    <!-- CONTAINER FLUID -->
    <div class="container-fluid">
        <!-- HEADLINE --> 
        <div class="headline inbox buttons two primary">
            <h4>Ticket Details</h4>
        </div>
        <!-- /HEADLINE -->
        <div class="ibox-content">


            <div class="chat-activity-list">
                <?php
                if (count($message_data) > 0) {
                    foreach ($message_data as $value) {

                        $ticket_id = $value->ticket_id;
                        $supportfolder = sha1("support_" . $ticket_id);
                        $main_image = isset($value->image) ? $value->image : "";
                        $support_img = '';
                        if (file_exists(FCPATH . uploads_path . '/support/' . $supportfolder . '/' . $main_image) && $main_image != '') {
                            $support_img = base_url() . uploads_path . '/support/' . $supportfolder . '/' . $main_image;
                        }


                        if ($value->type == 1) {
                            ?>
                            <div class="chat-element">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo $this->config->item('upload_url') . $value->profile_photo; ?>">
                                </a>
                                <div class="media-body">

                                    <strong><?php echo isset($value->first_name) ? ucfirst($value->first_name) . " " . ucfirst($value->last_name) : ''; ?></strong>
                                    <p class="m-b-xs">
                                        <?php echo isset($value->summary) ? nl2br($value->summary) : ''; ?>
                                    </p>
                                    <?php if (isset($support_img) && $support_img != '') { ?> <p> 
                                            <a class="attachement_color" href="<?php echo $support_img; ?>" download><span class="icon-paper-clip"></span>Attachemnt</a>
                                        </p>  <?php } ?>
                                    <small class="text-muted"> <?php echo date("F D d,Y | H:i A", strtotime(isset($value->created_on) ? $value->created_on : '')); ?></small>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="chat-element ">
                                <a href="#" class="pull-right ">
                                    <img alt="image" class="img-circle" src="<?php echo $this->config->item('upload_url') . $admin_data['ProfileImage']; ?>">
                                </a>
                                <div class="media-body text-right ">

                                    <strong><?php echo isset($admin_data['Firstname']) ? ucfirst($admin_data['Firstname']) . " " . ucfirst($admin_data['Lastname']) : ''; ?></strong>
                                    <p class="m-b-xs">
                                        <?php echo isset($value->summary) ? nl2br($value->summary) : ''; ?> 
                                    </p>
                                    <small class="text-muted"><?php echo date("F D d,Y | H:i A", strtotime(isset($value->created_on) ? $value->created_on : '')); ?></small>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>


                </div> <?php } ?>

            <div class="chat-form">
                <?php
                $send_user_id = (int) trim($this->session->userdata('admin_id'));

                $hidden = array('token_from' => trim($send_user_id), 'msg_ticket_id' => isset($ticket_id) ? $ticket_id : 0, 'user_id' => $value->user_id);
                $attributes = array('id' => 'private_message_from', "required" => true, 'name' => 'private_message_from', 'method' => "post");
                echo form_open('support/save_send_message', $attributes, $hidden);
                ?>
                <div class="form-group">
                    <?php echo form_textarea(array('rows' => "2", 'id' => 'message_text', 'name' => 'message_text', 'class' => 'form-control', 'placeholder' => "Enter To Replay Message")); ?>
                    <?php echo form_error('message_text'); ?>
                </div>
                <div class="form-group text-right">

                    <button  type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Reply</strong></button>

                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

    </div>


</div>
<?php include APPPATH . '/modules/views/footer.php'; ?>
