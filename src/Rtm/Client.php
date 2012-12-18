<?php

namespace Rtm;

class Client
{
    /**
     * Rtm object
     * @var Rtm\Rtm
     */
    private $rtm = null;

    public function __construct(Rtm $rtm)
    {
        $this->rtm = $rtm;
    }

    public function get($method, array $params = array())
    {
        $request = new Request($params);
        $request->setParameter('method', $method);

        if($request->hasParameter('api_key') === false)
        {
            $request->setParameter('api_key', $this->rtm->getApiKey());
        }

        if($request->hasParameter('format') === false)
        {
            $request->setParameter('format', $this->rtm->getResponseFormat());
        }

        if($request->hasParameter('auth_token') === false)
        {
            $request->setParameter('auth_token', $this->rtm->getAuthToken());
        }

        $request->sign($this->rtm->getSecret());

        $url = $request->getServiceUrl();

        $contents = file_get_contents($url);

        $response = new Response($contents, $this->rtm->getResponseFormat());

        if ($response->isValid() === false)
        {
            throw new \Exception($response->getErrorMessage(), $response->getErrorCode());
        }

        return $response->getResponse();
    }
}