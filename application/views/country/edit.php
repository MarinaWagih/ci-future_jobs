<form method="post" action="<?php echo site_url('country/update')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('country/_form',
            array('data'=> $data,'is_edit'=>true));
    ?>
</form>