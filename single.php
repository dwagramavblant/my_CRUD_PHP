<?php 
    require("db.php");
    if(!isset($_GET["id"])){
        echo "<script>
        alert('Pleace make order')
        location.href = 'index.php';
        </script>";
        exit();
    }

    $id = $_GET["id"];
    $item = $db->query("SELECT * FROM items WHERE id=$id")->fetchAll(2);

if(count($item) > 0){
    $item = $item[0];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="single">
    <header>
        <a href="index.php">Come back</a>
    </header>

    <main>
        <section class="info">
            <img src="<?= $item['photo']; ?> " alt="item">
            <h1><?= $item['name']; ?> </h1>
            <p><?= $item['description']; ?> </p>

        </section>

        <section class="buy">
            <div class="amount">
                <button>+</button>
                <span>1</span>
                <button>-</button>
            </div>
            <h2>$<?= $item['price']; ?> </h2>
        </section>
    </main>
</body>
</html>