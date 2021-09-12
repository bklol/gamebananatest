<?
    $keyword = $_GET["map"];
    if($keyword != "kz" && $keyword != "bhop" && $keyword != "surf")
    {
        echo "map fuck";
        exit();
    }
    if($keyword == "kz")
        $num = 5438;
    if($keyword == "bhop")
        $num = 5422;
    if($keyword == "surf")
        $num = 5425;
    $data = file("https://gamebanana.com/mods/cats/".$num);
    foreach ($data as $line_num => $line) 
    {
        if(strpos($line,"PreviewImage lazy"))
        {
            preg_match('/alt=".*" data-src/',$line,$m);
            echo str_replace(array("alt=\"","\" data-src"),"",$m[0])."<br>";
        }
        if(strpos($line,"https://gamebanana.com/mods/") && !strpos($line,"games") &&  !strpos($line,"cat")&&  !strpos($line,"a href"))
        {
            echo GetdlUrl(str_replace(array("href=\"","\">","\n","https://gamebanana.com/mods/"),"",$line))."<br>";
        }
        if(strpos($line,"https://images.gamebanana.com/img/ss/mods/"))
        {
            preg_match('/https.*jpg/',$line,$m);
            echo "<img src=\"".$m[0]."\"width=\"220\" height=\"130\" /> "."<br>";
        }
    }
    function GetdlUrl($index)
    {
        return json_decode(file_get_contents("https://gamebanana.com/apiv6/Mod/".$index."?_csvProperties=@gbdlpage"),true)["_aFiles"][0]["_sDownloadUrl"];
    }
