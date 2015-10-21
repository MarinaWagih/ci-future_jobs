<form method="post" action="<?php echo site_url('category/update')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('category/_form',
            array('data'=> $data,'is_edit'=>true));
    ?>
</form>