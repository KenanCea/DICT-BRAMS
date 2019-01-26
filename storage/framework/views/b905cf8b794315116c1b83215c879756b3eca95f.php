<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>BRAMS</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <div id="app">
        
        <main>
            <?php echo $__env->yieldContent('content'); ?>

        </main>



    </div>
    
    <script src="/js/app.js"></script>
</body>

</html>
