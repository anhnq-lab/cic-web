<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
require 'JwtAuthorization.php';
require '../vendor/autoload.php';
class EvnHanoi
{
    function __construct($customerId, $password, $startDate)
    {
        $this->customerId = $customerId;
        $this->password = $password;
        $this->startDate = $startDate;
        $this->maQuanLy = substr($this->customerId, 0, 6);
    }

    public $customerId = "";
    public $password = "";
    public $startDate = "11";
    public $token = "";
    private $maQuanLy = "";

    public function GetTotalMoney($totalPower)
    {
        $url = 'https://calc.evn.com.vn/TinhHoaDon/api/Calculate';
        $postData = '{"KIMUA_CSPK":"0","LOAI_DDO":"1","SO_HO":1,"MA_CAPDAP":"1","NGAY_DKY":"05/05/2021","NGAY_CKY":"04/06/2021","NGAY_DGIA":"01/01/1900","HDG_BBAN_APGIA":[{"LOAI_BCS":"KT","TGIAN_BANDIEN":"KT","MA_NHOMNN":"SHBT","MA_NGIA":"A"}],"GCS_CHISO":[{"BCS":"KT","SAN_LUONG":"' . $totalPower . '","LOAI_CHISO":"DDK"}]}';
        $data = json_decode($this->PostWithToken($this->token, $url, $postData)->body);
        return $data->Data->HDN_HDON[0]->TONG_TIEN;
    }

    public function GetPower()
    {
        $token = $this->GetToken($this->customerId, $this->password);
        if ($token == null) {
            return "Not found";
        }

        $this->token = $token;
        $result = $this->LayChiSoDoXa();
        if ($result->isError) {
            return "Error";
        }

        $totalPower = $result->data->tongSanLuong->kt;
        return $totalPower;
    }

    public function GetTinhHinhTieuThuDien()
    {
        $url = 'https://evnhanoi.com.vn/api/TraCuu/GetTinhHinhTieuThuDien';
        $year = date('Y');

        if (date('m') == 1) {
            $year--;
        }
        $postData = json_encode(array(
            "maDViQLy" =>  $this->maQuanLy,
            "maKhachHang" => $this->customerId,
            "nam" => (int) $year
        ));
        return json_decode($this->PostWithToken($this->token, $url, $postData)->body);
    }

    public function GetLichSuThanhToan()
    {
        $url = "https://evnhanoi.com.vn/api/TraCuu/GetLichSuThanhToan?maDvQly={$this->maQuanLy}&maKh={$this->customerId}&thang=" . date('m') . "&nam=" . date('Y');
        $data = json_decode($this->GetWithToken($this->token, $url));
        if ($data->isError) {
            return null;
        }

        return $data;
    }

    public function GetLatestInfo()
    {
        $token = $this->GetToken($this->customerId, $this->password);
        if ($token == null) {
            return array(
                "isError" => true,
                "message" => "Credential is not valid"
            );
        }

        $this->token = $token;
        $result = $this->LayChiSoDoXa();
        if ($result->isError) {
            return array(
                "isError" => true,
                "message" => "Error when get data"
            );
        }

        $totalPower = $result->data->tongSanLuong->kt;
        $totalMoney = $this->GetTotalMoney($totalPower);
        $lastDayPower = 0;
        $i = count($result->data->chiSoNgayFull) - 1;
        for ($i; $i >= 0; $i--) {
            if (array_key_exists('chiSo', $result->data->chiSoNgayFull[$i]) && $result->data->chiSoNgayFull[$i]->chiSo != 0) {
                $lastDayPower = $result->data->chiSoNgayFull[$i]->chiSo;
                break;
            }
        }

        $lastDayPower -= $result->data->chiSoNgayFull[$i - 1]->chiSo;
        $currentPowerConsumption = $this->GetTinhHinhTieuThuDien();
        $lastMonthPower = 0;
        $lastMonthCost = 0;
        $lastMonth = 0;
        if (!$currentPowerConsumption->isError) {
            $lastMonthPower = $currentPowerConsumption->data->tieuThuTheoThangList[0]->dienTthu;
            $lastMonthCost = $currentPowerConsumption->data->tieuThuTheoThangList[0]->soTien;
            $lastMonth = $currentPowerConsumption->data->tieuThuTheoThangList[0]->thang;
        }

        return array(
            "totalPower" => $totalPower,
            "yesterdayPower" => $lastDayPower,
            "totalMoney" => $this->EncodeMoney($totalMoney),
            "lastMonthPower" => $lastMonthPower,
            "lastMonthCost" => $this->EncodeMoney($lastMonthCost),
            "lastMonth" => $lastMonth,
        );
    }

    public function EncodeMoney($money)
    {
        return number_format((int)$money, 0, '', ',');
    }

    public function LayChiSoDoXa()
    {
        $data = array(
            "maDonVi" => $this->maQuanLy,
            "maDiemDo" => $this->customerId . "001",
            "maXacThuc" => "EVNHN",
            "ngayDau" => "23/05/2021",
            "ngayCuoi" => "04/06/2021",
        );

        $timeNow = new DateTime('now');
        if (date('d') <= $this->startDate) {
            $timeNow->setDate(date('Y'), date('m') - 1, $this->startDate);
        } else {
            $timeNow->setDate(date('Y'), date('m'), $this->startDate);
        }
        $data["ngayDau"] = $timeNow->format('d/m/Y');
        $timeNow->sub(new DateInterval('P1D'))->add(new DateInterval('P1M'));
        $data["ngayCuoi"] = $timeNow->format('d/m/Y');

        $url = 'https://evnhanoi.com.vn/api/TraCuu/LayChiSoDoXa';

        return json_decode($this->PostWithToken($this->token, $url, json_encode($data))->body);
    }

    public function PostWithToken($token, $url, $data)
    {
        $headers = array(
            "Content-Type" => "application/json",
            "Accept" => "application/json"
        );
        $option = array(
            'auth' => new JwtAuthorization($token),
            'verify' => false
        );
        return Requests::post($url, $headers, $data, $option);
    }

    public function GetWithToken($token, $url)
    {
        $headers = array(
            "Content-Type" => "application/json",
            "Accept" => "application/json"
        );
        $option = array(
            'auth' => new JwtAuthorization($token),
            'verify' => false
        );
        return Requests::get($url, $headers, $option)->body;
    }

    public function GetToken($username, $password)
    {
        $postData = array(
            'username' => $username,
            'password' => $password,
            'grant_type' => 'password',
            'client_id' => 'httplocalhost4500',
            'client_secret' => 'secret'
        );

        $response = Requests::post("https://apicskh.evnhanoi.com.vn/connect/token", array(), $postData);
        $data = json_decode($response->body);
        if (array_key_exists("error", $data)) {
            return null;
        } else {
            return json_decode($response->body)->access_token;
        }
    }
}
