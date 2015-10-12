<div class="row">
    <a href="<?php echo site_url('country/add')?>" class="btn btn-primary">
        Add company
    </a>
</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th>#</th>
            <th>Name</th>
            <th>arabic name</th>
            <th>Operations</th>

        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($data['countries']); ++$i) { ?>
            <tr>

                <td><?php echo $data['countries'][$i]->id; ?></td>
                <td><?php echo $data['countries'][$i]->name; ?></td>
                <td><?php echo $data['countries'][$i]->name_ar; ?></td>
                <td>
                    <a href="<?php echo base_url('country/edit')?>?id=<?php echo $data['countries'][$i]->id; ?>">
                        Edit
                    </a>
                    <a href="<?php echo site_url('country/delete')?>?id=<?php echo $data['countries'][$i]->id; ?>">
                       Delete
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
