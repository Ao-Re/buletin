<?php 
Session::check();
?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <title>Authors | Buletin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=1920">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">
    <?php include './navbar.php'; ?>
    <main class="flex-shrink-0 py-5" role="main">
        <div class="bg-info text-white">
            <div class="container" style="padding-top: 56px; padding-bottom: 64px">
                <h1 class="display-4 mt-lg-2">Meet the authors of <span class="text-monospace">buletin</span></h1>
                <p class="h5 font-weight-normal">Contributors behind this awesome project</p>
            </div>
        </div>
        <div class="container pt-3">
            <div class="card-columns">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laurentius Dominick L.</h4>
                        <p class="card-text"><i class="fab fa-github"></i><a href="https://github.com/nickylogan"
                                class="ml-2">nickylogan</a></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Nadya Felim B.</h4>
                        <p class="card-text"><i class="fab fa-github"></i><a href="https://github.com/Ao-Re"
                                class="ml-2">Ao-Re</a></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">James Adhitthana</h4>
                        <p class="card-text"><i class="fab fa-github"></i><a href="https://github.com/jamesadhitthana"
                                class="ml-2">jamesadhitthana</a></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Christopher Yefta</h4>
                        <p class="card-text"><i class="fab fa-github"></i><a href="https://github.com/ChrisYef"
                                class="ml-2">ChrisYef</a></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Barjuan Davis P.</h4>
                        <p class="card-text"><i class="fab fa-github"></i><a href="https://github.com/cokpsz"
                                class="ml-2">cokpsz</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include './footer.php'; ?>
</body>

</html>