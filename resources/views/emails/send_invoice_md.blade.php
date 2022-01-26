@component('mail::message')
# Dear Client,

Thank you for staying with Psychological Health and Wellness Clinic.
Kindly find attached your service bill copy between <?= date('d M Y', strtotime($from_date)) ?> and <?= date('d M Y', strtotime($to_date)) ?>.

Best Regards,<br>
{{-- {{ config('app.name') }} --}}
Psychological Health and Wellness Clinic
@component('mail::subcopy')
If you have any query, call +8809609013000 or send mail to reception@phwcbd.org
@endcomponent
@endcomponent
