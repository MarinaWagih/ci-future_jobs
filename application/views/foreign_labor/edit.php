<form method="post" action="<?php echo site_url('foreign_labor/update')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('foreign_labor/_form',
            array('data'=> $data,'is_edit'=>true));
    ?>
</form>