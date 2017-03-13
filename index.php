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
#draw-btn {
  font-size: 14px;
  padding: 2px 16px 3px 16px;
  margin-bottom: 8px;
}
</style>
<body>
  <?php
    $projName = $market = $solution = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $projName = test_input($_POST["projName"]);
      $market = test_input($_POST["market"]);
      $solution = test_input($_POST["solution"]);
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
      Project Name: <input type="text" name="projName"><br>
      Market<br>Exsisting <input type="range" name="market" min="0" max="10" value="0" step=".5"> New to World<br>
      Solution<br>Exsisting <input type="range" name="solution" min="0" max="10" value="0" step=".5"> New to World<br>
      <input type="submit">
    </form>
    <div>
      <input id='draw-btn' type='button' value='DRAW' onclick='Draw()' />
    </div>
  </center>
  <br>
  <br>
  <center>
    <?php
      echo "Project: ";
      echo $projName;
      echo "<br>";
      echo "Market: ";
      echo $market;
      echo "<br>";
      echo "Solution ";
      echo $solution;
      echo "<br>";
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
