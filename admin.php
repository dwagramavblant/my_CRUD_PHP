<?php
require("db.php");
$categories = $db->query("SELECT * FROM categories")->fetchAll(2);
$items = $db->query("SELECT * FROM items")->fetchAll(2);
// Add new cat and del
if (!empty($_GET)){
    if(isset($_GET["delete_cat"])){

        $id = $_GET['id'];        
        if ($db->query("DELETE FROM categories WHERE id=$id")){
            echo "<script>
            alert ('Delette sucsesfull');
            location.href = 'admin.php';
            </script>";
            exit();
        }else{
            var_dump($db->errorInfo());
        }
     }

     if(isset($_GET["delete"])) {
        $id = $_GET['id']; 

        if ($db->query("DELETE FROM items WHERE id=$id")){
            echo "<script>
            alert ('Delette sucsesfull');
            location.href = 'admin.php';
            </script>";
            exit();
        }else{
            var_dump($db->errorInfo());
        }
     }




        if(isset($_GET["new_cat"])){
        $name = $_GET["new_cat"];
        if($db->query("INSERT INTO categories (name) VALUES ('$name')")){
            echo "<script>
            alert ('New item added sucsesfully');
            location.href = 'admin.php';
            </script>";
        }else{
            var_dump($db->errorInfo());
        }
    }
}


    
// Add new products

if(isset($_GET["new_item_name"])){
    $name = $_GET["new_item_name"];
    $photo =  $_GET['photo'];
    $description = $_GET['description'];
    $price = $_GET['price'];
    $category = $_GET['category'];


    if ($db->query("INSERT INTO items (name, photo, description, price, category) 
    VALUES ('$name', '$photo', '$description', $price, $category )")) {
        echo "<script>
        alert ('New item added sucsesfully');
        location.href = 'admin.php';
        </script>";
    }else{
        var_dump($db->errorInfo());
    }
    
    
}  


// update cat
if(isset($_GET["cat_name"])){
    $name = $_GET["cat_name"];
    $id = $_GET["id"];
    if($db->query("UPDATE categories SET name='$name' WHERE id=$id ")){
        echo "<script>
        alert ('New item added sucsesfully');
        location.href = 'admin.php';
        </script>";
    }else{
        var_dump($db->errorInfo());
    }
}
// uppdate new items
if(isset($_GET["item_name"])){
    $name = $_GET["item_name"];
    $photo =  $_GET['photo'];
    $description = $_GET['description'];
    $price = $_GET['price'];
    $category = $_GET['category'];
    $id = $_GET['id'];


    if ($db->query("UPDATE items SET name='$name', photo='$photo', description='$description', price=$price, category=$category 
    WHERE id=$id ")) {
        echo "<script>
        alert ('New item added sucsesfully');
        location.href = 'admin.php';
        </script>";
    }else{
        var_dump($db->errorInfo());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <a href="index.php">Come back</a>
    </header>
    <h1>Admin_Panel</h1>
<main>
    <section class="categories">
        <h2>Categories</h2>

        <div class="container">
            <form action="#" class="item">
                <label>
                    Name
                    <input type="text" name="new_cat" required>
                </label>


                <button>Add new category</button>
            </form>


           <?php foreach($categories as $item): ?>
                <form action="#" class="item">
                    <label>
                        Name
                        <input type="text" name="cat_name" value="<?= $item['name']; ?>">
                        <input type="hidden" name="id" value="<?= $item['id']; ?>">
                    </label>
                    <button>Refresh</button>
                    <button name="delete_cat">Delete</button>
                </form>
            <?php endforeach; ?>  
        </div>

    </section>

    <section class="items">
        <h2>Products</h2>

        <div class="container">
<!-- 1Form -->
        <form action="#" class="item">
                    <!-- <img src="<?= $item['photo']; ?>" alt="photo" width="100" height="100"> -->
                    
                    <label>
                        Name
                        <input type="text" name="new_item_name"  required > 
                    </label>
                    <label>
                        Photo Link
                        <input type="text" name="photo" required></label>
                    </label>
                        
                    <label>
                        Description
                        <textarea type="text" name="description" required></textarea>
                    </label>
                        
                    <label>
                        Price
                        <input type="number" min="0" name="price" required>
                    </label>
                   <label>
                    Category
                     <select name="category">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id']; ?>">
                                <?= $cat['name']; ?> 
                            </option>
                        <?php endforeach; ?>
                     </select>
                    </label>

                    <button>Add new products</button>
                </form>

           <?php foreach($items as $item): ?>
                <form action="#" class="item">
                    <img src="<?= $item['photo']; ?>" alt="photo" width="100" height="100">
                    
                    <label>
                        Name
                        <input type="text" name="item_name" value="<?= $item['name']; ?>">
                    </label>
                    <label>
                        Photo Link
                        <input type="text" name="photo" value="<?= $item['photo']; ?>"></label>
                    </label>
                        
                    <label>
                        Description
                        <textarea type="text" name="description"><?= $item['description']; ?></textarea>
                    </label>
                        
                    <label>
                        Price
                        <input type="number" min="0" name="price" value="<?= $item['price']; ?>">
                    </label>
                   <label>
                    Category
                     <select name="category">
                        <?php foreach ($categories as $cat): ?>
                            <option <?php if($item['category'] == $cat['id']) echo 'selected'; ?> value="<?= $cat['id']; ?>">
                                <?= $cat['name']; ?> 
                            </option>
                        <?php endforeach; ?>
                     </select>
                    </label>
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    <button name="delete">Delete</button>
                    <button>Refresh</button>
                </form>
              <?php endforeach; ?>  
        </div>

    </section>
</main>

</body>
</html>