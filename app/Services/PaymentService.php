<?php
namespace App\Services;

use App\Models\Client;
use App\Models\Corporate;

/*
 * total_bill = (total_session_bill / total_corporate_bill) - total_writeoff_payment
 * total_paid = total_regular_payment - total_refund_payment
 * balance = total_paid - total_bill
*/
class PaymentService
{
    public function getNetPayableOfClient(Client $client)
    {
        $total_bill = $client->transaction_records()->where('transaction_type_id', 1)->sum('tr_amount'); // sum of total bill

        $total_regular_payments = $client->transaction_records()->where('transaction_type_id', 5)->sum('tr_amount');
        $total_refund_payments = $client->transaction_records()->where('transaction_type_id', 6)->sum('tr_amount');
        $total_write_off_payments = $client->transaction_records()->where('transaction_type_id', 7)->sum('tr_amount');

        $total_bill = $total_bill - $total_write_off_payments; // total bill = total bill - total writeoff

        $total_paid = $total_regular_payments - $total_refund_payments;
        $net_payable = $total_bill - $total_paid;

        return $net_payable > 0 ? $net_payable : 0;
    }

    public function getNetPayableOfCorporate(Corporate $corporate)
    {
        $net_payable = 0;
        $total_bill = $corporate->corporate_events()->sum('bill_amount');

        $payments = $corporate->payments;
        if ($payments) {
            $total_regular_payments = $payments->where('payment_type', 1)->sum('payment_amount');
            $total_refund_payments = $payments->where('payment_type', 2)->sum('payment_amount');
            $total_paid = $total_regular_payments - $total_refund_payments;

            $total_write_off_payments = $payments->where('payment_type', 3)->sum('payment_amount');
            $total_bill = $total_bill - $total_write_off_payments;

            $net_payable = $total_bill - $total_paid;
        }
        return $net_payable > 0 ? $net_payable : 0;
    }

    public function getBalanceOfClient(Client $client)
    {
        $total_session_bill = $client->transaction_records()->where('transaction_type_id', 1)->sum('tr_amount');
        $total_regular_payments = $client->transaction_records()->where('transaction_type_id', 5)->sum('tr_amount');
        $total_refund_payments = $client->transaction_records()->where('transaction_type_id', 6)->sum('tr_amount');
        $total_write_off_payments = $client->transaction_records()->where('transaction_type_id', 7)->sum('tr_amount');

        $total_session_bill = $total_session_bill - $total_write_off_payments;
        $total_paid = $total_regular_payments - $total_refund_payments;

        $total_balance = $total_paid - $total_session_bill;
        return $total_balance;
    }

    public function getBalanceOfCorporate(Corporate $corporate)
    {
        $total_session_bill = $corporate->transaction_records()->where('transaction_type_id', 1)->sum('tr_amount');
        $total_regular_payments = $corporate->transaction_records()->where('transaction_type_id', 5)->sum('tr_amount');
        $total_refund_payments = $corporate->transaction_records()->where('transaction_type_id', 6)->sum('tr_amount');
        $total_write_off_payments = $corporate->transaction_records()->where('transaction_type_id', 7)->sum('tr_amount');

        $total_session_bill = $total_session_bill - $total_write_off_payments;
        $total_paid = $total_regular_payments - $total_refund_payments;

        $total_balance = $total_paid - $total_session_bill;
        return $total_balance;
    }

    public function getClientTotalPaidBeforeDate(Client $client, $before_date)
    {
        $total_regular_payments = $client->transaction_records() // total regular payment
            ->where('transaction_type_id', 5)
            ->whereDate('tr_date', '<', $before_date)
            ->sum('tr_amount');

        $total_refund_payments = $client->transaction_records()
            ->where('transaction_type_id', 6)
            ->whereDate('tr_date', '<', $before_date)
            ->sum('tr_amount');

        $total_paid = $total_regular_payments - $total_refund_payments; // total paid = total paid - total refund
        return $total_paid;
    }

    public function getClientTotalBillBeforeDate(Client $client, $before_date)
    {
        $total_session_bill = $client->transaction_records() // total bill
            ->where('transaction_type_id', 1)
            ->whereDate('tr_date', '<', $before_date)
            ->sum('tr_amount');

        $total_write_off_payments = $client->transaction_records()
            ->where('transaction_type_id', 7)
            ->whereDate('tr_date', '<', $before_date)
            ->sum('tr_amount');

        $total_session_bill = $total_session_bill - $total_write_off_payments; // total bill = total bill - total writeoff

        return $total_session_bill;
    }

    public function getCorporateTotalPaidBeforeDate(Corporate $corporate, $before_date)
    {
        $total_regular_payments = $corporate->transaction_records() // total regular payment
            ->where('transaction_type_id', 5)
            ->whereDate('tr_date', '<', $before_date)
            ->sum('tr_amount');

        $total_refund_payments = $corporate->transaction_records()
            ->where('transaction_type_id', 6)
            ->whereDate('tr_date', '<', $before_date)
            ->sum('tr_amount');

        $total_paid = $total_regular_payments - $total_refund_payments; // total paid = total paid - total refund
        return $total_paid;
    }

    public function getCorporateTotalBillBeforeDate(Corporate $corporate, $before_date)
    {
        $total_session_bill = $corporate->transaction_records() // total bill
            ->where('transaction_type_id', 1)
            ->whereDate('tr_date', '<', $before_date)
            ->sum('tr_amount');

        $total_write_off_payments = $corporate->transaction_records()
            ->where('transaction_type_id', 7)
            ->whereDate('tr_date', '<', $before_date)
            ->sum('tr_amount');

        $total_session_bill = $total_session_bill - $total_write_off_payments; // total bill = total bill - total writeoff

        return $total_session_bill;
    }
}