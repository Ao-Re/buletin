<header>
    <nav class="navbar fixed-top navbar-expand navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-monospace" href="<?php url("/")?>">buletin</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <?php if(isset($_SESSION["id"])): ?>
                    <?php if(isset($index)): ?>
                    <button class="btn btn-info px-3 rounded-pill d-none d-md-inline trigger-post">Create post</button>
                    <button class="btn btn-info px-3 rounded-pill btn-sm d-inline d-md-none trigger-post" data-toggle="modal"
                        data-target="#postModal">Create post</button>
                    <?php else: ?>
                    <a class="btn btn-info px-3 rounded-pill d-none d-md-inline" href="<?php url("/")?>">Create post</a>
                    <a class="btn btn-info px-3 rounded-pill btn-sm d-inline d-md-none" href="<?php url("/")?>">Create post</a>
                    <?php endif; ?>
                    <?php endif; ?>
                </li>
            </ul>
            <?php if(isset($_SESSION["id"])): ?>
            <span class="navbar-text text-light">Hello, <?php e($_SESSION["name"])?></span>
            <form action="<?php url("/logout") ?>" method="post">
                <button class="nav-link btn btn-link text-white" type="submit">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
            <?php else: ?>
            <a class="nav-link btn btn-link btn-sm text-light" href="<?php url("/login") ?>">Log in</a>
            <a class="nav-link btn btn-info btn-sm rounded-pill" href="<?php url("/register") ?>">Register</a>
            <?php endif; ?>
        </div>
    </nav>
</header>