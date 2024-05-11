@extends('dashboard.layouts.main')

@section('container')

<div class="container mt-36 mb-10">
    <div class="bg-white w-auto rounded-xl shadow-xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="flex justify-between items-center">
          <div>
            <h1 class="text-xl font-bold text-gray-800">Request</h1>
            <p class="font-sans text-sm text-slate-400">Peminjaman/Pengembalian/Penghancuran</p>
          </div>
        </div>
        <div class="flex flex-col mt-10">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200">
                  @if(count($peminjaman) > 0)
                  <div>
                      <div class="py-3 px-4">
                        <h1 class="text-lg font-semibold text-gray-900">Peminjaman</h1>
                      </div>
                      <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                            <tr>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Kode Peminjaman</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Aset</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Peminjaman</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                              <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200">
                            
                            @php ($i = 0)
                            @foreach ($peminjaman as $pe)
                            @php($i++)
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $i }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->kodePeminjaman ? $pe->kodePeminjaman : 'XXXX/XXX/XXX/XX' }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->user->name }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->aset->namaAset }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->tglPeminjaman }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm  @if ($pe->status === 'Diterima')
                                text-green-600 font-semibold
                                @elseif($pe->status === 'Diproses')
                                    text-yellow-600 font-semibold
                                @elseif($pe->status === 'Ditolak')
                                    text-red-600 font-semibold
                                @endif">{{ $pe->status }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <a href="{{ route('request.terima.peminjaman', $pe->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-green-500 hover:text-green-800 disabled:opacity-50 disabled:pointer-events-none">Terima</a>
                                <a href="{{ route('request.tolak.peminjaman', $pe->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-500 hover:text-red-800 disabled:opacity-50 disabled:pointer-events-none">Tolak</a>
                                <a href="{{ route('request.show.peminjaman', $pe->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-slate-500 hover:text-slate-700 disabled:opacity-50 disabled:pointer-events-none">Detail</a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  @endif
                  @if(count($pengembalian) > 0)
                  <div>
                      <div class="py-3 px-4">
                        <h1 class="text-lg font-semibold text-gray-900">Pengembalian</h1>
                      </div>
                      <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                            <tr>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Kode Pengembalian</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Aset</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Pengembalian</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                              <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200">
                            @php ($i = 0)
                            @foreach ($pengembalian as $pe)
                            @php($i++)
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $i }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->kodePengembalian}}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->user->name }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->aset->namaAset }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->tglPengembalian }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm  @if ($pe->status === 'Diterima')
                                text-green-600 font-semibold
                                @elseif($pe->status === 'Diproses')
                                    text-yellow-600 font-semibold
                                @elseif($pe->status === 'Ditolak')
                                    text-red-600 font-semibold
                                @endif">{{ $pe->status }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <a href="{{ route('request.terima.pengembalian', $pe->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-green-500 hover:text-green-800 disabled:opacity-50 disabled:pointer-events-none">Terima</a>
                                <a href="{{ route('request.show.pengembalian', $pe->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-slate-500 hover:text-slate-700 disabled:opacity-50 disabled:pointer-events-none">Detail</a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                  @endif
                  @if(count($penghancuran) > 0)
                  <div>
                      <div class="py-3 px-4">
                        <h1 class="text-lg font-semibold text-gray-900">Penghancuran</h1>
                      </div>
                      <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                            <tr>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama Aset</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Aset</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tipe Pemusnahan</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Pemusnahan</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Pemohon</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">status</th>
                              <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200">
                            @php ($i = 0)
                            @foreach ($penghancuran as $pe)
                            @php($i++)
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $i }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->nama_aset}}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->aset->namaAset }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->tipePemusnahan }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->tglPemusnahan }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $pe->userpemohon->name }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm  @if ($pe->status === 'Diterima')
                                text-green-600 font-semibold
                                @elseif($pe->status === 'Diproses')
                                    text-yellow-600 font-semibold
                                @elseif($pe->status === 'Ditolak')
                                    text-red-600 font-semibold
                                @endif">{{ $pe->status }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <a href="{{ route('request.terima.penghancuran', $pe->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-green-500 hover:text-green-800 disabled:opacity-50 disabled:pointer-events-none">Terima</a>
                                <a href="{{ route('request.tolak.penghancuran', $pe->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-500 hover:text-red-800 disabled:opacity-50 disabled:pointer-events-none">Tolak</a>
                                <a href="{{ route('request.show.penghancuran', $pe->id) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-slate-500 hover:text-slate-700 disabled:opacity-50 disabled:pointer-events-none">Detail</a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        
    </div>
</div>
@endsection