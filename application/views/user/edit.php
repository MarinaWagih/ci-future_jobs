<form method="post" action="<?php echo site_url('user/update')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('user/_form',
            array('data'=> $data,'is_edit'=>true));
    ?>
</form>