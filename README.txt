OpenMOGame2
작업노트(작업 기준 : XGP2.9.4)
작성자 : 민군

1. 설치하기
일단 업로드 후 게임 폴더 퍼미션을 707, config.php를 777로 맞춘다.
그리고 설치한다.
설치후 install 폴더 삭제후 config.php 퍼미션을 707로 바꾼다.

2. 서버 텍스트 설정
만약 글씨 깨지는경우.. 유니코드 문제를 의심해야함
DB는 인코딩을 utf8_general_ci 로, 파일은 UTF8 Without BOM으로 맞추면됨.

3. 서버 제한걸기
최대 가입자수 제한을 걸려면
INSERT INTO `_config 비슷한 테이블명` (`config_name`, `config_value`) VALUES ('max_users', '500');
를 DB로 실행