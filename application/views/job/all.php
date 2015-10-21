<div class="row">
    <a href="<?php echo site_url('job/add')?>" class="btn btn-primary">
        Add Job
    </a>
</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th>#</th>
            <th>date</th>
            <th>category</th>
            <th>country</th>
            <th>company</th>
            <th>Operations</th>

        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($data['jobs']); ++$i) { ?>
            <tr>

                <td><?php echo $data['jobs'][$i]->id; ?></td>
                <td><?php echo $data['jobs'][$i]->date; ?></td>
                <td><?php echo $data['jobs'][$i]->category_name; ?>/<?php echo $data['jobs'][$i]->category_name_ar; ?></td>
                <td><?php echo $data['jobs'][$i]->name; ?>/<?php echo $data['jobs'][$i]->name_ar; ?></td>
                <td><?php echo $data['jobs'][$i]->company; ?></td>
                <td>
                    <a href="<?php echo base_url('job/edit')?>?id=<?php echo $data['jobs'][$i]->id; ?>">
                        Edit
                    </a>
                    <a href="<?php echo site_url('job/delete')?>?id=<?php echo $data['jobs'][$i]->id; ?>">
                       Delete
                    </a>
                    <a href="<?php echo site_url('job/show')?>?id=<?php echo $data['jobs'][$i]->id; ?>">
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
