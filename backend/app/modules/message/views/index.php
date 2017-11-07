<?php 
include APPPATH . '/modules/views/header.php';
?>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
           
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Message</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                        <th class="text-center">Message Sender</th>
                                        <th class="text-center">Message Receiver</th>
                                        <th class="text-center">Message</th>
                                </tr>
                            </thead>
                           <?php
                                $i = 1;
                                if (count($Message) > 0) {
                                    foreach ($Message as $row) {
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td class="text-center"><?php echo ucwords($row->from_firstname.' '.$row->from_lastname);?></td>
                                                <td class="text-center"><?php echo ucwords($row->to_firstname.' '.$row->to_lastname);?></td>
                                                <td class="text-center"><?php echo $row->message_text; ?></td>
                                        </tbody>  
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4" align="center" style="color: red"><h4>No Message Found</h4></td>
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