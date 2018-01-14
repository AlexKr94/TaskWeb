<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compitable" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
            <div class="container">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="http://task.web/?page=1&order=<?php
                        if (isset($_GET['order'])) {
                            echo htmlspecialchars($_GET["order"]); }
                        else {
                            echo 1;
                        } ; ?>">home <span class="sr-only">(current)</span></a>
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
    <title >Tasks</title>
</head>
<body>
<div class="content">
    <div class="container">
        <div class="slogan">
            <h1 style="color: #000000">tasks</h1>
        </div>
        <div class="row">
            <?php if ($tasksList != null) {
                foreach ($tasksList as $taskItem): ?>
                    <div class="col-md-12">
                        <div class="card">
                            <h4 style="color: #000000"><?=$taskItem['name'];?></h4>
                            <p><b style="color: #000000">Email: </b><?=$taskItem['email']?></p>
                            <p><b style="color: #000000">Task:</b><br><?=$taskItem['task'];?></p>
                            <p><img src="http://task.web/upload/<?php if (isset($taskItem['img'])){ echo $taskItem['img'];}?>" alt=""></p>
                            <a href=""></a>
                            <?php if (isset($taskItem['done']) && $taskItem['done'] == 1) { echo '<b style="color: green">THIS TASK COMPLETE</b>'; }?>
                            <div>
                                <button type="button" class="btn btn-outline-warning" onclick="window.open('/edit/<?=$taskItem['id']?>')" btn-sm>Edit</button>
                            </div>
                        </div>
                        <p></p>
                    </div>
                <?php endforeach;
            }?>
        </div>
        <p></p>
        <div class="sort">
            Sort by:
            <a class="btn btn-primary" href="http://task.web/?page=<?=htmlspecialchars($_GET["page"])?>&order=id" role="button">ID</a>
            <a class="btn btn-primary" href="http://task.web/?page=<?=htmlspecialchars($_GET["page"])?>&order=name" role="button">NAME</a>
            <a class="btn btn-primary" href="http://task.web/?page=<?=htmlspecialchars($_GET["page"])?>&order=email" role="button">E-MAIL</a>
        </div>
        <div>
            <p></p>
            <nav aria-label="...">
                <ul class="pagination">

                    <?php $pageT = 0; ?>
                    <?php while ($pageT++ < $numPages): ?>
                        <?php if ($pageT == $_GET['page']): ?>
                            <li class="page-item active">

                            <a class="page-link" href="#"><?=$pageT;?> <span class="sr-only">(current)</span></a>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $pageT; ?>&order=<?php if(isset($_GET['order'])) {echo htmlspecialchars($_GET["order"]);} else {echo 'id';};?>"><?php echo $pageT; ?></a></li>
                        <?php endif ?>
                    <?php endwhile ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>