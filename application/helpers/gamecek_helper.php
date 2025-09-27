<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * API key Zulmai untuk checker e-wallet/PLN
 * (ditanam langsung sesuai permintaan; lebih aman taruh di ENV)
 */
if (!defined('ZULMAI_API_KEY')) {
    define('ZULMAI_API_KEY', 'sk-3dbb652a8d6d8690d4730533246390c9184528fa9fac508d');
}

if (!function_exists('getGameApiUrl')) {
    function getGameApiUrl($game, $params = []) {
        // Daftar base URL untuk setiap game / layanan
        $baseUrls = [
            // GAME
            'mobile-legends'   => 'https://melpadigitalcek.vercel.app/api/game/mobile-legends-mp',
            'genshin-impact'   => 'https://melpadigitalcek.vercel.app/api/game/genshin-impact',
            'free-fire'        => 'https://melpadigitalcek.vercel.app/api/game/freefire-dg',
            'pubg-mobile'      => 'https://melpadigitalcek.vercel.app/api/game/pubg-mobile-vc',
            'magic-chess'      => 'https://cek-id-game-limit.vercel.app/api/game/magic-chess-go-go',
            'zenless-zone-zero'=> 'https://melpadigitalcek.vercel.app/api/game/zenless-zone-zero',
            'honor-of-kings'   => 'https://melpadigitalcek.vercel.app/api/game/honor-of-kings-vc',
            'honkai-star-rail' => 'https://melpadigitalcek.vercel.app/api/game/honkai-star-rail',
            'arena-of-valor'   => 'https://melpadigitalcek.vercel.app/api/game/arena-of-valor',

            // E-WALLET (tidak dipakai cekGame lama; dipakai wrapper)
            'dana'             => 'https://zulmai.me/api/checker/dana',
            'ovo'              => 'https://zulmai.me/api/checker/ovo',
            'shopeepay'        => 'https://zulmai.me/api/checker/shopeepay',
            'gopay'            => 'https://zulmai.me/api/checker/gopay',
            'linkaja'          => 'https://zulmai.me/api/checker/linkaja',

            // PLN
            'pln-prabayar'     => 'https://zulmai.me/api/checker/check-prabayar', // POST meterNumber
            'pln-pascabayar'   => 'https://zulmai.me/api/checker/check-bill',     // POST targetNumber
        ];

        // Periksa apakah game/layanan didukung
        if (!isset($baseUrls[$game])) {
            return false;
        }

        $query = http_build_query($params);
        return rtrim($baseUrls[$game], '/') . '?' . $query;
    }
}

function cekFreeFire($user_id) {
    return (empty($user_id) || (!is_string($user_id) && !is_numeric($user_id)))
        ? json_encode([
            'code' => 400,
            'status' => false,
            'message' => 'Invalid user_id parameter',
            'data' => null
          ])
        : cekGame('free-fire', ['id' => $user_id]);
}

if (!function_exists('cekPubgMobile')) {
    function cekPubgMobile($user_id) {
        return cekGame('pubg-mobile', ['id' => $user_id]);
    }
}
if (!function_exists('cekHonorOfKings')) {
    function cekHonorOfKings($user_id) {
        return cekGame('honor-of-kings', ['id' => $user_id]);
    }
}

if (!function_exists('cekArenaofValor')) {
    function cekArenaofValor($user_id) {
        return cekGame('arena-of-valor', ['id' => $user_id]);
    }
}

// Fungsi untuk mengecek Genshin Impact
if (!function_exists('cekGenshinImpact')) {
    function cekGenshinImpact($user_id, $zone_id) {
        return cekGame('genshin-impact', ['id' => $user_id, 'zone' => $zone_id]);
    }
}

if (!function_exists('cekZenlessZoneZero')) {
    function cekZenlessZoneZero($user_id, $zone) {
        // Mapping zone
        $mappingZone = [
        'Asia'      => 'prod_gf_jp',
        'America'   => 'prod_gf_us',
        'Europe'    => 'prod_gf_eu',
        'TW_HK_MO'  => 'prod_gf_sg'
        ];

        // Pastikan zone valid
        if (!isset($mappingZone[$zone])) {
            return json_encode([
                'code' => 400,
                'status' => false,
                'message' => "Invalid zone: $zone. Allowed: Asia, America, Europe, TW_HK_MO",
                'data' => null
            ]);
        }

        // Ambil zone ID yang sudah dimapping
        $zone_id = $mappingZone[$zone];

        return cekGame('zenless-zone-zero', ['id' => $user_id, 'zone' => $zone_id]);
    }
}

if (!function_exists('cekZenlessZoneZero')) {
    function cekZenlessZoneZero($user_id, $zone) {
        // Mapping zone
        $mappingZone = [
        'Asia'      => 'prod_gf_jp',
        'America'   => 'prod_gf_us',
        'Europe'    => 'prod_gf_eu',
        'TW_HK_MO'  => 'prod_gf_sg'
        ];

        // Pastikan zone valid
        if (!isset($mappingZone[$zone])) {
            return json_encode([
                'code' => 400,
                'status' => false,
                'message' => "Invalid zone",
                'data' => null
            ]);
        }

        // Ambil zone ID yang sudah dimapping
        $zone_id = $mappingZone[$zone];

        return cekGame('zenless-zone-zero', ['id' => $user_id, 'zone' => $zone_id]);
    }
}

if (!function_exists('cekHonkaiStarRail')) {
    function cekHonkaiStarRail($user_id, $zone) {
        // Mapping zone
        $mappingZone = [
        'os_asia'      => 'prod_official_asia',
        'America'   => 'prod_official_usa',
        'Europe'    => 'prod_official_eur',
        'TW_HK_MO'  => 'prod_official_cht'
        ];

        // Pastikan zone valid
        if (!isset($mappingZone[$zone])) {
            return json_encode([
                'code' => 400,
                'status' => false,
                'message' => "Invalid zone",
                'data' => null
            ]);
        }

        // Ambil zone ID yang sudah dimapping
        $zone_id = $mappingZone[$zone];

        return cekGame('honkai-star-rail', ['id' => $user_id, 'zone' => $zone_id]);
    }
}

// Fungsi umum untuk mengecek game lain
if (!function_exists('cekGame')) {
    function cekGame($game, $params = []) {
        $url = getGameApiUrl($game, $params);

        // Jika game tidak didukung
        if (!$url) {
            return json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Game not supported',
                'data' => null
            ]);
        }

        return fetch_game_data($url);
    }
}

if (!function_exists('fetch_game_data')) {
   function fetch_game_data($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error_msg = curl_error($ch);
    curl_close($ch);

    log_message('debug', "Request URL: $url");
    log_message('debug', "HTTP code: $http_code");
    log_message('debug', "Response: $response");
    if ($error_msg) {
        log_message('error', "CURL Error: $error_msg");
    }

    if ($error_msg) {
        return json_encode([
            'code' => 500,
            'status' => false,
            'message' => 'CURL Error: ' . $error_msg,
            'data' => null
        ]);
    }

    if ($http_code !== 200) {
        return json_encode([
            'code' => $http_code,
            'status' => false,
            'message' => 'API Request Failed',
            'data' => null
        ]);
    }

    $result = json_decode($response, true);
    
    return json_encode([
        'code' => $result['code'] ?? 400,
        'status' => $result['status'] ?? false,
        'message' => $result['message'] ?? 'Invalid response',
        'data' => [
            'username' => $result['data']['username'] ?? null,
            'user_id' => $result['data']['user_id'] ?? null,
            'zone' => $result['data']['zone'] ?? null
        ]
    ]);
}
}

/* ===================================================================== */
/* ================== TAMBAHAN: E-WALLET & PLN (POST) ================== */
/* ===================================================================== */

/**
 * Khusus e-wallet: lakukan POST ke Zulmai dgn Authorization Bearer
 * Tidak menyentuh fetch_game_data/cekGame lama
 */
if (!function_exists('fetch_wallet_data')) {
    function fetch_wallet_data($service, $phoneNumber) {
        $map = [
            'dana'      => 'https://zulmai.me/api/checker/dana',
            'ovo'       => 'https://zulmai.me/api/checker/ovo',
            'shopeepay' => 'https://zulmai.me/api/checker/shopeepay',
            'gopay'     => 'https://zulmai.me/api/checker/gopay',
            'linkaja'   => 'https://zulmai.me/api/checker/linkaja',
        ];
        if (!isset($map[$service])) {
            return json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Wallet not supported',
                'data' => null
            ]);
        }

        // Sanitasi nomor (angka saja)
        $digits = preg_replace('/\D+/', '', (string) $phoneNumber);
        if ($digits === '') {
            return json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Invalid phone number',
                'data' => null
            ]);
        }

        $url = $map[$service];
        $headers = [
            'Authorization: Bearer ' . ZULMAI_API_KEY,
            'Content-Type: application/json',
            'Accept: application/json'
        ];
        $payload = json_encode(['phoneNumber' => $digits]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error_msg = curl_error($ch);
        curl_close($ch);

        log_message('debug', "Wallet POST $service URL: $url");
        log_message('debug', "Payload: $payload");
        log_message('debug', "HTTP code: $http_code");
        log_message('debug', "Response: $response");
        if ($error_msg) {
            log_message('error', "CURL Error: $error_msg");
        }

        if ($error_msg) {
            return json_encode([
                'code' => 500,
                'status' => false,
                'message' => 'CURL Error: ' . $error_msg,
                'data' => null
            ]);
        }
        if ($http_code !== 200) {
            return json_encode([
                'code' => $http_code,
                'status' => false,
                'message' => 'API Request Failed',
                'data' => null
            ]);
        }

        $res = json_decode($response, true);
        $ok  = ($res['status'] ?? '') === 'success';
        $msg = $res['message'] ?? 'Unknown response';

        return json_encode([
            'code' => 200,
            'status' => $ok,
            'message' => $msg,
            'data' => [
                // Provider mengembalikan name ter-mask di "message"
                'name'        => $msg,
                'phoneNumber' => $digits,
                'service'     => $service
            ]
        ]);
    }
}

/**
 * PLN PRABAYAR (cek nama): POST meterNumber
 */
if (!function_exists('fetch_pln_prabayar_data')) {
    function fetch_pln_prabayar_data($meterNumber) {
        $url = 'https://zulmai.me/api/checker/check-prabayar';
        $meter = preg_replace('/\D+/', '', (string) $meterNumber);

        if ($meter === '') {
            return json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Invalid meter number',
                'data' => null
            ]);
        }

        $headers = [
            'Authorization: Bearer ' . ZULMAI_API_KEY,
            'Content-Type: application/json',
            'Accept: application/json'
        ];
        $payload = json_encode(['meterNumber' => $meter]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error_msg = curl_error($ch);
        curl_close($ch);

        log_message('debug', "PLN PRABAYAR POST URL: $url");
        log_message('debug', "Payload: $payload");
        log_message('debug', "HTTP code: $http_code");
        log_message('debug', "Response: $response");

        if ($error_msg) {
            return json_encode([
                'code' => 500,
                'status' => false,
                'message' => 'CURL Error: ' . $error_msg,
                'data' => null
            ]);
        }
        if ($http_code !== 200) {
            return json_encode([
                'code' => $http_code,
                'status' => false,
                'message' => 'API Request Failed',
                'data' => null
            ]);
        }

        $res = json_decode($response, true);
        $ok  = ($res['status'] ?? '') === 'success';
        $msg = $res['message'] ?? 'Unknown response';

        // Coba ambil nama jika ada di message/data
        $name = $res['data']['name'] ?? $res['message'] ?? null;

        return json_encode([
            'code' => 200,
            'status' => $ok,
            'message' => $msg,
            'data' => [
                'meterNumber' => $meter,
                'customerName'=> $name
            ]
        ]);
    }
}

/**
 * PLN PASCABAYAR (cek tagihan): POST targetNumber
 */
if (!function_exists('fetch_pln_pascabayar_data')) {
    function fetch_pln_pascabayar_data($targetNumber) {
        $url = 'https://zulmai.me/api/checker/check-bill';
        $target = preg_replace('/\D+/', '', (string) $targetNumber);

        if ($target === '') {
            return json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Invalid target number',
                'data' => null
            ]);
        }

        $headers = [
            'Authorization: Bearer ' . ZULMAI_API_KEY,
            'Content-Type: application/json',
            'Accept: application/json'
        ];
        $payload = json_encode(['targetNumber' => $target]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error_msg = curl_error($ch);
        curl_close($ch);

        log_message('debug', "PLN PASCABAYAR POST URL: $url");
        log_message('debug', "Payload: $payload");
        log_message('debug', "HTTP code: $http_code");
        log_message('debug', "Response: $response");

        if ($error_msg) {
            return json_encode([
                'code' => 500,
                'status' => false,
                'message' => 'CURL Error: ' . $error_msg,
                'data' => null
            ]);
        }
        if ($http_code !== 200) {
            return json_encode([
                'code' => $http_code,
                'status' => false,
                'message' => 'API Request Failed',
                'data' => null
            ]);
        }

        $res = json_decode($response, true);
        $ok  = ($res['status'] ?? '') === 'success';
        $msg = $res['message'] ?? 'Unknown response';

        // Ambil detail jika tersedia
        $detail = $res['data'] ?? [];
        $name   = $detail['customerName'] ?? $detail['name'] ?? null;
        $amount = $detail['amount'] ?? $detail['billAmount'] ?? null;
        $period = $detail['period'] ?? null;

        return json_encode([
            'code' => 200,
            'status' => $ok,
            'message' => $msg,
            'data' => [
                'targetNumber' => $target,
                'customerName' => $name,
                'amount'       => $amount,
                'period'       => $period,
                'raw'          => $detail // tetap kirim raw bila perlu dipakai di FE
            ]
        ]);
    }
}

/**
 * Wrapper e-wallet:
 * Catatan: untuk konsistensi param, kita pakai $user_id sebagai nomor HP.
 */
if (!function_exists('cekDana')) {
    function cekDana($user_id) {
        return fetch_wallet_data('dana', $user_id);
    }
}
if (!function_exists('cekOvo')) {
    function cekOvo($user_id) {
        return fetch_wallet_data('ovo', $user_id);
    }
}
if (!function_exists('cekShopeePay')) {
    function cekShopeePay($user_id) {
        return fetch_wallet_data('shopeepay', $user_id);
    }
}
if (!function_exists('cekGoPay')) {
    function cekGoPay($user_id) {
        return fetch_wallet_data('gopay', $user_id);
    }
}
if (!function_exists('cekLinkAja')) {
    function cekLinkAja($user_id) {
        return fetch_wallet_data('linkaja', $user_id);
    }
}

/**
 * Wrapper PLN:
 */
if (!function_exists('cekPlnPrabayar')) {
    // Cek Nama PLN Prabayar
    function cekPlnPrabayar($meterNumber) {
        return fetch_pln_prabayar_data($meterNumber);
    }
}
if (!function_exists('cekPlnPascabayar')) {
    // Cek Tagihan Pascabayar
    function cekPlnPascabayar($targetNumber) {
        return fetch_pln_pascabayar_data($targetNumber);
    }
}
