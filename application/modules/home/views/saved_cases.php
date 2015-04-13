<?php echo modules::run('home/header') ?>
<div class="content_wrapper">
    
	<div id="bodyContent">
                <div class="contentWrapper">
                    <div class="saved_cases_title">SAVED <?=strtoupper($type)?> CASES</div>
                    <div class="list_saved_items">
                        <ol type="1">
                        <?php foreach($saved_cases as $save_case){?>
                            <li>
                                <a href="<?=base_url()?>cases/<?=$type?>/<?=$save_case->serial_no?>/<?=$save_case->id?>" style="padding: 10px;display: block;"><?=$save_case->serial_no?></a>
                            </li>
                        <?php }?>
                        </ol>
                    </div>
                </div>            
        </div>
</div>
<?php echo modules::run('home/footer') ?>