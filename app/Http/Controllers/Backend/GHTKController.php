<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GHTKController extends Controller
{
    // Cấu hình chung - Môi trường - URL môi trường thử nghiệm, sandbox:
    public $moitruong = 'https://dev.ghtk.vn';

    // Token lấy ở đâu ra
    public $token = '3B008baea2008a0C90A29ABdfB89ae70E37553Ea';

    public function dangdonhang() {
        $order = <<<HTTP_BODY
        {
            "products": [{
                "name": "bút",
                "weight": 0.1,
                "quantity": 1
            }, {
                "name": "tẩy",
                "weight": 0.2,
                "quantity": 1
            }],
            "order": {
                "id": "aa13232391",

                "pick_name": "HCM-nội thành",
                "pick_money": "100000",
                "pick_address_id": "590",
                "pick_address": "590 CMT8 P.11",
                "pick_province": "TP. Hồ Chí Minh",
                "pick_district": "Quận 3",
                "pick_tel	": "0911222333",

                "name": "GHTK - HCM - Noi Thanh",
                "address": "123 nguyễn chí thanh",
                "province": "TP. Hồ Chí Minh",
                "district": "Quận 1",
                "tel": "0911222333",
                "email": "abc@gmail.com",

                "return_name": "Teo",
                "return_address": "123ABC",
                "return_province": "TP.Ho Chi Minh",
                "return_district    ": "Quận 3",
                "return_tel": "0911222333",
                "return_email": "def@gmail.com",

                "is_freeship": "1",
                "pick_date": "2016-09-30",
                "pick_money": "47000",
                "note": "Khối lượng tính cước tối đa: 1.00 kg",
                "value": 3000000,
                "transport": "fly",
            }
        }
        HTTP_BODY;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->moitruong . "/services/shipment/order",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: " . $this->token,
                "Content-Length: " . strlen($order),
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo 'Response: ' . $response;
    }

    public function tinhphivanchuyen() {
        $data = array(
            "pick_province" => "Hà Nội",
            "pick_district" => "Quận Hai Bà Trưng",
            "province" => "Hà nội",
            "district" => "Quận Cầu Giấy",
            "address" => "P.503 tòa nhà Auu Việt, số 1 Lê Đức Thọ",
            "weight" => 1000,
            "value" => 3000000,
            "transport" => "fly"
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->moitruong . "/services/shipment/fee?" . http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: " . $this->token,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo 'Response: ' . $response;
    }

    public function trangthaidonhang() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->moitruong . "/services/shipment/v2/S8366889.499923455 ",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: " . $this->token,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo 'Response: ' . $response;
    }
}
