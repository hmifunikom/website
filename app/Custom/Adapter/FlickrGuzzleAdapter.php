<?php namespace HMIF\Custom\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Rezzza\Flickr\Http\AdapterInterface;

/**
 * GuzzleAdapter
 *
 * @uses AdapterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class FlickrGuzzleAdapter implements AdapterInterface
{

    private $client;

    public function __construct()
    {
        $this->client  = new Client();
    }

    /**
     * {@inheritdoc}
     */
    public function post($url, array $data = [], array $headers = [])
    {
        $request = $this->client->createRequest('POST', $url);

        $query = $request->getQuery();

        foreach($data as $k => $v) {
            $query->set($k, $v);
        }

        // flickr does not supports this header and return a 417 http code during upload
        $request->setHeaders($headers);
        $request->removeHeader('Expect');

        return $this->client->send($request)->xml();
    }

    /**
     * @param array $requests
     * An array of Requests
     * Each Request is an array with keys: url, data and headers
     *
     * @return \SimpleXMLElement[]
     */
    public function multiPost(array $requests)
    {
        $multi_request = $this->client->getCurlMulti();
        foreach ($requests as &$request) {
            $request = $this->client->post($request['url'], $request['headers'], $request['data']);
            $multi_request->add($request);
        }
        unset($request);

        $multi_request->send();

        $responses = [];
        /** @var RequestInterface[] $requests */
        foreach ($requests as $request) {
            $responses[] = $request->getResponse()->xml();
        }

        return $responses;
    }

    /**
     * @return $client
     */
    public function getClient()
    {
        return $this->client;
    }

}
