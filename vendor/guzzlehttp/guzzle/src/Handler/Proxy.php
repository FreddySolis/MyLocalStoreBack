<?php
<<<<<<< HEAD

namespace GuzzleHttp\Handler;

use GuzzleHttp\Promise\PromiseInterface;
=======
namespace GuzzleHttp\Handler;

>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;

/**
 * Provides basic proxies for handlers.
 */
class Proxy
{
    /**
     * Sends synchronous requests to a specific handler while sending all other
     * requests to another handler.
     *
<<<<<<< HEAD
     * @param callable(\Psr\Http\Message\RequestInterface, array): \GuzzleHttp\Promise\PromiseInterface $default Handler used for normal responses
     * @param callable(\Psr\Http\Message\RequestInterface, array): \GuzzleHttp\Promise\PromiseInterface $sync    Handler used for synchronous responses.
     *
     * @return callable(\Psr\Http\Message\RequestInterface, array): \GuzzleHttp\Promise\PromiseInterface Returns the composed handler.
=======
     * @param callable $default Handler used for normal responses
     * @param callable $sync    Handler used for synchronous responses.
     *
     * @return callable Returns the composed handler.
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public static function wrapSync(
        callable $default,
        callable $sync
<<<<<<< HEAD
    ): callable {
        return static function (RequestInterface $request, array $options) use ($default, $sync): PromiseInterface {
=======
    ) {
        return function (RequestInterface $request, array $options) use ($default, $sync) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return empty($options[RequestOptions::SYNCHRONOUS])
                ? $default($request, $options)
                : $sync($request, $options);
        };
    }

    /**
     * Sends streaming requests to a streaming compatible handler while sending
     * all other requests to a default handler.
     *
     * This, for example, could be useful for taking advantage of the
     * performance benefits of curl while still supporting true streaming
     * through the StreamHandler.
     *
<<<<<<< HEAD
     * @param callable(\Psr\Http\Message\RequestInterface, array): \GuzzleHttp\Promise\PromiseInterface $default   Handler used for non-streaming responses
     * @param callable(\Psr\Http\Message\RequestInterface, array): \GuzzleHttp\Promise\PromiseInterface $streaming Handler used for streaming responses
     *
     * @return callable(\Psr\Http\Message\RequestInterface, array): \GuzzleHttp\Promise\PromiseInterface Returns the composed handler.
=======
     * @param callable $default   Handler used for non-streaming responses
     * @param callable $streaming Handler used for streaming responses
     *
     * @return callable Returns the composed handler.
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public static function wrapStreaming(
        callable $default,
        callable $streaming
<<<<<<< HEAD
    ): callable {
        return static function (RequestInterface $request, array $options) use ($default, $streaming): PromiseInterface {
=======
    ) {
        return function (RequestInterface $request, array $options) use ($default, $streaming) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return empty($options['stream'])
                ? $default($request, $options)
                : $streaming($request, $options);
        };
    }
}
