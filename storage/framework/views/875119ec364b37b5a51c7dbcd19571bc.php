<?php $__env->startSection('content'); ?>
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        <?php if(session('error')): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'you are not allowed to add this chapter name!',
                })
            </script>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <script>
                Swal.fire(
                    'Good job!',
                    'Chapter name add successfully!',
                    'success'
                )
            </script>
            <?php endif; ?>
        <div class="container-sm">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div style="display: inline" class="card-header">
                            <h3 class="card-title">Chapter Table</h3>
                            <div style="margin-left: 60%">
                            <a style="display: inline" class="btn btn-primary" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalLoginForm"   style="margin-left: 80%">Add Chapter</a>
                            <a style="display: inline" class="btn btn-success" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalLoginForm_edit_data"   style="margin-left: 80%">Smartly edit</a>
                            <a style="display: inline" class="btn btn-danger" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalLoginForm_delete_data"   style="margin-left: 80%">Smartly delete</a>
                            </div><br>
                            </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Chapter_id</th>
                                    <th>Book_id</th>
                                    <th>Title</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($abc->id); ?></td>
                                        <td><?php echo e($abc->book_id); ?></td>
                                        <td><?php echo e($abc->title); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </tbody>

                            </table>

                            <div class="d-flex justify-content-center">
                                <?php echo $data->links(); ?>

                            </div>



                            <!-- Modal for add chapter -->
                            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div style="background-color: deepskyblue" class="modal-header text-center">
                                            <h4 class="modal-title w-100 font-weight-bold">Add chapter</h4>
                                            <button style="background-color: deepskyblue" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span style="background-color: deepskyblue" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body mx-3">

                                            <form method="post" action="<?php echo e(route('chapter_save')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select book name</label>
                                                                <select name="book_id" id="theater_select"  class="form-control" required>
                                                                    <option disabled="disabled" selected="selected">----select----</option>
                                                                    <?php $__currentLoopData = $data2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($abc2->id); ?>"><?php echo e($abc2->title); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Chapter name</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="chapter_name" placeholder="Enter chapter name">
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



                            <!-- modal for edit data smartly     -->
                            <div class="modal fade" id="modalLoginForm_edit_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center" style="background-color:lightgreen">
                                            <h4 class="modal-title w-100 font-weight-bold">Smartly edit chapter data</h4>
                                            <button type="button" style="background-color:lightgreen" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" style="background-color:lightgreen">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body mx-3">

                                            <form method="post" action="<?php echo e(route('chapter_edit')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select book name</label>
                                                                <select name="book_id" id="book_select"  class="form-control" required>
                                                                    <option disabled="disabled" selected="selected">----select----</option>
                                                                    <?php $__currentLoopData = $data2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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


                                                    <br>

                                                    <div style="background-color: white" class="card-footer">

                                                        <button type="submit" class="btn btn-success">Submit</button>

                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end code for smartly edit -->


                            <!-- modal for delete data smartly  -->
                            <div class="modal fade" id="modalLoginForm_delete_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_delete_data"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center" style="background-color:palevioletred">
                                            <h4 class="modal-title w-100 font-weight-bold">Smartly delete chapter data</h4>
                                            <button type="button" style="background-color:palevioletred" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" style="background-color:palevioletred">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body mx-3">

                                            <form method="post" action="<?php echo e(route('chapter.delete')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select book name</label>
                                                                <select name="book_id2" id="book_select2"  class="form-control" required>
                                                                    <option disabled="disabled" selected="selected">----select----</option>
                                                                    <?php $__currentLoopData = $data2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                                <select name="chapter_id2" id="chapter_data2"  class="form-control" required>



                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>


                                                    <br>

                                                    <div style="background-color: white" class="card-footer">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"  title='Delete'>Delete</button>

                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end code for smartly delete -->



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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script>
        document.querySelector('#book_select').onchange = function()
        {
            const id = parseInt(document.getElementById('book_select').value);

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

    <!-- this script for delete section -->
    <script>
        document.querySelector('#book_select2').onchange = function()
        {
            const id = parseInt(document.getElementById('book_select2').value);

            $.ajax({
                url:"<?php echo e(url('heading/api/call')); ?>",
                type:"POST",
                data: {
                    book_id:id,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                dataType: 'json',
                success:function (result) {

                    $('#chapter_data2').html('<option disabled selected value="">---Select Chapter---</option>');
                    $.each(result, function (key, value) {
                        $("#chapter_data2").append('<option id="chapter_id2" value="' + value
                            .id + '">' + value.title + '</option>');
                    });

                }

            });
        }



    </script>


    <script >

        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "Make sure that if you delete chapter the whole chapter data will be deleted, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\high_court_projects\high_court_book_main\resources\views/Chapter/ChapterView.blade.php ENDPATH**/ ?>