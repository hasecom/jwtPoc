<?php
namespace Sample\JwtDemo;
require_once('jwt/vendor/firebase/php-jwt/src/JWT.php');
use \Firebase\JWT\JWT;
use Exception;

header('Content-Type: application/json; charset=UTF-8');

/* ヘッダーからJWTの文字列を取得 */
$headers = getallheaders();
$authorization = $headers['Authorization'];
$exploded_authorization = explode(' ', $authorization);
$jwt = $exploded_authorization[1];

try {
  /* デコード */
  $public_key = file_get_contents(__DIR__ . '/keys/jwt.key.pub');
  $claims = JWT::decode($jwt, $public_key, array('RS256'));
} catch (Exception $e) {
  $message = $e->getMessage();
  echo json_encode(array(
    'message' => $message
  ));
  exit;
}

/* デコード結果からクレーム情報を取り出せる */
$user_id = $claims->user_id;
$foo = $claims->foo;

echo json_encode(array(
  'message' => 'Success.',
  'user_id' => $user_id,
  'foo' => $foo
));
