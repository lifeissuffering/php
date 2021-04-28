<?php
    include "calculate.php";

    $start = microtime(true);

    $output_files = glob("A/*.ans");
    $input_files = glob("A/*.dat");

    $answers = array();
    foreach ($output_files as $output_file) 
    {
        $str = file_get_contents($output_file);
        array_push($answers, $str);
    }
    $index = 0;
    foreach ($input_files as $input_file) 
    {
        $data = array();
        $fs = fopen($input_file, 'r') or die("Err");
        while (!feof($fs)) 
        {
            $str = htmlentities(fgets($fs, 600));
            array_push($data, $str);
            $i = $i + 1;
        }
        if (calculate($data) == $answers[$index]){
            echo '<h1>OK</h1> Тест №' . (string)($index+1) 
            . '. Правильный ответ = ' . $answers[$index] . ' <br><hr/>';
        }
        else
        {
            echo '<h1>Ошибка.</h1>. Тест №' . (string)($index+1) 
            . '. Правильный ответ = ' . $answers[$index] . ' <br><hr/>';
        }
        fclose($fs);
        $index = $index + 1;
    }
    
    $finish = microtime(true);
    $delta = $finish - $start;
    echo '<h2>Время выполнения скрипта:</h2><h1> ' . $delta . ' секунды</h1>';
?>