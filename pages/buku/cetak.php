<?php
include '../../config.php';
$sql = mysqli_query($conn, "SELECT * FROM buku WHERE id = '$_GET[id]'");
$row = mysqli_fetch_array($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <title>Print</title>
    <style type="text/css">
        .texttt {
            color: black;
            font-family: poppins;
            font-weight: bold;
            font-size: 9pt;
            padding-left: 0.3cm;
        }

        .titlett {
            font-weight: 600;
            color: black;
            font-family: poppins;
            height: 0.3cm;
            font-size: 12pt;
            text-align: center;

        }

        table,
        table tr td,
        table tr th {
            page-break-inside: avoid;
        }

        .tg {
            table-layout: fixed;
            width: 5cm;
            height: 6cm;
            background-repeat: no-repeat;
            background-size: cover;
            /* margin: 0.3cm */
        }
    </style>
</head>

<body style="width: 21cm; height: 29cm; padding:0.1cm; background-color:white">
    <?php
    $count = $_GET['count'];
    ?>
    <div style="display: flex; flex-wrap: wrap;">
        <?php for ($i = 0; $i < $count; $i++) { ?>
            <table style="border-collapse: collapse; border: 2px solid #ddd; display: inline-block;" class="tg">
                <tbody>
                    <tr>
                        <td class="text-center"><img class="img-fluid"
                                src="../../assets/images/qrcode/buku-<?php echo "$row[kode_buku]" ?>.png" alt="Image"
                                style="width: 4cm"></td>
                    </tr>
                    <tr>
                        <td class="titlett">Milik Perpustakaan SMANCEP</td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>
    </div>
    <script>
        window.print();
        window.onafterprint = window.close;
    </script>
</body>



</html>