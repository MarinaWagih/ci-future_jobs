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
          <h3>
            <?php echo $this->lang->line('name')?> : <?php echo $data['name'];?><br><br>
            <?php echo $this->lang->line('email')?> : <?php echo $data['email'];?><br><br>
            <?php echo $this->lang->line('mobile')?> : <?php echo $data['mobile'];?><br><br>
            <?php echo $this->lang->line('phone')?> : <?php echo $data['phone'];?><br><br>
            <?php echo $this->lang->line('fax')?> : <?php echo $data['fax'];?><br><br>
            <?php echo $this->lang->line('years_of_experience')?> : <?php echo $data['years_of_experience'];?><br><br>
            <?php echo $this->lang->line('social_status')?> : <?php echo$this->lang->line( $data['social_status']);?><br><br>
            <?php echo $this->lang->line('nationality')?> : <?php echo $_SESSION['lang']=='ar'?$data['nationality_data'][0]['name_ar']:$data['nationality_data'][0]['name'];?><br><br>
            <?php echo $this->lang->line('place_of_residence')?> : <?php echo  $_SESSION['lang']=='ar'?$data['place_of_residence_data'][0]['name_ar']:$data['place_of_residence_data'][0]['name'];?><br><br>
            <?php echo $this->lang->line('cv')?> : <a target="_blank" href="<?php echo  base_url().'files/cv/'.$data['cv'];?>"><?php echo $data['name'];?></a>
           </h3>
    </div>
<hr>
<h1><?php echo $this->lang->line('applied_jobs')?></h1>
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