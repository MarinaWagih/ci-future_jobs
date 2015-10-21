<form method="post" action="<?php echo site_url('job/update')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('job/_form',
            array('data'=> $data,'is_edit'=>true));
    ?>
</form>