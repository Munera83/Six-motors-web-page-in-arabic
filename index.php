<!DOCTYPE html>
<html>
<head>
<title>Control</title>
<style>
table {
  width: 40%; 
  margin: auto; 
}
td{
  text-align: center;
  padding: 2px;
  height:35px;
}
.slidecontainer {
  margin: auto;
  width: 100%; 
}
.slider {
 
  appearance: none;
  width: 70%; 
  height: 15px;
  border-radius: 5px;
  background: #6B7081 ;
  outline: none; 
  opacity: 0.7; 
  -webkit-transition: .2s; 
  transition: opacity .5s;
}
.slider:hover {
  opacity: 1; /* Fully shown on mouse-over */
}
.slider::-webkit-slider-thumb {
  -webkit-appearance: none; 
  appearance: none;
  width: 20px;
  height: 20px; 
  border-radius: 50%; 
  background: #57C6B3 ;
  cursor: pointer; 
}
.slider::-moz-range-thumb {
  width: 25px; 
  height: 25px;
  border-radius: 50%;
  cursor: pointer; 
}
body {
  background-color: #F5EFE8;
  background-position: center;
  background-image: url('background.png');
  background-repeat:no-repeat;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 90%;
}
.button { 
height: 25px; 
width: 100px; 

  color: #112776 ;
}
</style>
</head>
<body text="#112776 ">
<?php
$con=mysqli_connect('localhost','munera','1234','robotarm');
if(!$con)
  echo 'Connection error';
else
{
  if(isset($_POST['save'])){//clicked save button
    $v1 = $_POST['m1'];
    $v2 = $_POST['m2'];
    $v3 = $_POST['m3'];
    $v4 = $_POST['m4'];
    $v5 = $_POST['m5'];
    $v6 = $_POST['m6'];

    if(!mysqli_query($con, "UPDATE MOTORS SET MOTOR1='$v1', MOTOR2='$v2' ,MOTOR3='$v3', MOTOR4='$v4' ,MOTOR5='$v5', MOTOR6='$v6' where ID=1 "))
      echo'<script>alert("فشل الحفظ")</script>';
    else
      echo'<script>alert("تم الحفظ")</script>';
  }

  if(isset($_POST['on'])){// clicked on/off button
    $result = mysqli_query($con,"SELECT onoff FROM MOTORS where ID=1")or die( mysqli_error($con));
    while($data=mysqli_fetch_array($result))

     if( $data['onoff']==0)//if it is off switch to on
       {
         if(!mysqli_query($con, "UPDATE MOTORS SET onoff=1"))
           {echo'<script>alert("فشل التشغيل")</script>';
           echo  mysqli_error($con); }
         else
           echo'<script>alert("تم التشغيل")</script>';
       }
    else //it is on ,switch to off
      { if(!mysqli_query($con, "UPDATE MOTORS SET onoff=0 where ID=1 "))
          echo'<script>alert("فشل الإطفاء")</script>';
        else
          echo'<script>alert("تم الإطفاء")</script>';
      }
  }
  
  $result = mysqli_query($con,"SELECT * FROM MOTORS where ID=1")or die( mysqli_error($con));
  while($data=mysqli_fetch_array($result)){
    $val1=$data['Motor1'];
    $val2=$data['Motor2'];
    $val3=$data['Motor3'];
    $val4=$data['Motor4'];
    $val5=$data['Motor5'];
    $val6=$data['Motor6'];
  }
}
?>
<br><br><br><br><br><br><br><br><br><br><br>
<form action="index.php" method="post">
  <table>
    <tr>
      <td width="10%"><p id="v1" > </p></td>
      <td width="90%"><div class="slidecontainer">
         <input type="range"  min="0" max="180" value="<?php echo (isset($val1))?$val1:"90";?>" class="slider" id="Motor1" name="m1"> محرك 1
         </div> </td>
    </tr>
    <tr>
      <td width="10%"><p id="v2"> </p></td>
      <td width="90%"><div class="slidecontainer">
         <input type="range"  min="0" max="180" value="<?php echo (isset($val2))?$val2:"90";?>" class="slider" id="Motor2" name="m2"> محرك 2
         </div> </td>
    </tr>
    <tr>
      <td width="10%"><p id="v3"> </p></td>
      <td width="90%"><div class="slidecontainer">
         <input type="range"  min="0" max="180" value="<?php echo (isset($val3))?$val3:"90";?>" class="slider" id="Motor3" name="m3"> محرك 3
         </div> </td>
    </tr>
    <tr>
      <td width="10%"><p id="v4"> </p></td>
      <td width="90%"><div class="slidecontainer">
         <input type="range"  min="0" max="180" value="<?php echo (isset($val4))?$val4:"90";?>" class="slider" id="Motor4" name="m4"> محرك 4
         </div> </td>
    </tr>
    <tr>
      <td width="10%"><p id="v5"> </p></td>
      <td width="90%"><div class="slidecontainer">
         <input type="range"  min="0" max="180" value="<?php echo (isset($val5))?$val5:"90";?>" class="slider" id="Motor5" name="m5"> محرك 5
         </div> </td>
    </tr>
    <tr>
      <td width="10%"><p id="v6"> </p></td>
      <td width="90%"><div class="slidecontainer">
         <input type="range"  min="0" max="180" value="<?php echo (isset($val6))?$val6:"90";?>" class="slider" id="Motor6" name="m6"> محرك 6
         </div> </td>
    </tr>
  </table>

 <center><p><button class="button" name="on"> تشغيل/إطفاء</button>
<button class="button" name="save" >حفظ</button></p> </center>

</form>
<script>
var slider = [];
var output = [];

slider[0] = document.getElementById("Motor1");
output[0] = document.getElementById("v1");
output[0].innerHTML = slider[0].value; 
slider[0].oninput = function() {output[0].innerHTML = this.value;}

slider[1] = document.getElementById("Motor2");
output[1] = document.getElementById("v2");
output[1].innerHTML = slider[1].value; 
slider[1].oninput = function() {output[1].innerHTML = this.value;}

slider[2] = document.getElementById("Motor3");
output[2] = document.getElementById("v3");
output[2].innerHTML = slider[2].value; 
slider[2].oninput = function() {output[2].innerHTML = this.value;}

slider[3] = document.getElementById("Motor4");
output[3] = document.getElementById("v4");
output[3].innerHTML = slider[3].value; 
slider[3].oninput = function() {output[3].innerHTML = this.value;}

slider[4] = document.getElementById("Motor5");
output[4] = document.getElementById("v5");
output[4].innerHTML = slider[4].value; 
slider[4].oninput = function() {output[4].innerHTML = this.value;}

slider[5] = document.getElementById("Motor6");
output[5] = document.getElementById("v6");
output[5].innerHTML = slider[5].value; 
slider[5].oninput = function() {output[5].innerHTML = this.value;}
</script>

<noscript>
 Sorry...JavaScript is needed to go ahead.
</noscript>


</body>
</html>