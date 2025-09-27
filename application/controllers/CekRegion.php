<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CekRegion extends CI_Controller {

    public function index()
    {
        $this->load->view('cekregion'); // Load view cekregion.php
    }

    public function check()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $user_id = isset($data['user_id']) ? trim($data['user_id']) : '';
        $zone_id = isset($data['zone_id']) ? trim($data['zone_id']) : '';

        if (empty($user_id) || empty($zone_id)) {
            return $this->response(400, 'USER ID & ZONE ID HARUS DIISI!');
        }

        // Panggil API eksternal
        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "User-Agent: Mozilla/5.0",
            "Referer: https://naimstore.id/stalk-ml",
        ];

        $post_data = json_encode(['user_id' => $user_id, 'zone_id' => $zone_id]);
        $url = 'https://api.naimstore.id/api/stack-ml';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200) {
            return $this->output->set_status_header(200)->set_output($response);
        }

        return $this->response(400, 'DATA TIDAK DITEMUKAN');
    }

    private function response($code, $message, $data = []) {
        return $this->output->set_status_header($code)
                            ->set_content_type('application/json')
                            ->set_output(json_encode(['status' => $code === 200, 'message' => $message, 'data' => $data]));
    }
}
