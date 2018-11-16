@component('mail::message')


{{ $user_info->message }}

--
Email: {{ $user_info['email'] }}  
@if( ! empty( $user_info['telephone_number'] ) )
	Phone: {{ $user_info['telephone_number'] }}  
@endif


{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
PriceDrummer.com
@endcomponent
