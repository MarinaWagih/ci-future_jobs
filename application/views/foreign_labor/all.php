<div class="row">
    <a href="<?php echo site_url('foreign_labor/add')?>" class="btn btn-primary">
        Add foreign labor
    </a>
</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th>#</th>
            <th>Number needed</th>
            <th>years of experience</th>
            <th>Operations</th>

        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($data['foreign_labors']); ++$i) { ?>
            <tr>

                <td><?php echo $data['foreign_labors'][$i]->id; ?></td>
                <td><?php echo $data['foreign_labors'][$i]->Number_needed; ?></td>
                <td><?php echo $data['foreign_labors'][$i]->years_of_experience; ?></td>
                <td>
                    <a href="<?php echo base_url('foreign_labor/edit')?>?id=<?php echo $data['foreign_labors'][$i]->id; ?>">
                        Edit
                    </a>
                    <a href="<?php echo site_url('foreign_labor/delete')?>?id=<?php echo $data['foreign_labors'][$i]->id; ?>">
                       Delete
                    </a>
                    <a href="<?php echo site_url('foreign_labor/show')?>?id=<?php echo $data['foreign_labors'][$i]->id; ?>">
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
