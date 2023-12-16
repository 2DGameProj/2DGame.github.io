<!DOCTYPE html>
<html>
    <head>
    <meta name = "viewport" content = "with=deivce-width, initials - scale = 1.0" charset="UTF-8">
        <title>Simple 2D Game</title>
        <link rel = "stylesheet" href = "records.css">
        <link href="https://fonts.cdnfonts.com/css/cascadia-code" rel="stylesheet">
        <link href=" https://cdn.jsdelivr.net/npm/css.gg@2.0.0/icons/all.min.css " rel="stylesheet">
    </head>
    <body>
    <section class = "header">
            <nav>
            <a href="https://youtu.be/aZWWlqDy8nE?t=2"> <img src = "images/logo.png" width="100" height="90"> </a>
            <div class="nav-links" id = "navLinks">
                <ul>
                    <li> <a href = "./index.html">Home</a> </li>
                    <li> <a href = "./records.php"> Records</a> </li>
                    <li> <a href = "./developers.html">Developers</a> </li>
                    <li> <a href = "./textures.html">Textures</a> </li>
                    <li> <a href = "game/Plank Game.zip" download>Download</a> </li>
                </ul>
            </div>
            

            <div class="pcmenu">
                <input type="checkbox" id="side-checkbox" />            
                <div class="side-panel">
                    <label class="side-button-2" for="side-checkbox">+</label>    
                    <div class="side-title"></div>
                    <li> <a href = "./index.html">Home</a> </li>
                    <li> <a href = "./records.php"> Records</a></li>
                    <li> <a href = "./developers.html">Developers</a> </li>
                    <li> <a href = "./textures.html">Textures</a> </li>
                    <li> <a href = "game/Plank Game.zip" download>Download</a> </li>
                </div>
                <div class="side-button-1-wr">
                    <label class="side-button-1" for="side-checkbox">
                        <div class="side-b side-open"><i class="gg-menu"></i></div>
                        <div class="side-b side-close"></div>
                    </label>
                </div>
            </div>
        </div>
    </nav>
    <?php
        $conn_string = 
        "host = dpg-clurgida73kc73bk2c9g-a.frankfurt-postgres.render.com
        port=5432 
        dbname=gamedb_j97j
        user=gamedb_j97j_user 
        password=kS2gdLdEWYY9FuoAhZihxybyZvbNV2B1";
        $conn = pg_connect($conn_string);
        if (!$conn) {
            echo "Error";
        }
    ?>
    <nav>
        <div class = "table-style">
                <?php 
                echo "<table>";
                echo"<tr><th>Nickname</th><th>kill count</th><th>Score</th><th>Time</th></tr>";
                $result = pg_query($conn,"SELECT u.nickname, s.kill_count, s.score_count, se.total_time  FROM statistic s JOIN session se ON s.session_id = se.session_id JOIN \"user\" u ON se.\"HWID\" = u.\"HWID\"");
                if(!$result)
                {
                    echo "Error in query!";
                }
                while ($row = pg_fetch_assoc($result))
                {
                    $v_minutes = (int)($row["total_time"] / 60);
                    $v_seconds = (int)$row["total_time"] % 60;
                    $v_milliseconds = (int)($row["total_time"] * 1000) % 1000;
                    $row["formated_time"] = sprintf("%02d:%02d:%03d", $v_minutes, $v_seconds, $v_milliseconds);
                    echo "<tr>";
                    echo "<td>".$row['nickname']."</td>";
                    echo "<td>".$row["kill_count"]."</td>";
                    echo "<td>".$row["score_count"]."</td>";
                    echo "<td>".$row["formated_time"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                pg_free_result($result);
                pg_close($conn);
                ?>
    </nav>
    </section>
    </body>
</html>