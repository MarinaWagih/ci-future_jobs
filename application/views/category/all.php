<div class="row">
    <a href="<?php echo site_url('category/add')?>" class="btn btn-primary">
        Add category
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
        <?php for ($i = 0; $i < count($data['categories']); ++$i) { ?>
            <tr>

                <td><?php echo $data['categories'][$i]->id; ?></td>
                <td><?php echo $data['categories'][$i]->name; ?></td>
                <td><?php echo $data['categories'][$i]->name_ar; ?></td>
                <td>
                    <a href="<?php echo base_url('category/edit')?>?id=<?php echo $data['categories'][$i]->id; ?>">
                        Edit
                    </a>
                    <a href="<?php echo site_url('category/delete')?>?id=<?php echo $data['categories'][$i]->id; ?>">
                       Delete
                    </a>
                    <a href="<?php echo site_url('category/show')?>?id=<?php echo $data['categories'][$i]->id; ?>">
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
