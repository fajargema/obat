<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<table>
    <thead>
        <tr>
            <th>Invoice</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Obat</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->kode }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->jk }}</td>
            <td>{{ $item->medicine->nama }}</td>
            <td>{{ $item->jumlah }} {{ $item->medicine->satuan }}</td>
            <td>{{ rupiah($item->total) }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr style="border-top: 1px solid black;">
            <td>Omset Penjualan : </td>
            <td colspan="5">{{ rupiah($total) }}</td>
        </tr>
    </tfoot>
</table>




</html>
