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
    <?php if ($successEdit == true) {
        echo '<script>location.replace("http://task.web/?page=1&order=id");</script>'; exit;
        exit;
    }?>
    <title>Edit task</title>
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
                        <a class="nav-link" href="http://task.web/<?php if(!isset($_SESSION['admin'])){ echo 'users/login'; }
                        else { echo 'users/logout';} ?>"><?php if(!isset($_SESSION['admin'])){ echo 'Login'; }
                            else { echo 'Logout' ;}?></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
<body>
<div class="content">
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <h4 style="color: #000000"><?=$showName;?></h4>
                <p><b style="color: #000000">Email: </b><?=$showEmail;?></p>
            </div>
            <p></p>
        </div>
        <form action="/edit/<?=$showid?>" method="post">
            <div class="form-group">
                <label style="color: #000000" for="area">Edit task</label>
                <textarea type="textarea" class="form-control" name="tasks" id="taskArea" rows="8" placeholder="Enter your Task"><?=$showTask;?></textarea>
                <span style="color:  #0069d9"><b><?=$errorTask;?></b></span>
            </div>
            <p></p>
            <button type="submit" class="btn btn-primary" name="edit">Edit</button>
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

