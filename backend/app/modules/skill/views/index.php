<?php
include APPPATH . '/modules/views/header.php';
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php $this->load->view('message') ?>
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title pull-left">Skill Table</h4>
                    <div align="right" style="padding-right: 10px">
                        <a href="<?php echo base_url("insert_skill"); ?>" type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="" >
                            <i class="material-icons">note_add</i>
                        </a>
                    </div>


                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th  class="text-center">Skill Title</th>
                                        <th  class="text-center">Skill Status</th>
                                       <th  class="text-center">Skill Category</th>
                                        <th class="text-center">Created On In</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                if (isset($Skill) && count($Skill) > 0) {
                                    foreach ($Skill as $row) {
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td class="text-center"><?php echo $row->name; ?></td>
                                                <td class="text-center"><?php echo isset($row->status) && $row->status == 'A' ? 'Active' : 'Inactive'; ?></td>
                                                <td class="text-center"><?php echo $row->category; ?></td>
                                                <td class="text-center"><?php echo $row->created_on; ?></td>
                                                
                                                <td class="td-actions text-center">
                                                    <a href="<?php echo base_url('insert_skill') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                                       <i class="material-icons">mode_edit</i>
                                                    </a>
                                                    <a href="<?php echo base_url('skill_status') . "?id=" . $row->ID . "&status=" . $row->status; ?>" type="button" rel="tooltip" class="btn btn-info btn-round" data-original-title="" title="">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                    <a href="<?php echo base_url('delete_skill') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
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
                                        <td colspan="6" align="center" style="color: red"><h4>No Skill Found</h4></td>
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
</div>
<?php include APPPATH . '/modules/views/footer.php';
?>