<?php session_start(); ?>
<?php
include("header.php");
include("essentials/database.php");
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="GNDEC GATE FORUM">
        <meta name="keywords" content="gate,priyanshumay,gne,gndec,">
        <meta name="author" content="PriyanshuMay,priyanshumay">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
 
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <style type="text/css">
        body{
    margin: 0!important;;
    padding: 0!important;
    border: 0!important;
    box-shadow: none!important;
    background: #fff;
}

        body::-webkit-scrollbar {
          display: none;
        }
        </style>
    </head>
    <body >
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript">

            window.onbeforeunload = function ()
            {
              document.location='signout.php';
            }    

  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
  });

  $(document).ready(function(){
    $('.sidenav').sidenav();
  });

    </script>



      <div class="row" id="cards_container">

    <div class="col s12 m6 l4 off" style="text-align: center;">
      <div class="card medium">
      <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="img/1.jpg">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">HSC-101<i class="material-icons right">more_vert</i></span>
      <span class="card-title  text-green">7500</span>
      <p>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">add_shopping_cart</i>Buy Later</a>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">shop</i>Buy Now</a>
      </p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Nike Shoe<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that and something.. something.. something.. something.. 
        something.. something..something.. something..something.. .</p>
        <a class="waves-effect waves-light btn-medium "><i class="material-icons left">shop</i>Buy Now</a>
    </div>
      </div>
    </div>

    <div class="col s12 m6 l4 off" style="text-align: center;">
      <div class="card medium">
      <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="img/2.jpg">
    </div>
    <br>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">HSC-101<i class="material-icons right">more_vert</i></span>
      <br>
      <p>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">add_shopping_cart</i>Buy Later</a>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">shop</i>Buy Now</a>
      </p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Nike Shoe<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that and something.. something.. something.. something.. 
        something.. something..something.. something..something.. .</p>
    </div>
      </div>
    </div>
    <div class="col s12 m6 l4 off" style="text-align: center;">
      <div class="card medium">
      <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="img/3.jpg">
    </div>
    <br>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">HSC-101<i class="material-icons right">more_vert</i></span>
      <br>
      <p>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">add_shopping_cart</i>Buy Later</a>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">shop</i>Buy Now</a>
      </p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Nike Shoe<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that and something.. something.. something.. something.. 
        something.. something..something.. something..something.. .</p>
    </div>
      </div>
    </div>
    <div class="col s12 m6 l4 off" style="text-align: center;">
      <div class="card medium">
      <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="img/4.jpg">
    </div>
    <br>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">HSC-101<i class="material-icons right">more_vert</i></span>
      <br>
      <p>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">add_shopping_cart</i>Buy Later</a>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">shop</i>Buy Now</a>
      </p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Nike Shoe<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that and something.. something.. something.. something.. 
        something.. something..something.. something..something.. .</p>
    </div>
      </div>
    </div>
    <div class="col s12 m6 l4 off" style="text-align: center;">
      <div class="card medium">
      <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="img/1.jpg">
    </div>
    <br>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">HSC-101<i class="material-icons right">more_vert</i></span>
      <br>
      <p>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">add_shopping_cart</i>Buy Later</a>
      <a class="waves-effect waves-light btn-small "><i class="material-icons left">shop</i>Buy Now</a>
      </p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Nike Shoe<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that and something.. something.. something.. something.. 
        something.. something..something.. something..something.. .</p>
    </div>
      </div>
    </div>

        <?php
        $sql = "SELECT id,content,level,tym,branch,username,datetym FROM questions ORDER BY datetym DESC";
        $result = $con->query($sql);
        if ($result->num_rows > 0)
        while ($row = $result->fetch_assoc()) :?>
        <button type="button" class="collapsible">
        <span id="title"><?php echo $row["content"]; ?></span><br><hr id="line"><br>
        <span id="specs">Asked by </span>&nbsp;<span id="details"><?php echo $row["username"]; ?></span> &emsp;
        <span id="specs">time alloted is</span> &nbsp;<span id="details"><?php echo $row["tym"]; ?></span> &emsp;
        <span id="specs">difficulty level estimated is</span>&nbsp;&nbsp;<span id="details"><?php echo $row["level"]; ?></span> &emsp;
        <span id="specs">question comes under</span> &nbsp;<span id="details"><?php echo $row["branch"]; ?></span><span id="specs"> branch</span>&emsp;
        <span id="specs">posted on</span> &nbsp;<span id="details"><?php echo $row["datetym"]; ?></span><br>
        <form method="post" action="addans.php"><br>
            <input  type="submit"id="answer_button" value="Have a better answer?"/>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
        </form>
        </button>
        <?php
        echo '<div class="content">';
            $queid = $row["id"];
            $ql = "SELECT * FROM answers WHERE id = '$queid' ORDER BY datetym DESC ";
            $resul = $con->query($ql);
            if ($resul->num_rows > 0) {
                while ($ro = $resul->fetch_assoc()) {
                    echo "<br><div id='answer_box'>
                <span id='anstitle'><br> ". $ro["content"] . "</span><br><span id='specs'> <br>&emsp;&emsp;&emsp;Time required is </span>&nbsp;<span id='details'> " . $ro ["tym"] . "&emsp;&emsp;<span id='specs'> Difficulty Level according to user is </span>&nbsp; ". $ro["level"] ."&emsp;&emsp;<span id='specs'> Answered by </span>&nbsp; " . $ro["username"] . "&emsp;&emsp;<span id='specs'> answered on </span>&nbsp; " . $ro["datetym"] ."</span></div>";
                }
            } else {
                echo "<br><div id='answer_box'><span id='anstitle'>Be the first to answer</span></div>";
            }
            echo '<br><br></div>';
            endwhile; ?>
            <button onclick="topFunction()" id="top_button_index" title="Go to top">UP</button>
            <script>
            var coll = document.getElementsByClassName("collapsible");
            var i;
            for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
            content.style.display = "none";
            } else {
            content.style.display = "block";
            }
            });
            }

            var mybutton = document.getElementById("top_button_index");
            window.onscroll = function() {scrollFunction()};
            function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
            } else {
            mybutton.style.display = "none";
            }
            }
            function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            }
            </script>
            <div class="fixed-action-btn">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">mode_edit</i>
  </a>
  <ul>
    <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
  </ul>
</div>
        </body>
    </html>
   