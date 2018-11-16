<br> 
Hello Seller
<hr>
Email: {{ $user_info['email'] }}
<br>
@if( ! empty( $user_info['telephone_number'] ) )
	Phone: {{ $user_info['telephone_number'] }}
@endif
<hr>
<br>
Message: <br> {{ $user_info['message'] }}