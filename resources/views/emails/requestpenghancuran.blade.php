@extends('emails.template_email')

@section('email')

<section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">    
        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200">Hallo Admin Super,</h2>
            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                {{ $mailData['pemohon'] }} Sedang melakukan Request {{ $mailData['request'] }} Aset.
            </p>
            <h3 class="mt-8">Detail Aset :</h3>
            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Nama Aset : {{ $mailData['nama_aset'] }}
                <br>
                Kategori : {{ $mailData['aset'] }}
                <br>
                Tanggal {{ $mailData['request'] }} : {{ $mailData['tglPemusnahan'] }}
            </p>
            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Segera meberikan Respon, <br>
                Terima Kasih
            </p>
        </main>
    </section>
</section>