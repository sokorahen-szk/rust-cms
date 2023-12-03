こんにちは、{{ $accountId }} さん<br />
<br />
{{ $appTitle }}へのご登録、誠にありがとうございます。<br />
アカウントを有効にするには、以下のリンクをクリックしてメールアドレス認証を行ってください。<br />
<br />
<a target="_blank" href="{{ $verifyEmail }}">{{ $verifyEmail }}</a><br />
<br />
このリンクをクリックすると、アカウントが有効化されます。<br />
※このメール認証リンクは{{ $verifyExpiresMinutes }}分で無効になります。<br />
※期限内にクリックしてメールアドレス認証するようにしてください。<br />