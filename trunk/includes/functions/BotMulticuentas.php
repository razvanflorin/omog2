<?php 

function MulticuentasBot ($FleetRow) 
{ 
    $esmulticuenta=0; 
 
    if ($FleetRow['fleet_mess'] == 0 && $FleetRow['fleet_start_time'] <= time() ) 
    { 
        //Obtenemos los datos del jugador que recibe a la flota 
        $QryTargetUser  = "SELECT * FROM {{table}} "; 
        $QryTargetUser .= "WHERE "; 
        $QryTargetUser .= "`id` = '". $FleetRow['fleet_target_owner'] ."';"; 
        $TargetUser     = doquery( $QryTargetUser, 'users', true); 
        $TargetUserID   = $TargetUser['id']; 
        $TargetUserIP     = $TargetUser['user_lastip']; 
        $TargetUserName = $TargetUser['username']; 
 
        //Obtenemos los datos del jugador que envía la flota 
        $QryCurrentUser   = "SELECT * FROM {{table}} "; 
        $QryCurrentUser  .= "WHERE "; 
        $QryCurrentUser  .= "`id` = '". $FleetRow['fleet_owner'] ."';"; 
        $CurrentUser      = doquery($QryCurrentUser , 'users', true); 
        $CurrentUserID  = $CurrentUser['id']; 
        $CurrentUserIP    = $CurrentUser['user_lastip']; 
        $CurrentUserName = $CurrentUser['username']; 
 
        //Si las IPs son iguales pero los IDs de los jugadores son distintos, o sea que no nos mandamos la flota a un planeta nuestro 
        if($CurrentUserIP == $TargetUserIP && $CurrentUserID != $TargetUserID) 
        { 
            $Time = time(); 
 
            $remitente = "Bot de Control Multicuentas"; 
            $titulo = "Actividad desde una misma IP"; 
            $mensaje1= "Un movimiento de flotas acaba de ser reportado al Administrador del juego, <br> ya que se lanz&oacute; a un jugador con su misma IP. <br> Por favor, evite este tipo de cosas."; 
            $mensaje2= "Un movimiento de flotas de un jugador con la misma IP ha sido reportada al Administrador del juego. <br> Por favor, evite este tipo de cosas."; 
            $mensaje3 = "<b>Dos usuarios fueron detectados violando la norma de multicuentas. <br> El jugador ".$CurrentUserName."(ID=".$CurrentUserID.") interactu&oacute; con ".$TargetUserName."(ID=".$TargetUserID.")"; 
            $AdminID = 1; //Cambiar 1 por el ID del administrador 
 
            //function SendSimpleMessage ( $Owner, $Sender, $Time, $Type, $From, $Subject, $Message) 
            SendSimpleMessage ( $CurrentUserID, '', $time, 1, $remitente, $titulo, $mensaje1 ); // MP al jugador 1 
            SendSimpleMessage ( $TargetUserID, '', $time, 1, $remitente, $titulo, $mensaje2 );  // MP al jugador 2 
            SendSimpleMessage ( $AdminID, '', $time, 1, $remitente, $titulo, $mensaje3 );       // MP al Administrador del juego 
 
            //Eliminamos de la tabla el movimiento de flotas 
            doquery("DELETE FROM {{table}} WHERE `fleet_id` = '". $FleetRow['fleet_id'] ."';", 'fleets'); 
 
            $esmulticuenta=1; 
        } 
    } 
    return $esmulticuenta; 
} 
?>