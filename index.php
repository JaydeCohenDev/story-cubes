<?php
$num = $_GET["n"] ?? 3;
//https://game-icons.net/icons/ffffff/000000/1x1/cathelineau/bad-gnome.svg
$icon_map = json_decode(file_get_contents("https://game-icons.net/sitemaps/icons.json"), true)["icons"]["1x1"];
//var_dump($icon_map);

function get_rand_author()
{
    global $icon_map;

    $totalWeight = 0;
    foreach($icon_map as $author => $icons)
    {
        $totalWeight += count($icons);
    }

    $randVal = rand(0, $totalWeight);

    foreach($icon_map as $author => $icons)
    {
        $randVal -= count($icons);
        if($randVal <= 0)
        {
            return $author;
        }
    }

    return "";
}    

function get_rand_icon_name($author)
{
    global $icon_map;
    $icon = array_rand($icon_map[$author], 1);
    return $icon_map[$author][$icon];
}

function show_rand_icon()
{
    echo "<div style='width:250px;height:250px'>";
    $aa = get_rand_author();
    $ii = get_rand_icon_name($aa);
    echo file_get_contents("https://game-icons.net/icons/ffffff/000000/1x1/".$aa."/".$ii.".svg");
    echo "</div>";
}

echo "<div style='display:flex'>";
for($i = 0; $i < $num; $i++)
    show_rand_icon();

echo "</div>"
?>
<html>
    <style>
        body {
            background-color: #000;
        }
        </style>
</html>