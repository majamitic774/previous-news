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

 <body>
     <div class="container-short">
         <form action="" method="POST" enctype="multipart/form-data">
             <?php if (isset($_SESSION['token'])) : ?>
                 <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
             <?php endif; ?>
             <div class="mb-3">
                 <label for="username" class="form-label">Username</label>
                 <input type="text" class="form-control" name="username" id="username">
             </div>
             <div class="mb-3">
                 <label for="email" class="form-label">Email</label>
                 <input type="email" class="form-control" name="email" id="email">
             </div>
             <div class="mb-3">
                 <label for="password" class="form-label">Password</label>
                 <input type="password" class="form-control" name="password" id="password">
             </div>
             <button type="submit" name="insert-user" class="btn btn-primary">Submit</button>
         </form>
     </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </body>

 </html>