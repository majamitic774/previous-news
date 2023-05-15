<?php
session_start();

require_once '../src/utils/constants.php';

ob_start();
$token = md5(uniqid(rand(), true));
$_SESSION['token'] = $token;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>index.php?page=news">News</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>index.php?page=insertNewsForm">Add News</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>index.php?page=usersRegisterForm">Register</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>index.php?page=usersLoginForm">Login</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>index.php?logOut">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>
<?php




// use models\NewsModel;
// use auth\Auth;
// use controllers\CommentController;
// use models\CommentModel;
// use controllers\NewsController;
// use controllers\UsersController;
// use models\UserModel;

// $auth = new Auth();
// $newsController = new NewsController(new NewsModel());
// $usersController = new UsersController(new UserModel(), $auth);
// $commentController = new CommentController(new CommentModel());

use News\Controllers\CommentController;
use News\Models\News;
use News\Models\User;

use News\Controllers\NewsController;
use News\Controllers\UsersController;
use News\Core\Auth;
use News\Models\Comment;

$news = new News();
$user = new User();
$comment = new Comment();
$auth = new Auth();

$newsController = new NewsController($news);
$usersController = new UsersController($user, $auth);
$commentController = new CommentController($comment);

if (isset($_GET['page'])) {
    if ($_GET['page'] == 'news') {
        $newsController->index('news.php');
    } else if ($_GET['page'] == 'insertNewsForm') {
        $newsController->create("insertNewsForm.php");
    } else if ($_GET['page'] == 'usersRegisterForm') {
        $usersController->create('usersRegisterForm.php');
    } else if ($_GET['page'] == 'usersLoginForm') {
        $usersController->createLogin('usersLoginForm.php');
    } else if ($_GET['page'] == "single-news") {
        $newsController->showSingleNews();
    } else if ($_GET['page'] == "update-comment") {
        $commentController->showUpdateForm();
    } else if ($_GET['page'] == "update-news") {
        $newsController->showUpdateForm();
    }
}

if (isset($_POST['insert-news']) && Auth::isAdmin()) {
    $newsController->insert();
}

//update news
if (isset($_POST['updateNews']) && Auth::isAdmin()) {
    $newsController->update();
}

//register user
if (isset($_POST['insert-user'])) {
    $usersController->insert();
}

//login user
if (isset($_POST['login-user'])) {
    $usersController->logIn();
}

//logOut user
if (isset($_GET['logOut'])) {
    $usersController->logOut();
}

//delete news
if (isset($_POST['delete-news']) && Auth::isAdmin()) {
    $newsController->delete();
}


//insert comments
if (isset($_POST['insert-comment'])) {
    $commentController->insert();
}

//delete comments
if (isset($_GET['delete-comment'])) {
    $commentController->delete();
}

//update comment
if (isset($_POST['update-comment'])) {
    $commentController->update();
}

ob_end_flush();
