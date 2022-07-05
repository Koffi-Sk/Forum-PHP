<?php 
    session_start();
    require_once "actions/questions/showArticleContentAction.php"; 
    require_once "actions/questions/postAnswerAction.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php"; ?>

<body>
    <?php include "includes/navbar.php"; ?>
    <br><br>

    <div class="container">
        <?php if (isset($errorMsg)){ echo $errorMsg; }
    
            if(isset($question_publication_date)){
                ?>
        <section class="show-content">
            <h3><?= $question_title; ?></h3>
            <hr>
            <p><?= $question_contenu; ?></p>
            <hr>
            <small><?= $question_pseudo_author . " " . $question_publication_date; ?></small>
        </section>
        <br>
        <section class="show-answers">
            <form class="form-group" method="POST">
                <div class="mb-3">
                    <label class="form-label">Réponse :</label>
                    <textarea name="answer" class="form-control"></textarea>
                    <br>
                    <button class="btn btn-primary" type="submit" name="validate">Répondre</button>
                </div>

            </form>
        </section>

        <?php
            }
        ?>
    </div>

</body>

</html>