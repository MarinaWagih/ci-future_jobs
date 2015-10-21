<h1>form</h1>
<span class="alert-danger" id="msg">
    <?php echo validation_errors();?>
</span>
<div class="form-group">
    <label><?php echo $this->lang->line('years_of_experience')?></label>
    <select class="form-control" name="years_of_experience">
        <option value="less_than_5" <?php echo $data['years_of_experience']=='less_than_5'?'selected':''?>>
            <?php echo $this->lang->line('less_than_5')?>
        </option>
        <option value="from_5_to_10" <?php echo $data['years_of_experience']=='from_5_to_10'?'selected':''?>>
            <?php echo $this->lang->line('from_5_to_10')?>
        </option>
        <option value="more_than_10" <?php echo $data['years_of_experience']=='more_than_10'?'selected':''?>>
            <?php echo $this->lang->line('more_than_10')?>
        </option>
    </select>
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('salary_from')?></label>
    <input type="number" name="salary_from" class="form-control"
           placeholder="<?php echo $this->lang->line('salary_from')?>"
           id="userSalary_from"
           value="<?php echo $data['salary_from'];?>"
           min="0" step="1">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('salary_to')?></label>
    <input type="number" name="salary_to" class="form-control"
           placeholder="<?php echo $this->lang->line('salary_to')?>"
           id="userSalary_from"
           value="<?php echo $data['salary_to'];?>"
           min="0" step="1">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('Number_needed')?></label>
    <input type="number" name="Number_needed" class="form-control"
           placeholder="<?php echo $this->lang->line('Number_needed')?>"
           id="userNumber_needed"
           value="<?php echo $data['Number_needed'];?>"
           min="0" step="1">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('nationality')?></label>
    <select class="form-control" name="nationality">
        <?php

        for($i=0;$i<count($data['countries']);$i++ )
        {


            echo '<option value="'.$data['countries'][$i]['id'].'" ';
            echo ($data['nationality']==$data['countries'][$i]['id']?'selected':'');
            echo ' >';
            echo isset($_SESSION['lang'])&&$_SESSION['lang']=='ar'?$data['countries'][$i]['name_ar']:$data['countries'][$i]['name'];
            echo  '</option>';
//            echo $option;
        }
        ?>
    </select>

    <span class="alert-danger" id='userSocial_statusError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('name')?></label>
    <input type="text" name="contact_name" class="form-control"
           placeholder="<?php echo $this->lang->line('name')?>"
           required
           id="userName"
           value="<?php echo $data['contact_name'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label ><?php echo $this->lang->line('email')?></label>
    <input type="email" name="contact_email" class="form-control"
           placeholder="<?php echo $this->lang->line('email')?>"
           required
           id="Email"
           value="<?php echo $data['contact_email'];?>">
    <span class="alert-danger" id='emailError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('mobile')?></label>
    <input type="text" name="contact_mobile" class="form-control"
           placeholder="<?php echo $this->lang->line('mobile')?>"
           required id="userMobile"
           value="<?php echo $data['contact_mobile'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('phone')?></label>
    <input type="text" name="contact_phone" class="form-control"
           placeholder="<?php echo $this->lang->line('phone')?>"
           id="userPhone"
           value="<?php echo $data['contact_phone'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('fax')?></label>
    <input type="text" name="contact_fax" class="form-control"
           placeholder="<?php echo $this->lang->line('fax')?>"
           id="userFax"
           value="<?php echo $data['contact_fax'];?>">
    <span class="alert-danger" id='userFaxError'></span>
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
