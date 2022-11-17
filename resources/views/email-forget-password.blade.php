{{-- <h3>Halo, {{ $nama }} !</h3>
<p>{{ $website }}</p>
 
<p>Selamat datang di <a href="citra.net.id">Citranet</a></p>
<p>Test kirim email dengan laravel.</p> --}}

@component('mail::message')
# {{ $data['title'] }}

Hi!, <br>
Kode OTP kamu sebagai berikut ya.<br>
### {{$data['otp']}}
<br>
Masukan kode OTP dan email pada halaman lupa password. <br>
Mohon untuk dapat menjaga kerahasian data tersebut. <br>

Sekian, terima kasih,<br>
Best Regards<br>
Farhan Kurnia<br>

@endcomponent