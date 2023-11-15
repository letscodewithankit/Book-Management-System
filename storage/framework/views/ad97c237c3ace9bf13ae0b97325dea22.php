<?php $__env->startSection('content'); ?>
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        <div class="container-sm">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Heading Table</h3>
                            <a class="btn btn-primary" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalLoginForm"   style="margin-left: 80%">Add Heading</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Heading_id</th>
                                    <th>Chapter_id</th>
                                    <th>Title</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($abc->id); ?></td>
                                        <td><?php echo e($abc->chapter_id); ?></td>
                                        <td><?php echo e($abc->title); ?></td>
                                        <td>
                                            <a class=" btn btn-dark">Edit</a>
                                            <a class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </tbody>

                            </table>



                            <!-- Modal for add book -->
                            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title w-100 font-weight-bold">Add book</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body mx-3">

                                            <form method="post" action="<?php echo e(route('heading_save')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select book name</label>
                                                                <select name="book_id" id="book_select"  class="form-control" required>
                                                                    <option disabled="disabled" selected="selected">----select----</option>
                                                                    <?php $__currentLoopData = $data3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($abc3->id); ?>"><?php echo e($abc3->title); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select Chapter name</label>
                                                                <select name="chapter_id" id="chapter_data"  class="form-control" required>



                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Heading name</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="Heading_name" placeholder="Enter Heading name">
                                                    </div>

                                                    <br>

                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </section>

    <script>
       document.querySelector('#book_select').onchange = function(){
       var id=parseInt(document.getElementById('book_select').value);

       $.ajax({
           url:"<?php echo e(url('heading/api/call')); ?>",
           type:"POST",
           data: {
               book_id:id,
               _token: '<?php echo e(csrf_token()); ?>'
           },
           dataType: 'json',
           success:function (result) {

               $('#chapter_data').html('<option disabled selected value="">---Select Chapter---</option>');
               $.each(result, function (key, value) {
                   $("#chapter_data").append('<option id="chapter_id" value="' + value
                       .id + '">' + value.title + '</option>');
               });
           }

       });


        }

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\high_court_projects\high_court_book\resources\views/Heading/HeadingView.blade.php ENDPATH**/ ?>