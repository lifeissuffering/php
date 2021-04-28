<?php
function calculate(&$data)
    {
        $balance = 0;
       
        for ($i = 1; $i <= $data[0]; $i++) 
        {
            $bet = (int)trim(explode(" ", $data[$i])[1]);
            $balance = $balance - $bet;
            $game_string = $data[(int)$data[0] + 1 + (int)explode(" ", $data[$i])[0]];
            $outcome_bet = trim(explode(" ", $data[$i])[2]);
            $outcome_game = trim(explode(" ", $game_string)[4]);
            if ($outcome_bet == $outcome_game) 
            {
                if ($outcome_bet == "L") 
                {
                    $balance = $balance + $bet * (float)explode(" ", $game_string)[1];
                }
                if ($outcome_bet == "R") 
                {
                    $balance = $balance + $bet * (float)explode(" ", $game_string)[2];
                }
                if ($outcome_bet == "D") 
                {
                    $balance = $balance + $bet * (float)explode(" ", $game_string)[3];
                }
            }
        }
        return $balance;
    }
?>