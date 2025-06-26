@extends('layout.main')

@section('content')
<div class="container py-4">
    <h3 class="mb-4"><i class="ti ti-shopping-cart"></i> Keranjang Belanja</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(count($keranjang) > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($keranjang as $item)
                    @php
                        $subtotal = $item->jumlah * $item->sukuCadang->harga;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td class="text-center">
                            <img src="{{ $item->sukuCadang->foto }}" width="60" height="60" class="rounded">
                        </td>
                        <td class="text-center">{{ $item->sukuCadang->nama }}</td>
                        <td class="text-center">Rp {{ number_format($item->sukuCadang->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <input type="number" name="jumlah"
                                value="{{ $item->jumlah }}"
                                min="1"
                                class="form-control form-control-sm jumlah-input"
                                style="width: 80px;"
                                data-id="{{ $item->id }}"
                                data-harga="{{ $item->sukuCadang->harga }}"
                                data-subtotal-id="subtotal-{{ $item->id }}">
                        </td>
                        <td id="subtotal-{{ $item->id }}" class="text-center">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                @csrf
                                <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="table-light">
                    <td colspan="4" class="text-end fw-bold">Total</td>
                    <td colspan="2" class="fw-bold text-success" id="grand-total">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <div class="alert alert-info">Keranjang Anda kosong.</div>
    @endif
</div>
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.jumlah-input').on('change', function () {
            let input = $(this);
            let id = input.data('id');
            let jumlah = parseInt(input.val());
            let harga = parseInt(input.data('harga'));
            let subtotalEl = $('#' + input.data('subtotal-id'));
            let token = '{{ csrf_token() }}';

            $.ajax({
                url: '/keranjang/' + id + '/update',
                type: 'POST',
                data: {
                    _token: token,
                    jumlah: jumlah
                },
                success: function (res) {
                    // Hitung ulang subtotal
                    let subtotal = jumlah * harga;
                    subtotalEl.text('Rp ' + subtotal.toLocaleString('id-ID'));

                    // Update grand total
                    let total = 0;
                    $('.jumlah-input').each(function () {
                        let j = parseInt($(this).val());
                        let h = parseInt($(this).data('harga'));
                        total += j * h;
                    });

                    $('#grand-total').text('Rp ' + total.toLocaleString('id-ID'));
                },
                error: function () {
                    alert('Gagal memperbarui jumlah.');
                }
            });
        });
    });
</script>
@endsection
@endsection

