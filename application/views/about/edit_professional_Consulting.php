<br>
<form method="post" action="<?php echo site_url('professional_consulting_services/update')?>" enctype="multipart/form-data">
    <h1></h1>
    <h1><?php echo $this->lang->line('professional_consulting_services')?></h1>
    <main>
        <div class="adjoined-bottom">
            <div class="grid-container">
                <div class="grid-width-100">

                    <textarea id="editor" name="professional_consulting_data">
                        <?php echo $professional_consulting_data;?>
                    </textarea>
                </div>
            </div>
        </div>

    </main>
    <br><br>
    <h1><?php echo $this->lang->line('professional_consulting_services_ar')?></h1>
    <main>
        <div class="adjoined-bottom">
            <div class="grid-container">
                <div class="grid-width-100">
                   <textarea id="editor2" name="professional_consulting_data_ar" style="direction: rtl;">
                        <?php echo $professional_consulting_data_ar;?>
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

