<h1 class="title_jobs">
    <?php echo $this->lang->line('search')?>
</h1>
<form method="get" action="<?php echo site_url('job/search')?>">
    <div class="form-group">
        <label><?php echo $this->lang->line('category')?></label>
        <select class="form-control" name="category_id">
            <?php

            for($i=0;$i<count($data['categories']);$i++ )
            {
                echo '<option value="'.$data['categories'][$i]['id'].'" ';
                //echo ($data['category_id']==$data['categories'][$i]['id']?'selected':'');
                echo ' >';
                echo isset($_SESSION['lang'])&&$_SESSION['lang']=='ar'?$data['categories'][$i]['name_ar']:$data['categories'][$i]['name'];
                echo  '</option>';
//            echo $option;
            }
            ?>
        </select>
        <span class="alert-danger" id='userCountryError'></span>
    </div>
    <div class="form-group">
        <label><?php echo $this->lang->line('country')?></label>
        <select class="form-control" name="country_id">
            <?php

            for($i=0;$i<count($data['countries']);$i++ )
            {


                echo '<option value="'.$data['countries'][$i]['id'].'" ';
                //echo ($data['country_id']==$data['countries'][$i]['id']?'selected':'');
                echo ' >';
                echo isset($_SESSION['lang'])&&$_SESSION['lang']=='ar'?$data['countries'][$i]['name_ar']:$data['countries'][$i]['name'];
                echo  '</option>';
//            echo $option;
            }
            ?>
        </select>
        <span class="alert-danger" id='userCountryError'></span>
    </div>
    <button type="submit" class="btn btn-info" id="submit">
        <?php echo $this->lang->line('search')?>
    </button>
</form>
 <?php for ($i = 0; $i < count($data['jobs']); ++$i) { ?>

            <div class="tile">
                <img class="tile-image" alt="" src="<?php echo base_url().'images/job/'.$data['jobs'][$i]->image?>"/>

                <div class="recent_job">
                    <h3 class="tile-title"><?php echo $data['jobs'][$i]->title;?> </h3>
                    <h4 class="tile-subtitle">
                        <?php echo $this->lang->line('posted_at').' : '.
                            $data['jobs'][$i]->date; ?>
                    </h4>
                    <?php
                    $id=$data['jobs'][$i]->id;
                    $protocol=isset($_SERVER['HTTPS'])?'https://':'http://';
                    $domain=$_SERVER['HTTP_HOST'];
                    $url=$protocol.''.$domain.site_url('job/show').'?id='.$id.'';
                    $title='Jobs at '.$data['jobs'][$i]->company ;
                    ?>
                    <div class="social_jobs">
                        <a class="zocial twitter"  target="_blank"
                           href="http://twitter.com/home?status=<?php echo $title ?>+<?php echo $url ?>">

                        </a>
                        <a class="zocial facebook"  target="_blank"
                           href="http://www.facebook.com/share.php?u=<?php echo $url;?>&amp;title=<?php echo $title; ?>">
                        </a>
                        <a class="zocial linkedin"  target="_blank"
                           href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url?>&amp;title=<?php echo $title?>&amp;source=<?php echo $domain;?>">
                        </a>
                        <a class="zocial googleplus"  target="_blank"
                           href="https://plus.google.com/share?url=<?php echo $url; ?>">
                        </a>
                    </div>
                    <p><?php echo $data['jobs'][$i]->description; ?></p>
                    <h6>
                        <a class="btn btn-custom"
                           href="<?php echo site_url('job/show')?>?id=<?php echo $data['jobs'][$i]->id; ?>">
                            <b>read more</b>
                        </a>
                    </h6>
                </div>
            </div>
        <?php } ?>

    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo $data['pagination']; ?>
        </div>
    </div>

