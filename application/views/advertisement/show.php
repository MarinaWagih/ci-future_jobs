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
                    <?php echo $this->lang->line('image')?>:
                </span>
   <img src="<?php echo base_url().'images/adv/'.$data['image'];?>" class="center-block img-responsive"/>
    <br><br>
                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('column')?> :
                </span>
    <?php echo $this->lang->line($data['direction']);?><br><br>
                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('rank')?> :
                </span>
    <?php echo $data['rank'];?><br><br>
                <span style="text-decoration: underline;">
                     <?php echo $this->lang->line('date')?> :
                 </span>
    <?php echo $data['date'];?><br><br>

</h3>

</div>