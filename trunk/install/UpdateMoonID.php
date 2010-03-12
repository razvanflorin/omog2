<?php
##############################################################################
#	OpenMOGame2 프로젝트
#	라이센스 : GNU GPL v3.0
#	이 프로젝트는 XGP 2.9.4 에서 분할되었습니다.
#	OpenMOGame2 를 사용하고 있는 MOGame2 서버는 http://mogame2.kr 이며 운영자는 민군입니다.
#	프로젝트 마스터 : 민군(kmsr819@naver.com) 
#	코더 : 민군(kmsr819@naver.com)
#	서포터 : 이현종(010-2299-0754)
#	디자이너 : 동이군, 니콜라이(ims130@hotmail.com)
#	번역자 : 니콜라이(ims130@hotmail.com), 김종범(010-8458-6161), 엘리나, 워니, 이현종
#	XGP Team, SHWorks 호스팅에 감사드립니다.
#	연락 : 민군(kmsr819@naver.com)
##############################################################################


if(!defined('INSIDE')){ die(header("location:../../"));}

	function UpdateMoonID()
	{
		$Data = doquery(	"SELECT l.id AS idluna,p.id AS idplanets,
							g.galaxy AS galaxy, g.system AS system,
							g.planet AS planet
							FROM {{table}}lunas AS l
							Left Join {{table}}galaxy AS g ON
							l.id = g.id_luna AND
							l.galaxy = g.galaxy AND
							l.system = g.system AND
							l.lunapos = g.planet
							Left Join {{table}}planets AS p ON
							g.galaxy = p.galaxy AND
							g.system = p.system AND
							g.planet = p.planet AND
							p.planet_type = 3;",'');

		if($Data)
		{
			while ( $Moon = mysql_fetch_assoc ( $Data ) )
			{
				if($Moon['idplanets']!='')
				{
					$salida['planeta'][$Moon['idplanets']]=$Moon['idplanets'];
					$salida['luna'][$Moon['idluna']]=$Moon['idluna'];
					doquery ( "UPDATE {{table}} SET `id_luna` = '" . $Moon['idplanets'] . "' WHERE `galaxy` = '" . $Moon['galaxy'] . "' AND `system` = '" . $Moon['system'] . "' AND `planet` = '" . $Moon['planet'] . "';", 'galaxy' );
				}
				else
				{
					doquery ( "UPDATE {{table}} SET `id_luna` = '0' WHERE `galaxy` = '" . $Moon['galaxy'] . "' AND `system` = '" . $Moon['system'] . "' AND `planet` = '" . $Moon['planet'] . "';", 'galaxy' );
				}
			}
			return $salida;
		}
	}

?>