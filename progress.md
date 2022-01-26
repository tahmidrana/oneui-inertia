<p align="center"><a href="https://laravel.com" target="_blank"><img src="public/theme/media/phwc-logo.png" width="400"></a></p>

## PHWC v1.0
* Admin Console
    * `Permission` - Add, Update, Delete
    * `Menu` - Add, Update, Delete
    * `User type` - Add, Update, Delete, Assign

* Users
    * Add new user
    * View list, activate, deactivate, password reset
    * Update user

* Clinicians
    * Add new - (Need to filter supervisor list)
    * Update clinician
    * View list, activate, deactivate, password reset

* Clients
    * Add corporate client (Service contract expire date need to fix)
    * Update corporate client
    * View list, activate, deactivate
    * Add `General Client`
    * Update `General client`

* Settings
    * Timeslot
        * Add timeslot (with availability check)


### Permission Applied to
* Clients - Controller
* Corporate
    * Controller, View
    * Corporate Discount policy controller
* Clinician - Controller, Post Request
* User - Controller, Post Request, Update Request

### TBD

-------------------------------------------------------------------------------------------------------
## v1.2 Progress
------------------------------
1. Add clinical session - Done
2. Manage clinical session (Pending)
    1. Filter - Done
    2. Edit - Done
    3. Delete - Done
3. Manage clinical session (Confirmed)
    1. Discount - Done
    2. Additional Charge - Done
4. Discount & Additional Fees request - Done
5. Session Invitation - Done
6. Client profile -> Session History - Done (recheck) - 1.8-1.2
7. Client profile -> Advice
    1. Session note, Prescription - Done
    2. Download all - TBD
    3. Session Note download - Done
    4. Prescription download - Done
    5. Prescription view - Done
    6. Assessment/Core 10 view/download - Done
8. Add non clinical session - Done
9. Manage non clinical session
    1. Fiter - Done
    2. Edit - Done
    3. Delete - Done
    4. Confirm - Done
10. (Admin View) Clinician profile -> Session History - Done(90%) - 3.0-1.2
11. Calendar - Done
    1. Clinician Wise view
    2. Room wise view
12. Dashboard Page - Done
----------------------------------------------------------------------------