<?php
namespace Sample\JwtDemo;
require_once('jwt/vendor/firebase/php-jwt/src/JWT.php');
use \Firebase\JWT\JWT;  // PHP-JWT

header('Content-Type: application/json; charset=UTF-8');

function is_valid($user_id, $password) {
  /* 認証処理 */
}

/* 認証に使う情報の定義（今回は例としてID・パスワード形式で） */
//$user_id = $_GET['user_id'];
//$password = $_GET['password'];
$user_id = 'user_id';
$password = 'password';

/* 認証 */
if (!is_valid($user_id, $password)) {
  echo json_encode(array(
    'message' => 'Invalid User.'
  ));
}

/* クレーム情報の定義 */
$current_time = time();
$expiry = $current_time + (30 * 24 * 60 * 60); //有効期限として30日後を指定
$claims = array(
  'iat' => $current_time,
  'exp' => $expiry,
  'user_id' => $user_id,
  'foo' => 'bar'
);

/* 秘密鍵の取得 */
$private_key = file_get_contents(__DIR__ . '/key/jwt.key');

/* エンコード */
$jwt = JWT::encode($claims, $private_key, 'RS256');

echo json_encode(array(
  'message' => 'Success.',
  'jwt' => $jwt
));
