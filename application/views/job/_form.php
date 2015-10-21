<h1>form</h1>
<span class="alert-danger" id="msg">
    <?php echo validation_errors();?>
</span>
<div class="form-group">
    <label><?php echo $this->lang->line('title')?></label>
    <input type="text" name="title" class="form-control"
           placeholder="<?php echo $this->lang->line('title')?>"
           required
           id="title"
           value="<?php echo $data['title'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('requirement')?></label>
        <textarea type="text" name="requirements" class="form-control"
                  placeholder="<?php echo $this->lang->line('requirement')?>"
                  id="userRequirement"
                  value=""><?php echo $data['requirements'];?></textarea>
    <span class="alert-danger" id='userNotesError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('description')?></label>
        <textarea type="text" name="description" class="form-control"
                  placeholder="<?php echo $this->lang->line('description')?>"
                  id="userDescription"
                  ><?php echo $data['description'];?></textarea>
    <span class="alert-danger" id='userNotesError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('category')?></label>
    <select class="form-control" name="category_id">
        <?php

        for($i=0;$i<count($data['categories']);$i++ )
        {
            echo '<option value="'.$data['categories'][$i]['id'].'" ';
            echo ($data['category_id']==$data['categories'][$i]['id']?'selected':'');
            echo ' >';
            echo isset($_SESSION['lang'])&&$_SESSION['lang']=='ar'?$data['categories'][$i]['name_ar']:$data['categories'][$i]['name'];
            echo  '</option>';
//            echo $option;
        }
        ?>
    </select>
    <span class="alert-danger" id='userCountryError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('country')?></label>
    <select class="form-control" name="country_id">
        <?php

        for($i=0;$i<count($data['countries']);$i++ )
        {


            echo '<option value="'.$data['countries'][$i]['id'].'" ';
            echo ($data['country_id']==$data['countries'][$i]['id']?'selected':'');
            echo ' >';
            echo isset($_SESSION['lang'])&&$_SESSION['lang']=='ar'?$data['countries'][$i]['name_ar']:$data['countries'][$i]['name'];
            echo  '</option>';
//            echo $option;
        }
        ?>
    </select>
    <span class="alert-danger" id='userCountryError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('company')?></label>
    <input type="text" name="company" class="form-control"
           placeholder="<?php echo $this->lang->line('company')?>"
           required
           id="CompanyName"
           value="<?php echo $data['company'];?>">
    <span class="alert-danger" id='CompanyNameError'></span>
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
<div class="form-group">
    <label ><?php echo $this->lang->line('image')?></label>
    <input type="file" name="image" >
</div>
<button type="submit" class="btn btn-info" id="submit">
    <?php echo isset($is_edit)?$this->lang->line('edit'):$this->lang->line('add')?>
</button>
