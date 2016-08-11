

<?php $__env->startSection('content'); ?>
<div class="container">

    <h1>Edit Intro <?php echo e($intro->id); ?></h1>

    <?php echo Form::model($intro, [
        'method' => 'PATCH',
        'url' => ['/admin/intros', $intro->id],
        'class' => 'form-horizontal'
    ]); ?>


                <div class="form-group <?php echo e($errors->has('user_id') ? 'has-error' : ''); ?>">
                <?php echo Form::label('user_id', 'User Id', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::number('user_id', null, ['class' => 'form-control', 'required' => 'required']); ?>

                    <?php echo $errors->first('user_id', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                <?php echo Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::textarea('title', null, ['class' => 'form-control', 'required' => 'required']); ?>

                    <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('duration') ? 'has-error' : ''); ?>">
                <?php echo Form::label('duration', 'Duration', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::number('duration', null, ['class' => 'form-control', 'required' => 'required']); ?>

                    <?php echo $errors->first('duration', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            <?php echo Form::submit('Update', ['class' => 'btn btn-primary form-control']); ?>

        </div>
    </div>
    <?php echo Form::close(); ?>


    <?php if($errors->any()): ?>
        <ul class="alert alert-danger">
            <?php foreach($errors->all() as $error): ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>