<?
$command = "SELECT * FROM roundltc,dailytotal,round";
$q = mysql_query($command);
$dltc = mysql_query("SELECT * FROM `dailyltc`");
$rows = mysql_num_rows($q);
$rows2 = mysql_num_rows($dltc);
$i = 0;
while ($i < $rows) {
    $roundltc = mysql_result($q, $i, "roundltc");
    $dailytotal = mysql_result($q, $i, "dailytotal");
    $round = mysql_result($q, $i, "round");
    $i++;
    }
?>