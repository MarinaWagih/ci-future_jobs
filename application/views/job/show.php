<div class="tile">
    <img class="tile-image center-block img-responsive" alt=""
         src="<?php echo base_url().'images/job/'.$data['image']?>"
        />

    <div class="recent_job">
        <h3 class="tile-title"><?php echo $data['title'];?> </h3>
        <h4 class="tile-subtitle">
            <?php echo $this->lang->line('posted_at').' : '.$data['date']; ?>
        </h4>
        <?php
        $id=$data['id'];
        $protocol=isset($_SERVER['HTTPS'])?'https://':'http://';
        $domain=$_SERVER['HTTP_HOST'];
        $url=$protocol.''.$domain.site_url('job/show').'?id='.$id.'';
        $title=$data['title'].' at '.$data['company'] ;
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
                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('desc')?>:
                </span>
                <?php echo $data['description'];?><br><br>
                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('requirement')?> :
                </span>
                <?php echo $data['requirements'];?><br><br>
                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('company')?> :
                </span>
                <?php echo $data['company'];?><br><br>
                <span style="text-decoration: underline;">
                     <?php echo $this->lang->line('country')?> :
                 </span>
                 <?php echo $_SESSION['lang']=='ar'?$data['country_data'][0]['name_ar']:$data['country_data'][0]['name'];?><br><br>
                 <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('category')?> :
                 </span>

                <?php echo $_SESSION['lang']=='ar'?$data['category_data'][0]['name_ar']:$data['category_data'][0]['name'];?><br>
            <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('number_of_applicant')?> :
                 </span>

                <?php echo count($data['applied_users']);?><br>
            </h3>
        </div>


    </div>
</div>
<?php
$flag=false;
foreach ($data['applied_users'] as $applicant)
{
    if($applicant->id==$this->session->userdata('logged_in')['id'])
    {
        $flag=true;
        break;
    }
}
?>
<?php
if(!$flag&&$this->session->userdata('logged_in')['type']=='employer'){
?>
    <div class="row">
    <a href="<?php echo site_url('job/apply').'?id='.$data['id']?>" class="btn btn-primary">
        <?php echo $this->lang->line('apply')?>
    </a>
    </div>
<?php
}?>
