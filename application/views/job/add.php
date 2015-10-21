<form method="post" action="<?php echo site_url('job/store')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('job/_form', $data);
    ?>
</form>