<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="section">
    <div class="container">
        <div class="wrapper center-block">
            <h1  class="cms_page_class">FAQ</h1>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php if (count($faq_list) > 0 && isset($faq_list)): ?>
                    <?php
                    $i = 0;
                    $j = 1;
                    foreach ($faq_list as $val):
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading <?php echo ($i == 0) ? "active" : ""; ?>" role="tab" id="heading<?php echo $val['ID'] ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $val['ID'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $val['ID'] ?>">
                                        <?php echo "#" . $j . " " . ucfirst($val['title']); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?php echo $val['ID'] ?>" class="panel-collapse collapse <?php echo ($i == 0) ? " in show" : ""; ?>" role="tabpanel" aria-labelledby="heading<?php echo $val['ID'] ?>">
                                <div class="panel-body"><?php echo nl2br($val['description']) ?></div>
                            </div>
                        </div>
                        <?php
                        $i++;
                        $j++;
                    endforeach;
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('.panel-collapse').on('show.bs.collapse', function () {
        $(this).siblings('.panel-heading').addClass('active');
    });

    $('.panel-collapse').on('hide.bs.collapse', function () {
        $(this).siblings('.panel-heading').removeClass('active');
    });
</script>