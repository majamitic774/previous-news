<?php

use News\Core\Auth; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="storage/assets/style.css">

    <style>
        body {
            background-color: #e6e6fa;
        }

        .container-short {
            margin-top: 100px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 50px;
            box-shadow: 0 0 10px #888888;
            border-radius: 10px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8">
                <div class="news my-5">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="mt-3"><?= $title . "<br>"; ?></h2>
                            <p class="text-muted">Published on <?= $created_at ?></p>
                            <p><?= $body ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-md-5">
                <div class="text-center">
                    <div class="card-body">
                        <img src="storage/images/<?= $image ?>" class="mx-auto d-block img-fluid" width="100%" height="100px">
                    </div>
                </div>
            </div>
        </div>

        <!-- START COMMENTS -->
        <div class="row">
            <div class="col-md-12">
                <div class="comments my-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Comments</h4>
                            <?php foreach ($comments as $comment) : ?>
                                <div class="row">
                                    <!-- START SINGLE COMMENT -->
                                    <div class="media col-md-9">
                                        <div class="media-body">
                                            <h5 class="mt-0"><?= $comment['username'] ?></h5>
                                            <p><?= $comment["body"] ?></p>
                                        </div>
                                    </div>
                                    <!-- END SINGLE COMMENT -->
                                    <div class="col-md-3">
                                        <form action="<?= BASE_URL . 'index.php' ?>">
                                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                                            <input type="hidden" name="comment-id" value="<?= $comment['id'] ?>">
                                            <input type="hidden" name="news-id" value="<?= $news_id ?>">
                                            <input type="hidden" name="user-commented-email" value="<?= $comment['email'] ?>">
                                            <?php if ($loggedInUser && $loggedInUser['email'] == $comment['email'] || Auth::isAdmin()) : ?>
                                                <div class="float-md-end">
                                                    <button type="submit" class="btn btn-danger" name="delete-comment">delete</button>

                                                    <?php if ($loggedInUser && $loggedInUser['email'] == $comment['email']) : ?>
                                                        <a href="<?= BASE_URL ?>index.php?page=update-comment&comment_id=<?php echo $comment['id'] ?>&news_id=<?php echo $news_id; ?>&user-commented-email=<?php echo $comment['email'] ?>" class="btn btn-primary">Edit</a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END COMMENTS -->
        <!-- START COMMENT FORM -->
        <?php if ($loggedInUser) : ?>
            <div class="mb-5">
                <form action="<?= BASE_URL . 'index.php' ?>" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_SESSION['token'])) : ?>
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                    <?php endif; ?>
                    <input type="hidden" name="news_id" value="<?= $news_id ?>" /><br />
                    <input type="hidden" name="user_id" value="<?= $user_id ?? '' ?>" /><br />
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">Your Comment</label>
                            <textarea class="form-control w-100" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <div id="emailHelp" class="form-text">Leave your comment...</div>
                        </div>
                    </div>

                    <button type="submit" name="insert-comment" class="btn btn-primary">Submit</button>
                </form>
            </div>
        <?php endif; ?>
        <!-- END COMMENT FORM -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>