<html>
<head>
    <title>
        Future Jobs
    </title>
    <?php
    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "en";
    ?>

    <?php
    if ($_SESSION['lang'] == "en")
    {

        $this->lang->load("msg", "english");
        echo '<link href="/q8DZ/css/newstyle.css" rel="stylesheet" type="text/css"/>';
    }
    else
    {
        $this->lang->load("msg", "arabic");
        echo '<link href="/q8DZ/css/rtl.css" rel="stylesheet" type="text/css"/>';
    }
    ?>

</head>
<body>
<div>Layout</div>
<div class="container">
    view
    <?php
    if (isset($data))
    {
        $this->load->view($content, $data);
    } else
    {
        $this->load->view($content);
    }

    ?>
</div>
</body>
</html>