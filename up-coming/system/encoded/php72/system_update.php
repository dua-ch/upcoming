<?php


require __DIR__ . "/../../config_session.php";
if (isset($_POST["version_install"]) && boomAllow(11)) {
    $version = escape($_POST["version_install"]);
    echo boomupdatechat($version);
    exit;
}
exit;

function boomUpdateChat($v)
{
    global $mysqli;
    global $data;
    global $cody;
    if ($v <= $data["version"]) {
        return boomCode(0, ["error" => "Version is already installed"]);
    }
    $fpath = BOOM_PATH . "/updates/" . $v . "/files.zip";
    $upath = BOOM_PATH . "/updates/" . $v . "/update.php";
    $epath = BOOM_PATH . "/";
    if (file_exists($fpath)) {
        $zip = new ZipArchive();
        if ($zip->open($fpath) !== true) {
            return boomCode(0, ["error" => "unable to process automatic update please refer to manual update procedure or contact us for support."]);
        }
        $zip->extractTo($epath);
        $zip->close();
    }
    if (file_exists($upath)) {
        require $upath;
    }
    return boomCode(2);
}

?>