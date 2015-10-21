<div <?php if($_SESSION['lang']=='ar'){?>
    style="direction: rtl"
<?php
}else{
    ?>
    style="direction: ltr"
<?php
}
?>
    >
    <h3>

                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('name')?> :
                </span>
        <?php echo $data['name'];?><br><br>
                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('ar_name')?> :
                </span>
        <?php echo $data['name_ar'];?><br><br>


    </h3>

</div>