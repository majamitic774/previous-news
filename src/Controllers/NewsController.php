<?php

namespace News\Controllers;

// use models\CommentModel;

use News\Core\Auth;
use News\Core\Image;
use News\Core\View;
use News\Models\Comment;
use News\Models\News;

class NewsController
{
    private News $newsModel;

    public function __construct(News $newsModel)
    {
        $this->newsModel = $newsModel;
    }

    public function index($fileName, $data = [])
    {
        $auth = new Auth();
        $category = $this->newsModel->getCategories();
        $all_news = $this->newsModel->getAll();

        if (isset($_GET['category'])) {
            $all_news = array_filter($all_news, function ($news) {
                return $news['category_id'] == $_GET['category'];
            });
        }

        $data = ['auth' => $auth, 'category' => $category, 'all_news' => $all_news];
        View::render($fileName, $data);
    }

    public function create($fileName)
    {
        $data = ["categories" => $this->newsModel->getCategories()];
        View::render($fileName, $data);
    }


    public function insert()
    {
        $fileInfo = Image::uploadImage();
        $imageName = $fileInfo ? $fileInfo['NameFile'] : '';

        $title = $_POST['title'] ?? '';
        $body = $_POST['body'] ?? '';
        $category_id = $_POST['category_id'] ?? '';

        if (empty($title) || empty($body) || empty($category_id)) {
            header('location: ' . BASE_URL . 'index.php?page=insertNewsForm');
            exit;
        }

        $title = htmlspecialchars($title);
        $body = htmlspecialchars($body);
        $category_id = htmlspecialchars($category_id);

        $this->newsModel->insert($title, $body, $category_id, $imageName);
    }

    public function showSingleNews()
    {
        $news_id = '';
        if (isset($_GET['news_id'])) {
            $news_id = htmlspecialchars($_GET['news_id']);
        }
        $news = new News();
        $singleNews = $news->findById($news_id);

        $title = $singleNews['title'];
        $body = $singleNews['body'];
        $created_at = $singleNews['created_at'];
        $image = $singleNews['image'];

        $auth = new Auth();
        $loged_user = $auth->getLoggedInUser();
        $user_id =  $loged_user ? $loged_user['id'] : "";

        $comment = new Comment();
        $comments = $comment->getComments($news_id);

        $data = [
            "title" => $title,
            "body" => $body,
            "created_at" => $created_at,
            "image" => $image,
            "user_id" => $user_id,
            "news_id" => $news_id,
            "comments" => $comments,
            "loggedInUser" => $auth->getLoggedInUser(),
        ];

        View::render("singleNews.php", $data);
    }

    public function delete()
    {
        $this->newsModel->delete(htmlspecialchars($_POST['id']));
    }

    public function update()
    {
        $fileInfo = Image::uploadImage();
        $imageName = $fileInfo ? $fileInfo['NameFile'] : '';

        $id = $_POST['id'] ?? '';
        $title = $_POST['title'] ?? '';
        $body = $_POST['body'] ?? '';

        if (empty($title) || empty($body) || empty($id)) {
            header('location: ' . BASE_URL . "index.php?page=update-news&news_id=$id");
            exit;
        }

        $this->newsModel->update($id, $title, $body, $imageName);
    }

    public function showUpdateForm()
    {
        $data = [
            "news" => (new News())->findById($_GET['news_id'])
        ];

        View::render("updateNewsForm.php", $data);
    }
}
