<?php $__env->startSection('content'); ?>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <form>
        <?php echo csrf_field(); ?>
        <!-- Search form -->
        <div class="container" style="margin-top:5% ">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>HIGH COURT RULES</h3>
                    </div>

                </div>
            </div><!-- /.container-fluid -->

            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h5 style="display: inline">Book</h5>
                        <select class="select form-control-lg"  class="width" name="book_id" id="book_select" class="form-control" style="display: inline;margin:10px;margin-left: 11.6%;width: 350px" >
                            <option disabled selected>-----Select-----</option>
                            <?php $__currentLoopData = $book; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abc3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($abc3->id); ?>"><?php echo e($abc3->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select><br>

                        <h5 style="display: inline">Chapter's</h5>
                        <select class="select form-control-lg" class="width" name="chapter_id" id="chapter_data"   class="form-control" style="display: inline;margin:10px;margin-left: 8%;width: 350px" >
                            <option disabled selected>-----Select-----</option>

                        </select><br>

                        <h5 style="display: inline">Heading</h5>
                        <select class="select form-control-lg" class="width" name="heading_id" id="heading_data" class="form-control" style="display: inline;margin:10px;margin-left: 8.8%;width: 350px">
                            <option disabled selected>-----Select-----</option>

                        </select><br>

                        <h5 style="display: inline">Sub Heading1</h5>
                        <select class="select form-control-lg" placeholder="please" class="width" name="subheading_id" id="subheading_data"  class="form-control"  style="display: inline;margin:10px;margin-left: 4%;width: 350px">
                            <option disabled selected>-----Select-----</option>

                        </select><br>
                        <div class="row">
                            <div class="form-group">
                                <h5 style="display: inline" >Sub Heading2</h5>
                                <select class="select form-control-lg"  class="width" name="subsubheading_id" id="subsubheading_data"  class="form-control" style="display: inline;margin:10px;margin-left: 3.8%;width: 350px"/>
                                <option disabled selected>-----Select-----</option>

                                </select><br>
                            </div>
                        </div>
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

        </div>
        </div>
        </div>

        </div>








    </form>
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

    <script>
        $("form").submit(function (e) {
            e.preventDefault(e);
            let book_id = parseInt(document.getElementById('book_select').value);
            let chapter_id = parseInt(document.getElementById('chapter_data').value);

            console.log(chapter_id);

            $.ajax({
                url: "<?php echo e(url('datamain/api/call')); ?>",
                type: "POST",
                data:
                    {
                        chapter_id: chapter_id,
                        book_id: book_id,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                dataType: 'json',


                success: function (result) {
                    console.log(result);
                    // document.getElementById('#main_data').innerHTML = result;
                }


            });

        });



    </script>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\strome\high_court_book\resources\views/Dashboard.blade.php ENDPATH**/ ?>