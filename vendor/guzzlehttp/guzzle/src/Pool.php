<?php
<<<<<<< HEAD

=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
namespace GuzzleHttp;

use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\PromisorInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Sends an iterator of requests concurrently using a capped pool size.
 *
 * The pool will read from an iterator until it is cancelled or until the
 * iterator is consumed. When a request is yielded, the request is sent after
 * applying the "request_options" request options (if provided in the ctor).
 *
 * When a function is yielded by the iterator, the function is provided the
 * "request_options" array that should be merged on top of any existing
 * options, and the function MUST then return a wait-able promise.
 */
class Pool implements PromisorInterface
{
<<<<<<< HEAD
    /**
     * @var EachPromise
     */
=======
    /** @var EachPromise */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private $each;

    /**
     * @param ClientInterface $client   Client used to send the requests.
     * @param array|\Iterator $requests Requests or functions that return
     *                                  requests to send concurrently.
     * @param array           $config   Associative array of options
<<<<<<< HEAD
     *                                  - concurrency: (int) Maximum number of requests to send concurrently
     *                                  - options: Array of request options to apply to each request.
     *                                  - fulfilled: (callable) Function to invoke when a request completes.
     *                                  - rejected: (callable) Function to invoke when a request is rejected.
=======
     *     - concurrency: (int) Maximum number of requests to send concurrently
     *     - options: Array of request options to apply to each request.
     *     - fulfilled: (callable) Function to invoke when a request completes.
     *     - rejected: (callable) Function to invoke when a request is rejected.
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public function __construct(
        ClientInterface $client,
        $requests,
        array $config = []
    ) {
<<<<<<< HEAD
        if (!isset($config['concurrency'])) {
=======
        // Backwards compatibility.
        if (isset($config['pool_size'])) {
            $config['concurrency'] = $config['pool_size'];
        } elseif (!isset($config['concurrency'])) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $config['concurrency'] = 25;
        }

        if (isset($config['options'])) {
            $opts = $config['options'];
            unset($config['options']);
        } else {
            $opts = [];
        }

        $iterable = \GuzzleHttp\Promise\iter_for($requests);
<<<<<<< HEAD
        $requests = static function () use ($iterable, $client, $opts) {
            foreach ($iterable as $key => $rfn) {
                if ($rfn instanceof RequestInterface) {
                    yield $key => $client->sendAsync($rfn, $opts);
                } elseif (\is_callable($rfn)) {
=======
        $requests = function () use ($iterable, $client, $opts) {
            foreach ($iterable as $key => $rfn) {
                if ($rfn instanceof RequestInterface) {
                    yield $key => $client->sendAsync($rfn, $opts);
                } elseif (is_callable($rfn)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    yield $key => $rfn($opts);
                } else {
                    throw new \InvalidArgumentException('Each value yielded by '
                        . 'the iterator must be a Psr7\Http\Message\RequestInterface '
                        . 'or a callable that returns a promise that fulfills '
                        . 'with a Psr7\Message\Http\ResponseInterface object.');
                }
            }
        };

        $this->each = new EachPromise($requests(), $config);
    }

    /**
     * Get promise
<<<<<<< HEAD
     */
    public function promise(): PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public function promise()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->each->promise();
    }

    /**
     * Sends multiple requests concurrently and returns an array of responses
     * and exceptions that uses the same ordering as the provided requests.
     *
     * IMPORTANT: This method keeps every request and response in memory, and
     * as such, is NOT recommended when sending a large number or an
     * indeterminate number of requests concurrently.
     *
     * @param ClientInterface $client   Client used to send the requests
     * @param array|\Iterator $requests Requests to send concurrently.
     * @param array           $options  Passes through the options available in
<<<<<<< HEAD
     *                                  {@see \GuzzleHttp\Pool::__construct}
     *
     * @return array Returns an array containing the response or an exception
     *               in the same order that the requests were sent.
     *
=======
     *                                  {@see GuzzleHttp\Pool::__construct}
     *
     * @return array Returns an array containing the response or an exception
     *               in the same order that the requests were sent.
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     * @throws \InvalidArgumentException if the event format is incorrect.
     */
    public static function batch(
        ClientInterface $client,
        $requests,
        array $options = []
<<<<<<< HEAD
    ): array {
=======
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        $res = [];
        self::cmpCallback($options, 'fulfilled', $res);
        self::cmpCallback($options, 'rejected', $res);
        $pool = new static($client, $requests, $options);
        $pool->promise()->wait();
<<<<<<< HEAD
        \ksort($res);
=======
        ksort($res);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

        return $res;
    }

    /**
     * Execute callback(s)
<<<<<<< HEAD
     */
    private static function cmpCallback(array &$options, string $name, array &$results): void
    {
        if (!isset($options[$name])) {
            $options[$name] = static function ($v, $k) use (&$results) {
=======
     *
     * @return void
     */
    private static function cmpCallback(array &$options, $name, array &$results)
    {
        if (!isset($options[$name])) {
            $options[$name] = function ($v, $k) use (&$results) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                $results[$k] = $v;
            };
        } else {
            $currentFn = $options[$name];
<<<<<<< HEAD
            $options[$name] = static function ($v, $k) use (&$results, $currentFn) {
=======
            $options[$name] = function ($v, $k) use (&$results, $currentFn) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                $currentFn($v, $k);
                $results[$k] = $v;
            };
        }
    }
}
