<?php
Session::check();
require_once "../form_handler/do_create_post.php";
$index = true;
$err  = isset($_GET['e']) ? json_decode(base64_decode($_GET['e'])) : null;
$prev = isset($_GET['p']) ? json_decode(base64_decode($_GET['p'])) : null;
$db_conn = new Buletin_DBConnection();
$posts = $db_conn->retrieve_posts();
?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <title>Buletin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=1920">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php url("/css/index.css") ?>">
</head>

<body class="d-flex flex-column h-100" style="background-color: #e6ecf0">
    <?php include './navbar.php'; ?>
    <main class="mt-2 flex-shrink-0 pb-5" role="main" style="padding-top: 56px">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-3 pr-2">
                    <div class="card p-0 border-0 rounded-0">
                        <?php if(isset($_SESSION["id"])) : ?>
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-3">
                                    <div class="acronym acronym-lg bg-secondary">
                                        <span
                                            class="text-white font-weight-light h5 m-0"><?php e($_SESSION['acronym']) ?></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h5 class="card-title mb-1"><?php e($_SESSION['name']) ?></h5>
                                    <small class="card-text text-secondary">@<?php e($_SESSION['username'])?></small>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-1">Welcome to buletin!</h5>
                            <small class="card-text text-secondary"><a href="<?php url("/login") ?>">Log in</a> or <a
                                    href="<?php url("/register") ?>">Register</a> to post something</small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 px-2">
                    <div class="card p-0 border-0 rounded-0">
                        <?php if(isset($_SESSION["id"])): ?>
                        <div class="card-body" style="background-color: #f5f8f9">
                            <form action="" method="post" id="post-form">
                                <div class="row no-gutters">
                                    <div class="col-1 text-right">
                                        <div class="acronym acronym-sm bg-secondary">
                                            <span class="text-white m-0"><?php e($_SESSION['acronym']) ?></span>
                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <div class="form-group">
                                            <textarea
                                                class="form-control form-control-sm auto-expand <?php if(isset($err) && isset($err->content)) echo "is-invalid"; ?>"
                                                name="content" id="content" rows="1"
                                                placeholder="What's happening today?"><?php if(isset($prev) && isset($prev->content)) e($prev->content) ?></textarea>
                                            <div class="invalid-feedback" id="content-invalid">
                                                <?php if(isset($err) && isset($err->content)) e($err->content); ?>
                                            </div>
                                        </div>
                                        <div class="mt-3 <?php if(!isset($err)) echo "d-none"?>" id="post-footer">
                                            <button type="submit" id="post-submit"
                                                class="btn btn-info btn-sm rounded-pill float-right py-2 px-3" disabled>
                                                Submit post
                                            </button>
                                            <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY ?>" data-callback="postCaptcha">
                                            </div>
                                            <small
                                                class="text-danger"><?php if(isset($err) && isset($err->captcha)) e($err->captcha); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php endif; ?>
                        <ul class="list-group list-group-flush">
                            <?php if (!empty($posts)):?>
                            <?php foreach ($posts as $post): ?>
                            <li class="list-group-item">
                                <?php 
                                $names = explode(" ", $post["name"]);
                                $acronym = strtoupper($names[0][0].end($names)[0]);
                                ?>
                                <div class="row">
                                    <div class="col-1">
                                        <div class="acronym acronym-sm bg-secondary">
                                            <span class="text-white m-0"><?php e($acronym) ?></span>
                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <strong><?php e($post["name"])?></strong><small
                                            class="text-muted ml-1">@<?php e($post["username"])?> &middot;
                                            <?php e($post["timestamp"])?></small>
                                        <p>
                                            <?php e($post["content"]) ?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <?php elseif(isset($_SESSION["id"])): ?>
                            <li class="list-group-item text-center p-5">
                                <span class="h5">Everything is quiet...</span>
                                <small class="d-block mt-2">Make some noise by <a href="#" data-toggle="modal"
                                        data-target="#postModal">creating a post</a></small>
                            </li>
                            <?php else: ?>
                            <li class="list-group-item text-center p-5">
                                <span class="h5">There's nothing?</span>
                                <small class="d-block mt-2"><a href="<?php url("/login") ?>">Log in</a> or <a
                                        href="<?php url("/register") ?>">register</a> to be the first to post</small>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include './footer.php'; ?>
    <script src="./script/index.js"></script>
</body>

</html>