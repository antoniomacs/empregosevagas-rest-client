<?php

class Efetivo {


    /**
     * URLs
     */
    const URL_SERVICE               = 'http://api.empregosevagas.com.br/';
    const METHOD_IDENTIFIER         = 'm';

    /**
     * Available methods
     */
    const METHOD_LIST_POSITIONS      = 'list_positions';
    const METHOD_POSITION_DATA       = 'view_position';
    
    /**
     * API key
     * @var string
     */
    public $apiKey;

    /**
     * Secret
     * @var string
     */
    public $secret;

    /**
     * Auth token
     * @var string
     */
    private $authToken;

    /**
     * Request parameters
     * @var array
     */
    private $parameters = array();






    /**
     * Constructor
     */
    public function __construct(){}
    






    /* ------------------------------------------------------ */
            // SERVICE IDENTIFIERS    
    /* ------------------------------------------------------ */
    /**
     * Set API key
     * @param string $apiKey
     * @return Rtm
     */
    public function setApiKey($key)
    {
        $this->apiKey = $key;
        return $this;
    }    
    /**
     * Get API key
     * @return string
     * @throws Rtm\Exception If API key is not set
     */
    public function getApiKey()
    {
        if (false === isset($this->apiKey)) {
            throw new Exception('API key not set');
        }

        return $this->apiKey;
    }

    /**
     * Set secret
     * @param string $secret
     * @return Rtm
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }
    /**
     * Get secret
     * @return string
     * @throws Rtm\Exception If secret is not set
     */
    public function getSecret()
    {
        if (false === isset($this->secret)) {
            throw new Exception('Secret not set');
        }

        return $this->secret;
    }







    /* ------------------------------------------------------ */
            // PARAMS    
    /* ------------------------------------------------------ */

    /**
     * Set request parameters
     * @param array $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    /**
     * Get all request parameters
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Set one parameter
     * @param string $name  Parameter name
     * @param mixed  $value Parameter value
     */
    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }

    /**
     * Get one parameter
     * @param  string $name    Parameter name
     * @param  mixed  $default Default value to return if parameter is not set
     * @return mixed
     */
    public function getParameter($name, $default = null)
    {
        if (false === $this->hasParameter($name)) {
            return $default;
        }

        return $this->parameters[$name];
    }

    /**
     * Check whether parameter is set
     * @param  string  $name Parameter name
     * @return boolean
     */
    public function hasParameter($name)
    {
        return isset($this->parameters[$name]);
    }










    /* ------------------------------------------------------ */
            // API CONNECTION    
    /* ------------------------------------------------------ */
    /**
     * Get service URL to call (with appropriate parameters)
     * @return string
     */
    public function getServiceUrl()
    {
        return $this::URL_SERVICE . http_build_query($this->parameters);
    }
    /**
     * Get method default identifier
     * @return string
     */
    public function getMethodIdentifier($method)
    {
        return $this::METHOD_IDENTIFIER . '/' . $method;
    }

    /**
     * Returns a SID (single identifier) required to use API calls
     * @param STRING    - the user private key (API-SECRET)
     * @param ARRAY     - the current request params array
     * @return string (SHA256)
     */
    private function buildAuthSID($secret, $params)
    {
        $token = hash_hmac('sha256', http_build_query($params), $secret);

        return $token;
    }


    /**
     * Create request object
     * @param  string $method
     * @param  array  $params
     * @return Request
     */
    private function createRequest($params=array())
    {
        $p = (is_array($params)) ? $params : array();
        ksort($p);

        $this->parameters = $p;

        $this->setParameter('sid', $this->buildAuthSID($this->getSecret(), $this->parameters));

        if (false === $this->hasParameter('key')) {
            $this->setParameter('key', $this->getApiKey());
        }
        if (false === $this->hasParameter('format')) {
            $this->setParameter('format', 'xml');
        }

        $request = $this->parameters;
        ksort($request);

        $url = '';

        foreach ($request as $key => $val) {
            if ($val != '') {
                $url .= '/' .  $key . '/' . $val;
            }
        }

        return $url;
    }








    /**
     * Calls METHOD_LIST_POSITIONS method
     * @param  string $method
     * @param  array  $params
     * @return mixed
     */
    public function getPositions($params = array())
    {
        $method = $this::METHOD_LIST_POSITIONS;
        try
        {
            $r = $this->call($method, $params);

            return $r;
        }
        catch (Exception $e)
        {
            throw new Exception($method . ': ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
    /**
     * Calls METHOD_POSITION_DATA method
     * @param  string $method
     * @param  array  $params
     * @return mixed
     */
    public function getPosition($params = array())
    {
        $method = $this::METHOD_POSITION_DATA;
        try
        {
            $r = $this->call($method, $params);

            return $r;
        }
        catch (Exception $e)
        {
            throw new Exception($method . ': ' . $e->getMessage(), $e->getCode(), $e);
        }
    }












    /**
     * Makes a request to the API (low-level request)
     * @param  string $method
     * @param  array  $params
     * @return mixed
     */
    public function call($method, array $params = array())
    {
        try
        {   
            $this->parameters = array();
            $url = $this->getServiceUrl();
            $url .= $this->getMethodIdentifier($method);
            $url .= $this->createRequest($params);
            $contents = file_get_contents($url);

            return $contents;
        }
        catch (Exception $e)
        {
            throw new Exception($method . ': ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

}
?>
