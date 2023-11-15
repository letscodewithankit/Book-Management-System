<?php $__env->startSection('content'); ?>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <form method="post" action="<?php echo e(route('hello')); ?>" >
        <?php echo csrf_field(); ?>
        <div class="container" style="margin-left: 8%;margin-top: 2%">
        <div class="card card-default">
            <div class="card-header">

                <h3 class="card-title">High Court Rules</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->

        <div class="card-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select book name</label>
                        <select name="book_id" id="book_select"  class="form-control" >
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
                        <select name="chapter_id" id="chapter_data"  class="form-control" >

                        </select>
                    </div>

                </div>
            </div><br>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select heading name</label>
                        <select name="heading_id" id="heading_data"  class="form-control" >

                        </select>
                    </div>

                </div>
            </div><br>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select subheading name</label>
                        <select name="subheading_id" id="subheading_data"  class="form-control" >

                        </select>
                    </div>

                </div>
            </div><br>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select subsubheading name</label>
                        <select name="subsubheading_id" id="subsubheading_data"  class="form-control" >

                        </select>
                    </div>

                </div>
            </div><br>

            <br>

            <div class="card-footer">
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
            <!-- /.card -->
        </div>
        </div>
        <br>
        <br>
        <div class="container" style="margin-left: 8%;">
        <div class="card card-default">
            <div class="card-header">

                <div id="main_data"></div>

            </div>
        </div>
        </div>
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
                // console.log(ide);

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
                // console.log(idee);

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

        <script>
            document.querySelector('#subheading_data').onchange = function() {
                var ideee = parseInt(document.getElementById('subheading_data').value);
                console.log(ideee);

                $.ajax({
                    url:"<?php echo e(url('mainsubsubheading/api/call')); ?>",
                    type:"POST",
                    data: {
                        subheading_id:ideee,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    dataType: 'json',


                    success:function (result) {
                        console.log(result);
                        $('#subsubheading_data').html('<option disabled selected value="">---Select SubSubHeading---</option>');
                        $.each(result, function (key, value) {
                            $("#subsubheading_data").append('<option id="subsubheading_id" value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }

                });


            }
        </script>




































    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\high_court_projects\high_court_book\resources\views/Dashboard.blade.php ENDPATH**/ ?>