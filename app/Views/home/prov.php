<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 7d0b4eeaf6bcd262bc67cd532a17055d"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, TRUE);

    for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
        echo '<option value="' . $data['rajaongkir']['results'][$i]['province_id'] . ',' . $data['rajaongkir']['results'][$i]['province'] . '">' . $data['rajaongkir']['results'][$i]['province'] . '</option>';
    }
}
