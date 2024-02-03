<?php if (!$user) : ?>
    <div class="h-100 d-flex align-items-center justify-content-center">
        <h1>Please log in to your profile: <a href="login">Log in</a> </h1>
    </div>

<?php else : ?>
    <div class="h-100 d-flex align-items-center justify-content-center">
        <h1>You are logged in as: <?= $user->name ?> <?= $user->lastname ?></h1>
    </div>
<?php endif ?>