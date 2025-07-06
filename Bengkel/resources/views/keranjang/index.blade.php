@extends('layout.main')

@section('title','Keranjang')

@section('content')
<style>
    .checkout-footer-fixed {
        position: fixed;
        bottom: 0;
        left: 250px;
        right: 0;
        background-color: #fff;
        border-top: 1px solid #e0e0e0;
        z-index: 1100;
        padding: 8px 20px;
        box-shadow: 0 -1px 6px rgba(0, 0, 0, 0.08);
    }
    .checkout-footer-fixed .container-fluid {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .checkout-footer-fixed .btn {
        padding: 6px 16px;
        font-size: 14px;
    }
    @media (max-width: 768px) {
        .checkout-footer-fixed {
            left: 0;
            padding: 12px 16px;
        }
        .checkout-footer-fixed .container-fluid {
            flex-direction: column;
            align-items: flex-start;
        }
        .checkout-footer-fixed .btn {
            width: 100%;
        }
    }
</style>

<div class="container py-4" style="margin-bottom: 120px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="ti ti-shopping-cart"></i> Keranjang Belanja</h3>
        <form method="POST" action="{{ route('keranjang.hapusTerpilih') }}" id="form-hapus-terpilih" class="d-none">
            @csrf
            <input type="hidden" name="ids" id="hapus-terpilih-ids">
            <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin ingin menghapus item terpilih?')">
                <i class="ti ti-trash"></i> Hapus
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(!empty($keranjang) && count($keranjang) > 0)
        <form method="GET" action="{{ route('transaksiBengkel.create') }}" id="form-checkout">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Pilih</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang as $item)
                        @php $subtotal = $item->jumlah * $item->sukuCadang->harga; @endphp
                        <tr>
                            <td class="text-center align-middle">
                                <input type="checkbox" class="check-item" value="{{ $item->id }}">
                                <input type="hidden" name="sukuCadangs[{{ $item->sukuCadang->id }}][id]"
                                    value="{{ $item->sukuCadang->id }}" class="input-id" disabled>
                                <input type="hidden" name="sukuCadangs[{{ $item->sukuCadang->id }}][jumlah]"
                                    value="{{ $item->jumlah }}" class="input-jumlah" disabled>
                            </td>
                            <td class="text-center">
                                <img src="{{ $item->sukuCadang->foto }}" width="60" height="60" class="rounded">
                            </td>
                            <td class="text-center">{{ $item->sukuCadang->nama }}</td>
                            <td class="text-center">Rp {{ number_format($item->sukuCadang->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <input type="number" value="{{ $item->jumlah }}" class="form-control form-control-sm jumlah-input text-center"
                                    style="width: 80px;" data-id="{{ $item->id }}" data-harga="{{ $item->sukuCadang->harga }}"
                                    data-subtotal-id="subtotal-{{ $item->id }}">
                            </td>
                            <td id="subtotal-{{ $item->id }}" class="text-center">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    @else
        <div class="alert alert-info">Keranjang Anda kosong.</div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        function updateHapusTerpilih() {
            let selectedIds = $('.check-item:checked').map(function () {
                return $(this).val();
            }).get();

            $('#hapus-terpilih-ids').val(selectedIds.join(','));

            let total = 0;
            $('.check-item').each(function () {
                let row = $(this).closest('tr');
                let idInput = row.find('.input-id');
                let jumlahInput = row.find('.jumlah-input');
                let jumlahHiddenInput = row.find('.input-jumlah');

                if ($(this).is(':checked')) {
                    let jumlah = parseInt(jumlahInput.val());
                    let harga = parseInt(jumlahInput.data('harga'));
                    total += jumlah * harga;

                    idInput.prop('disabled', false);
                    jumlahHiddenInput.prop('disabled', false).val(jumlah);
                } else {
                    idInput.prop('disabled', true);
                    jumlahHiddenInput.prop('disabled', true);
                }
            });

            $('#grand-total').text('Rp ' + total.toLocaleString('id-ID'));
            $('#form-hapus-terpilih').toggleClass('d-none', selectedIds.length === 0);
            $('#btn-checkout').prop('disabled', selectedIds.length === 0);
        }

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
                data: { _token: token, jumlah: jumlah },
                success: function () {
                    subtotalEl.text('Rp ' + (jumlah * harga).toLocaleString('id-ID'));
                    updateHapusTerpilih();
                },
                error: function () {
                    alert('Gagal memperbarui jumlah.');
                }
            });
        });

        $('.check-item').on('change', updateHapusTerpilih);
        updateHapusTerpilih();
    });
</script>
@endsection

<div class="checkout-footer-fixed">
    <div class="container-fluid">
        <div class="fw-bold mb-0 mt-2">
            Total: <span class="text-success" id="grand-total">Rp 0</span>
        </div>
        <button type="submit" class="btn btn-success px-4 me-3 mt-3" id="btn-checkout" form="form-checkout" disabled>
            <i class="ti ti-shopping-cart"></i> Checkout
        </button>
    </div>
</div>
