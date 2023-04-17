<?php


require __DIR__ . "/../../../../config_session.php";
if (!boomAllow(8)) {
    exit;
}
echo elementTitle($lang["users_management"]);
echo "<div class=\"page_full\">\r\n\t<div class=\"page_element\">\r\n\t\t";
if (boomAllow(10)) {
    echo "\t\t<button onclick=\"createUser();\" class=\"theme_btn bmargin10 reg_button\"><i class=\"fa fa-plus-circle\"></i> ";
    echo $lang["add_user"];
    echo "</button>\r\n\t\t";
}
echo "\t\t<p class=\"label\">";
echo $lang["search_member"];
echo "</p>\r\n\t\t<div class=\"admin_search\">\r\n\t\t\t<div class=\"admin_input bcell\">\r\n\t\t\t\t<input class=\"full_input\" id=\"member_to_find\" type=\"text\"/>\r\n\t\t\t</div>\r\n\t\t\t<div id=\"search_member\" class=\"admin_search_btn default_btn\">\r\n\t\t\t\t<i class=\"fa fa-search\" aria-hidden=\"true\"></i>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t\t<div class=\"setting_element \">\r\n\t\t\t<p class=\"label\">";
echo $lang["advance_search"];
echo "</p>\r\n\t\t\t<select id=\"member_critera\">\r\n\t\t\t\t";
echo "<option value=\"0\" selected disabled>";
echo $lang["select_critera"];
echo "</option>\r\n\t\t\t\t";
echo listRank(0);
echo "\t\t\t</select>\r\n\t\t</div>\r\n\t</div>\r\n\t<div class=\"page_full\" id=\"member_list\">\r\n\t\t<div class=\"page_element\">\r\n\t\t\t\t";
echo listlastmembers();
echo "\t\t</div>\r\n\t</div>\r\n</div>";

function listLastMembers()
{
    global $mysqli;
    global $lang;
    $list_members = "";
    $getmembers = $mysqli->query("SELECT * FROM boom_users WHERE user_rank != 0 AND user_bot = 0 ORDER BY user_join DESC LIMIT 50");
    if (0 < $getmembers->num_rows) {
        while ($members = $getmembers->fetch_assoc()) {
            $list_members .= boomTemplate("element/admin_user", $members);
        }
    } else {
        $list_members .= emptyZone($lang["empty"]);
    }
    return $list_members;
}

?>