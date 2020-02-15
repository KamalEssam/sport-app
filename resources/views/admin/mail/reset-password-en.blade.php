Hello {{ $data['name'] }},
 <p>We received a request to reset the password for your account.</p>
  
 <p>If you want to reset your password, copy and paste the reset code into your app</p>
  
 <div>
 <p><b>Reset code :</b> {{ $data['reset_code'] }}</p>
 </div>
  
 <p>If you don't want to reset your password, please ignore this message. Your password will not be reset.</p>
  
 <br/>
 Thank You.
 <br/>