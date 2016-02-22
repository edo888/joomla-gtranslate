<?php
include 'config.php';

if(!isset($_GET['glang']) or !isset($_GET['gurl']))
    exit;

$glang = $_GET['glang'];

shuffle($servers);
$server = $servers[1];

$page_url = '/'.$_GET['gurl'];

$page_url_segments = explode('/', $page_url);
foreach($page_url_segments as $i => $segment) {
    $page_url_segments[$i] = rawurlencode($segment);
}
$page_url = implode('/', $page_url_segments);

$get_params = array();
foreach($_GET as $key => $val) {
    if($key != 'glang' and $key != 'gurl') {
        if(is_array($val))
            foreach($val as $v)
                $get_params[] = $key.'[]='.$v;
        else
            $get_params[] = $key.'='.$val;
    }
}

if(count($get_params)) {
    $page_url .= '?' . implode('&', $get_params);
}

if($glang == $main_lang) {
    header('Location: ' . $page_url, true, 301);
    exit;
}

$page_url = $server.'.tdn.gtranslate.net' . $page_url;

$protocol = preg_match('/https/i', $_SERVER['SERVER_PROTOCOL']) ? 'https' : 'http';
$page_url = $protocol . '://' . $page_url;

if(!in_array($glang, array('af','sq','ar','hy','az','eu','be','bg','ca','zh-CN','zh-TW','hr','cs','da','nl','en','et','tl','fi','fr','gl','ka','de','el','ht','iw','hi','hu','is','id','ga','it','ja','ko','lv','lt','mk','ms','mt','no','fa','pl','pt','ro','ru','sr','sk','sl','es','sw','sv','th','tr','uk','ur','vi','cy','yi','bn','bs','ceb','eo','gu','ha','hmn','ig','jw','kn','km','lo','la','mi','mr','mn','ne','pa','so','ta','te','yo','zu')))
    exit;

if(!function_exists("getallheaders")) {
  //Adapted from http://www.php.net/manual/en/function.getallheaders.php#99814
  function getallheaders() {
    $result = array();
    foreach($_SERVER as $key => $value) {
      if (substr($key, 0, 5) == "HTTP_") {
        $key = str_replace(" ", "-", ucwords(strtolower(str_replace("_", " ", substr($key, 5)))));
        $result[$key] = $value;
      }
    }
    return $result;
  }
}

$request_headers = getallheaders();

if(isset($request_headers['X-GT-Lang'])) {
    echo 'Please remove DNS cname records for GTranslate!';
    exit;
}

$host = $glang . '.' . preg_replace('/^www\./', '', $_SERVER['HTTP_HOST']);
$request_headers['Host'] = $host;
$request_headers['Accept-Encoding'] = '';
if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
    $request_headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
//print_r($request_headers);
//exit;

$headers = array();
foreach($request_headers as $key => $val) {
    $headers[] = $key . ': ' . $val;
}

//print_r($headers);
//exit;

// proxy request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $page_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST': {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
    }; break;

    case 'PUT': {
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_INFILE, fopen('php://input', 'r'));
    }; break;
}

// Debug
if($debug or isset($_GET['enable_debug'])) {
    $fh = fopen('debug.txt', 'a');
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_STDERR, $fh);
}

$response = curl_exec($ch);
$response_info = curl_getinfo($ch);
curl_close($ch);

//print_r($response_info);

$header_size = $response_info['header_size'];
$header = substr($response, 0, $header_size);
$html = substr($response, $header_size);

$response_headers = explode(PHP_EOL, $header);
//print_r($response_headers);
$headers_sent = '';
foreach($response_headers as $header) {
    if(!empty($header) and !preg_match('/Content\-Length|Transfer\-Encoding|Content\-Encoding|Link/', $header)) {
        $headers_sent .= $header;
        header($header);
    }
}
//echo $headers_sent;

// TODO: modify URLs
$html = str_replace($host, $_SERVER['HTTP_HOST'] . '/' . $glang, $html);
$html = str_replace('href="/', 'href="/' . $glang . '/', $html);
$html = str_replace('href="/' . $glang . '//', 'href="//', $html);
$html = str_replace('action="/', 'action="/' . $glang . '/', $html);
$html = str_replace('action="/' . $glang . '//', 'action="//', $html);

if(isset($_GET['language_edit'])) {
    $html = str_replace('/tdn-static/', $protocol . '://tdns.gtranslate.net/tdn-static/', $html);
    $html = str_replace('/tdn-bin/', $protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . $glang . '/tdn-bin/', $html);
}

echo $html;