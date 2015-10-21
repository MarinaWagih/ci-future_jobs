<div
    <?php if($_SESSION['lang']=='ar'){?>
        style="direction: rtl"
    <?php
    }else{
        ?>
        style="direction: ltr"
    <?php
    }
    ?>
    >
<?php

echo $_SESSION['lang']=='ar'?$data[0]['data_ar']:$data[0]['data'];
?>
    </div>