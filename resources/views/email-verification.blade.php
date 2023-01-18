{{-- <h3>Halo, {{ $nama }} !</h3>
<p>{{ $website }}</p>
 
<p>Selamat datang di <a href="citra.net.id">Citranet</a></p>
<p>Test kirim email dengan laravel.</p> --}}

@component('mail::message')
# {{ $data['title'] }}

Hi {{$data['name']}}!,<br>
Terima kasih telah melakukan registrasi melalui aplikasi Customercare Officer Citranet. <br>
Untuk melakukan verifikasi akun, anda dapat menekan tombol berikut. <br>
@component('mail::button', ['url' => $data['url']])
Verify
@endcomponent

Atau akses melalui <a href="{{$data['url']}}">link</a> berikut<br>

Mohon untuk dapat menjaga kerahasian data tersebut. Selamat bekerja<br>

Sekian, terima kasih,<br>
Best Regards<br>
Farhan Kurnia
<br>
@endcomponent