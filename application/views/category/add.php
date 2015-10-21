<form method="post" action="<?php echo site_url('category/store')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('category/_form', $data);
    ?>
</form>