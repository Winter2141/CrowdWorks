<?php

namespace App\Service;

use App\Models\Value;
use Auth;
use DB;
use Carbon\Carbon;

class VeritransService {

    const PAY_NOW_ID_FAILURE_CODE = 'failure';
    const PAY_NOW_ID_PENDING_CODE = 'pending';
    const PAY_NOW_ID_SUCCESS_CODE = 'success';

    const EXIST_ACCOUNT_RESULT_CODE = 'XH11000000000000';
    const EXIT_ACCOUNT_RESULT_CODE = 'XH12000000000000';

    const PAY_SUCCESS_CODE = 'success';

    public static function registerAccount($account_id)
    {
        $create_date = Carbon::now()->format('Ymd');
        $request_data = new \AccountAddRequestDto();
        $request_data->setAccountId($account_id);
        $request_data->setCreateDate($create_date);
        $execute_data = self::executeTransaction($request_data, $account_id);

        if ($execute_data == false) return false;
        if (isset($execute_data['result'])) {
            if (isset($execute_data['result']['result_code'])) {
                if ($execute_data['result']['result_code'] == self::EXIT_ACCOUNT_RESULT_CODE) {
                    return self::restoreAccount($account_id);
                } else {
                    return $execute_data['result'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function restoreAccount($account_id)
    {
        $delete_date = Carbon::now()->format('Ymd');

        $request_data = new \AccountRestoreRequestDto();
        $request_data->setAccountId($account_id);
        $request_data->setCreateDate($delete_date);
        $execute_data = self::executeTransaction($request_data, $account_id);
        return isset($execute_data['result']) ? $execute_data['result'] : false;
    }

    public static function deleteAccount($account_id)
    {

        $delete_date = Carbon::now()->format('Ymd');

        $request_data = new \AccountDeleteRequestDto();
        $request_data->setAccountId($account_id);
        $request_data->setDeleteDate($delete_date);

        $execute_data = self::executeTransaction($request_data, $account_id);
        return isset($execute_data['result']) ? $execute_data['result'] : false;
    }

    public static function getCreditCard($account_id)
    {
        $request_data = new \CardInfoGetRequestDto();
        $request_data->setAccountId($account_id);

        $cardList = [];
        $execute_data = self::executeTransaction($request_data, $account_id);

        if ($execute_data == false) return false;

        if (!empty($execute_data['pay_now_id_res'])) {
            $account = $execute_data['pay_now_id_res']->getAccount();
            if (isset($account)) {
                //カード情報取得
                $cardInfos = $account->getCardInfo();

                if (!is_null($cardInfos)) {
                    $cardList['key'] = $cardInfos[0]->getCardId();
                    $cardList['card_number'] = $cardInfos[0]->getCardNumber();
                    $cardList['exp'] = $cardInfos[0]->getCardExpire();
                }
            }
            return array_merge($execute_data['result'], ['cards' => $cardList]);
        } else {
            return $execute_data['result'];
        }
    }

    public static function registerCreditCard($account_id, $token) {
        $request_data = new \CardInfoAddRequestDto();
        $request_data->setAccountId($account_id);
        $request_data->setToken($token);
        $execute_data = self::executeTransaction($request_data, $account_id);
        return isset($execute_data['result']) ? $execute_data['result'] : false;
    }

    public static function deleteCard($account_id, $card_key=null)
    {
        $request_data = new \CardInfoDeleteRequestDto();
        $request_data->setAccountId($account_id);
        if (!is_null($card_key)) {
            $request_data->setCardId($card_key);
        }

        $execute_data = self::executeTransaction($request_data, $account_id);
        return isset($execute_data['result']) ? $execute_data['result'] : false;
    }

    public static function payMonthlyFee($account_id, $order_id, $card_id, $payment_method, $payment_amount, $with_capture) {
        $request_data = new \CardAuthorizeRequestDto();

        $request_data->setOrderId($order_id);
        $request_data->setAmount($payment_amount);
        $request_data->setWithCapture($with_capture);
        $request_data->setJpo($payment_method);
        $request_data->setAccountId($account_id);
        $request_data->setCardId($card_id);

        $transaction = new \TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);

        //予期しない例外
        if (!isset($response_data)) {
           return false;
        } else {
            //取引ID取得
            $result_order_id = $response_data->getOrderId();

            //結果コード取得
            $txn_status = $response_data->getMStatus();

            //詳細コード取得
            $txn_result_code = $response_data->getVResultCode();
            //エラーメッセージ取得
            $error_message = $response_data->getMerrMsg();

            //PayNowIDレスポンス取得
            $pay_now_id_res = $response_data->getPayNowIdResponse();

            $process_id = '';
            $pay_now_id_status = '';
            if (isset($pay_now_id_res)) {
                // PayNowID処理番号取得
                $process_id = $pay_now_id_res->getProcessId();
                //PayNowIDステータス取得
                $pay_now_id_status = $pay_now_id_res->getStatus();
            }

            return [
                    'order_id' => $result_order_id,
                    'order_status' => $txn_status,
                    'process_id' => $process_id,
                    'status' => $pay_now_id_status,
                    'result_code' => $txn_result_code,
                    'result_message' => $error_message,
            ];
        }
    }

    public static function executeTransaction($request_data, $account_id=null) {
        //実施
        $transaction = new \TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);

        //予期しない例外
        if (!isset($response_data)) {
            return false;
        } else {
            //PayNowIDレスポンス取得
            $pay_now_id_res = $response_data->getPayNowIdResponse();
            $process_id = '';
            $pay_now_id_status = '';
            if (isset($pay_now_id_res)) {
                // PayNowID処理番号取得
                $process_id = $pay_now_id_res->getProcessId();
                //PayNowIDステータス取得
                $pay_now_id_status = $pay_now_id_res->getStatus();
            }
            //詳細コード取得
            $txn_result_code = $response_data->getVResultCode();
            //エラーメッセージ取得
            $error_message = $response_data->getMerrMsg();

            //成功
            return [
                'pay_now_id_res' => $pay_now_id_res,
                'result' =>[
                    'process_id' => $process_id,
                    'status' => $pay_now_id_status,
                    'result_code' => $txn_result_code,
                    'result_message' => $error_message,
                ]
            ];


        }
    }

    public static function checkRegisterAccount($register_result)
    {
        if (!$register_result) return false;

        if ($register_result['status'] == VeritransService::PAY_NOW_ID_SUCCESS_CODE) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkCreatedOrExistAccount($register_result)
    {
        if (!$register_result) return false;

        if ($register_result['status'] == VeritransService::PAY_NOW_ID_SUCCESS_CODE || ($register_result['status'] == VeritransService::PAY_NOW_ID_FAILURE_CODE && $register_result['result_code'] == VeritransService::EXIST_ACCOUNT_RESULT_CODE)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkExistAccount($account_id) {
        $request_data = new \CardInfoGetRequestDto();
        $request_data->setAccountId($account_id);
        $transaction = new \TGMDK_Transaction();
        $response_data = $transaction->execute($request_data);
        if (isset($response_data)) {
            $pay_now_id_res = $response_data->getPayNowIdResponse();
            if (isset($pay_now_id_res)) {
                $account = $pay_now_id_res->getAccount();
                if ($account->getAccountInfo()) {
                   return true;
                }
            }
        }
        return false;
    }

}