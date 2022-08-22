<?php

# File created using Visual Studio Code: https://code.visualstudio.com/




if (!defined("DOCUMENT_ROOT")) {
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
}

require_once DOCUMENT_ROOT.'/configs.php';
require_once DOCUMENT_ROOT.'/session/session.class.php';

$session = new Session();

$_SESSION['tokenName'] = md5(uniqid(mt_rand(), true));
$_SESSION['tokenValue'] = md5(uniqid(mt_rand(), true));


if (!isset($_SESSION['HTTP_REFERER']) || $_SESSION['HTTP_REFERER'] !== 'ecommerceloginpage') {
    unset($_SESSION['loginerrors']);
    unset($_SESSION['loginsuccess']);
}
if (isset($_SESSION['HTTP_REFERER'])) {
    unset($_SESSION['HTTP_REFERER']);
}




?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>ecommerce site</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/assets/site/css/main.css?version=<?php echo filemtime('/assets/site/css/main.css'); ?>">

</head>
<body>
<?php require_once DOCUMENT_ROOT.'/templates_include/header.php'; ?>

<section id="page_container" class="w-100 px-4 py-5 bg-white border rounded-5">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>

    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-7 col-xl-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="img-fluid reg_image001" data-name="Layer 1" width="1010.89168" height="727.28412" viewBox="0 0 1010.89168 727.28412"><title>unlock</title><path d="M1105.44584,813.64206q-78.13266-11.44365-150.28146-19.73l19.01951-30.77769c-6.41163-1.89409-34.58476,15.65146-34.58476,15.65146l24.9672-89.4801c-32.24833,3.10673-48.65763,94.51337-48.65763,94.51337L879.884,752.72283l17.43785,34.85367c-147.2123-15.19523-274.3507-21.16492-381.28967-21.85348L532.311,739.38054c-6.41164-1.8941-34.58476,15.65146-34.58476,15.65146l24.9672-89.4801c-32.24834,3.10672-48.65763,94.51337-48.65763,94.51337L438.01107,728.969l18.46945,36.91575c-89.651,1.08665-162.76069,5.87171-219.19088,11.45114,16.46742-41.07795,72.39365-79.96014,72.39365-79.96014-42.70771,10.43621-65.112,28.1517-76.82,44.71011-.89495-50.81752,5.12559-144.99985,49.85547-249.09453,0,0-88.29554,160.40869-77.04785,268.40786l1.34441,19.17452c-74.83623,8.62484-112.4612,17.78422-112.4612,17.78422Z" transform="translate(-94.55416 -86.35794)" fill="#3f3d56"/><path d="M632.0806,115.488v648.2a29.13909,29.13909,0,0,1-29.13,29.11h-263.15a29.07906,29.07906,0,0,1-29.13-29.11v-648.2a29.12748,29.12748,0,0,1,29.13-29.13h39.38v5.05a23.987,23.987,0,0,0,23.98,23.99h133.84a23.78923,23.78923,0,0,0,14.22-4.68,22.28455,22.28455,0,0,0,2.36-1.98,23.917,23.917,0,0,0,7.4-17.33v-5.05h41.97A29.12108,29.12108,0,0,1,632.0806,115.488Z" transform="translate(-94.55416 -86.35794)" fill="#3f3d56"/><circle cx="289.42646" cy="108" r="7" fill="#f2f2f2"/><path d="M553.5806,108.738a22.28455,22.28455,0,0,1-2.36,1.98,125.247,125.247,0,0,0,80.86,60.19v-3.12A122.29883,122.29883,0,0,1,553.5806,108.738Z" transform="translate(-94.55416 -86.35794)" fill="#1266f1"/><path d="M493.7706,115.39792h-3.28a181.66827,181.66827,0,0,0,141.59,113.05v-3.1A178.54983,178.54983,0,0,1,493.7706,115.39792Z" transform="translate(-94.55416 -86.35794)" fill="#1266f1"/><path d="M433.35062,115.39792h-3.16c26.43,91.74,106.18,160.03,201.89,171.12v-3.05C538.03061,272.428,459.65061,205.4379,433.35062,115.39792Z" transform="translate(-94.55416 -86.35794)" fill="#1266f1"/><polygon points="266.426 159.822 264.604 159.822 264.604 158 264.249 158 264.249 159.822 262.426 159.822 262.426 160.178 264.249 160.178 264.249 162 264.604 162 264.604 160.178 266.426 160.178 266.426 159.822" fill="#f2f2f2"/><polygon points="389.426 68.822 387.604 68.822 387.604 67 387.249 67 387.249 68.822 385.426 68.822 385.426 69.178 387.249 69.178 387.249 71 387.604 71 387.604 69.178 389.426 69.178 389.426 68.822" fill="#f2f2f2"/><polygon points="284.426 231.822 282.604 231.822 282.604 230 282.249 230 282.249 231.822 280.426 231.822 280.426 232.178 282.249 232.178 282.249 234 282.604 234 282.604 232.178 284.426 232.178 284.426 231.822" fill="#f2f2f2"/><polygon points="368.426 178.822 366.604 178.822 366.604 177 366.249 177 366.249 178.822 364.426 178.822 364.426 179.178 366.249 179.178 366.249 181 366.604 181 366.604 179.178 368.426 179.178 368.426 178.822" fill="#f2f2f2"/><polygon points="488.426 211.822 486.604 211.822 486.604 210 486.249 210 486.249 211.822 484.426 211.822 484.426 212.178 486.249 212.178 486.249 214 486.604 214 486.604 212.178 488.426 212.178 488.426 211.822" fill="#f2f2f2"/><circle cx="467.42646" cy="125" r="4" fill="#ff6584"/><path d="M418.68064,305.15793l-2.27.35c.71,4.54,1.27,9.18,1.68,13.77l2.29-.2C419.97061,314.428,419.40061,309.748,418.68064,305.15793Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M412.47061,277.8179l-2.2.67005c1.33,4.4,2.52,8.91,3.53,13.4l2.25-.51C415.0206,286.83792,413.81064,282.27792,412.47061,277.8179Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M402.56064,251.59793l-2.09.96c1.92,4.19,3.72,8.49,5.35,12.79l2.15-.81C406.32065,260.1879,404.51065,255.82791,402.56064,251.59793Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M389.16062,227.01792l-1.94,1.23c2.47,3.87994,4.84,7.9,7.04,11.93l2.02-1.1C394.06064,234.998,391.66062,230.9379,389.16062,227.01792Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M372.50064,204.488l-1.75,1.49c2.98,3.5,5.88,7.16,8.62,10.86l1.84-1.37C378.45059,211.72794,375.5206,208.02792,372.50064,204.488Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M352.92063,184.428l-1.53,1.71c3.44,3.07,6.81,6.3,10.02,9.59l1.65-1.61C359.81064,190.78793,356.40061,187.52792,352.92063,184.428Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M330.80063,167.20792l-1.29,1.9c3.82,2.57,7.6,5.31,11.23,8.14l1.42-1.81006C338.48062,172.57791,334.66062,169.808,330.80063,167.20792Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M310.67063,155.248v2.6c2.39,1.25,4.76,2.56,7.08,3.9l1.15-1.99Q314.85058,157.41791,310.67063,155.248Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M418.16091,521.16082c.373-2.236.71425-4.5192,1.01475-6.78518l2.27933.30227c-.30389,2.29157-.649,4.5992-1.02589,6.86071Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M411.75189,548.14021l2.19741.68431c1.37871-4.44384,2.62647-8.99608,3.70743-13.53149l-2.23928-.52959C414.34645,539.24986,413.12052,543.74533,411.75189,548.14021Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M401.71048,573.97176l2.0863.978c1.98369-4.2078,3.84038-8.54363,5.52458-12.88411l-2.14578-.83709C405.51127,565.52206,403.67434,569.81092,401.71048,573.97176Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M388.199,598.20534l1.92823,1.25186c2.54321-3.89939,4.983-7.94236,7.25441-12.00964l-2.00526-1.12476C393.13462,590.34512,390.71455,594.3411,388.199,598.20534Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M371.48232,620.34395l1.74272,1.51c3.05929-3.52841,6.02513-7.19843,8.83619-10.91033l-1.84138-1.377C377.44823,613.23551,374.512,616.86051,371.48232,620.34395Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M351.90747,639.98907l1.51427,1.72861c3.51621-3.06749,6.95467-6.304,10.24042-9.59211l-1.62648-1.629C358.78733,633.75148,355.37844,636.943,351.90747,639.98907Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M329.85451,656.77957l1.27021,1.92364c3.88265-2.56378,7.73865-5.29636,11.43808-8.112l-1.39026-1.83593C337.50854,651.54757,333.69978,654.249,329.85451,656.77957Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M319.16062,666.00791c-2.78,1.57-5.62,3.09-8.49,4.53v-2.58c2.48-1.26,4.94-2.59,7.35-3.94Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M418.83559,333.46366l2.29863-.04178c.04223,2.3211.04537,4.6545.00942,6.93606l-2.29844-.03589C418.88015,338.06645,418.87714,335.75892,418.83559,333.46366Z" transform="translate(-94.55416 -86.35794)" fill="#e6e6e6"/><path d="M226.21644,301.63184H461.42653a65.99993,65.99993,0,0,1,65.99993,65.99993v8.73639a0,0,0,0,1,0,0H292.21638a65.99993,65.99993,0,0,1-65.99993-65.99993v-8.73639A0,0,0,0,1,226.21644,301.63184Z" fill="#fff"/><path d="M476.87034,791.87943c-.22949-.375-5.64063-9.41016-7.5166-28.17188-1.72071-17.21289-.61426-46.22656,14.43261-86.69824,28.50586-76.6709-6.56933-138.5332-6.92773-139.14941l1.73047-1.00391c.09082.15625,9.1416,15.92871,14.48828,41.04394a179.06112,179.06112,0,0,1-7.416,99.80664c-28.457,76.54-7.30078,112.77344-7.084,113.13086Z" transform="translate(-94.55416 -86.35794)" fill="#f2f2f2"/><circle cx="371.1697" cy="434" r="13" fill="#1266f1"/><circle cx="412.1697" cy="482" r="13" fill="#f2f2f2"/><circle cx="384.1697" cy="514" r="13" fill="#1266f1"/><circle cx="418.1697" cy="541" r="13" fill="#1266f1"/><circle cx="374.1697" cy="583" r="13" fill="#f2f2f2"/><path d="M484.72385,792.35794s-13-32,26-56Z" transform="translate(-94.55416 -86.35794)" fill="#f2f2f2"/><path d="M468.73587,791.77747s-5.91642-34.02934-51.7085-33.73768Z" transform="translate(-94.55416 -86.35794)" fill="#f2f2f2"/><circle cx="322.42646" cy="339" r="80" fill="#1266f1" opacity="0.2"/><circle cx="322.42646" cy="339" r="56.33803" fill="#1266f1" opacity="0.2"/><circle cx="322.42646" cy="339" r="37.1831" fill="#1266f1"/><path d="M423.74119,417.33806a6.76057,6.76057,0,1,0-11.03131,5.23894l-2.48982,17.42883h13.52113L421.25136,422.577A6.74554,6.74554,0,0,0,423.74119,417.33806Z" transform="translate(-94.55416 -86.35794)" fill="#fff"/><path d="M790.66145,139.658s-22.302-19.99486-52.29427,17.68777-76.90334,56.13944-87.66981,70.75107c0,0,44.60394-18.4568,59.98461-26.14713s14.61163-6.15227,14.61163-6.15227-20.7639,14.61163-24.60907,29.22327-.769,26.91616-7.69033,41.5278S825.268,276.546,825.268,276.546s13.8426-23.84,9.99743-48.4491S833.72732,142.73416,790.66145,139.658Z" transform="translate(-94.55416 -86.35794)" fill="#2f2e41"/><path d="M748.47878,202.56005s4.84954,33.94676-15.93419,41.56746-13.163,18.01256-13.163,18.01256l31.1756,15.2414,33.254-10.39186,11.08466-16.627s-18.01257-4.15674-13.163-16.627,6.23512-16.627,6.23512-16.627Z" transform="translate(-94.55416 -86.35794)" fill="#ffb9b9"/><path d="M748.47878,202.56005s4.84954,33.94676-15.93419,41.56746-13.163,18.01256-13.163,18.01256l31.1756,15.2414,33.254-10.39186,11.08466-16.627s-18.01257-4.15674-13.163-16.627,6.23512-16.627,6.23512-16.627Z" transform="translate(-94.55416 -86.35794)" opacity="0.1"/><path d="M835.77045,299.55078s-4.84954,63.73677-3.464,66.50794,0,99.06911,0,99.06911,9.69907,51.95932-2.77116,54.73048-9.69908-58.19444-9.69908-58.19444L807.366,381.30012l1.38558-79.671Z" transform="translate(-94.55416 -86.35794)" fill="#ffb9b9"/><path d="M835.77045,299.55078s-4.84954,63.73677-3.464,66.50794,0,99.06911,0,99.06911,9.69907,51.95932-2.77116,54.73048-9.69908-58.19444-9.69908-58.19444L807.366,381.30012l1.38558-79.671Z" transform="translate(-94.55416 -86.35794)" opacity="0.1"/><path d="M700.67621,491.45388S677.8141,578.05276,678.50689,620.313,688.206,721.46049,688.206,721.46049s1.38558,25.63326-.69279,28.40443S697.905,764.41353,697.905,764.41353l13.163-7.6207,4.84954-5.54233V746.401s-7.6207-23.55489-1.38558-42.26025,9.69907-65.81514,3.464-80.36375l42.953-127.47354Z" transform="translate(-94.55416 -86.35794)" fill="#ffb9b9"/><path d="M699.29062,753.32887S690.97713,742.937,685.4348,746.401s-14.54861,27.01885-14.54861,27.01885-31.17559,29.79-9.00628,31.17559,31.86839-6.23511,34.63955-11.77744S724.92389,772.727,724.92389,772.727s-2.77116-26.32606-6.92791-27.01885S707.60412,756.1,707.60412,756.1Z" transform="translate(-94.55416 -86.35794)" fill="#2f2e41"/><path d="M776.19042,496.99621v85.90608a265.61649,265.61649,0,0,0,2.07837,31.1756c2.07838,15.2414-11.77744,128.85912-11.77744,128.85912l1.38558,20.09094,17.31977-1.38559,2.07838-17.31977,24.94047-76.207s8.31349-46.417,4.15675-63.73677,21.47652-128.16633,21.47652-128.16633Z" transform="translate(-94.55416 -86.35794)" fill="#ffb9b9"/><path d="M762.3346,758.17841l5.13095-1.1155s3.87534-8.58357,8.72487-6.5052a52.29963,52.29963,0,0,1,9.64308,5.778l2.13437,3.921s4.84954,10.39187,11.08465,17.31978,13.163,22.16931,2.77117,23.55489-24.24769,2.07837-28.40443-1.38558-1.38558-9.00628-5.54233-10.39187-7.6207-5.54232-6.92791-6.92791S762.3346,758.17841,762.3346,758.17841Z" transform="translate(-94.55416 -86.35794)" fill="#2f2e41"/><circle cx="681.63626" cy="109.2742" r="30.7902" fill="#ffb9b9"/><path d="M717.996,249.66983l9.15108-3.19485s-3.60875,5.966,15.7894,9.43,39.48715,4.69031,48.4944-6.66113c0,0,3.46492-1.65236,8.31446,3.19718s7.6207,3.464,7.6207,3.464l-3.464,18.01257-6.92791,33.254L787.96787,332.112l-25.63327-5.54233L734.623,306.47869,724.2311,279.45985V254.51937Z" transform="translate(-94.55416 -86.35794)" fill="#1266f1"/><path d="M802.51648,259.36891l6.92791-4.84954s23.55489,4.15675,24.94047,15.2414L816.3723,304.40032a39.43662,39.43662,0,0,1-.69279,29.79c-6.92791,15.9342-6.23512,19.39815-6.23512,19.39815l-4.84954,20.78373-87.98445,6.92791s-3.464-8.31349-4.84954-9.69907-1.38558-6.23512,0-6.23512,0-2.07838-1.38558-4.15675-2.07837-2.77116,0-5.54233-3.464-27.71164-3.464-27.71164V300.93637l-23.55489-31.1756s8.31349-12.47024,12.47024-13.85582,23.93018-6.84988,23.93018-6.84988l4.47425,6.588,6.23512,50.14279,9.00628,30.48281,37.921-6.4431,14.73113-24.7325,9.69908-29.09722Z" transform="translate(-94.55416 -86.35794)" fill="#1266f1"/><path d="M828.84254,265.604l5.54232,4.15674s4.84954,38.7963,3.464,41.56746-25.63327,5.54233-26.32606,4.15675S828.84254,265.604,828.84254,265.604Z" transform="translate(-94.55416 -86.35794)" fill="#1266f1"/><path d="M714.532,246.20588l6.9279,45.7242s-6.23511,67.89352-4.84953,81.74934l1.38558,4.15674s-2.77116-1.38558-3.464,1.38559,0,11.77744,0,11.77744-4.15675,4.15675-5.54233,27.01885-18.01257,77.59259-11.77745,79.671,43.64583,12.47024,63.73677,10.39187,92.1412-26.32606,91.44841-32.56118-35.33234-94.21957-35.33234-94.21957S810.83,370.90825,810.83,369.52267s8.31349-6.92791,6.23512-12.47024-13.163-63.73676-13.163-63.73676l7.6207-41.56746L801.1309,248.977l-7.6207,40.18188s-29.79,14.54861-60.96561,1.38558l-6.92791-47.10979Z" transform="translate(-94.55416 -86.35794)" fill="#2f2e41"/><path d="M747.86436,173.53492s51.26654,35.33234,65.12236,19.39814-24.24769-29.79-24.24769-29.79l-31.86838-3.46395Z" transform="translate(-94.55416 -86.35794)" fill="#2f2e41"/><path d="M668.20911,549.39967a27.02739,27.02739,0,1,0-8.47865-10.5236L589.02369,597.748l-9.41452-11.17356-4.22986,2.82912-4.70726-5.58677,3.86777-3.25888-4.70726-5.58677-6.01653,5.06935,2.89678,3.438L560.26652,588.91l-2.89677-3.438-9.45454,7.96613,4.34516,5.157,3.438-2.89678,4.70726,5.58678-4.29752,3.621,8.69032,10.31405-10.31405,8.69032,10.50081,12.46281Zm17.65411-39.492A17.88151,17.88151,0,1,1,666.52438,526.202,17.88156,17.88156,0,0,1,685.86322,509.90763Z" transform="translate(-94.55416 -86.35794)" fill="#1266f1"/><path d="M678.50689,307.86428s4.84954,63.73677,3.464,66.50793,0,99.06911,0,99.06911-9.69907,51.95932,2.77116,54.73049,9.69908-58.19445,9.69908-58.19445l12.47023-80.36375-1.38558-79.671Z" transform="translate(-94.55416 -86.35794)" fill="#ffb9b9"/><path d="M688.89876,267.6824l-5.54233,2.07837s-10.39186,43.64583-7.6207,43.64583,36.02513,4.15675,36.02513,2.77117-6.23512-35.33234-6.23512-35.33234Z" transform="translate(-94.55416 -86.35794)" fill="#1266f1"/></svg>
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <form action="login/c" method="post">
                <div class="container">
                    <h1>Login</h1>

                    <hr>

                    <?php
                    if (!empty($errors)) {
                        echo '<div id="error_explanation" class="text-danger">';
                        echo '<div class="error_message alert alert-danger d-none"><strong>Some Errors occurred!</strong></div>';
                        echo '<ul>';
                        foreach ($errors as $error) {
                            echo '<li>'.$error.'</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                    if (isset($success)) {
                        echo '<div class="error_message alert alert-success"><strong>'.$success.'</strong></div>';
                    }

                    ?>
                    <?php
                    if (isset($_SESSION['loginerrors']) && count($_SESSION['loginerrors']) > 0) {
                        echo '<div id="error_explanation" class="text-danger">';
                            echo '<div class="error_message alert alert-danger d-none"><strong>Some Errors occurred!</strong></div>';
                                echo '<ul>';
                                foreach ($_SESSION['loginerrors'] as $error) {
                                    echo '<li>'.$error.'</li>';
                                }
                                echo '</ul>';
                        echo '</div>';
                    }
                    if (isset($_SESSION['loginsuccess']) && strlen($_SESSION['loginsuccess']) > 0) {
                        // User is already logged in
                        // Just show a message 
                    } else {

                    ?>

                    <label for="email"><b>User</b></label>
                    <input type="text" placeholder="Enter Username" name="username" id="username"  value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" />

                    <label for="pwd"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pwd" id="pwd"  />


                    <input type="submit" name="login" class="registerbtn" value="Login">

                    <input type="hidden" name="<?php echo $_SESSION['tokenName']; ?>" value="<?php echo $_SESSION['tokenValue']; ?>" />

                    <?php } ?>
                </div>

                <div class="container signin">
                    <p>Don't have an account? <a href="/register">Register here</a>.</p>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once DOCUMENT_ROOT.'/templates_include/footer.php'; ?>

</body>

</html>
