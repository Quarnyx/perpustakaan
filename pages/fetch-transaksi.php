<?php
session_start();
?>

<?php
include '../config.php';
$tahun = date('Y');

$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

for ($bulan = 1; $bulan <= 12; $bulan++) {

    $sql = "SELECT
            MONTH (tanggal_pinjam) AS bulan,
                    count(*) AS total
                FROM
                    pengembalian d
                INNER JOIN peminjaman p ON p.id = d.peminjaman_id
                WHERE
                    MONTH (tanggal_pinjam) = '$bulan'
                AND YEAR (tanggal_pinjam) = '$tahun'
                GROUP BY
                bulan";
    $hasilkembali = mysqli_query($conn, $sql);
    $datakembali = mysqli_fetch_array($hasilkembali);

    if (isset($datakembali['total']) != 0) {
        $totalkembali[] = $datakembali['total'];
    } else {
        $totalkembali[] = 0;
    }

    $sqlb = "SELECT
                MONTH(peminjaman.tanggal_pinjam) AS bulan,
                Count(*) AS total
                FROM
                peminjaman
                WHERE
                MONTH(peminjaman.tanggal_pinjam) = '$bulan' AND
                YEAR (peminjaman.tanggal_pinjam) = '$tahun' AND
                peminjaman.`status` = 'pinjam'
                ";
    $hasilpinjam = mysqli_query($conn, $sqlb);
    $datapinjam = mysqli_fetch_array($hasilpinjam);

    if (isset($datapinjam['total']) != 0) {
        $totalpinjam[] = $datapinjam['total'];
    } else {
        $totalpinjam[] = 0;
    }
}
?>

<script>
    var options =
    {
        series:
            [{ name: "Pinjam", data: <?php echo json_encode($totalpinjam); ?> },
            { name: "Kembali", data: <?php echo json_encode($totalkembali); ?> }],
        chart: {
            toolbar: { show: !1 },
            height: 350,
            type: "area"
        },
        dataLabels: { enabled: !1 },
        yaxis: {
            labels: { formatter: function (e) { return e } }
        },
        stroke: { curve: "smooth", width: 2 },
        grid: {
            show: !0,
            borderColor: "#90A4AE",
            strokeDashArray: 0,
            position: "back",
            xaxis: { lines: { show: !0 } },
            yaxis: { lines: { show: !0 } },
            row: {
                colors: void 0,
                opacity: .8
            },
            column: { colors: void 0, opacity: .8 },
            padding: { top: 10, right: 0, bottom: 10, left: 10 }
        },
        legend: { show: !1 },
        fillcolors: ["#0f9cf3", "#6fd088"],
        labels: <?php echo json_encode($label); ?>
    }, chart = new ApexCharts(document.querySelector("#tampil_grafik_transaksi_per_bulan"),
        options);
    chart.render();
</script>