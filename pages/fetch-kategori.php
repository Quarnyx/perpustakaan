<?php
session_start();
?>
<?php
$tahun = date('Y');

include '../config.php';

$sql = "SELECT
Count(v_buku_full.nama_kategori) AS total,
v_buku_full.nama_kategori
FROM
v_buku_full
GROUP BY
v_buku_full.nama_kategori
";


$hasil = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($hasil)) {
    $nama_kategori_pustaka[] = $data['nama_kategori'];
    $total[] = $data['total'];

}
?>
<script>
    options = {
        series: <?php echo json_encode($total); ?>.map(Number),
        chart: { height: 286, type: "donut" },
        labels: <?php echo json_encode($nama_kategori_pustaka); ?>,
        plotOptions: {
            pie: {
                donut: {
                    size: "73%",
                    labels: {
                        show: !0,
                        name: {
                            show: !0,
                            fontSize: "18px",
                            offsetY: 5
                        },
                        value: {
                            show: !1,
                            fontSize: "20px",
                            color: "#343a40",
                            offsetY: 8
                        },
                        total: {
                            show: !0,
                            fontSize: "17px",
                            label: "Kategori",
                            color: "#6c757d",
                            fontWeight: 600
                        }
                    }
                }
            }
        },
        dataLabels: { enabled: !1 },
        colors: ["#0f9cf3", "#6fd088", "#ffbb44"]
    };
    (chart = new ApexCharts(document.querySelector("#tampil_grafik_transaksi_per_kategori"),
        options)).render();
</script>