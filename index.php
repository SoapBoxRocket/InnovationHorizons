<!DOCTYPE html>
<html lang="en">
<head>
  <title>Soap Box Rocket - Innovation Horizons</title>
  <script type="text/javascript">
    function Draw(){
      var img = document.getElementById("graph");
      var cnvs = document.getElementById("graphCanvas");

      cnvs.style.position = "absolute";
      cnvs.style.left = img.offsetLeft + "px";
      cnvs.style.top = img.offsetTop + "px";

      var ctx = cnvs.getContext("2d");
      ctx.beginPath();
      ctx.arc(50, 50, 10, 0, 2 * Math.PI, false);
      ctx.lineWidth = 2;
      ctx.strokeStyle = "red";
      ctx.stroke();

      var ctx = cnvs.getContext("2d");
      ctx.font = "15px Ariel";
      ctx.fillStyle = "red";
      ctx.fillText ("1", 46, 55);
    }
  </script>
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<style>
#container {
    position: relative;
}
#circle {
  font-size: 50px;
  color: red;
}
#text {
    z-index: 1;
    position: absolute;
    top: 23.5px;
    left: 10.5px;
    color: red;
}
</style>
<body>
  <?php
    $nameErr = $marketErr = $solutionErr = "";
    $name = $market = $solution = "";
    $counter = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $counter = test_input($_POST["counter"]);
      $counter++;
      if (empty($_POST["name"])) {
        $nameErr = "Pleae provide a project name.";
      } else {
          $name = test_input($_POST["name"]);
      }

      if ($_POST["market"] == 0) {
        $marketErr = "Please estimate the market fit for this project.";
      } else {
        $market = test_input($_POST["market"]);
      }

      if ($_POST["solution"] == 0) {
        $solutionErr = "Please estimate the solution fit for this project.";
      } else {
        $solution = test_input($_POST["solution"]);
      }

      $projfile = fopen("projfile.txt", "a") or die("No known Innovations!");
      fwrite ($projfile, $counter);
      fwrite ($projfile, $name);
      fwrite ($projfile, $market);
      fwrite ($projfile, $solution);
      fclose ($projfile);

    } else {
        $projfile = fopen("projlist.txt", "w");
        fclose ($projfile);
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
  ?>
  <center>
    <img id="graph" src="images/HorizonsGraph.png">
    <canvas id='graphCanvas' width='500px' height='500px' style="border:1px solid #000000"></canvas>
    <form action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" method="post">
      Project Name: <input type="text" name="name">
      <span class="error"> <?php echo $nameErr;?></span><br>
      Market<br>Exsisting <input type="range" name="market" min="0" max="10" value="0" step=".5"> New to World
      <span class="error"> <?php echo $marketErr;?></span><br>
      Solution<br>Exsisting <input type="range" name="solution" min="0" max="10" value="0" step=".5"> New to World
      <span class="error"> <?php echo $solutionErr;?></span><br>
      <input type="hidden" name="counter" value="<?php echo $counter;?>">
      <input type="submit" value="Add Project" onclick='Draw()'>
    </form>
  </center>
  <br>
  <center>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $projfile = fopen("projlist.txt", "r") or die("Sorry, no innovation!");
        echo fread($projfile,filesize("projlist.txt"));
        fclose($projfile);
      }
    ?>
  </center>
  <div id="container">
    <div id="circle">&#x25CB;</div>
    <div id="text">1</div>
  </div>
  <div id="container">
    <div id="circle">&#x25CB;</div>
    <div id="text">2</div>
  </div>
</body>
</html>
