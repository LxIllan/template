<?php

class Fetch {

    /**
     * @var string
     */
    private string $base_url;

    /**
     * @var string
     */
    private string $authorization;

    /**
     * @param string $base_url
     * @param string $token
     */
    public function __construct(string $base_url, string $token = '') {
        $this->curl = curl_init();
        $this->base_url = $base_url;
        $this->authorization = "Authorization: Bearer $token";
    }

    /**
     * @param string $token
     * @return void
     */
    public function setToken(string $token): void
    {
        $this->authorization = "Authorization: Bearer $token";
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }    

    /**
     * @param string $url
     * @return stdClass
     */
    public function get(string $url): stdClass
    {
        return $this->request($url, 'GET');
    }

    /**
     * @param string $url
     * @param array $data
     * @return stdClass
     */
    public function post(string $url, array $data): stdClass
    {
        return $this->request($url, 'POST', $data);
    }

    /**
     * @param string $url
     * @param array $data
     * @return stdClass
     */
    public function put(string $url, array $data): stdClass
    {
        return $this->request($url, 'PUT', $data);
    }

    /**
     * @param string $url
     * @return stdClass
     */
    public function delete(string $url): stdClass
    {
        return $this->request($url, 'DELETE');
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return stdClass
     */
    private function request(string $url, string $method = "GET", array $data = []): stdClass
    {
        $options = [
            CURLOPT_URL => $this->base_url . $url,
            CURLOPT_HTTPHEADER => [
                $this->authorization,
                'Content-Type: application/json'
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data)
        ];
        
        curl_setopt_array($this->curl, $options);
    
        return json_decode(curl_exec($this->curl));
    }
}