<?php $__env->startSection('content'); ?>
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        <div class="container-sm">
            <div class="card">
                <div class="card-header">
                    <p style="font-family: 'Berlin Sans FB';font-size: 24px">Edit Rules Name</p>
                    <form method="post" action="<?php echo e(route('rules_update',$data[0]->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">C_Name</label>
                                <input type="text" value="<?php echo e($data[0]->cname); ?>" class="form-control" id="edit" name="rname" placeholder="Enter  C_name">
                            </div> <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">C_Description</label>
                                <textarea class="ckeditor form-control" placeholder="Enter C_Description" value="<?php echo e($data[0]->cdescription); ?>" name="rdescription"></textarea>
                            </div>

                            <br>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="data">Submit</button>
                            </div>

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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\strome\high_court_book\resources\views/Rules/RulesEdit.blade.php ENDPATH**/ ?>