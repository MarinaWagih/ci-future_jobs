<h1>form</h1>
<span class="alert-danger" id="msg">
    <?php echo validation_errors();?>
</span>
<div class="form-group">
    <label><?php echo $this->lang->line('name')?></label>
    <input type="text" name="name" class="form-control"
           placeholder="<?php echo $this->lang->line('name')?>"
           required
           id="userName"
           value="<?php echo $data['name'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('ar_name')?></label>
    <input type="text" name="name_ar" class="form-control"
           placeholder="<?php echo $this->lang->line('ar_name')?>"
           required
           id="userName"
           value="<?php echo $data['name_ar'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<?php
if(isset($is_edit))
{
?>

    <input type="hidden" name="id"
           class="form-control" value="<?php echo $data['id'];?>" >
<?php
}
?>
<button type="submit" class="btn btn-info" id="submit">
    <?php echo isset($is_edit)?$this->lang->line('edit'):$this->lang->line('add')?>
</button>
