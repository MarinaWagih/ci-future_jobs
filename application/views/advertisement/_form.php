<h1>form</h1>
<span class="alert-danger" id="msg">
    <?php echo validation_errors();?>
</span>
<div class="form-group">
    <label ><?php echo $this->lang->line('image')?></label>
    <input type="file" name="image" >
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('rank')?></label>
    <input type="number" name="rank" class="form-control"
           placeholder="<?php echo $this->lang->line('rank')?>"
           id="userRank"
           value="<?php echo $data['rank'];?>"
           min="0" step="1">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('column')?></label>
    <select class="form-control" name="direction">
        <option value="left" <?php echo $data['direction']=='left'?'selected':''?>>
            <?php echo $this->lang->line('left')?>
        </option>
        <option value="right" <?php echo $data['direction']=='right'?'selected':''?>>
            <?php echo $this->lang->line('right')?>
        </option>
    </select>

    <span class="alert-danger" id='userDirectionError'></span>
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
