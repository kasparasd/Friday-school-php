<div style="width: 50%; margin: 0 auto;">

  <div class="container mt-4 mb-4 p-3 d-flex justify-content-center align-items-center">
    <div class="card p-4">
      <div class=" image d-flex flex-column justify-content-center"> <button class="btn btn-secondary"> <img src="https://i.imgur.com/wvxPV9S.png" height="100" width="100" /></button>
      </div>
      <div class="d-flex flex-column justify-content-center align-items-center mb-3">
        <div class="name mt-3">Name: <?= $user->name ?></div>
        <div class="name mt-3">Lastname: <?= $user->lastname ?></div>
        <div class="name mt-3">Email: <?= $user->email ?></div>
        <div class="name mt-3">Role: <?= $user->role ?></div>
      </div>

      <div class="d-flex flex-column justify-content-center align-items-center">

        <div class="row col-8">

          <h3 class="text-uppercase text-center mb-2">Change user details</h3>

          <form action="<?= URL ?>updateDetails" method="post">
            <input hidden name="id" value="<?= $user->id ?>">
            <input hidden name="role" value="<?= $user->role ?>">
            <div class="form-floating mb-2">
              <input value="<?= $user->name ?>" name='name' type="name" class="form-control" placeholder="Name" />
              <label class="form-label" for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-2">
              <input value="<?= $user->lastname ?>" name='lastname' type="lastname" class="form-control" placeholder="Lastname" />
              <label class="form-label" for="floatingInput">Lastname</label>
            </div>
            <div class="form-floating mb-2">
              <input value="<?= $user->email ?>" name='email' type="email" class="form-control" placeholder="Email" />
              <label class="form-label" for="floatingInput">Email</label>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-primary btn-block btn-sm gradient-custom-4 text-body mt-2 mb-2">Update</button>
            </div>
            <?php if (isset($_SESSION['updateError'])) : ?>
              <div class="form-floating mb-2">
                <ul>
                  <?php foreach ($_SESSION['updateError'] as $errorMsg) : ?>
                    <li style="color: red;"><?= $errorMsg ?></li>
                  <?php endforeach ?>
                </ul>
              </div>
            <?php unset($_SESSION['updateError']);
            endif ?>
          </form>

          <h3 class="text-uppercase text-center mb-4">Change password</h3>

          <form action="<?= URL ?>updatePassword" method="post">
            <input hidden name="id" value="<?= $user->id ?>">
            <div class="form-floating mb-2">
              <input name='oldpassword' type="password" class="form-control" placeholder="Password" />
              <label class="form-label" for="floatingInput">Old password</label>
            </div>

            <div class="form-floating mb-2">
              <input name='newpassword' type="password" class="form-control" placeholder="Password" />
              <label class="form-label" for="floatingInput">New password</label>
            </div>
            <div class="form-floating mb-2">
              <input name='newpassword2' type="password" class="form-control" placeholder="Password" />
              <label class="form-label" for="floatingInput">Repeat new password</label>
            </div>

            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-primary btn-block btn-sm gradient-custom-4 text-body mt-2 mb-2">Update</button>
            </div>

          </form>
          <?php if (isset($_SESSION['changePasswordError'])) : ?>
            <ul>

              <?php foreach ($_SESSION['changePasswordError'] as $errorMsg) : ?>
                <li style="color: red;"><?= $errorMsg ?></li>
              <?php endforeach ?>
            </ul>
          <?php unset($_SESSION['changePasswordError']);
          endif ?>


          <h3 class="text-uppercase text-center mb-4">Delete this account</h3>

          <form action="<?= URL ?>deleteAccount" method="post">
            <input hidden name="id" value="<?= $user->id ?>">
            <div class="form-floating mb-2">
              <input name='password' type="password" class="form-control" placeholder="Password" />
              <label class="form-label" for="floatingInput">Password</label>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-primary btn-block btn-sm gradient-custom-4 text-body mt-2 mb-2">Delete account</button>
            </div>

          </form>
          <?php if (isset($_SESSION['deleteError'])) : ?>
            <ul>

              <?php foreach ($_SESSION['deleteError'] as $errorMsg) : ?>
                <li style="color: red;"><?= $errorMsg ?></li>
              <?php endforeach ?>
            </ul>
          <?php unset($_SESSION['deleteError']);
          endif ?>
        </div>
      </div>
    </div>
  </div>
</div>
