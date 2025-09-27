<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function cekGame()
    {
        $data      = $this->input->input_stream();
        $ip        = $this->input->ip_address();
        $api       = !empty($data['api_key']) ? $data['api_key'] : '';
        $user_id   = !empty($data['user_id']) ? $data['user_id'] : '';
        $zone_id   = !empty($data['zone_id']) ? $data['zone_id'] : ''; 
        $nama_game = !empty($data['game']) ? $data['game'] : '';

        log_message('debug', "Request received from IP: $ip with api_key: $api, user_id: $user_id, zone_id: $zone_id, game: $nama_game");

        // Cek API Key di database
        $cek = $this->db->get_where('api_key', ['api_key' => $api])->row();
        if (!$cek) {
            log_message('error', "API Key tidak ditemukan: $api");
            return $this->response(400, 'API KEY NOT FOUND!');
        }

        log_message('debug', "API Key valid untuk user_id: {$cek->id_user}");

        // Cek status pengguna
        $cek_status = $this->db->get_where('users', ['id_user' => $cek->id_user])->row();
        if (!$cek_status) {
            log_message('error', "User dengan id {$cek->id_user} tidak ditemukan");
            return $this->response(400, 'USER NOT FOUND!');
        }
        if ($cek_status->status == 0) {
            log_message('error', "User dengan id {$cek->id_user} tidak aktif");
            return $this->response(400, 'INACTIVE USER!');
        }

        // Daftar game/layanan yang diizinkan
        $allowed_games = [
            'Mobile Legends',
            'Free Fire',
            'PUBG Mobile',
            'Magic Chess',
            'Genshin Impact',
            'Zenless Zone Zero',
            'Honor of Kings',
            'Honkai Star Rail',
            'Arena of Valor',
            'Dana',
            'OVO',
            'ShopeePay',
            'GoPay',
            'LinkAja',
            'PLN Prabayar',
            'PLN Pascabayar',
        ];

        if (!in_array($nama_game, $allowed_games)) {
            log_message('error', "Game/Layanan tidak diizinkan: $nama_game");
            return $this->response(400, 'GAME OR SERVICE NOT FOUND!');
        }

        // Validasi IP whitelist jika ada
        if (!empty($cek->whitelist_ip) && $cek->whitelist_ip !== '*' && !in_array($ip, explode(':', $cek->whitelist_ip))) {
            log_message('error', "IP $ip tidak diizinkan untuk mengakses dengan API Key $api");
            return $this->response(400, "YOUR IP ADDRESS $ip IS NOT ALLOWED TO ACCESS");
        }

        // Cek berdasarkan nama
        $game_json = $this->cekGameByName($nama_game, $user_id, $zone_id);
        log_message('debug', "Response dari cekGameByName: $game_json");

        $game = json_decode($game_json);

        if (!$game) {
            log_message('error', "Response cekGameByName tidak valid JSON: $game_json");
            return $this->response(500, 'Internal server error: invalid response format');
        }

        if ($game->code !== 200) {
            log_message('error', "cekGameByName gagal dengan pesan: {$game->message}");
            return $this->response(400, $game->message);
        }

        // Berhasil
        return $this->response(200, 'success', [
            'game'     => $nama_game,
            'user_id'  => $user_id,
            'zone_id'  => $zone_id,
            'username' => $game->data->username ?? $game->data->name ?? ''
        ]);
    }

    private function cekGameByName($nama_game, $user_id, $zone_id)
    {
        switch (strtolower($nama_game)) {
            case 'mobile legends':
                return cekGame('mobile-legends', ['id' => $user_id, 'zone' => $zone_id]);

            case 'free fire':
                return cekFreeFire($user_id);

            case 'pubg mobile':
                return cekPubgMobile($user_id);

            case 'magic chess':
                return cekGame('magic-chess', ['id' => $user_id, 'zone' => $zone_id]);

            case 'genshin impact':
                return cekGenshinImpact($user_id, $zone_id);

            case 'zenless zone zero':
                return cekZenlessZoneZero($user_id, $zone_id);

            case 'honor of kings':
                return cekHonorOfKings($user_id);

            case 'honkai star rail':
                return cekHonkaiStarRail($user_id, $zone_id);

            case 'arena of valor':
                return cekArenaofValor($user_id);

            // E-Wallet: user_id = phoneNumber
            case 'dana':
                return cekDana($user_id);

            case 'ovo':
                return cekOvo($user_id);

            case 'shopeepay':
                return cekShopeePay($user_id);

            case 'gopay':
                return cekGoPay($user_id);

            case 'linkaja':
                return cekLinkAja($user_id);

            // PLN: user_id dipakai untuk nomor meter / customer id
            case 'pln prabayar':
                // Cek Nama PLN Prabayar -> user_id dianggap sebagai meterNumber
                return cekPlnPrabayar($user_id);

            case 'pln pascabayar':
                // Cek Tagihan Pascabayar -> user_id dianggap sebagai targetNumber
                return cekPlnPascabayar($user_id);

            default:
                return json_encode(['code' => 400, 'message' => 'Game/Service not supported']);
        }
    }

    private function response($code, $message, $data = [])
    {
        $status = $code === 200 ? 'success' : 'error';
        $output = json_encode(compact('code', 'status', 'message') + ($data ? ['result' => $data] : []));
        return $this->output->set_status_header($code)->set_output($output);
    }
}
