<form method="post" action="<?php echo site_url('foreign_labor/store')?>" enctype="multipart/form-data">
    <?php
        $this->load->view('foreign_labor/_form', $data);
    ?>
</form>