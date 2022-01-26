N.B:
* In dev/production server create a fonts folder in storage and permission 777 (for dompdf)
** mkdir storage/fonts. chmod 777 storage/fonts

> Guest clinician must accept invitation first
* Session Note
    1. Only counselor clinician
* Prescriptions
    1. Only psychiatrist clinician
* Core Ten
    1. Only host clinician

Q1. Can session note / prescription be created before core ten?
> Ans: No

Q. Multiple core ten/session note/prescription possible for a session?
> Ans: Core 10 can be submitted once only by the host clinician for a session.
And all the clinician involved in the session can either submit one Session notes (if the clinician is a counselor)or one Prescription (if the clinician is a psychiatrist).



----------------------------------------------------------------------------
* If the selected room has any pending session at that time then the system will not allow the user to create the session.
* if the host of the session has any other session or accepted any session invitation at that time, then
he can’t create the session.

* Notified after selecting Clinician-Code (Javascript alert) if the clinician has
any other session within that time frame.
* If the guest clinician has other session within the time frame and he accepted the session then the
notification will be for example “XYZ has accepted a session in this time frame”
* If the invited clinician has other session within the time frame and he is yet to accept the session
(which mean pending session) then the notification will be for example “XYZ has a session in this time
frame which he has not confirmed yet”



Overlaps:
0. can not create, If selected room is not free - Done
1. can not create, If overlaps with own clinical/non sessions - Done
2. can not create, If overlaps with accepted session invitations - Done

3. Notify, If guest clinician accepted any invitation
4. Notify, If guest clinician has pending invitation
----------------------------------------------------------------------------

## Billing
* Manage clinical sessions -> cancel individual session -> if bill percentage is > 0, Add Bill for client
* Manage clinical sessions -> confirm individual session -> Add Bill for client
-> Check if this particular session eligible for corporate discount -> if yes -> new transaction with discount deduct
-> if no -> return

* Additional charge confirm -> Add bill for client
* Discount confirm -> new transaction with discount deduct


# Regular, Refund, Write-off
-> regular adds with Total paid
-> refund deducts from Total paid
-> write-off deducts from Total bill

* total_bill = (total_session_bill / total_corporate_bill) - total_writeoff_payment
* total_paid = total_regular_payment - total_refund_payment
* balance = total_paid - total_bill


1. Service Bills - done
2. Discount - done
3. Cancellation Charge - done
4. Additional Charge - done
5. Regular Payment - done
6. Refund - done
7. Write off - done
---------------------------------------------

* previous due = if total_paid till previous date - total_bill till previous date <=0 
* advance = if total_paid till previous date - total_bill till previous date > 0 

* net payable / (remaining balance)


### reports:
--------------------------------------------
* Clinician session report - done
* Clinician hour log - done
* Client session report - done
* Room Utilization report - done
* Account Received Report - done
* Account Receivable Report - done
* Credit Aging Report - done
* Session Wise Bills Status - done

### notifications:
--------------------------------------------
* Individual Client Enrollment - DONE
* Client Initial Assign - DONE
* Clinical Session Invitation - DONE
* Clinical Session Invitation Response - DONE
* Clinical Session Cancellation - DONE
* Clinical Session Edit - DONE
* Clinical Session Delete - DONE
* Clinical Session Confirmation - DONE
* Additional Charge Request - DONE
* Additional Charge Request Response - DONE
* Discount Request - DONE
* Discount Request Response - DONE
* Client Handover Request - DONE
* Client Handover Request Response - DONE
* Supervision Session Invitation - DONE
* Supervision Session Invitation Response - DONE
* Supervision Session Confirmation - DONE
* Supervision Session Edit (Date / Time /Place of Service) - DONE
* Supervision Session Delete - DONE

### sms notifications:
--------------------------------------------
* Clinical Session Create - DONE
* Clinical Session Cancel - DONE
* 24 Hours before Clinical Session Time - DONE
* Clinical Session Edit (Only if the date, time or place of service changes) - DONE
* Clinical Session delete - DONE

### Issues
-------------------------
* 5210 - only show if there is any "previous" due/advance available
* 5209 - only show if there is any "previous" due/advance available
* 5222 - no issue found
* 5213 - no issue found
* 5211 - no issue found
* 5208 - no issue found (check description of issue)

* Manage clinical session datatable error (Clinician user - SF8547) - done

### UAT Dependencies
-------------------------
* (SRS-1.1 / 5.6-1.1) - Clinician Assign Request: CLINICIAN requests assign/release/handover of client to SUPERVISOR 
* (SRS-1.2 / 1.4-1.2 / 1.5-1.2 / 1.6-1.2) - Additional charge/Discount request: CLINICIAN  created additional charge/discount request for a confirmed session to ADMIN

### Need to Update
* Create a discount record for a client who is eligible for corporate discount after new session created. So that a record exists for session corporate discount


### UAT-2 Feedback:
* Show client payments with bills in invoice (billing & financial) - DONE
* Show payment details page immediately after a payment created (billing & financial) - DONE
* Add client filter option on Client session report - DONE
* Add client wise filter for Credit aging report - DONE
* Add client filter option on Account Received report - DONE
* Add new column for individual payment amount with date (Account Received report) (need to discuss as it shows repetitive data)
* Admin need to approve a session if the client has previous due


### UAT All feedbacks:
* In the Non-clinical session – Remarks filed will contain the text limit of 150k - DONE
* Individual Client Add – 3 categories/types will be added in (dropdown). PHWC will give the data. - 3 hrs - DONE
* In the Billing & Financial section, the System should show client payments with every bill in the invoice. - 8 hrs - DONE
* In the Billing & Financial section, Show payment details page immediately after a payment is created. - DONE
* Add client filter option on Client session report - DONE
* Add client wise filter for Credit aging report - 1 hr - DONE
* Add client filter option on Account Received report. - 1 hr - DONE
* Add a new column for the individual payment amount with the date (Account Received report). - 2 hr (need to discuss as it shows repetitive data) - TBD
* Session notes will be similar to core 10. There will be some additional fields. PHWC will give the data - 5 hrs - TBD
* Clinician - There will be session notes and prescriptions both options for Psychiatrist - 6 hrs - DONE
* Admin needs to approve a session if the client has due. - 8 hr - DONE