<h1>form</h1>
<span class="alert-danger" id="msg">
    <?php echo validation_errors();?>
</span>
<div class="form-group">
    <label><?php echo $this->lang->line('type')?></label>
    <select class="form-control" name="type">
        <option value="employer" <?php echo $data['type']=='employer'?'selected':''?>>
            <?php echo $this->lang->line('employer')?>
        </option>
        <option value="company" <?php echo $data['type']=='country'?'selected':''?>>
            <?php echo $this->lang->line('country')?>
        </option>
        <?php if(!isset($_SESSION['type'])&&$_SESSION['type']=='admin')
        {
        ?>

           <option value="admin" <?php echo $data['type']=='admin'?'selected':''?>>
               <?php echo $this->lang->line('admin')?>
           </option>
        <?php
        }
?>
    </select>

    <span class="alert-danger" id='userSocial_statusError'></span>
</div>
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
    <label ><?php echo $this->lang->line('email')?></label>
    <input type="email" name="email" class="form-control"
           placeholder="<?php echo $this->lang->line('email')?>"
           required
           id="Email"
           value="<?php echo $data['email'];?>">
    <span class="alert-danger" id='emailError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('mobile')?></label>
    <input type="text" name="mobile" class="form-control"
           placeholder="<?php echo $this->lang->line('mobile')?>"
           required id="userMobile"
           value="<?php echo $data['mobile'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('phone')?></label>
    <input type="text" name="phone" class="form-control"
           placeholder="<?php echo $this->lang->line('phone')?>"
           id="userPhone"
           value="<?php echo $data['phone'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('fax')?></label>
    <input type="text" name="fax" class="form-control"
           placeholder="<?php echo $this->lang->line('fax')?>"
           id="userFax"
           value="<?php echo $data['fax'];?>">
    <span class="alert-danger" id='userFaxError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('specialty')?></label>
    <input type="text" name="specialty" class="form-control"
           placeholder="<?php echo $this->lang->line('specialty')?>"
           id="userSpecialty"
           value="<?php echo $data['specialty'];?>">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('years_of_experience')?></label>
    <input type="number" name="years_of_experience" class="form-control"
           placeholder="<?php echo $this->lang->line('years_of_experience')?>"
           id="userYears_of_experience"
           value="<?php echo $data['years_of_experience'];?>"
        min="0" step="1">
    <span class="alert-danger" id='userNameError'></span>
</div>
<div class="form-group">
    <label><?php echo $this->lang->line('social_status')?></label>
    <select class="form-control" name="social_status">
        <option value="single" <?php echo $data['social_status']=='single'?'selected':''?>>
            <?php echo $this->lang->line('single')?>
        </option>
        <option value="married" <?php echo $data['social_status']=='married'?'selected':''?>>
            <?php echo $this->lang->line('married')?>
        </option>
        <option value="divorced" <?php echo $data['social_status']=='divorced'?'selected':''?>>
            <?php echo $this->lang->line('divorced')?>
        </option>
        <option value="Widowed" <?php echo $data['social_status']=='Widowed'?'selected':''?>>
            <?php echo $this->lang->line('Widowed')?>
        </option>
    </select>

    <span class="alert-danger" id='userSocial_statusError'></span>
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
    <label><?php echo $this->lang->line('place_of_residence')?></label>
    <select class="form-control" name="place_of_residence">
        <?php

        for($i=0;$i<count($data['countries']);$i++ )
        {


            echo '<option value="'.$data['countries'][$i]['id'].'" ';
            echo ($data['place_of_residence']==$data['countries'][$i]['id']?'selected':'');
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
    <label><?php echo $this->lang->line('sex')?></label>
    <select class="form-control" name="sex">
        <option value="male" <?php echo $data['sex']=='male'?'selected':''?>>
            <?php echo $this->lang->line('male')?>
        </option>
        <option value="female" <?php echo $data['sex']=='female'?'selected':''?>>
            <?php echo $this->lang->line('female')?>
        </option>

    </select>

    <span class="alert-danger" id='userSocial_statusError'></span>
</div>
<?php
if(!isset($is_edit))
{
   ?>
    <div class="form-group">
        <label ><?php echo $this->lang->line('password')?></label>
        <input type="password"
               name="password"
               id="password"
               class="form-control"
               placeholder="<?php echo $this->lang->line('password').' '.$this->lang->line('at_least_8_character')?>"
               required>
        <span class="alert-danger" id='passwordError'></span>
    </div>
    <div class="form-group">
        <label ><?php echo $this->lang->line('re-enter password')?></label>
        <input type="password"
               id="confirm_password" class="form-control"
               placeholder="<?php echo $this->lang->line('password').' '.$this->lang->line('at_least_8_character')?>"
               name="confirm_password">
        <span class="alert-danger" id='passwordConfirmError'></span>
    </div>
<?php
}else
{
    ?>
    <input type="hidden" name="id"
           class="form-control" value="<?php echo $data['id'];?>" >
<?php
}
?>

<div class="form-group">
    <label ><?php echo $this->lang->line('cv')?></label>
    <input type="file" name="cv" >
</div>
<div class="form-group">
    <label ><?php echo $this->lang->line('image')?></label>
    <input type="file" name="image" >
</div>
<button type="submit" class="btn btn-default" id="submit">Submit</button>
