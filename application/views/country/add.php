<form method="post" action="<?php echo site_url('country/store')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('country/_form', $data);
    ?>
</form>