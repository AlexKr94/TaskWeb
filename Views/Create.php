<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compitable" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <title>CREAR YOUR TASK</title>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
            <div class="container">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="http://task.web/?page=1&order=id">home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://task.web/tasks/create">create task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</head>
<body>
<div class="content">
    <div class="container">
        <form action="/tasks/create" method="post" enctype="multipart/form-data" >
            <div class="form-group" name="Create form">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="inputEmail1" aria-describedby="emailHelp" value="<?=$_SESSION['email']?>" placeholder="Enter your Email">
                <span style="color: #0069d9"><b><?=$error_email;?></b></span>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="inlineFormInput">Name</label>
                <input type="text" class="form-control mb-2" name="name" id="nameInput" value="<?=$_SESSION['name']?>"  placeholder="Your Name">
                <span style="color: #0069d9"><b><?=$error_name;?></b></span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Your task</label>
                <textarea type="textarea" class="form-control" name="text" id="textArea" rows="8" placeholder="Enter your Task"><?=$_SESSION['text']?></textarea>
                <span style="color:  #0069d9"><b><?=$error_text;?></b></span>
            </div>
            <div class="custom-file">
                <input type="file" name="pic" class="custom-file-input" id="custom">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <span style="color: #0069d9"><b><?=$error_file;?></b></span>
            <p></p>
            <button type="submit" class="btn btn-primary" name="send">Send!</button>
        </form>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>
<?php if ($addText == true) {
    echo '<script>location.replace("http://task.web/?page=1&order=id");</script>'; exit;
    exit;
}?>
