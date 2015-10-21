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
                    <?php echo $this->lang->line('years_of_experience')?>:
                </span>
        <?php echo $this->lang->line($data['years_of_experience']);?><br><br>
                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('salary_from')?> :
                </span>
        <?php echo $data['salary_from'];?><br><br>
                <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('salary_to')?> :
                </span>
        <?php echo $data['salary_to'];?><br><br>
                <span style="text-decoration: underline;">
                     <?php echo $this->lang->line('nationality')?> :
                 </span>
        <?php echo $_SESSION['lang']=='ar'?$data['country_data'][0]['name_ar']:$data['country_data'][0]['name'];?><br><br>
                 <span style="text-decoration: underline;">
                    <?php echo $this->lang->line('Number_needed')?> :
                 </span>

        <?php echo $data['Number_needed'];?><br>
        <hr>
        <span style="text-decoration: underline;">
             <?php echo $this->lang->line('contact_info')?>:
        </span>
        <hr>
            <span style="text-decoration: underline;">
                <?php echo $this->lang->line('name')?> :
            </span>

            <?php echo $data['contact_name'];?><br>
            <span style="text-decoration: underline;">
                <?php echo $this->lang->line('phone')?> :
            </span>

            <?php echo $data['contact_phone'];?><br>
            <span style="text-decoration: underline;">
                <?php echo $this->lang->line('mobile')?> :
            </span>

            <?php echo $data['contact_mobile'];?><br>
            <span style="text-decoration: underline;">
                <?php echo $this->lang->line('email')?> :
            </span>

            <?php echo $data['contact_email'];?><br>
            <span style="text-decoration: underline;">
                <?php echo $this->lang->line('fax')?> :
            </span>

            <?php echo $data['contact_fax'];?><br>

    </h3>
    <div class="pad25"></div>
    <div class="pad25"></div>
</div>