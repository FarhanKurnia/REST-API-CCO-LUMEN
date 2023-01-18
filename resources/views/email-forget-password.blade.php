{{-- <h3>Halo, {{ $nama }} !</h3>
<p>{{ $website }}</p>
 
<p>Selamat datang di <a href="citra.net.id">Citranet</a></p>
<p>Test kirim email dengan laravel.</p> --}}

@component('mail::message')
# {{ $data['title'] }}

Hi!, <br>
Kode OTP kamu sebagai berikut ya.<br>
## {{$data['otp']}}
Kamu dapat memasukan kode OTP dan email pada halaman lupa password. <br>
<br>
<br>
Atau klik tombol aktivasi di bawah untuk menggunakan password default dari sistem.<br>
@component('mail::button', ['url' => $data['url']])
Activate
@endcomponent
Password default kamu adalah <strong>{{$data['random_pass']}}</strong><br>
Harap langsung mengganti password setelah login ya.<br>
Mohon untuk dapat menjaga kerahasian data tersebut. Selamat bekerja<br>
<br>
<br>
Sekian, terima kasih,<br>
Best Regards<br>
Farhan Kurnia<br>

@endcomponent