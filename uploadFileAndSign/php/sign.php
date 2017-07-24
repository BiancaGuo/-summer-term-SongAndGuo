<?php
function signFile($file,$out,$username)
{
  if(!is_file($file)) {
      echo "$file does not exist!\n";
      exit(1);
  }
  $data = file_get_contents($file);
  // read private and public key
  // $cwd = "../keys"
  $username_hash=md5($username);
  $priv_key = openssl_pkey_get_private("file://../keys/".$username_hash.".key");
  //create signature
  openssl_sign($data, $signature, $priv_key, OPENSSL_ALGO_SHA256);
  file_put_contents($out, $signature);
  return;
}
