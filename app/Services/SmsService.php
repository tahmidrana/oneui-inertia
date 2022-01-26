<?php

namespace App\Services;

use App\Models\ClinicalSession;
use App\Models\Room;
use Exception;
use Illuminate\Support\Facades\Http;

class SmsService
{
    public function clinicalSessionCreatedNotifyClient(ClinicalSession $clinicalSession)
    {
        $client = $clinicalSession->client;

        $session_type = $clinicalSession->session_type_clinical == 1 ? 'An assessment' : 'A follow-up';
        $session_date = date('d M Y', strtotime($clinicalSession->session_date));
        $session_time = date('h:i a', strtotime($clinicalSession->start_time)) . ' - ' . date('h:i a', strtotime($clinicalSession->end_time));

        $session_place = 'Online';
        if ($clinicalSession->place_of_service == 1) {
            $room = Room::find($clinicalSession->room_no_id);
            $session_place = "Room No - {$room->room_no}, Branch - {$room->branch}";
        }

        $sms_body = "Dear Client, {$session_type} session is scheduled on {$session_date}, Time : {$session_time}, Place : {$session_place}";

        $this->sendSms($client->phone, $sms_body);
    }

    public function clinicalSessionCancelledNotifyClient(ClinicalSession $clinicalSession)
    {
        if ($clinicalSession->session_status == 3) {
            $client = $clinicalSession->client;

            $cancel_type = $clinicalSession->cancel_type == 1 ? 'DNA' : ($clinicalSession->cancel_type == 2 ? 'UTC' : 'TC');
            $session_date = date('d M Y', strtotime($clinicalSession->session_date));
            $session_time = date('h:i a', strtotime($clinicalSession->start_time)) . ' - ' . date('h:i a', strtotime($clinicalSession->end_time));

            $session_place = 'Online';
            if ($clinicalSession->place_of_service == 1) {
                $room = Room::find($clinicalSession->room_no_id);
                $session_place = "Room No - {$room->room_no}, Branch - {$room->branch}";
            }
            $sms_body = "Dear Client, the scheduled session on {$session_date}; Time : {$session_time}; Place : {$session_place}. has been cancelled ({$cancel_type}) as per your request.";

            $this->sendSms($client->phone, $sms_body);
        }
    }

    public function clinicalSessionDeleteddNotifyClient(ClinicalSession $clinicalSession)
    {
        $client = $clinicalSession->client;

        $session_date = date('d M Y', strtotime($clinicalSession->session_date));
        $sms_body = "Dear Client, your scheduled session on {$session_date} has been cancelled by PHWC";

        $this->sendSms($client->phone, $sms_body);
    }

    public function clinicalSessionReminderBefore24Hour()
    {
        $clinicalSessions = ClinicalSession::query()
            ->with(['client', 'room'])
            ->whereRaw("TIMESTAMPDIFF(HOUR, NOW(), STR_TO_DATE(CONCAT(session_date, 'T', start_time), '%Y-%m-%dT%H:%i:%s')) = 24")
            ->select('id', 'client_id', 'session_date', 'start_time', 'end_time')
            ->get();

        foreach ($clinicalSessions as $clinicalSession) {
            $session_date = date('d M Y', strtotime($clinicalSession->session_date));
            $session_time = date('h:i a', strtotime($clinicalSession->start_time)) . ' - ' . date('h:i a', strtotime($clinicalSession->end_time));
            $session_place = 'Online';
            if ($clinicalSession->place_of_service == 1) {
                $room = $clinicalSession->room;
                $session_place = "Room No - {$room->room_no}, Branch - {$room->branch}";
            }

            // $client_name = $clinicalSession->client->name;
            $sms_body = "Dear Client, you have a scheduled session on {$session_date}; Time : {$session_time}; Place : {$session_place}";
            $this->sendSms($clinicalSession->client->phone, $sms_body);
        }
    }

    /*
     * @params
     * string phone_no : 11 digit
     * string sms_body
     */
    public function sendSms(string $phone_no, string $sms_body)
    {
        $phone_no = $this->validatePhone($phone_no);

        try {
            throw_if(!$phone_no, new Exception('Invalid phone no'));

            $sms_body = trim($sms_body);
            $mask_title = env('INFOBUZZER_SMS_MASK_TITLE');
            $smsDatumArray = [
                [
                    'smsID' => $this->udate('YmdHisu'),
                    'smsSendTime' => date('Y-m-d H:i:s'),
                    'mask' => $mask_title,
                    'mobileNo' => $phone_no,
                    'smsBody' => $sms_body,
                ]
            ];

            logger('Send one sms: ', $smsDatumArray);

            $response = $this->sendReq($smsDatumArray);
            throw_unless($response['status'] == 200, new Exception($response['message']));

            return true;
            /* return [
                'success' => true,
                'message' => 'Message sent successfully',
            ]; */
        } catch (Exception $e) {
            logger('Send one sms error: '. $e->getMessage());
            return false;
            /* return [
                'success' => false,
                'message' => $e->getMessage()
            ]; */
        }
    }

    /*
     * $smsData = [
     *      ["phone_no" => "8801676470847", "sms_body" => "example sms body"],
     *      ["phone_no" => "8801676470847", "sms_body" => "example sms body"],
     *      ...
     * ]
     */
    public function sendSmsMulti(array $smsData)
    {
        try {
            $mask_title = env('INFOBUZZER_SMS_MASK_TITLE');

            $smsDatumArray = [];

            $invalid_phones = [];

            foreach ($smsData as $sms) {
                throw_unless(array_key_exists('phone_no', $sms) && array_key_exists('phone_no', $sms), new Exception('Invalid data'));

                $phone_no = $this->validatePhone($sms['phone_no']);
                if (!$phone_no) {
                    $invalid_phones[] = $sms['phone_no'];
                }
                $sms_body = trim($sms['sms_body']);

                if ($phone_no) {
                    $smsDatumArray[] = [
                        'smsID' => $this->udate('YmdHisu'),
                        'smsSendTime' => date('Y-m-d H:i:s'),
                        'mask' => $mask_title,
                        'mobileNo' => $phone_no,
                        'smsBody' => $sms_body,
                    ];
                }
            }

            logger('Send multi sms: ', $smsDatumArray);

            $response = $this->sendReq($smsDatumArray);
            throw_unless($response['status'] == 200, new Exception($response['message']));

            $return_data = [
                'success' => true,
                'message' => 'Message sent successfully',
                'invalid_phones' => $invalid_phones,
            ];

            return $return_data;
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function sendReq(array $smsDatumArray)
    {
        $sms_enabled = env('SMS_ENABLED', false);
        $url = env('INFOBUZZER_SMS_API_URL');
        $username = env('INFOBUZZER_SMS_USERNAME');
        $password = env('INFOBUZZER_SMS_PASSWORD');

        if (!$sms_enabled) {
            logger('SMS service disabled from env');
            return [
                'status'=> 200,
                'success'=> true,
                'message' => 'SMS service disabled from env'
            ];
        }

        try {
            throw_if(count($smsDatumArray) === 0, new Exception('Not enough data'));

            $data = [
                'trxID' => $this->udate('YmdHisu'),
                'trxTime' => date('Y-m-d H:i:s'),
                'smsDatumArray' => $smsDatumArray
            ];

            $response = Http::withBasicAuth($username, $password)
                ->post($url, $data);

            return [
                'status'=> $response['status'],
                'success'=> $response['success'],
                'message' => $response['reason']
            ];
        } catch (Exception $e) {
            return [
                'status'=> 500,
                'success'=> false,
                'message' => $e->getMessage()
            ];
        }
    }

    protected function udate($format, $utimestamp = null)
    {
        $m = explode(' ',microtime());
        list($totalSeconds, $extraMilliseconds) = array($m[1], (int)round($m[0]*1000,3));
        return date("YmdHis", $totalSeconds) . sprintf('%03d',$extraMilliseconds) ;
    }

    protected function validatePhone($phone)
    {
        $phone = preg_replace("/[^0-9]/", '', $phone); // remove all special charecters

        // phone no must start with 01. must container 9 digit except first 2 digit
        if(preg_match("/^(01)?[0-9]{9}$/i", $phone)) {
            return "88{$phone}";
        }
        return false;
    }
}