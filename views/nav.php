<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>">School</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($user) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>profile">Profile</a>
                    </li>
                <?php endif ?>
                <?php if ($user && $user->role == 'admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>createUser">Create new user</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>users">Show all users</a>
                    </li>
                <?php endif ?>
            </ul>
            <div class="d-flex">
                <?php if ($user) : ?>
                    <div class="me-3">Hello, <?= $user->name ?></div>
                    <form action="<?= URL ?>logout" method="post">
                        <button class="btn btn-outline-danger" type=" submit">
                            Logout
                        </button>
                    </form>
                <?php else : ?>
                    <a href="<?= URL ?>login" class="btn btn-outline-primary">Login</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>
<?php require ROOT . 'views/message.php' ?>