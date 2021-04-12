<?php
require "db_osztaly.php";

if(isset($_SESSION["username"]))
{
    session_destroy();
}

if(isset($_POST["sub"]) && isset($_POST["username"]) && isset($_POST["password"]))
{
    $user=$_POST["username"];
    $pw=$_POST["password"];
    $db = new db_oszt();
    $db->Connection("eximtrans");

    if($db->Login($user,$pw))
    {   
        session_start();
        $_SESSION["username"]=$user;
        header("Location: logged.php");
    }
}

if(isset($_POST["reg"]) && isset($_POST["username"]) && isset($_POST["password"]))
{
    
    $user=$_POST["username"];
    $pw=$_POST["password"];
    $db = new db_oszt();
    $db->Connection("eximtrans");
    session_start();
    if($db->Reg($user,$pw))
    {
        echo "<script>alert('Sikeres regisztráció!')</script>";
    }
    else
    {
        echo "<script>alert('A regisztráció nem sikerült!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="hu">

<head>
<title>Eximtrans</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
<script src="szamol.js"></script>
<script></script>
</head>

<body>

<div id="container" class="container-fluid" style="padding:0px;">


<div class="d-flex justify-content-center"><img src="images/highway.jpg" alt=""></div>

<nav class="navbar navbar-expand-sm bg-light justify-content-center nopad">
<ul class="navbar-nav">
<li class="nav-item"><a class="nav-link" href="#" alt="">Aktuális</a></li>
<li class="nav-item"><a class="nav-link" href="#" alt="">Megrendelés</a></li>
<li class="nav-item"><a class="nav-link" href="#" alt="">Rólunk</a></li>
<li class="nav-item"><a class="nav-link" href="#" alt="">Kapcsolat</a></li>
</ul>
</nav>

<div class="d-flex justify-content-center"><h1>Export-import szállítás</h1></div>

<div id="tablazat" class="borderless-table pad20">

<table>
    <tr>
        <td class="szelesseg">
        <h2>Díjszabás</h2>
        <ul>
        <li>Alapdíj: 2.000 Ft</li>
        <li>Súly díj: 100 Ft/kg</li>
        <li>Távolsági díj: 400 Ft/km</li>
        </ul>
        </td>
        
        <td>
        Mert elviszünk bármit bárhová a lehető leggyorsabban. Nincs sorbanállás velünk egyszerűen intézheted a csomagküldést!  
        A többi szolgálathoz hasonlóan mi is a lakosság kényelmét szolgáljuk azzal, hogy elszállítjuk csomagjaikat a világ bármely szegletébe. De miben más az Eximtrans? Az Eximtrans rendelkezésedre áll a nap 24 órájában! Válassz minket és hozz egy jó döntést!
        </td>
    </tr>

    <tr>
        <td class="szelesseg">
            <div class="bg-secondary pad20 rmarg20">
                <h2>Viteldíj kalkulátor</h2>
                <form action="">
                 <div class="form-group">
                     <label for="kg">Súly [kg]:</label>
                     <input type="number" class="form-control" id="kg" name="kg" placeholder="Egész kg" required>
                 </div>

                 <div class="form-group">
                     <label for="km">Távolság [km]:</label>
                     <input type="number" class="form-control" id="km" name="km" placeholder="Egész km" required>
                 </div>
                 <input type="button" class="form-control" id="szamol" name="szamol" value="Számoljon" onclick="viteldij_szam()">
                </form>
            </div>
        </td>
        <td>
        Számold ki mennyibe kerül csomagod kiszállítása! Írd be a termék súlyát kg-ban és a kiszállítás távolságát km-ben! A kalkulátor máris kiszámolja mennyi lesz a csomagküldés díja.
        </td>
    </tr>

    <tr>
        <td class="szelesseg">
            <div class="bg-secondary pad20 rmarg20">
                <h2>Ügyfeleknek</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Adja meg a nevét!" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="password" name="password" placeholder="Adja meg a jelszavát!" required>
                    </div>
                    <input type="submit" id="sub" name="sub" value="Belépés">
                    <input type="submit" id="reg" name="reg" value="Regisztráció">
                </form>
            </div>
        </td>
        <td>
        Ha már ügyfelünk, a megrendeléshez jelentkezzen be. Ha még nem ügyfelünk, adja meg a nevét és egy jelszót, majd kattintson a "Regisztráció" gombra.
        </td>
    </tr>
</table>

</div>


</div>

</body>

</html>