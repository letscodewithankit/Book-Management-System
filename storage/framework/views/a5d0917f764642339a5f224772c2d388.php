<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>




</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a style="font-family: 'Arial Narrow';font-size: 30px" class="navbar-brand" href="javascript:void(0)">HIGH COURT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('booklist')); ?>">Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('chapterlist')); ?>">Chapter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('headinglist')); ?>">Heading</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('subheadinglist')); ?>">SubHeading</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('subsubheadinglist')); ?>">SubSubHeading</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('ruleslist')); ?>">Rules</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search">
                <button class="btn btn-primary" type="button">Search</button>
            </form>
        </div>
    </div>
</nav>

<?php echo $__env->yieldContent('content'); ?>

</body>
</html>


<?php /**PATH F:\strome\high_court_book\resources\views/layouts/app.blade.php ENDPATH**/ ?>