<?php 
    include "db.php";
    $xml = simplexml_load_file("test.xml");
    
    foreach ($xml->food as $position)
    {
        $name = $position->name;
        $price = $position->price;
        $description = $position->description;
        $calories = $position->calories;
        
        if (!R::findOne( 'food', ' name = ? ', [ (string)$name ] ))
        {
            $food = R::dispense('food');
            $food->name = (string)$name;
            $food->price = (string)$price;
            $food->description = (string)$description;
            $food->calories = (string)$calories;
            #var_dump($food);
            R::store($food);
            echo '<h1>Сохранено</h1>';
        }
        else
        {
            echo 'В бд уже есть данные.';
        }
    }
    $data_from_db = R::getAll('SELECT * FROM food');
    $fp = fopen("file.json", "w");
    fwrite($fp, json_encode($data_from_db, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    fclose($fp);
?>
