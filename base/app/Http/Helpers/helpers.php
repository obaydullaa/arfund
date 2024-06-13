<?php

use App\Constants\Status;
use App\Lib\GoogleAuthenticator;
use App\Models\Plugin;
use App\Models\Frontend;
use App\Models\SiteSetting;
use Carbon\Carbon;
use App\Lib\Captcha;
use App\Lib\ClientInfo;
use App\Lib\CurlRequest;
use App\Lib\FileManager;
use App\Models\Donation;
use App\Notify\Notify;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

function systemDetails()
{
    $system['name'] = 'ArFund Admin';
    $system['version'] = '1.0';
    $system['build_version'] = '1.0';
    return $system;
}

function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}

function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = (int) ($min - 1) . '9';
    return random_int($min, $max);
}

function getNumber($length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function activeTemplate($asset = false)
{
    $general = gs();
    $template = session('template') ?? $general->active_template;
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function activeTemplateName()
{
    $general = gs();
    $template = session('template') ?? $general->active_template;
    return $template;
}

function siteLogo($type = null)
{
    $general = gs();
    $name = $type ? $general->image->logo_white : $general->image->logo;
    return getImage(getFilePath('logoIcon') . '/' . $name);
}

function thumbLogo($type = null)
{
    $general = gs();
    $name = $type ? 'thumb_' . $general->image->logo : $general->image->logo;
    return getImage(getFilePath('logoIcon') . '/' . $name);
}




function siteFavicon()
{
    return getImage(getFilePath('logoIcon') . '/' . gs()->image->favicon);
}

function loadReCaptcha()
{
    return Captcha::reCaptcha();
}

function loadCustomCaptcha($width = '100%', $height = 46, $bgColor = '#003')
{
    return Captcha::customCaptcha($width, $height, $bgColor);
}

function verifyCaptcha()
{
    return Captcha::verify();
}

function loadPlugin($key)
{
    $plugin = Plugin::where('act', $key)->where('status', Status::ENABLE)->first();
    return $plugin ? $plugin->generateScript() : '';
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getAmount($amount, $length = 2)
{
    $amount = round($amount ?? 0, $length);
    return $amount + 0;
}

function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
{
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        } else {
            $printAmount = rtrim($printAmount, '0');
        }
    }
    return $printAmount;
}


function removeElement($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet)
{
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$wallet&choe=UTF-8";
}


function keyToTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}


function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}


function strLimit($title = null, $length = 10)
{
    return Str::limit($title, $length);
}


function getIpInfo()
{
    $ipInfo = ClientInfo::ipInfo();
    return $ipInfo;
}


function osBrowser()
{
    $osBrowser = ClientInfo::osBrowser();
    return $osBrowser;
}



function getPageSections($arr = false)
{
    $jsonUrl = resource_path('views/') . str_replace('.', '/', activeTemplate()) . 'sections.json';
    $sections = json_decode(file_get_contents($jsonUrl));
    if ($arr) {
        $sections = json_decode(file_get_contents($jsonUrl), true);
        ksort($sections);
    }
    return $sections;
}


function getImage($image, $size = null)
{
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return route('placeholder.image', $size);
    }
    return asset('assets/images/default.png');
}


function notify($user, $templateName, $shortCodes = null, $sendVia = null, $createLog = true)
{
    $general = gs();
    $globalShortCodes = [
        'site_name' => $general->site_name,
        'site_currency' => $general->cur_text,
        'currency_symbol' => $general->cur_sym,
    ];

    if (gettype($user) == 'array') {
        $user = (object) $user;
    }

    $shortCodes = array_merge($shortCodes ?? [], $globalShortCodes);

    $notify = new Notify($sendVia);
    $notify->templateName = $templateName;
    $notify->shortCodes = $shortCodes;
    $notify->user = $user;
    $notify->createLog = $createLog;
    $notify->userColumn = isset($user->id) ? $user->getForeignKey() : 'user_id';
    $notify->send();
}

function getPaginate($paginate = 20)
{
    return $paginate;
}

function paginateLinks($data)
{
    return $data->appends(request()->all())->links();
}


function menuActive($routeName, $type = null, $param = null)
{
    if ($type == 3) $class = 'side-menu--open';
    elseif ($type == 2) $class = 'sidebar-submenu__open';
    elseif ($type == 4) $class = 'd-block';
    else $class = 'active';

    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) return $class;
        }
    } elseif (request()->routeIs($routeName)) {
        if ($param) {
            $routeParam = array_values(@request()->route()->parameters ?? []);
            if (strtolower(@$routeParam[0]) == strtolower($param)) return $class;
            else return;
        }
        return $class;
    }
}


function fileUploader($file, $location, $size = null, $old = null, $thumb = null, $filename = null)
{
    $fileManager = new FileManager($file);
    $fileManager->path = $location;
    $fileManager->size = $size;
    $fileManager->old = $old;
    $fileManager->thumb = $thumb;
    $fileManager->filename = $filename;
    $fileManager->upload();
    return $fileManager->filename;
}

function fileManager()
{
    return new FileManager();
}

function getFilePath($key)
{
    return fileManager()->$key()->path;
}

function getFileSize($key)
{
    return fileManager()->$key()->size;
}

function getFileExt($key)
{
    return fileManager()->$key()->extensions;
}

function diffForHumans($date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date, $format = 'Y-m-d h:i A')
{
    $general = gs();

    $formats = [
        'mm-dd-yyyy' => 'm-d-Y h:i A',
        'dd-mm-yyyy' => 'd-m-Y h:i A',
        'yyyy-mm-dd' => 'Y-m-d h:i A',
    ];

    $format = $formats[$general->date_format] ?? 'Y-m-d h:i A';

    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

function getContent($dataKeys, $singleQuery = false, $limit = null, $orderById = false)
{

    $templateName = activeTemplateName();
    if ($singleQuery) {
        $content = Frontend::where('tempname', $templateName)->where('data_keys', $dataKeys)->orderBy('id', 'desc')->first();
    } else {
        $article = Frontend::where('tempname', $templateName);
        $article->when($limit != null, function ($q) use ($limit) {
            return $q->limit($limit);
        });
        if ($orderById) {
            $content = $article->where('data_keys', $dataKeys)->orderBy('id')->get();
        } else {
            $content = $article->where('data_keys', $dataKeys)->orderBy('id', 'desc')->get();
        }
    }
    return $content;
}

/*
     * Showing: Ordinal Numbers.
     */
function ordinal($number)
{
    $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
    if ((($number % 100) >= 11) && (($number % 100) <= 13))
        return $number . 'th';
    else
        return $number . $ends[$number % 10];
}

function gatewayRedirectUrl($type = false)
{
    if ($type) {
        return 'user.deposit.history';
    } else {
        return 'user.deposit.index';
    }
}

function verifyG2fa($user, $code, $secret = null)
{
    $authenticator = new GoogleAuthenticator();
    if (!$secret) {
        $secret = $user->tsc;
    }
    $oneCode = $authenticator->getCode($secret);
    $userCode = $code;
    if ($oneCode == $userCode) {
        $user->tv = 1;
        $user->save();
        return true;
    } else {
        return false;
    }
}


function urlPath($routeName, $routeParam = null)
{
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}


function showMobileNumber($number)
{
    $length = strlen($number);
    return substr_replace($number, '***', 2, $length - 4);
}

function showEmailAddress($email)
{
    $endPosition = strpos($email, '@') - 1;
    return substr_replace($email, '***', 1, $endPosition);
}


function getRealIP()
{
    $ip = $_SERVER["REMOTE_ADDR"];
    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ($ip == '::1') {
        $ip = '127.0.0.1';
    }

    return $ip;
}


function appendQuery($key, $value)
{
    return request()->fullUrlWithQuery([$key => $value]);
}

function dateSort($a, $b)
{
    return strtotime($a) - strtotime($b);
}

function dateSorting($arr)
{
    usort($arr, "dateSort");
    return $arr;
}

function gs($key = null)
{
    $general = Cache::get('SiteSetting');
    if (!$general) {
        $general = SiteSetting::first();
        Cache::put('SiteSetting', $general);
    }
    if ($key) return @$general->$key;
    return $general;
}

function isImage($string)
{
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $fileExtension = pathinfo($string, PATHINFO_EXTENSION);
    if (in_array($fileExtension, $allowedExtensions)) {
        return true;
    } else {
        return false;
    }
}

function isHtml($string)
{
    if (preg_match('/<.*?>/', $string)) {
        return true;
    } else {
        return false;
    }
}

if (!function_exists('fetchCount')) {
    function fetchCount($model, $column, $value, $type = true, $scope = null)
    {
        $modelName = ucfirst($model);
        $modelClass = 'App\Models\\' . $modelName;
        if ($type) {
            $count = $modelClass::where($column, $value);
        } else {
            $count = $modelClass::whereIn($column, $value);
        }

        if ($scope) {
            $count = $modelClass::where($column, $value)->$scope();
        }
        return $count->count();
    }
}


if (!function_exists('fetchModal')) {
    function fetchModal($model)
    {
        $modelName = ucfirst($model);
        $modelClass = 'App\Models\\' . $modelName;
        return $modelClass::query();
    }
}


if (!function_exists('fetchSelectionOrder')) {
    function fetchSelectionOrder($model, $dataKeys, $limit, $orderById)
    {
        $elements = fetchModal($model)->where('data_keys', $dataKeys)->orderByRaw('CAST(JSON_UNQUOTE(JSON_EXTRACT(data_values, "$.order")) AS SIGNED)')->get();

        return $elements;
    }
}


if (!function_exists('summernoteContent')) {
    function summernoteContent($requestContent, $content = false)
    {
        if ($content) {
            $previousDom = new \DOMDocument();
            @$previousDom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $prviousImages = $previousDom->getElementsByTagName('img');
            $previousImage = [];
            $newImageName = [];
            if ($prviousImages) {
                $baseURL = url('/');
                $baseAssetsPath = getFilePath('summernoteImage') . '/';
                foreach ($prviousImages as $key => $img) {
                    $previousImageSrc = $img->getAttribute('src');
                    $link = explode($baseAssetsPath, $previousImageSrc)[1];
                    $previousImage[] = $link;
                }
            }
            $dom = new \DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($requestContent, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            $baseURL = url('/');
            $assetsDirectory = getFilePath('summernoteImage') . '/';
            foreach ($images as $key => $img) {
                $dataUri = $img->getAttribute('src');
                $parts = explode(',', $dataUri);
                if (@$parts[1]) {
                    $data = base64_decode($parts[1]);
                    $mime = explode(':', substr($dataUri, 0, strpos($dataUri, ';')))[1];
                    $extension = explode('/', $mime)[1];
                    $imageName = time() . $key . rand(10, 99) . '.' . $extension;
                    $imagePath = $assetsDirectory  . $imageName;
                    file_put_contents($imagePath, $data);
                    $absoluteImageUrl = $baseURL . '/' . $imagePath;
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $absoluteImageUrl);
                } else {
                    $parts = explode($assetsDirectory, $dataUri);
                    $newImageName[$key] = $parts[1];
                }
            }
            foreach ($previousImage as $image) {
                if (!in_array($image, $newImageName)) {
                    fileManager()->removeFile(getFilePath('summernoteImage') . '/' . $image);
                }
            }
            $description = $dom->saveHTML();
            $description = str_replace('<br />', '<br>', $description);
            $description = str_replace('<br \\/>', '<br>', $description);
            $description = str_replace('<\/', '</', $description);
            $description = str_replace('\\r\\n', '', $description);
            $purifier = new \HTMLPurifier();
            $description = $purifier->purify($description);
            $description = preg_replace('/\s+/', ' ', $description);
            return $description;
        } else {
            $dom = new \DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($requestContent, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            $baseURL = url('/');
            $assetsDirectory = getFilePath('summernoteImage') . '/';
            foreach ($images as $key => $img) {
                $dataUri = $img->getAttribute('src');
                $parts = explode(',', $dataUri);
                $data = base64_decode($parts[1]);
                $mime = explode(':', substr($dataUri, 0, strpos($dataUri, ';')))[1];
                $extension = explode('/', $mime)[1];
                $imageName = time() . $key . rand(10, 99) . '.' . $extension;
                $imagePath = $assetsDirectory  . $imageName;
                file_put_contents($imagePath, $data);
                $absoluteImageUrl = $baseURL . '/' . $imagePath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $absoluteImageUrl);
            }
            $description = $dom->saveHTML();
            $description = str_replace('<br />', '<br>', $description);
            $description = str_replace('<br \\/>', '<br>', $description);
            $description = str_replace('<\/', '</', $description);
            $description = str_replace('\\r\\n', '', $description);
            $purifier = new \HTMLPurifier();
            $description = $purifier->purify($description);
            $description = preg_replace('/\s+/', ' ', $description);
            return $description;
        }
    }
}

if (!function_exists('modalStatusBadge')) {
    function modalStatusBadge($status, $methodCode = null, $updatedAt = null)
    {
        $html = '';
        switch ($status) {
            case Status::TICKET_OPEN:
                $html = '<span class="badge badge-success">' . trans("Open") . '</span>';
                break;
            case Status::TICKET_ANSWER:
                $html = '<span class="badge badge-primary">' . trans("Answered") . '</span>';
                break;
            case Status::TICKET_REPLY:
                $html = '<span class="badge badge-warning">' . trans("Customer Reply") . '</span>';
                break;
            case Status::TICKET_CLOSE:
                $html = '<span class="badge badge-dark">' . trans("Closed") . '</span>';
                break;
            case Status::PAYMENT_PENDING:
                $html = '<span class="badge badge-warning">' . trans('Pending') . '</span>';
                break;
            case Status::PAYMENT_SUCCESS:
                if ($methodCode >= 1000) {
                    $html = '<span><span class="badge badge-success">' . trans('Approved') . '</span><br>' . diffForHumans($updatedAt) . '</span>';
                } else {
                    $html = '<span class="badge badge-success">' . trans('Succeed') . '</span>';
                }
                break;
            case Status::PAYMENT_REJECT:
                $html = '<span><span class="badge badge-danger">' . trans('Rejected') . '</span><br>' . diffForHumans($updatedAt) . '</span>';
                break;
            case Status::PAYMENT_INITIATE:
                $html = '<span class="badge badge-dark">' . trans('Initiated') . '</span>';
                break;
            default:
                $html = '<span class="badge badge-dark">' . trans('Match The Status') . '</span>';
                break;
        }
        return $html;
    }
}



if (!function_exists('fetchDonationCount')) {
    function fetchDonationCount($id)
    {
        $count = Donation::where('campaign_id', $id)->where('status', 1)->sum('donation');

        return $count;
    }
}
function percent($donate, $campaign)
{
    return ($donate * 100) / $campaign->goal;
}

function progressPercent($percent)
{
    return   $percent >= 100 ? '100' : $percent;
}
if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($number)
    {
        return preg_replace('/[^0-9+]/', '', $number);
    }
}

function showRatings($rating)
{
    $ratings = '';
    if ($rating > 0) {
        $avgRating = $rating;
        $integerVal = floor($avgRating);
        $fraction = $avgRating - $integerVal;
        if ($fraction < .25) {
            $avgRating = intval($avgRating);
        }
        if ($fraction > .75) {
            $avgRating = intval($avgRating) + 1;
        }
        for ($i = 1; $i <= $avgRating; $i++) {
            $ratings .= '<i class="las la-star"></i>';
        }
        if ($fraction > .25 && $fraction < .75) {
            $avgRating += 1;
            $ratings .= '<i class="las la-star-half-alt"></i>';
        }
    } else {
        $avgRating = 0;
    }
    $nonStar = 5 - intval($avgRating);
    for ($k = 1; $k <= $nonStar; $k++) {
        $ratings .= '<i class="lar la-star"></i>';
    }
    return $ratings;
}

function covertDateFormat()
{
    $format = gs()->date_format;

    $formatMap = [
        'mm' => 'm',
        'dd' => 'd',
        'yyyy' => 'Y',
    ];

    foreach ($formatMap as $from => $to) {
        $format = str_replace($from, $to, $format);
    }
    return $format;
}