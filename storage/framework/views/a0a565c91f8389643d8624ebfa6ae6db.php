<?php $__env->startSection('content'); ?>
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        <div class="container-sm">
            <div class="card">
                <div class="card-header">
                    <p style="font-family: 'Berlin Sans FB';font-size: 24px">Edit Sub Heading Name</p>
                    <form method="post" action="<?php echo e(route('subheading_update',$data[0]->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Heading Name</label>
                                <input type="text" value="<?php echo e($data[0]->title); ?>" class="form-control" id="edit" name="sub_name" placeholder="Enter SubHeading name">
                            </div>

                            <br>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="data">Submit</button>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </form>


                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        </div>
        <!-- /.container-fluid -->


    </section>
    


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    





    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\strome\high_court_book\resources\views/Subheading/SubheadingEdit.blade.php ENDPATH**/ ?>