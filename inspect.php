<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
   <?php
    session_start();
    if(isset($_SESSION['username'])){
        if(isset($_GET['app_id'])){
        }
        else{
            header("location:evaluatorsProfile.php");
        }
    }
    else{
        header("location:registration/loginEvaluator.php");
    }
    ?>
    <form action="process.php" id="NCF-003" onsubmit="return false">
        <div class="form-label">
            NURSERY AUDIT FORM
        </div>
        <div class="nursery-info">
            <div class="nursery-id">Nursery ID: <input type="text" readonly value="<?php echo $_SESSION['details']['kefri_num']?>" name="kefri_num"></div> 
            <div class="nursery-name"><label>Nursery Name:</label><input type="text" readonly value="<?php echo $_SESSION['details']['nursery_name']?>"></div>
            <input type="text" name="nurseryType"  value="private"hidden>
            <input type="text" name="application_id"  value="<?php echo $_SESSION['details']['application_id']?>"hidden>
        </div>
        
        <fieldset class="nursery-audit-score">
            <legend>Nursery Audit Score</legend>
            <div class="score-progress">
               <div id="score">
                    <label>Score:</label><input id="total-score" type="number" value="0" name="score" readonly><label>    /100</label>
               </div>
                    <progress id="progress-bar" value="0" max="100">50</progress>
            </div>
            <div class="tab"> label</div>
            <section class="test">
                

                



            </section>
            <div class="side-bar">
            <button class="hide-side-bar">+</button>
            
            </div>
            <div class='submit-btn'>
                <input type="submit" name="submit" id="submit-btn" value="submit" class="btn">
                <button type="button" class="btn" id="next-btn">next</button>
            </div>
        </fieldset>
    </form>
    <div class="modal">
        <div class="pop-modal">
            <div class="rating div">
                <img src="" class="image">
            </div>
            <div class="score div">
            <label>score:</label> <span></span>
        </div>
            <div class="message div">
        </div>
        <a href="correctiveaction.php?app_id=<?php echo $_SESSION['details']['application_id']?>"><button id="collective-action-btn">click to continue to collective action</button></a>
        </div>
    </div>
    <footer class="footer"> Designed and coded by Peter Mbugua & Copyright All Right Reserved 2021, Kenya Forest Research Institute</footer>
    <script type="text/javascript" src="js/min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/adt.js"></script>
    <script type="text/javascript" src="js/store.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
</body></html>