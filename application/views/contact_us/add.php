<br>
<form method="post" action="<?php echo site_url('contact_us/add')?>" enctype="multipart/form-data">
    <h1>form</h1>

    <div class="form-group">
        <label><?php echo $this->lang->line('name')?></label>
        <input type="text" name="name" class="form-control"
               placeholder="<?php echo $this->lang->line('name')?>"
               required
               id="userName"
               value="">
        <span class="alert-danger" id='userNameError'></span>
    </div>
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
        <label><?php echo $this->lang->line('mobile')?></label>
        <input type="text" name="mobile" class="form-control"
               placeholder="<?php echo $this->lang->line('mobile')?>"
               required id="userMobile"
               value="">
        <span class="alert-danger" id='userNameError'></span>
    </div>
    <div class="form-group">
        <label><?php echo $this->lang->line('phone')?></label>
        <input type="text" name="phone" class="form-control"
               placeholder="<?php echo $this->lang->line('phone')?>"
               id="userPhone"
               value="">
        <span class="alert-danger" id='userNameError'></span>
    </div>
    <div class="form-group">
        <label><?php echo $this->lang->line('fax')?></label>
        <input type="text" name="fax" class="form-control"
               placeholder="<?php echo $this->lang->line('fax')?>"
               id="userFax"
               value="">
        <span class="alert-danger" id='userFaxError'></span>
    </div>
    <div class="form-group">
        <label><?php echo $this->lang->line('content')?></label>
        <textarea type="text" name="content" class="form-control"
               placeholder="<?php echo $this->lang->line('content')?>"
               id="userContent"
               value="">
            </textarea>
        <span class="alert-danger" id='userContentError'></span>
    </div>
    <div class="form-group">
        <label><?php echo $this->lang->line('notes')?></label>
        <textarea type="text" name="notes" class="form-control"
                  placeholder="<?php echo $this->lang->line('notes')?>"
                  id="userNotes"
                  value="">
            </textarea>
        <span class="alert-danger" id='userNotesError'></span>
    </div>
        <button type="submit" class="btn btn-info" id="submit">
            <?php echo $this->lang->line('send')?>
        </button>
</form>

