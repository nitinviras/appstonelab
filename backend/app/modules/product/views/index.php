<?php
include APPPATH . '/modules/views/header.php';

?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php $this->load->view('message') ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pending Product Table</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Product Title</th>
                                    <th>Product Status</th>
                                    <th>Created By</th>
                                    <th class="text-center">Created In</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            if (count($pending) > 0) {
                                foreach ($pending as $row) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td><?php echo $row->item_name; ?></td>
                                            <td><?php echo isset($row->item_status) && $row->item_status == 'A' ? 'Approve' : 'Pending'; ?></td>
                                            <td><?php echo date("d/m/Y H:i", strtotime($row->created_date));  ?></td>
                                            <td class="text-center"><?php echo $row->created_date; ?></td>
                                            <td class="td-actions text-center">
                                                <a href="<?php echo base_url('pending') . "?id=" . $row->ID . "&user_id=" . $row->user_id; ?>" type="button" rel="tooltip" class="btn btn-info btn-round" data-original-title="" title="">
                                                    <i class="material-icons">person</i>
                                                </a>
                                                <a href="<?php echo base_url('delete_product') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
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
                                    <td colspan="6" align="center" style="color: red"><h4>No Record Found</h4></td>
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

    <div class="row">
        <div class="col-lg-12">
            <?php $this->load->view('message') ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Approve Product Table</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Product Title</th>
                                    <th>Product Status</th>
                                    <th>Created By</th>
                                    <th class="text-center">Created In</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $i = 1;
                            if (count($approve) > 0) {
                                foreach ($approve as $row) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td><?php echo $row->item_name; ?></td>
                                            <td><?php echo isset($row->item_status) && $row->item_status == 'A' ? 'Approve' : 'Pending'; ?></td>
                                            <td><?php echo $row->created_by; ?></td>
                                            <td class="text-center"><?php echo date("d/m/Y H:i", strtotime($row->created_date));  ?></td>
                                            <td class="td-actions text-center">
                                                <a href="<?php echo base_url('delete_product') . "?id=" . $row->ID; ?>" type="button" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
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
                                    <td colspan="6" align="center" style="color: red"><h4>No Record Found</h4></td>
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
