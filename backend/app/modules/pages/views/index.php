<?php
include APPPATH . '/modules/views/header.php';
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
             <?php $this->load->view('message') ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage Pages Table</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">pages Title</th>
                                    <th class="text-center">pages slug</th>
                                    <th class="text-center">pages Description</th>
                                    <th class="text-center">pages Status</th>
                                    <th class="text-center">Created In</th>
                                    <th class="text-center">Updated In</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            if (isset($Pages) && count($Pages) > 0) {
                                foreach ($Pages as $row) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td class="text-center"><?php echo $row->name; ?></td>
                                            <td class="text-center"><?php echo $row->slug; ?></td>
                                            <td class="text-center"><?php echo $row->description; ?></td>
                                            <td class="text-center"><?php echo isset($row->status) && $row->status == 'A' ? 'Active' : 'Inactive'; ?></td>
                                            <td class="text-center"><?php echo  date("d/m/Y H:i", strtotime($row->created_on)); ?></td>
                                            <td class="text-center"><?php echo  date("d/m/Y H:i", strtotime( $row->updated_on)); ?></td>
                                            <td class="td-actions text-center">
                                                <a href="<?php echo base_url('insert_pages') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                                <a href="<?php echo base_url('pages_status') . "?id=" . $row->ID . "&status=" . $row->status; ?>" type="button" rel="tooltip" class="btn btn-info btn-round" data-original-title="" title="">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a href="<?php echo base_url('delete_pages') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
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
                                    <td colspan="8" align="center" style="color: red"><h4>No data Found</h4></td>
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
?><script>
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