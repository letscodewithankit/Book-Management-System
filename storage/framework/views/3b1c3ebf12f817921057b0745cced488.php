<?php $__env->startSection('content'); ?>
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        <div class="container-sm">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">SubSubHeading Table</h3>
                            <a class="btn btn-primary" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalLoginForm"   style="margin-left: 80%">Add SubSubHeading</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SubSubHeading_id</th>
                                    <th>SubHeading_id</th>
                                    <th>Title</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($abc->id); ?></td>
                                        <td><?php echo e($abc->subheading_id); ?></td>
                                        <td><?php echo e($abc->title); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('subsubheading_edit',$abc->id)); ?>" class=" btn btn-dark" >Edit</a>

                                            <form method="POST" action="<?php echo e(route('Subsubheading.delete', $abc->id)); ?>" style="display: inline">
                                                <?php echo csrf_field(); ?>
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"  title='Delete'>Delete</button>
                                            </form>
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
                                            <h4 class="modal-title w-100 font-weight-bold">Add SubSubheading</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body mx-3">

                                            <form method="post" action="<?php echo e(route('subsubheading_save')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select book name</label>
                                                                <select name="book_id" id="book_select"  class="form-control" required>
                                                                    <option disabled="disabled" selected="selected">----select----</option>
                                                                    <?php $__currentLoopData = $book; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select heading name</label>
                                                                <select name="heading_id" id="heading_data"  class="form-control" required>

                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select subheading name</label>
                                                                <select name="subheading_id" id="subheading_data"  class="form-control" required>

                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">SubSubHeading Name</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="SubSubHeading_name" placeholder="Enter SubSubHeading name">
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

    <script>
        document.querySelector('#chapter_data').onchange = function() {
            var ide = parseInt(document.getElementById('chapter_data').value);
            console.log(ide);

            $.ajax({
                url:"<?php echo e(url('subheading/api/call')); ?>",
                type:"POST",
                data: {
                    chapter_id:ide,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                dataType: 'json',
                success:function (result) {

                    $('#heading_data').html('<option disabled selected value="">---Select Heading---</option>');
                    $.each(result, function (key, value) {
                        $("#heading_data").append('<option id="heading_id" value="' + value
                            .id + '">' + value.title + '</option>');
                    });
                }

            });


        }
    </script>

    <script>
        document.querySelector('#heading_data').onchange = function() {
            var idee = parseInt(document.getElementById('heading_data').value);
            console.log(idee);

            $.ajax({
                url:"<?php echo e(url('subsubheading/api/call')); ?>",
                type:"POST",
                data: {
                    heading_id:idee,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                dataType: 'json',
                success:function (result) {

                    $('#subheading_data').html('<option disabled selected value="">---Select Heading---</option>');
                    $.each(result, function (key, value) {
                        $("#subheading_data").append('<option id="subheading_id" value="' + value
                            .id + '">' + value.title + '</option>');
                    });
                }

            });


        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\strome\high_court_book\resources\views/SubSubHeading/SubSubHeadingView.blade.php ENDPATH**/ ?>