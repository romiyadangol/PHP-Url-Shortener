<?php
    require "connect.php";
    ##insert data
    if(isset($_POST['shorten'])){
        $long_url = $_POST['long_url'];
        $short_url = substr(md5(uniqid(mt_rand(), true)), 0, 7);

        $sql = "INSERT INTO `url` (long_url, short_url) VALUES ('$long_url', 'http://localhost:8080/$short_url')";

        if(mysqli_query($conn, $sql)){
            header("Location: " . $_SERVER['PHP_SELF']);
            echo "URL Shortened Successfully";
        }else{
            echo "Unsuccesful, Try Again!";
        }
    }

    if(isset($_POST['search'])){
        $short_url = $_POST['short_url'];
        $sql = "SELECT * FROM `url` WHERE short_url = '$short_url'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($row){
            header("Location: ".$row['long_url']);
        }else{
            echo "URL Not Found";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Url Shortner</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <main>
        <form action="/" method="post">
            <h1>Enter a URL to Shorten</h1>
            <input type="text" name="long_url" id="url" placeholder="Enter your URL"><br><br>
            <button type="submit" name="shorten">ShortenURL</button>
        </form>

        <form action="/" method="post">
            <h1>Enter the Shorten URL</h1>
            <input type="text" name="short_url" id="url" placeholder="Enter your URL"><br><br>
            <button type="submit" name="search">Search</button>
        </form>
        <table border='1'>
            <tr>
                <th>Long URL</th>
                <th>Short URL</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `url`";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$row['long_url']."</td>";
                        echo "<td>".$row['short_url']."</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>
  
    </main>
</body>
</html>