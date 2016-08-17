

<?php $__env->startSection('content'); ?>
<div class="container">

    <h1>Intro <?php echo e($intro->id); ?>

        <a href="<?php echo e(url('admin/intros/' . $intro->id . '/edit')); ?>" class="btn btn-primary btn-xs" title="Edit Intro"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        <?php echo Form::open([
            'method'=>'DELETE',
            'url' => ['admin/intros', $intro->id],
            'style' => 'display:inline'
        ]); ?>

            <?php echo Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Intro',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));; ?>

        <?php echo Form::close(); ?>

    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td><?php echo e($intro->id); ?></td>
                </tr>
                <tr><th> User Id </th><td> <?php echo e($intro->user_id); ?> </td></tr><tr><th> Title </th><td> <?php echo e($intro->title); ?> </td></tr><tr><th> Duration </th><td> <?php echo e($intro->duration); ?> </td></tr>
            </tbody>
        </table>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>