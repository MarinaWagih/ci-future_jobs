<div class="row">
    <a href="<?php echo site_url('advertisement/add')?>" class="btn btn-primary">
        Add Advertisement
    </a>
</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th>#</th>
            <th>Image</th>
            <th>Rank</th>
            <th>Column</th>
            <th>Date</th>
            <th>Operations</th>

        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($data['advertisements']); ++$i) { ?>
            <tr>

                <td><?php echo $data['advertisements'][$i]->id; ?></td>
                <td>
                    <img style="width: 50px;height: 50px;"
                         src="<?php echo base_url().'images/adv/'.
                             $data['advertisements'][$i]->image;?>">
                </td>
                <td><?php echo $data['advertisements'][$i]->rank; ?></td>
                <td><?php echo $data['advertisements'][$i]->direction; ?></td>
                <td><?php echo $data['advertisements'][$i]->date; ?></td>
                <td>
                    <a href="<?php echo site_url('advertisement/edit')?>?id=<?php echo $data['advertisements'][$i]->id; ?>">
                        Edit
                    </a>
                    <a href="<?php echo site_url('advertisement/delete')?>?id=<?php echo $data['advertisements'][$i]->id; ?>">
                       Delete
                    </a>
                    <a href="<?php echo site_url('advertisement/show')?>?id=<?php echo $data['advertisements'][$i]->id; ?>">
                        Show
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo $data['pagination']; ?>
        </div>
    </div>
</div>
