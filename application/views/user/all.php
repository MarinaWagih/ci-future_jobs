<div class="row">
    <a href="<?php echo site_url('user/add')?>" class="btn btn-primary">
        Add User
    </a>
</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th>#</th>
            <th>user Name</th>
            <th>e-mail</th>
            <th>type</th>
            <th>specialty</th>
            <th>Operations</th>

        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($data['users']); ++$i) { ?>
            <tr>

                <td><?php echo $data['users'][$i]->id; ?></td>
                <td><?php echo $data['users'][$i]->name; ?></td>
                <td><?php echo $data['users'][$i]->email; ?></td>
                <td><?php echo $data['users'][$i]->type; ?></td>
                <td><?php echo $data['users'][$i]->type=='admin'?'Website Admin':
                               $data['users'][$i]->specialty; ?></td>
                <td>
                    <a href="<?php echo base_url('user/edit')?>?id=<?php echo $data['users'][$i]->id; ?>">
                        Edit
                    </a>
                    <a href="<?php echo site_url('user/delete')?>user/delete?id=<?php echo $data['users'][$i]->id; ?>">
                       Delete
                    </a>
                    <a href="<?php echo site_url('user/show')?>?id=<?php echo $data['users'][$i]->id; ?>">
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
