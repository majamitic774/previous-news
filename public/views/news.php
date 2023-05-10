<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tvoja stranica</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e6e6fa;
        }
    </style>

</head>

<!-- category -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <?php foreach ($category as $cat) : ?>
                        <a href="?page=news&category=<?php echo $cat['id'] ?>"><?= $cat['name'] ?></a>
                    <?php endforeach; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- and category  -->

<!-- all news  -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1></h1>
            <!-- ovo mora da se vidi kako da se ispravi -->
        </div>
    </div>


    <div class="row">
        <?php foreach ($all_news as $news) : ?>
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="<?= BASE_URL ?>storage/images/<?= $news['image'] ?>" alt="Slika vesti">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#"><?= $news['title'] ?></a></h5>
                        <small class="text-muted">Created: <?= $news['created_at'] ?></small>
                        <form action="<?= BASE_URL . 'index.php' ?>" method="POST">
                            <?php if (isset($_SESSION['token'])) : ?>
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                                <input type="hidden" name="id" value="<?= $news['id'] ?>">
                                <?php if (false == $auth->isAdmin()) : ?>
                                <?php else : ?>
                                    <button type="submit" name="delete-news">delete</button><br />
                                <?php endif; ?>
                            <?php endif; ?>
                        </form>
                        <a href="<?= BASE_URL ?>/index.php?page=single-news&news_id=<?php echo $news['id'] ?>">single news</a>
                        <?php if ($auth != False && false == $auth->isAdmin()) : ?>
                        <?php else : ?>
                            <a href="<?= BASE_URL ?>index.php?page=update-news&news_id=<?php echo $news['id'] ?>">update</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach;  ?>
    </div>
    <!-- and news  -->