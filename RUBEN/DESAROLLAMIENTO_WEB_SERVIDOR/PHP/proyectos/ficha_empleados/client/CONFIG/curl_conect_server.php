<?php
    function curl_conect($url, $method, $params = NULL){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        if($params != NULL){
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, array("cache-control: no-cache"));

        $responde = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if($err){
            $responde = json_encode("error ". $err);
        }

        return $responde;
    }
?>