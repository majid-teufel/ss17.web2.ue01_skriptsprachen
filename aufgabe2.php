<?php
/**
 * Created by PhpStorm.
 * User: jottd
 * Date: 13.05.2017
 * Time: 16:50
 */

class Ratings {

    public $pdo;

    public function __construct($database, $dbuser, $dbpass) {

        $this->pdo = new PDO($database, $dbuser, $dbpass);                    // Create PDO Object related to Database Variables above
    }

    public function getRatings($url) {

        $statement = $this->pdo->prepare('SELECT * FROM ratings WHERE url = :url');
        $statement->execute(['url' => $url]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);              // PDO::FETCH_ASSOC -- sonst wird alles doppelt übertragen!

        return $result;
    }

    public function printRatings($url) {

        $statement = $this->pdo->prepare('SELECT * FROM ratings WHERE url = :url');
        $statement->execute(['url' => $url]);
        $result = $statement->fetch();

        foreach($result as $entry) {
            echo "$entry<br>";
        }
    }
}

$dbhost = 'localhost';                                          // Database Variables
$dbname = 'ratings';
$database = "mysql:host=$dbhost;dbname=$dbname";
$dbuser = 'root';
$dbpass = '';

$url = 'musik-kneipe-eltmann.de';                               // Entity Variables
$rating = rand(1,10);
$ratings = new Ratings($database, $dbuser, $dbpass);

    // printRatings (echo within function)
    echo "<b>printRatings: </b><br>";
    $ratings->printRatings($url);

    // getRatings (echo outside function)
    echo "<br><br><b>getRatings: </b><br>";
    $result = $ratings->getRatings($url);

        foreach($result as $entry) {
            echo "$entry<br>";
        }



