<?php


require __DIR__ . "/../../config_session.php";
if (isset($_FILES["file"]) && isset($_POST["self"])) {
    echo processcover();
    exit;
}
if (isset($_FILES["file"]) && isset($_POST["target"])) {
    echo staffaddcover();
    exit;
}
if (isset($_POST["delete_cover"])) {
    $reset = resetCover($data);
    exit;
}
if (isset($_POST["remove_cover"])) {
    echo staffremovecover();
}
echo " ";

function processCover()
{
    global $mysqli;
    global $data;
    global $cody;
    if (!canCover()) {
        return boomCode(1);
    }
    ini_set("memory_limit", "128M");
    $info = pathinfo($_FILES["file"]["name"]);
    $extension = $info["extension"];
    if (fileError(3)) {
        return boomCode(7);
    }
    if (isCoverImage($extension)) {
        $imginfo = getimagesize($_FILES["file"]["tmp_name"]);
        if ($imginfo !== false) {
            list($width, $height) = $imginfo;
            $type = $imginfo["mime"];
            $fname = encodeFileTumb($extension, $data);
            $file_name = $fname["full"];
            $file_tumb = $fname["tumb"];
            boomMoveFile("cover/" . $file_name);
            $source = "cover/" . $file_name;
            $tumb = "cover/" . $file_tumb;
            if (canGifCover()) {
                $create = imageTumb($source, $tumb, $type, 500);
            } else {
                $create = imageTumbGif($source, $tumb, $type, 500);
            }
            if (sourceExist($source) && sourceExist($tumb)) {
                unlinkCover($file_name);
                unlinkCover($data["user_cover"]);
                $mysqli->query("UPDATE boom_users SET user_cover = '" . $file_tumb . "' WHERE user_id = '" . $data["user_id"] . "'");
                return boomCode(5, ["data" => myCover($file_tumb)]);
            }
            if (sourceExist($source)) {
                if (!canGifCover()) {
                    unlinkCover($file_name);
                    return boomCode(7);
                }
                unlinkCover($data["user_cover"]);
                $mysqli->query("UPDATE boom_users SET user_cover = '" . $file_name . "' WHERE user_id = '" . $data["user_id"] . "'");
                return boomCode(5, ["data" => myCover($file_name)]);
            }
            return boomCode(7);
        }
        return boomCode(1);
    }
    return boomCode(1);
}

function staffAddCover()
{
    global $mysqli;
    global $data;
    global $cody;
    $target = escape($_POST["target"]);
    $user = userDetails($target);
    if (!canModifyCover($user)) {
        return boomCode(1);
    }
    ini_set("memory_limit", "128M");
    $info = pathinfo($_FILES["file"]["name"]);
    $extension = $info["extension"];
    if (fileError(3)) {
        return boomCode(1);
    }
    if (isCoverImage($extension)) {
        $imginfo = getimagesize($_FILES["file"]["tmp_name"]);
        if ($imginfo !== false) {
            list($width, $height) = $imginfo;
            $type = $imginfo["mime"];
            $fname = encodeFileTumb($extension, $user);
            $file_name = $fname["full"];
            $file_tumb = $fname["tumb"];
            boomMoveFile("cover/" . $file_name);
            $source = "cover/" . $file_name;
            $tumb = "cover/" . $file_tumb;
            if (canGifCover()) {
                $create = imageTumb($source, $tumb, $type, 500);
            } else {
                $create = imageTumbGif($source, $tumb, $type, 500);
            }
            if (sourceExist($source) && sourceExist($tumb)) {
                unlinkCover($file_name);
                unlinkCover($user["user_cover"]);
                $mysqli->query("UPDATE boom_users SET user_cover = '" . $file_tumb . "' WHERE user_id = '" . $user["user_id"] . "'");
                return boomCode(5, ["data" => myCover($file_tumb)]);
            }
            if (sourceExist($source)) {
                if (!canGifCover()) {
                    unlinkCover($file_name);
                    return boomCode(7);
                }
                unlinkCover($user["user_cover"]);
                $mysqli->query("UPDATE boom_users SET user_cover = '" . $file_name . "' WHERE user_id = '" . $user["user_id"] . "'");
                return boomCode(5, ["data" => myCover($file_name)]);
            }
            return boomCode(7);
        }
        return boomCode(1);
    }
    return boomCode(1);
}

function staffRemoveCover()
{
    global $mysqli;
    global $data;
    global $cody;
    $target = escape($_POST["remove_cover"]);
    $user = userDetails($target);
    if (!canModifyCover($user)) {
        return 0;
    }
    resetCover($user);
    boomConsole("remove_cover", ["target" => $user["user_id"]]);
    return 1;
}

?>