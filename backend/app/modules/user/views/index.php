

<?php
include APPPATH . '/modules/views/header.php';
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php $this->load->view('message') ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage User Table</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">User Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created In</th>
                                    <th class="text-center">Actions</th>
                                    
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            if (isset($User) && count($User) > 0) {
                                foreach ($User as $row) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td><?php echo $row->user_login; ?></td>
                                            <td><?php echo $row->user_email; ?></td>
                                            <td><?php echo isset($row->user_status) && $row->user_status == 'A' ? 'Approve' : 'Pending'; ?></td>
                                            <td><?php echo date("d/m/Y H:i", strtotime($row->user_registered));  ?></td>
                                            <td class="td-actions text-center">
                                                <a href="<?php echo base_url('user_details') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                                <a href="<?php echo base_url('user_delete') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
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
                                    <td colspan="6" align="center" style="color: red"><h4>No Tag Found</h4></td>
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
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });

</script>