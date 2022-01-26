<?php
namespace App\Services;

use App\Models\AdditionalFee;
use App\Models\User;
use App\Notifications\AdditionalChargeNotification;
use App\Notifications\ClientAssignNotification;
use App\Notifications\ClientEntryNotification;
use App\Notifications\ClinicalSessionCreated;
use App\Notifications\CommonNotification;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    public function clientEntryNotificationToSupervisor($client_id)
    {
        $supervisor_users = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('slug', 'supervisor');
            })->get();

        $notification_detail = [
            'title' => 'New Client Enrolled',
            'text' => "New client has been enrolled",
            'client_id' => $client_id
        ];

        Notification::send($supervisor_users, new ClientEntryNotification($notification_detail));
    }

    public function clientAssignNotifyToClinician($clinician, $client)
    {
        $notification_detail = [
            'title' => 'New Client Assign',
            'text' => "{$client->client_code} Has been assigned to you",
            'client_id' => $client->id
        ];

        Notification::send($clinician, new ClientAssignNotification($notification_detail));
    }

    public function sessionInvitationNotifyGuestClinicians($clinician, $clinical_session, $guest_clinicians_list)
    {
        $guest_clinicians = User::whereIn('id', $guest_clinicians_list)->get();

        $session_date = date("d M - Y", strtotime($clinical_session->session_date));
        $notification_detail = [
            'title' => 'Session Invitation',
            'text' => "{$clinician->userid} has invited you to attend a session on {$session_date}",
            'clinical_session_id' => $clinical_session->id
        ];

        if (count($guest_clinicians)) {
            Notification::send($guest_clinicians, new ClinicalSessionCreated($notification_detail));
        }
    }

    public function sessionUpdateNotifyGuestClinicians($clinical_session)
    {
        $guest_clinicians = $clinical_session->guest_clinicians;

        $client = $clinical_session->client;

        $session_date = date("d M - Y", strtotime($clinical_session->session_date));
        $notification_detail = [
            'title' => 'Session Updated',
            'text' => "The Date/Time/Place of Service has been changed for the scheduled session on {$session_date} of client {$client->client_code}.",
            'clinical_session_id' => $clinical_session->id,
            'name' => 'clinical-session-update',
        ];

        if (count($guest_clinicians)) {
            Notification::send($guest_clinicians, new CommonNotification($notification_detail));
        }
    }

    public function sessionCancelNotifyGuestClinicians($clinical_session)
    {
        $guest_clinicians = $clinical_session->guest_clinicians;

        $client = $clinical_session->client;

        $notification_detail = [
            'title' => 'Session Cancelled',
            'text' => "The scheduled session of {$client->client_code} has been cancelled",
            'clinical_session_id' => $clinical_session->id,
            'name' => 'session-cancel-notification',
        ];

        Notification::send($guest_clinicians, new CommonNotification($notification_detail));
    }

    public function additionalFeeRequestNotifyAdmin($additionalFee, $created_by)
    {
        $admin_users = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('slug', 'admin');
            })->get();

        $client = $additionalFee->clinical_session->client;

        $notification_detail = [
            'title' => 'Session Additional Charge',
            'text' => "{$created_by->userid} has requested additional charge for {$client->client_code}",
            'clinical_session_id' => $additionalFee->clinical_session_id,
            'additional_fee_id' => $additionalFee->id,
            'name' => 'session-additional-fee-request',
        ];

        Notification::send($admin_users, new AdditionalChargeNotification($notification_detail));
    }

    public function additionalFeeRequestResponse($additionalFee, $approval_status)
    {
        $clinical_session = $additionalFee->clinical_session;

        $host_clinician = $clinical_session->host_clinician;
        $client = $clinical_session->client;

        $status_text = $approval_status == 2 ? 'accepted' : 'declined';

        $notification_detail = [
            'title' => 'Session Additional Charge',
            'text' => "Your additional charge request for {$client->client_code} has been {$status_text}",
            'clinical_session_id' => $additionalFee->clinical_session_id,
            'additional_fee_id' => $additionalFee->id,
            'name' => 'session-additional-fee-request-response',
        ];

        Notification::send($host_clinician, new AdditionalChargeNotification($notification_detail));
    }

    public function discountRequestNotifyAdmin($discount, $created_by)
    {
        $admin_users = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('slug', 'admin');
            })->get();

        $client = $discount->clinical_session->client;

        $notification_detail = [
            'title' => 'Session Discount',
            'text' => "{$created_by->userid} has requested discount for {$client->client_code}",
            'clinical_session_id' => $discount->clinical_session_id,
            'session_discount_id' => $discount->id,
            'name' => 'session-discount-request',
        ];

        Notification::send($admin_users, new CommonNotification($notification_detail));
    }

    public function discountRequestApproval($discount, $approval_status)
    {
        $clinical_session = $discount->clinical_session;

        $host_clinician = $clinical_session->host_clinician;
        $client = $clinical_session->client;

        $status_text = $approval_status == 2 ? 'accepted' : 'declined';

        $notification_detail = [
            'title' => 'Session Discount',
            'text' => "Your discount request for {$client->client_code} has been {$status_text}",
            'clinical_session_id' => $discount->clinical_session_id,
            'session_discount_id' => $discount->id,
            'name' => 'session-discount-request-response',
        ];

        Notification::send($host_clinician, new CommonNotification($notification_detail));
    }

    /*
     * All assign, release, handover request notification to admin
     * request_type: 1 - assign, 2 - Release, 3 - Handover
     */
    public function assignReleaseRequestNotifyAdmin($assignRequest)
    {
        $admin_users = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('slug', 'admin');
            })->get();

        $assigned_by = $assignRequest->assigned_by;

        // if assigned by is not admin then send notification
        if ( !in_array($assigned_by->id, $admin_users->pluck('id')->toArray()) ) {
            $clinician = $assignRequest->clinician;
            $client = $assignRequest->client;

            $request_type = $assignRequest->request_type; // assign
            $title_text = 'Assign Request';
            $text = "{$assigned_by->userid} has requested to assign {$clinician->userid} for {$client->client_code}";
            $name = 'client-clinician-assign-request';

            if ($request_type == 2) { // release
                $title_text = 'Release Request';
                $name = 'client-clinician-release-request';
                $text = "{$clinician->userid} has requested release from {$client->client_code}";
            } elseif ($request_type == 3) { // handover
                $handover_to = $assignRequest->handover_to;

                $title_text = 'Handover Request';
                $name = 'client-clinician-handover-request';
                $text = "{$assigned_by->userid} has requested handover of {$client->client_code} to {$handover_to->userid}";
            }

            $notification_detail = [
                'title' => $title_text,
                'text' => $text,
                'client_clinician_assign_request_id' => $assignRequest->id,
                'name' => $name,
            ];

            Notification::send($admin_users, new CommonNotification($notification_detail));
        }
    }

    /*
     * All assign, release, handover request response notification to respective clinicians
     * request_type: 1 - assign, 2 - Release, 3 - Handover
     */
    public function assignReleaseRequestApproval($assignRequest, $approval_status)
    {
        $assigned_by = $assignRequest->assigned_by;

        $request_type = $assignRequest->request_type;
        $request_type_text = "assign";
        $title_text = "Assign Request";
        $name = 'client-clinician-assign-request-approval';

        $approval_text = $approval_status == 2 ? 'approved' : 'declined';

        if ($request_type == 2) { // release
            $title_text = 'Release Request';
            $name = 'client-clinician-release-request-approval';
            $request_type_text = "release";
        } elseif ($request_type == 3) { // handover
            $title_text = 'Handover Request';
            $name = 'client-clinician-handover-request-approval';
            $request_type_text = "handover";
        }

        $text = "Your request of {$request_type_text} has been {$approval_text}";

        $notification_detail = [
            'title' => $title_text,
            'text' => $text,
            'client_clinician_assign_request_id' => $assignRequest->id,
            'name' => $name,
        ];
        Notification::send($assigned_by, new CommonNotification($notification_detail));

        if ($approval_status == 2 && in_array($request_type, [1, 3])) { // Send notification to newly assigned clinician
            $clinician = null;
            $client = $assignRequest->client;
            if ($request_type == 1) { //
                $clinician = $assignRequest->clinician;
                //
            } else {
                $clinician = $assignRequest->handover_to;
            }

            $notification_data = [
                'title' => 'New Client Assign',
                'text' => "{$client->client_code} Has been assigned to you",
                'client_id' => $client->id
            ];
            Notification::send($clinician, new ClientAssignNotification($notification_data));
        }
    }

    public function superVisionSessionInvitation($clinicaiSession)
    {
        $host_clinician = $clinicaiSession->host_clinician;
        $session_date = date("d M Y", strtotime($clinicaiSession->session_date));

        $notification_details = [
            'title' => 'Supervision Invitation',
            'text' => "{$host_clinician->userid} has invited you to attend the supervision on {$session_date}",
            'clinical_session_id' => $clinicaiSession->id,
            'name' => 'supervision-invitation',
        ];

        User::find($clinicaiSession->supervision_clinician_id)
            ->notify(new ClinicalSessionCreated($notification_details));
    }

} // End of class
