<?php

namespace Rtm;

class Client implements ClientInterface
{
    /**
     * Rtm object
     * @var Rtm\Rtm
     */
    private $rtm = null;

    public function setRtm(RtmInterface $rtm)
    {
        $this->rtm = $rtm;
    }

    public function call($method, array $params = array())
    {
        $request = new Request($params);
        $request->setParameter('method', $method);

        if (false === $request->hasParameter('api_key')) {
            $request->setParameter('api_key', $this->rtm->getApiKey());
        }

        if (false === $request->hasParameter('auth_token')) {
            $request->setParameter('auth_token', $this->rtm->getAuthToken());
        }

        if (false === $request->hasParameter('format')) {
            if (null != $this->rtm->getResponseFormat()) {
                $request->setParameter('format', $this->rtm->getResponseFormat());
            }
        }

        $request->sign($this->rtm->getSecret());

        $url = $request->getServiceUrl();

        $contents = file_get_contents($url);

        $response = new Response($contents, $this->rtm->getResponseFormat());

        if (false === $response->isValid()) {
            throw new \Exception($response->getErrorMessage(), $response->getErrorCode());
        }

        return $response->getResponse();
    }
}