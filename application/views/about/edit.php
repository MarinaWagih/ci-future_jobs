<br>
<form method="post" action="<?php echo site_url('about/update')?>" enctype="multipart/form-data">
    <h1></h1>
    <h1><?php echo $this->lang->line('about')?></h1>
    <main>
        <div class="adjoined-bottom">
            <div class="grid-container">
                <div class="grid-width-100">

                    <textarea id="editor" name="data">
                        <?php echo $data;?>
                    </textarea>
                </div>
            </div>
        </div>

    </main>
    <br><br>
    <h1><?php echo $this->lang->line('about_ar')?></h1>
    <main>
        <div class="adjoined-bottom">
            <div class="grid-container">
                <div class="grid-width-100">
                    <label><?php echo $this->lang->line('About')?></label>
                    <textarea id="editor2" name="data_ar" style="direction: rtl;">
                        <?php echo $data_ar;?>
                    </textarea>
                </div>
            </div>
        </div>

    </main>
<br>
    <script>
        initSample();
        initSample2();
    </script>
        <button type="submit" class="btn btn-info" id="submit"><?php echo $this->lang->line('edit');?></button>
</form>

