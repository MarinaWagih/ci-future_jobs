<form method="post" action="<?php echo site_url('advertisement/store')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('advertisement/_form', $data);
    ?>
</form>