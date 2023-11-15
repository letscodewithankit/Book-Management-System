<?php $__env->startSection('content'); ?>
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        <div class="container-sm">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Book Table</h3>
                            <a class="btn btn-primary" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalLoginForm"   style="margin-left: 80%">Add Book</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Book_id</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td name="id" class="id"><?php echo e($abc->id); ?></td>
                                        <td name="title" id="title"><?php echo e($abc->title); ?></td>
                                        <td>
                                            <a class=" btn btn-dark" data-bs-toggle="modal"  id="submit" data-bs-target="#modalLoginFormedit">Edit</a>
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

                                            <form method="post" action="<?php echo e(route('book_save')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Book Name</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="b_name" placeholder="Enter book name">
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


                            <!-- Modal for edit book -->
                            <div class="modal fade" id="modalLoginFormedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title w-100 font-weight-bold">Edit book</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body mx-3">

                                            <form method="post" action="<?php echo e(route('book_save')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Book Name</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="b_name"  placeholder="Enter book name">
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

        <script type="text/javascript">
            $("#submit").click(function () {
                var id= $("#id").val();
                var name = $("#title").val();
                console.log(id);
            });
        </script>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\high_court_projects\high_court_book\resources\views/BookView.blade.php ENDPATH**/ ?>