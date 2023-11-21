<?php
    $colors = [
        "red" => "background: rgb(240, 64, 64)",
		"orange" => "background: rgb(255, 79, 0)",
        "green" => "background: rgb(50, 205, 50)",
		"velvet" => "background: rgb(117, 8, 81)",
        "blue" => "background: rgb(135, 206, 250)",
		"dgrey" => "background: rgb(16, 16, 16)",
        "white" => "background: rgb(250, 250, 250)",
        "default" => "background: rgb(250, 250, 250)"
		
    ];


if (!isset($_POST['action'])) {
    $_SESSION["error"] = "";
    $_SESSION["success"] = "";
}
 
function dbConnect(): PDO {
    try {
        // подключаемся к серверу
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=php_Kashkirov", "root", "");
        // установка режима вывода ошибок
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } 
    catch (PDOException $e) {
        echo "не определена БД" . $e->getMessage();
        exit();
    }
}

function fetchUser(PDO $conn, string $username): bool { 
    $stmt = $conn->prepare("SELECT * FROM cookies WHERE login = ?");
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result === false) {
        $_SESSION["error"] = sprintf("Аккаунт %s не найден.", $username);
        return false;
    }
    setcookie("uLogin", $result["login"], time() + 3600*24*7, "/");
    setcookie("uColor", $result["color"], time() + 3600*24*7, "/");
    return true;
}

function signup(PDO $conn) {
    if ( 
        !(isset($_POST["login"]) && isset($_POST["color"])) || (
        empty($_POST["login"]) || empty($_POST["color"]) ) 
        ) {
        $_SESSION["error"] = "Пустой логин или пропущены поля ниже!";
        return;
    }
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM cookies WHERE login = ?");
    $checkStmt->bindParam(1, $_POST["login"], PDO::PARAM_STR);
    $checkStmt->execute();
    if ($checkStmt->fetch()[0] != 0) {
        $_SESSION["error"] = sprintf("Аккаунт %s занят!", $_POST['login']);
    return;
    }

    $stmt = $conn->prepare("INSERT IGNORE INTO cookies VALUES(NULL, :login, :color)");
    $stmt->bindParam(":login", $_POST["login"], PDO::PARAM_STR);
    $stmt->bindParam(":color", $_POST["color"], PDO::PARAM_STR);
    if ($stmt->execute()) {
    $_SESSION["success"] = "Регистрация завершена!";
    } else {
    $_SESSION["error"] = "Попробуйте еще раз";
    }
}

function logout() {
    session_destroy();
    setcookie("uLogin", null, 0, "/");
    setcookie("uColor", null, 0, "/");
}

function loginForm(PDO $conn) {
    if ( !isset($_POST["loginForm"]) || empty($_POST["loginForm"]) ) {
        $_SESSION["error"] = "Введите логин!";
        return;
    }
    $stmt = $conn->prepare("SELECT * FROM cookies WHERE login = ?");
    $stmt->bindParam(1, $_POST["loginForm"], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result === false) {
        $_SESSION["error"] = sprintf("Аккаунт %s не найден.", $_POST["loginForm"]);
    }
    setcookie("uLogin", $result["login"], time() + 3600*24*7, "/");
    setcookie("uColor", $result["color"], time() + 3600*24*7, "/");

}

function adjustColor(PDO $conn) {
    if ( !isset($_POST["color"]) || empty($_POST["color"]) ) {
        $_SESSION["error"] = "Выберите цвет!";
        return;
    }
    if ( !isset($_COOKIE["uLogin"]) ) {
        $_SESSION["error"] = "Оставлено пустое поле аккуанта!";
        return;
    } 
    if ( $_POST["color"] == $_COOKIE["uColor"] ) {
        return;
    }
    /*if ($_POST["login"] != $_COOKIE["uLogin"]) {
        $_SESSION["error"] = "Выберите текущий аккаунт аккаунт!";
        return;
    }
    */
    $stmt = $conn->prepare("UPDATE `cookies` SET `color` = :color WHERE `login` = :login");
    $stmt->bindParam(":color", $_POST["color"], PDO::PARAM_STR);
    $stmt->bindParam(":login", $_COOKIE["uLogin"], PDO::PARAM_STR);
    $stmt->execute();
    if ( $stmt->rowCount() > 0) {
        $_SESSION["success"] = "Настройки обновлены";
    } 
    else {
        $_SESSION["error"] = "Попробуйте еще раз";
    }
}
function kernel(PDO $conn) {
    if(isset($_POST["action"])) {
        if($_POST["action"]=="Подтвердить регистрацию") {
            signup($conn);
        }
        else if($_POST["action"]=="Подтвердить авторизацию") {
            loginForm($conn);
        }  
        else if($_POST["action"]=="Выйти") {
            logout();
        }
        else if($_POST["action"]=="Подтвердить изменения") {
            adjustColor($conn);
        }
    }
    
}

//setcookie("uColor", "default",time() + 3600*24*31, "/");
$conn = dbConnect();
    if ($_COOKIE["uLogin"]) {
        fetchUser($conn, $_COOKIE["uLogin"]);
    }  
    if (isset($_POST['action'])) {
        kernel($conn);
        header("Location: index.php");
    }
?>