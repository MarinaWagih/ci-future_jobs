<form method="post" action="<?php echo site_url('user/store')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('user/_form', $data);
    ?>
</form>