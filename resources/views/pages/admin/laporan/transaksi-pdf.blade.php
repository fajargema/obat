<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LAPORAN TRANSAKSI</title>
    <style>
        .text-center {
            text-align: center;
        }



        .satu {

            float: left;
            margin: 20px;

        }

        .dua {

            float: right;
            margin: 20px;

        }

        .center-hor {
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
</head>

<body class="A4" id="area">

    <div>
        <h1 class="text-center">LAPORAN TRANSAKSI</h1>
        <h3 class="text-center" style="margin-top:-20px;">APOTEK BAKUNG</h3>
        <p class="text-center" style="margin-top:-16px;">
            Alamat : Jl Moch Ramdhan -
            Telp : 081224718794 /
            Fax : 089673902507
        </p>
        <hr>
        <p>Periode : {{ $from }} - {{ $to }}</p>
    </div>
    <section class="sheet padding-10mm">

        <table width="100%" cellspacing="0" style="margin: 10px; font-size:10pt " border="1" class="text-center">
            <thead>
                <tr style="background-color:yellow;">
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
                <tr style="background-color: yellow;">
                    <td>Omset Penjualan : </td>
                    <td colspan="5">{{ rupiah($total) }}</td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section>

        <div class="satu">
            <p>Diperiksa Oleh</p>
            <p> Apoteker </p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p>{{ \Auth::user()->nama }}</p>
            <p>...................................</p>
        </div>

        <div class="dua">
            <p>Disetujui Oleh</p>
            <p> Akuntansi </p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p>{{ \Auth::user()->nama }}</p>
            <p>...................................</p>
        </div>
    </section>

    <script>
        window.print();
    </script>
</body>

</html>
