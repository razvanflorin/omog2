<?php
//MOGame2
 $simulador_name="시뮬레이터";
 $simulador_desc="게임 상황을 예측합니다.";
 $config_line .= AdmPlugin($simulador_name, $simulador_desc);
 if(PluginAct($simulador_name) == 1){
    
$lang['lm_overview']    .='</a></font></div></td></tr><tr><td><div align="center"><font color="#FFFFFF"><a href="game.php?page=simulador">시뮬레이터';

    $page=$_GET['page'];
        
if(is_phpself('game') && $page=='simulador'){ 
    //Función del chatarrero, copyright de sus respectivos creadores
    function simulador($planetrow) {
    
    global $pricelist, $ressource, $xgp_root, $phpEx, $user, $ProdGrid, $lang, $dpath;


    include($xgp_root . 'includes/functions/CheckPlanetBuildingQueue.' . $phpEx);
    include($xgp_root . 'includes/functions/GetBuildingPrice.' . $phpEx);
    include($xgp_root . 'includes/functions/IsElementBuyable.' . $phpEx);
    include($xgp_root . 'includes/functions/SetNextQueueElementOnTop.' . $phpEx);
    include($xgp_root . 'includes/functions/UpdatePlanetBatimentQueueList.' . $phpEx);
    include_once($xgp_root . 'includes/functions/RoundUp.' . $phpEx);

    $parse = $lang;
    
  
if(isset($_POST['submit'])) {

    // !-------------------------------------------------------------------------------------------------------------------------------------! //

    // Lets get fleet.
    // ACS function: put all fleet into an array
    $attackFleets = array();

    /*        
    $fleets = doquery('SELECT * FROM {{table}} WHERE fleet_group='.$FleetRow['fleet_group'],'fleets');
    while ($fleet = mysql_fetch_assoc($fleets)) {
        $attackFleets[$fleet['fleet_id']]['fleet'] = $fleet;
        $attackFleets[$fleet['fleet_id']]['user'] = doquery('SELECT * FROM {{table}} WHERE id='.$fleet['fleet_owner'],'users', true);
        $attackFleets[$fleet['fleet_id']]['detail'] = array();
        $temp = explode(';', $fleet['fleet_array']);
        foreach ($temp as $temp2) {
            //!! check line below!!
            $temp2 = explode(',', $temp2);
            if ($temp2[0] < 100) continue;
            if (!isset($attackFleets[$fleet['fleet_id']]['detail'][$temp2[0]])) $attackFleets[$fleet['fleet_id']]['detail'][$temp2[0]] = 0;
            $attackFleets[$fleet['fleet_id']]['detail'][$temp2[0]] += $temp2[1];
        }
    }
    */
    


//Generic
    $attackFleets_fleet_mr['fleet_id'] = 0;
    $attackFleets_fleet_mr['fleet_owner'] = 0;
    $attackFleets_fleet_mr['fleet_mission'] = 0;
    $attackFleets_fleet_mr['fleet_amount'] = 0;
    $attackFleets_fleet_mr['fleet_array'] = 0;
    $attackFleets_fleet_mr['fleet_start_time'] = time();
    $attackFleets_fleet_mr['fleet_start_galaxy'] = 0;
    $attackFleets_fleet_mr['fleet_start_system'] = 0;
    $attackFleets_fleet_mr['fleet_start_planet'] = 0;
    $attackFleets_fleet_mr['fleet_start_type'] = 0;
    $attackFleets_fleet_mr['fleet_end_time'] = (time() + 10);
    $attackFleets_fleet_mr['fleet_end_stay'] = 0;
    $attackFleets_fleet_mr['fleet_end_galaxy'] = 0;
    $attackFleets_fleet_mr['fleet_end_system'] = 0;
    $attackFleets_fleet_mr['fleet_end_plane'] = 0;
    $attackFleets_fleet_mr['fleet_end_type'] = 0;
    $attackFleets_fleet_mr['fleet_taget_owner'] = 0;
    $attackFleets_fleet_mr['fleet_resource_metal'] = 0;
    $attackFleets_fleet_mr['fleet_resource_crystal'] = 0;
    $attackFleets_fleet_mr['fleet_resource_deuterium'] = 0;
    $attackFleets_fleet_mr['fleet_target_owner'] = 0;
    $attackFleets_fleet_mr['fleet_group'] = 0;
    $attackFleets_fleet_mr['fleet_mess'] = 0;
    $attackFleets_fleet_mr['start_time'] = (time() - 10);

    for ($fleet_id_mr = 1; $fleet_id_mr < 2; $fleet_id_mr++) {
        $fleet_code[$fleet_id_mr] = '';
        $fleet_count[$fleet_id_mr] = '';
        for ($i = 200; $i < 400; $i++) {
            $fleet_us_mr = $_POST['fleet_us'];
            if($fleet_us_mr[$fleet_id_mr][$i] > 0){
                $fleet_code[$fleet_id_mr]  .= $i.",".$fleet_us_mr[$fleet_id_mr][$i].";";
                $fleet_count[$fleet_id_mr] += $fleet_us_mr[$fleet_id_mr][$i];
            }
        }

        $attackFleets[$fleet_id_mr]['fleet'] = $attackFleets_fleet_mr;
        $attackFleets[$fleet_id_mr]['fleet']['fleet_id'] = $fleet_id_mr;
        $attackFleets[$fleet_id_mr]['fleet']['fleet_owner'] = $fleet_id_mr;
        $attackFleets[$fleet_id_mr]['fleet']['fleet_amount'] = $fleet_count[$fleet_id_mr];
        $attackFleets[$fleet_id_mr]['fleet']['fleet_array'] = $fleet_code[$fleet_id_mr];

        $rpg_amiral_us_mr    = $_POST['rpg_amiral_us'];
        $defence_tech_us_mr  = $_POST['defence_tech_us'];
        $shield_tech_us_mr   = $_POST['shield_tech_us'];
        $military_tech_us_mr = $_POST['military_tech_us'];

        $attackFleets[$fleet_id_mr]['user']['rpg_amiral']    = $rpg_amiral_us_mr[$fleet_id_mr];
        $attackFleets[$fleet_id_mr]['user']['defence_tech']  = $defence_tech_us_mr[$fleet_id_mr];
        $attackFleets[$fleet_id_mr]['user']['shield_tech']   = $shield_tech_us_mr[$fleet_id_mr];
        $attackFleets[$fleet_id_mr]['user']['military_tech'] = $military_tech_us_mr[$fleet_id_mr];
    
        $attackFleets[$fleet_id_mr]['detail'] = array();
        $temp = explode(';', $attackFleets[$fleet_id_mr]['fleet']['fleet_array']);
        foreach ($temp as $temp2) {
            //!! check line below!!
            $temp2 = explode(',', $temp2);
            if ($temp2[0] < 100) continue;
            if (!isset($attackFleets[$fleet_id_mr]['detail'][$temp2[0]])) $attackFleets[$fleet_id_mr]['detail'][$temp2[0]] = 0;
            $attackFleets[$fleet_id_mr]['detail'][$temp2[0]] += $temp2[1];
        }
    }

    // !---------------------------------------------------------------------------------------------------------------------------!//

    //Lets get Defense        
    $defense = array();

    // Get ACS Defend fleets. (stationed on the planet)
    /*
    for ($fleet_id_mr = 101; $fleet_id_mr < 104; $fleet_id_mr++) {
        $fleet_code[$fleet_id_mr] = '';
        $fleet_count[$fleet_id_mr] = '';
        for ($i = 200; $i < 300; $i++) {
            $fleet_them_mr = $_POST['fleet_them'];
            if($fleet_them_mr[$fleet_id_mr][$i] > 0){
                $defense[$defRow['fleet_id']]['def'][$i] += $fleet_them_mr[$fleet_id_mr][$i];
            }    
        }
        $rpg_amiral_them_mr    = $_POST['rpg_amiral_them'];
        $defence_tech_them_mr  = $_POST['defence_tech_them'];
        $shield_tech_them_mr   = $_POST['shield_tech_them'];
        $military_tech_them_mr = $_POST['military_tech_them'];

        $defense[$fleet_id_mr]['user']['rpg_amiral']    = $rpg_amiral_them_mr[$fleet_id_mr];
        $defense[$fleet_id_mr]['user']['defence_tech']  = $defence_tech_them_mr[$fleet_id_mr];
        $defense[$fleet_id_mr]['user']['shield_tech']   = $shield_tech_them_mr[$fleet_id_mr];
        $defense[$fleet_id_mr]['user']['military_tech'] = $military_tech_them_mr[$fleet_id_mr];
    }
    */
    $rpg_amiral_them_mr    = $_POST['rpg_amiral_them'];
    $defence_tech_them_mr  = $_POST['defence_tech_them'];
    $shield_tech_them_mr   = $_POST['shield_tech_them'];
    $military_tech_them_mr = $_POST['military_tech_them'];

    $defense[0]['user']['rpg_amiral']    = $rpg_amiral_them_mr[0];
    $defense[0]['user']['defence_tech']  = $defence_tech_them_mr[0];
    $defense[0]['user']['shield_tech']   = $shield_tech_them_mr[0];
    $defense[0]['user']['military_tech'] = $military_tech_them_mr[0];

            
    $defense[0]['def'] = array();
    for ($i = 200; $i < 500; $i++) {
        $fleet_them_mr = $_POST['fleet_them'];
        if($fleet_them_mr[0][$i] > 0){
            $defense[0]['def'][$i] = $fleet_them_mr[0][$i];
        }
    }

    // Lets calcualte attack...

    $start = microtime(true);
    $result = calculateAttack($attackFleets, $defense);
    $totaltime = microtime(true) - $start;
    

    // moon chance

    $FleetDebris      = $result['debree']['att'][0] + $result['debree']['def'][0] + $result['debree']['att'][1] + $result['debree']['def'][1];

    $MoonChance       = $FleetDebris / 10000000;
           if ($FleetDebris > 35000000) {
        $UserChance = mt_rand(1, 100);
        $MoonChance = 20;
    } elseif ($FleetDebris < 10000000) {
        $UserChance = 0;
        $ChanceMoon = "";
    } elseif ($FleetDebris >= 10000000) {
        $UserChance = mt_rand(1, 100);
        $ChanceMoon = sprintf ($lang['sys_moonproba'], $MoonChance);
    }    
        
    if (($UserChance > 0) && ($UserChance <= $MoonChance) /*&& ($galenemyrow['id_luna'] == 0)*/) {
        //$TargetPlanetName = CreateOneMoonRecord ( $FleetRow['fleet_end_galaxy'], $FleetRow['fleet_end_system'], $FleetRow['fleet_end_planet'], $TargetUserID, $FleetRow['fleet_start_time'], '', $MoonChance );
        $GottenMoon       = sprintf ($lang['sys_moonbuilt'], $TargetPlanetName, $FleetRow['fleet_end_galaxy'], $FleetRow['fleet_end_system'], $FleetRow['fleet_end_planet']);
        $GottenMoon .= "<br />";
    } else {
        $GottenMoon = "";
    }

    // Resources stolen...    
    
    $steal = array('metal' => 0, 'crystal' => 0, 'deuterium' => 0);
    if ($result['won'] == 1) {
        // Calculate new fleet maximum resources for base attacker
        $max_resources = 0;
        foreach ($attackFleets[1]['detail'] as $Element => $amount) {
            $max_resources += $pricelist[$Element]['capacity'] * $amount;
        }
            
        if ($max_resources > 0) {
            $metal   = $targetPlanet['metal'] / 2;
            $crystal = $targetPlanet['crystal'] / 2;
            $deuter  = $targetPlanet['deuterium'] / 2;
            if ($metal > $max_resources / 3) {
                $steal['metal']         = $max_resources / 3;
                $max_resources         = $max_resources - $steal['metal'];
            } else {
                $steal['metal']         = $metal;
                $max_resources        -= $steal['metal'];
            }
            
            if ($crystal > $max_resources / 2) {
                $steal['crystal'] = $max_resources / 2;
                $max_resources   -= $steal['crystal'];
            } else {
                $steal['crystal'] = $crystal;
                $max_resources   -= $steal['crystal'];
            }
                
            if ($deuter > $max_resources) {
                $steal['deuterium']     = $max_resources;
                $max_resources        -= $steal['deuterium'];
            } else {
                $steal['deuterium']     = $deuter;
                $max_resources        -= $steal['deuterium'];
            }
        }
                
        $steal = array_map('round', $steal);
                
        //$steal['metal']
        //$steal['crystal']
        //$steal['deuterium']
    }



    // !---------------------------------------------------------------------------------------------------------------------------------! //

    //Code checkpoint 1 (for finding this point again

    $formatted_cr = formatCR($result,$steal,$MoonChance,$GottenMoon,$totaltime);

    // Well lets just copy rw.php code. If I am showing a cr why re-inent the wheel???
  $Page  = "<html>";
    $Page .= "<head>";
    $Page .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$dpath."/formate.css\">";
    $Page .= "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />";
    $Page .= "</head>";
    $Page .= "<body>";
    $Page .= "<center>";
    $Page .= "</div>";
    //OK, one change, we won't be getting cr from datbase, instead we will be generating it directly, lets skip the database stage, this is what get generated and put in the database.
    $report = stripslashes($formatted_cr['html']);
    foreach ($lang['tech_rc'] as $id => $s_name) {
        $str_replace1  = array("[ship[".$id."]]");
        $str_replace2  = array($s_name);
        $report = str_replace($str_replace1, $str_replace2, $report);
    }
    $no_fleet = "<table border=1 align=\"center\"><tr><th>타입</th></tr><tr><th>Total</th></tr><tr><th>무기</th></tr><tr><th>방어막</th></tr><tr><th>장갑</th></tr></table>";
    $destroyed = "<table border=1 align=\"center\"><tr><th><font color=\"red\"><strong>파괴되었습니다!</strong></font></th></tr></table>";
    $str_replace1  = array($no_fleet);
    $str_replace2  = array($destroyed);
    $report = str_replace($str_replace1, $str_replace2, $report);
    $Page .= $report;

    $Page .= "<br /><br />";
    //We we aren't gonna chare this reoprt because we cheated so it acutally doesn't exist.
    $Page .= "이 기록을 복사할 수 없습니다.";
    $Page .= "<br /><br />";
    $Page .= "</center>";
    $Page .= "</body>";
    $Page .= "</html>";

    echo $Page;

// Now its Sonyedorlys input form. Many thanks for allowing me to use it. (Slightly edited)
} else {
    $parse['military'] = 0;
    $parse['defence'] = 0;
    $parse['shield'] = 0;
    if($user['military_tech'] != '') $parse['military'] = $user['military_tech'];
    if($user['defence_tech'] != '') $parse['defence'] = $user['defence_tech'];
    if($user['shield_tech'] != '') $parse['shield'] = $user['shield_tech'];
    $parse['metal'] = 0;
    $parse['crystal'] = 0;
    $parse['deuterium'] = 0;
    for ($SetItem = 109; $SetItem <= 111; $SetItem++) $parse[$SetItem] = 0;
    for ($SetItem = 200; $SetItem <= 500; $SetItem++) $parse[$SetItem] = 0;
    if($_GET['raport'] != '') {
        $esprep = mysql_fetch_assoc(doquery("SELECT message_text FROM {{table}} WHERE `message_id` = '".$_GET['raport']."'", 'messages'));
        $esprep = $esprep['message_text'];
        $esprep = preg_replace("/<(.*?)>/","\n", $esprep);
        //echo $esprep;
        preg_match("/\[(.*?):(.*?):(.*?)\]/", $esprep, $matches);
        $parse['target_galaxy'] = $matches[1];
        $parse['target_system'] = $matches[2];
        $parse['target_planet'] = $matches[3];
        preg_match("/Metal\n\n(.*?)\n\n&nbsp;\n\nCrystal\n\n\n(.*?)\n\n\n\nDeuterium\n\n(.*?)\n\n&nbsp;/", $esprep, $matches);
        $parse['metal'] = $matches[1];
        $parse['crystal'] = $matches[2];
        $parse['deuterium'] = $matches[3];
        for ($SetItem = 109; $SetItem <= 111; $SetItem++) {
            if($lang["tech"][$SetItem] != "" && strpos($lang["tech"][$SetItem], $esprep) != -1) {
                preg_match("/".$lang["tech"][$SetItem]."\n\n(.*?)\n/", $esprep, $matches);
                if($matches[1] != '') $parse[$SetItem] = $matches[1];
                else $parse[$SetItem] = 0;
            } else $parse[$SetItem] = 0;
        }
        for ($SetItem = 200; $SetItem < 500; $SetItem++) {
            if($lang["tech"][$SetItem] != "" && strpos($lang["tech"][$SetItem], $esprep) != -1) {
                preg_match("/".$lang["tech"][$SetItem]."\n\n(.*?)\n/", $esprep, $matches);
                if($matches[1] != '') $parse[$SetItem] = $matches[1];
                else $parse[$SetItem] = 0;
            } else $parse[$SetItem] = 0;
        }
    }
    $page = "<div id='content'><form action='game.php?page=simulador' method='post'><center><table><tr><td>게임 시뮬레이터<br />";
    $page .= "<table border=1 width=100%><tr><td class=\"c\">&nbsp;</td><td class=\"c\">공격자</td><td class=\"c\">방어자</td></tr>";
    $page .= "<tr><td class=\"c\" colspan=\"3\">기술</td></tr>";
    $page .= "<tr><th>무기 기술</th><th><input type='text' name='military_tech_us[1]' value='".$parse['military']."'></th><th><input type='text' name='military_tech_them[0]' value='".$parse[109]."'></th></tr>";
    $page .= "<tr><th>방어 기술</th><th><input type='text' name='defence_tech_us[1]' value='".$parse['defence']."'></th><th><input type='text' name='defence_tech_them[0]' value='".$parse[110]."'></th></tr>";
    $page .= "<tr><th>방어막 기술</th><th><input type='text' name='shield_tech_us[1]' value='".$parse['shield']."'></th><th><input type='text' name='shield_tech_them[0]' value='".$parse[111]."'></th></tr>";
    for ($SetItem = 200; $SetItem < 500; $SetItem++) {
        if($lang["tech"][$SetItem] != "") {
            if(floor($SetItem/100)*100 == $SetItem) $page .= "<tr><td class=\"c\" colspan=\"3\">".$lang["tech"][$SetItem]."</td></tr>";
            else {
                $page .= "<tr><th>".$lang["tech"][$SetItem]."</th>";
                if($SetItem < 400)
                    $page .= "<th><input type='text' name='fleet_us[1][".$SetItem."]' value='0'></th><th><input type='text' name='fleet_them[0][".$SetItem."]' value='".$parse["$SetItem"]."'></th></tr>";
                else
                    $page .= "<th>&nbsp;</th><th><input type='text' name='fleet_them[0][".$SetItem."]' value='".$parse["$SetItem"]."'></th></tr>";
            }
        }
    }
    $page .= "<tr><td class=\"c\" colspan=\"3\">자원</td></tr>";
    $page .= "<tr><th>메탈</th><th>&nbsp;</th><th><input type='text' name='metal' value='".$parse['metal']."'></th></tr>";
    $page .= "<tr><th>크리스탈</th><th>&nbsp;</th><th><input type='text' name='crystal' value='".$parse['crystal']."'></th></tr>";
    $page .= "<tr><th>듀테륨</th><th>&nbsp;</th><th><input type='text' name='deuterium' value='".$parse['deuterium']."'></th></tr>";
    $page .= "<tr><th colspan='3'><input type='submit' name='submit' value='예측하기'></th></tr>";
    $page .= "</table></center></form></div>";
    display($page, "Combat Simulator", false);
}

function rp($input) {
    return str_replace(".", "", $input);
}
    
    }
    
    include($xgp_root . 'includes/functions/SortUserPlanets.' . $phpEx);
    
    $dpath     = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
    include($xgp_root . 'includes/functions/SetSelectedPlanet.' . $phpEx);
    SetSelectedPlanet ($user);

    $planetrow = doquery("SELECT * FROM `{{table}}` WHERE `id` = '".$user['current_planet']."';", "planets", true);

    include($xgp_root . 'includes/functions/CheckPlanetUsedFields.' . $phpEx);
    CheckPlanetUsedFields($planetrow);
    
    
    simulador($CurrentUser, $CurrentPlanet, $PlanetRow);
    break;
    } 
}
?>