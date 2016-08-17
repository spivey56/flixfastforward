<?php $__env->startSection('content'); ?>
    <?php if(isset($intros)): ?>
    <div class="container">

        <h1>Intros <a href="<?php echo e(url('/admin/intros/create')); ?>" class="btn btn-primary btn-xs"
                      title="Add New Intro"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th> User Id</th>
                    <th> Title</th>
                    <th> Start Time</th>
                    <th> Duration</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php /* */$x=0;/* */ ?>
                    <?php foreach($intros as $item): ?>
                        <?php /* */$x++;/* */ ?>
                        <tr>
                            <td><?php echo e($x); ?></td>
                            <td><?php echo e($item->user_id); ?></td>
                            <td><?php echo e($item->title); ?></td>
                            <td><?php echo e($item->start_time); ?></td>
                            <td><?php echo e($item->duration); ?></td>
                            <td>
                                <a href="<?php echo e(url('/admin/intros/' . $item->id)); ?>" class="btn btn-success btn-xs"
                                   title="View Intro"><span class="glyphicon glyphicon-eye-open"
                                                            aria-hidden="true"/></a>
                                <a href="<?php echo e(url('/admin/intros/' . $item->id . '/edit')); ?>"
                                   class="btn btn-primary btn-xs" title="Edit Intro"><span
                                            class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                <?php echo Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/intros', $item->id],
                                    'style' => 'display:inline'
                                ]); ?>

                                <?php echo Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Intro" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Intro',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ));; ?>

                                <?php echo Form::close(); ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="pagination-wrapper"> <?php echo $intros->render(); ?> </div>
        </div>

    </div>

        <?php else: ?>
        <div style="text-align: center" class="alert-warning">
            No intros created yet!
        </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>