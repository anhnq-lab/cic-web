<?php
require 'EvnHanoi.php';

if (isset($_GET['customerId'], $_GET['password'], $_GET['startDate'])) {
    $evnHanoi = new EvnHanoi($_GET['customerId'], $_GET['password'], $_GET['startDate']);
    $latestData = $evnHanoi->GetLatestInfo();

    $paymentHistory = $evnHanoi->GetLichSuThanhToan();
    $isLastMonthPaid = false;
    if ($paymentHistory != null) {
        $latestPaymentMonth = $paymentHistory->data->dmLichSuThanhToanList[0]->thang;
        if ($latestData['lastMonth'] == $latestPaymentMonth) {
            $isLastMonthPaid = true;
        }
    }

    if($isLastMonthPaid){
        $latestData['isLastMonthPaid'] = "Đã đóng tiền";
    }else{
        $latestData['isLastMonthPaid'] = "Chưa đóng tiền";
    }
    echo json_encode($latestData);
}
