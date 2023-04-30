<div class="container-short">
    <form action="" method="POST" enctype="multipart/form-data">
        <?php if (isset($_SESSION['token'])) : ?>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" name="login-user" class="btn btn-primary">Login</button>
    </form>
</div>