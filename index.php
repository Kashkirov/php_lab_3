<?php
    require "vendor/autoload.php";
	  session_start();
    require "backend.php";
?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <!--<link rel="stylesheet" href="Css/styles.css">-->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
  <style>@font-face
  {
    font-family: Kartika;
    src: url(fonts/kartika.ttf)
  }
  </style>
  <style>@font-face
  {
    font-family: Athabasca;
    src: url(fonts/athabasca.extralight.ttf)
  }
  </style>

</head>
<body>

<div class="wrapper">


<h1 class="headers">Регистрация</h1>
<form class="formstyle" action="" method="post">
  <div class="formElem">
    <h2 class="headers" style="text-align:center">Ваш логин</h2>
    <input type="text" name="login"  placeholder="Mark">
    <h2 class="headers" style="text-align:center">И цвет интерфейса</h2>
  </div>
  
  <div class="formElem">
  <label for="setRed">Red</label>
    <input type="radio" name="color" value="red" id="reg-c-red">
    
	<br>
  <label for="setOrange">Orange</label>
	<input type="radio" name="color" value="orange" id="reg-c-orange">
    
	<br>
  <label for="setGreen">Green</label>
    <input type="radio" name="color" value="green" id="reg-c-green">
    
	<br>
  <label for="setVelvet">Velvet</label>
	<input type="radio" name="color" value="velvet" id="reg-c-velvet">
    
	<br>
  <label for="setBlue">Blue</label>
    <input type="radio" name="color" value="blue" id="reg-c-blue">
    
	<br>
  <label for="setDarkGrey">Dark-Grey</label>
	<input type="radio" name="color" value="dgrey" id="reg-c-dgrey">
    
	<br>
  <label for="setWhite">White</label>
    <input type="radio" name="color" value="white" id="reg-c-white">
	<br>
  <input type="submit" class="button" name="action" value="Подтвердить регистрацию">
  </div>
</form>
<div style="display: flex; justify-content: center;" >

</div>
</div>


<div class="wrapper" style="<?= $_COOKIE["uLogin"] ? 'display: none' : '' ?>">
<h1 class="headers">Войти в систему</h1>
<div class="header">

</div>

<form class="formstyle" action="" method="post">
  <input  type="text" name="loginForm" placeholder="Ваш логин" ><br>
  <input  class="button" type="submit" name="action" value="Подтвердить авторизацию">
</form>

<div style="display: flex; justify-content: center;">
  
</div>
</div>

<div class="wrapper" style="<?= $_COOKIE["uLogin"] ? '' : 'display: none' ?>">
<h1 class="headers">Можете изменить цвет в учетной записи</h1>

<form class="formstyle" action="" method="post">
  <!--<div class="formElem">
    <h2 class="headers" style="text-align:center">Ваш логин</h2>
    <input type="text" name="login"  placeholder="Mark">
    <h2 style="text-align:center" class="headers">И цвет интерфейса</h2>
  </div>-->
  
  <div class="formElem">
  <label for="setRed">Red</label>
    <input type="radio" name="color" value="red" id="reg-c-red">
	<br>
  <label for="setOrange">Orange</label>
	<input type="radio" name="color" value="orange" id="reg-c-orange">
	<br>
  <label for="setGreen">Green</label>
    <input type="radio" name="color" value="green" id="reg-c-green">
	<br>
  <label for="setVelvet">Velvet</label>
	<input type="radio" name="color" value="velvet" id="reg-c-velvet">
	<br>
  <label for="setBlue">Blue</label>
    <input type="radio" name="color" value="blue" id="reg-c-blue">
	<br>
  <label for="setDarkGrey">Dark-Grey</label>
	<input type="radio" name="color" value="dgrey" id="reg-c-dgrey">
	<br>
  <label for="setWhite">White</label>
    <input type="radio" name="color" value="white" id="reg-c-white">
	<br>
  <input type="submit" class="button" name="action" value="Подтвердить изменения">
  </div>
</form>

<div style="display: flex; justify-content: center;">
  
</div>
</div>

<div class="extra">
<div  style="<?= $_SESSION["error"] ? 'display: block' : 'display: none' ?>">
            <p><?= $_SESSION["error"] ?></p>
        </div>
        <div style="<?= $_SESSION["success"] ? 'display: block' : 'display: none' ?>">
            <p><?= $_SESSION["success"] ?></p>
        </div>
        <div style="<?= $_COOKIE["uLogin"] ? 'display: block' : 'display: none' ?>">
            <p><?= $_COOKIE["uLogin"]?>, вы успешно вошли</p>
            <p>Ваш цвет интерфейса: <?= $colors[$_COOKIE["uColor"]] ?></p>
            <form action="" method="post">
                <input class="button" type="submit" name="action" value="Выйти">
            </form>
</div>
</div>
</body>

<style>
body {
    display: block;
  }
.wrapper {
  position: relative;
  align-content: center;
  border: 1px solid black;
  border-radius: 5%;
  margin-bottom: 5vw;
  margin-left: 35vw;
  margin-right: 35vw;
  <?= $colors[$_COOKIE["uColor"]] ?>;
}
.extra {
  align-content: center;
  border: 1px solid black;
  text-align: center;
  border-radius: 5%;
  margin-bottom: 5vw;
  margin-left: 35vw;
  margin-right: 35vw;
  font-size: 1vw;
  font-family: Courier;
  <?= $colors[$_COOKIE["uColor"]] ?>;
}
.header {
  margin-left: 3vw;
  margin-right: 3vw;
  border-bottom: 2px solid #111;
  position: center;
}
.headers {
  text-align: center;
  font-family: Raleway;
  font-size: 2vh;
}
.headline {
  font-family: Raleway;
  font-size: 2vh;
  justify-content: center;
  text-align: center;
}
.formstyle {
  display: block;
  justify-content: center;
  align-content: center;
  position: relative;
  text-align: left;
  
}
.formElem {
  margin: 1vh;
  display: block;
}
input {
  margin: 0.5vh;
}
.button {
  style="font-family: 'Raleway';
  font-size: 2vh;
  border:0;
  border-radius:2;
  margin: 1vw;
}
.button:hover {
	background-color: rgba(210, 230, 230, 90);
}
</style>
