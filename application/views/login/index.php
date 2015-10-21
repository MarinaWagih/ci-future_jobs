<form method="post" action="<?php echo site_url('login/verify')?>" enctype="multipart/form-data">
    <div class="form-group">
        <label ><?php echo $this->lang->line('email')?></label>
        <input type="email" name="email" class="form-control"
               placeholder="<?php echo $this->lang->line('email')?>"
               required
               id="Email"
               value="">
        <span class="alert-danger" id='emailError'></span>
    </div>
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
    <button type="submit" class="btn btn-info" id="submit">
        <?php echo $this->lang->line('sign in')?>
    </button>
</form>
<span class="alert-danger" id="msg">
    <?php echo validation_errors();?>
    <?php echo isset($data['error'])?$data['error']:''?>

</span>