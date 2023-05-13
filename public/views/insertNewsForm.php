<!DOCTYPE html>
<html>

<head>
    <title>Form with Bootstrap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

<div class="container-short">
    <form action="" method="POST" enctype="multipart/form-data">
        <?php if (isset($_SESSION['token'])) : ?>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <?php endif; ?>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Categories</label>
            <select name="category_id" class="form-select" id="inputGroupSelect01">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"> <?= $category['name']  ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Content here -->
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Body</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="body" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="id">
        </div>
        <button type="submit" name="insert-news" class="btn btn-primary">Submit</button>
    </form>
</div>