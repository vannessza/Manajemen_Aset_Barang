@extends('emails.template_email')

@section('email')

<section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">    
        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200">Hallo {{ $mailData['name'] }},</h2>
            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                Request {{ $mailData['request'] }} Aset Telah  {{ $mailData['respon'] }}.
            </p>
            <h3 class="mt-8">Detail Aset :</h3>
            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Nama Aset : {{ $mailData['namaAset'] }}
                <br>
                Kategori : {{ $mailData['kategori'] }}
                <br>
                Tanggal {{ $mailData['request'] }} : {{ $mailData['tanggal'] }}
                <br>
                Lokasi : {{ $mailData['lokasi'] }}
                <br>
                Keterangan : {{ $mailData['keterangan'] }}
            </p>
            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Terima Kasih
            </p>
        </main>
    </section>
</section>