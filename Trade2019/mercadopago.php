<?php

/**
* MercadoPago Integration Library
* Access MercadoPago for payments integration
*
* @author hcasatti
*
*/
$GLOBALS["LIB_LOCATION"] = dirname(__FILE__);

class MP {

    const version = "0.1.5";

    private $client_id;
    private $client_secret;
    private $access_data;

    function __construct($client_id, $client_secret) {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    /**
* Get Access Token for API use
*/
    public function get_access_token() {
        $appClientValues = $this->build_query(array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials'
                ));

        $access_data = MPRestClient::post("/oauth/token", $appClientValues, MPRestClient::MIME_FORM);

        if (isset($access_data['response']['access_token']) && isset($access_data['response']['access_token'])) {
            $this->access_data = $access_data['response'];

            return $this->access_data['access_token'];
        } else {
            throw new Exception(json_encode($access_data));
        }
    }

    /**
* Get information for specific payment
* @param int $id
* @return array(json)
*/
    public function get_payment_info($id) {
        try {
            $accessToken = $this->get_access_token();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $paymentInfo = MPRestClient::get("/collections/notifications/" . $id . "?access_token=" . $accessToken);
        return $paymentInfo;
    }

    /**
* Refund accredited payment
* @param int $id
* @return array(json)
*/
    public function refund_payment($id) {
        try {
            $accessToken = $this->get_access_token();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $refund_status = array(
            "status" => "refunded"
        );

        $response = MPRestClient::put("/collections/" . $id . "?access_token=" . $accessToken, $refund_status);
        return $response;
    }

    /**
* Cancel pending payment
* @param int $id
* @return array(json)
*/
    public function cancel_payment($id) {
        try {
            $accessToken = $this->get_access_token();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $cancel_status = array(
            "status" => "cancelled"
        );

        $response = MPRestClient::put("/collections/" . $id . "?access_token=" . $accessToken, $cancel_status);
        return $response;
    }

    /**
* Search payments according to filters, with pagination
* @param array $filters
* @param int $offset
* @param int $limit
* @return array(json)
*/
    public function search_payment($filters, $offset = 0, $limit = 0) {
        try {
            $accessToken = $this->get_access_token();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $filters["offset"] = $offset;
        $filters["limit"] = $limit;

        $filters = $this->build_query($filters);

        $collectionResult = MPRestClient::get("/collections/search?" . $filters . "&access_token=" . $accessToken);
        return $collectionResult;
    }

    /**
* Create a checkout preference
* @param array $preference
* @return array(json)
*/
    public function create_preference($preference) {
        try {
            $accessToken = $this->get_access_token();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $preferenceResult = MPRestClient::post("/checkout/preferences?access_token=" . $accessToken, $preference);
        return $preferenceResult;
    }

    /**
* Update a checkout preference
* @param string $id
* @param array $preference
* @return array(json)
*/
    public function update_preference($id, $preference) {
        try {
            $accessToken = $this->get_access_token();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $preferenceResult = MPRestClient::put("/checkout/preferences/{$id}?access_token=" . $accessToken, $preference);
        return $preferenceResult;
    }

    /**
* Get a checkout preference
* @param string $id
* @return array(json)
*/
    public function get_preference($id) {
        try {
            $accessToken = $this->get_access_token();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $preferenceResult = MPRestClient::get("/checkout/preferences/{$id}?access_token=" . $accessToken);
        return $preferenceResult;
    }

    /* * **************************************************************************************** */

    private function build_query($params) {
        if (function_exists("http_build_query")) {
            return http_build_query($params);
        } else {
            foreach ($params as $name => $value) {
                $elements[] = "{$name}=" . urlencode($value);
            }

            return implode("&", $elements);
        }
    }

}

/**
* MercadoPago cURL RestClient
*/
class MPRestClient {

    const API_BASE_URL = "https://api.mercadolibre.com";
    const MIME_JSON = "application/json";
    const MIME_FORM = "application/x-www-form-urlencoded";

    private static function getConnect($uri, $method, $contentType) {
        $connect = curl_init(self::API_BASE_URL . $uri);

        curl_setopt($connect, CURLOPT_USERAGENT, "MercadoPago PHP SDK v" . MP::version);
        curl_setopt($connect, CURLOPT_CAINFO, $GLOBALS["LIB_LOCATION"] . "/cacert.pem");
        curl_setopt($connect, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($connect, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($connect, CURLOPT_HTTPHEADER, array("Accept: application/json", "Content-Type: " . $contentType));

        return $connect;
    }

    private static function setData(&$connect, $data, $contentType) {
        if ($contentType == self::MIME_JSON) {
            if (gettype($data) == "string") {
                json_decode($data, true);
            } else {
                $data = json_encode($data);
            }

            if(function_exists('json_last_error')) {
                $json_error = json_last_error();
                if ($json_error != JSON_ERROR_NONE) {
                    throw new Exception("JSON Error [{$json_error}] - Data: {$data}");
                }
            }
        }

        curl_setopt($connect, CURLOPT_POSTFIELDS, $data);
    }

    private static function exec($method, $uri, $data, $contentType) {
        $connect = self::getConnect($uri, $method, $contentType);
        self::setData($connect, $data, $contentType);

        $apiResult = curl_exec($connect);
        $apiHttpCode = curl_getinfo($connect, CURLINFO_HTTP_CODE);

        $response = array(
            "status" => $apiHttpCode,
            "response" => json_decode($apiResult, true)
        );

        curl_close($connect);

        return $response;
    }

    public static function get($uri, $contentType = self::MIME_JSON) {
        return self::exec("GET", $uri, null, $contentType);
    }

    public static function post($uri, $data, $contentType = self::MIME_JSON) {
        return self::exec("POST", $uri, $data, $contentType);
    }

    public static function put($uri, $data, $contentType = self::MIME_JSON) {
        return self::exec("PUT", $uri, $data, $contentType);
    }

}

?>