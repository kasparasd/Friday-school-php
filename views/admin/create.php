        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-4">Create new user</h2>

                                <form action="<?= URL ?>store" method="post">
                                    <div class="form-floating mb-2">
                                        <input value="<?= isset($_SESSION['error']) ? $_SESSION['data']['name'] : '' ?>" name='name' type="name" class="form-control form-control-lg" placeholder="Name" />
                                        <label class="form-label" for="floatingInput">Name</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input value="<?= isset($_SESSION['error']) ? $_SESSION['data']['lastname'] : '' ?>" name='lastname' type="lastname" class="form-control form-control-lg" placeholder="Lastname" />
                                        <label class="form-label" for="floatingInput">Lastname</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input value="<?= isset($_SESSION['error']) ? $_SESSION['data']['email'] : '' ?>" name='email' type="email" class="form-control form-control-lg" placeholder="Email" />
                                        <label class="form-label" for="floatingInput">Email</label>
                                    </div>

                                    <div class="form-floating mb-2">
                                        <input name='password' type="password" class="form-control form-control-lg" placeholder="Password" />
                                        <label class="form-label" for="floatingInput">Password</label>
                                    </div>

                                    <div class="form-floating mb-2">
                                        <input name='password2' type="password" class="form-control form-control-lg" placeholder="Password" />
                                        <label class="form-label" for="floatingInput">Repeat password</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg gradient-custom-4 text-body mt-5">Register</button>
                                    </div>

                                </form>
                                <?php if (isset($_SESSION['error'])) : ?>
                                    <ul>

                                        <?php foreach ($_SESSION['error'] as $errorMsg) : ?>
                                            <li style="color: red;"><?= $errorMsg ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                <?php unset($_SESSION['error']);
                                endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

