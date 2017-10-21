<?php

session_start();
echo '<html><body><table border = "1">';
{
//check if path is set in session
    if (isset($_SESSION['path'])) {
        $flag = true;
        $path = $_SESSION['path'];
        //check if file exists
        if (file_exists($path)) {
            //open and read csv file line by line
            $f = fopen($path, "r");

            while (($line = fgetcsv($f)) !== false) {
                echo "<tr>";
                foreach ($line as $cell) {
                    if ($flag) {
                        //make first line bold
                        echo "<th>" . htmlspecialchars($cell) . "</th>";
                    } else {
                        //print rest of the line normally
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                }
                echo "</tr>";
                $flag = false;
            }
            fclose($f);
        }
    }
}
echo "\n</table></body></html>";
