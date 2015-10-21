<form method="post" action="<?php echo site_url('advertisement/update')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('advertisement/_form',
            array('data'=> $data,'is_edit'=>true));
    ?>
</form>