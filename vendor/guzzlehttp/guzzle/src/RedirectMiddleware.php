<?php
<<<<<<< HEAD

=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
namespace GuzzleHttp;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use GuzzleHttp\Promise\PromiseInterface;
<<<<<<< HEAD
=======
use GuzzleHttp\Psr7;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Request redirect middleware.
 *
 * Apply this middleware like other middleware using
 * {@see \GuzzleHttp\Middleware::redirect()}.
 */
class RedirectMiddleware
{
<<<<<<< HEAD
    public const HISTORY_HEADER = 'X-Guzzle-Redirect-History';

    public const STATUS_HISTORY_HEADER = 'X-Guzzle-Redirect-Status-History';

    /**
     * @var array
     */
=======
    const HISTORY_HEADER = 'X-Guzzle-Redirect-History';

    const STATUS_HISTORY_HEADER = 'X-Guzzle-Redirect-Status-History';

>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    public static $defaultSettings = [
        'max'             => 5,
        'protocols'       => ['http', 'https'],
        'strict'          => false,
        'referer'         => false,
        'track_redirects' => false,
    ];

<<<<<<< HEAD
    /**
     * @var callable(RequestInterface, array): PromiseInterface
     */
    private $nextHandler;

    /**
     * @param callable(RequestInterface, array): PromiseInterface $nextHandler Next handler to invoke.
=======
    /** @var callable  */
    private $nextHandler;

    /**
     * @param callable $nextHandler Next handler to invoke.
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public function __construct(callable $nextHandler)
    {
        $this->nextHandler = $nextHandler;
    }

<<<<<<< HEAD
    public function __invoke(RequestInterface $request, array $options): PromiseInterface
=======
    /**
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return PromiseInterface
     */
    public function __invoke(RequestInterface $request, array $options)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $fn = $this->nextHandler;

        if (empty($options['allow_redirects'])) {
            return $fn($request, $options);
        }

        if ($options['allow_redirects'] === true) {
            $options['allow_redirects'] = self::$defaultSettings;
<<<<<<< HEAD
        } elseif (!\is_array($options['allow_redirects'])) {
=======
        } elseif (!is_array($options['allow_redirects'])) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            throw new \InvalidArgumentException('allow_redirects must be true, false, or array');
        } else {
            // Merge the default settings with the provided settings
            $options['allow_redirects'] += self::$defaultSettings;
        }

        if (empty($options['allow_redirects']['max'])) {
            return $fn($request, $options);
        }

        return $fn($request, $options)
            ->then(function (ResponseInterface $response) use ($request, $options) {
                return $this->checkRedirect($request, $options, $response);
            });
    }

    /**
<<<<<<< HEAD
=======
     * @param RequestInterface  $request
     * @param array             $options
     * @param ResponseInterface $response
     *
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     * @return ResponseInterface|PromiseInterface
     */
    public function checkRedirect(
        RequestInterface $request,
        array $options,
        ResponseInterface $response
    ) {
<<<<<<< HEAD
        if (\strpos((string) $response->getStatusCode(), '3') !== 0
=======
        if (substr($response->getStatusCode(), 0, 1) != '3'
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            || !$response->hasHeader('Location')
        ) {
            return $response;
        }

        $this->guardMax($request, $options);
        $nextRequest = $this->modifyRequest($request, $options, $response);

        if (isset($options['allow_redirects']['on_redirect'])) {
<<<<<<< HEAD
            \call_user_func(
=======
            call_user_func(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                $options['allow_redirects']['on_redirect'],
                $request,
                $response,
                $nextRequest->getUri()
            );
        }

<<<<<<< HEAD
=======
        /** @var PromiseInterface|ResponseInterface $promise */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        $promise = $this($nextRequest, $options);

        // Add headers to be able to track history of redirects.
        if (!empty($options['allow_redirects']['track_redirects'])) {
            return $this->withTracking(
                $promise,
                (string) $nextRequest->getUri(),
                $response->getStatusCode()
            );
        }

        return $promise;
    }

    /**
     * Enable tracking on promise.
<<<<<<< HEAD
     */
    private function withTracking(PromiseInterface $promise, string $uri, int $statusCode): PromiseInterface
    {
        return $promise->then(
            static function (ResponseInterface $response) use ($uri, $statusCode) {
=======
     *
     * @return PromiseInterface
     */
    private function withTracking(PromiseInterface $promise, $uri, $statusCode)
    {
        return $promise->then(
            function (ResponseInterface $response) use ($uri, $statusCode) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                // Note that we are pushing to the front of the list as this
                // would be an earlier response than what is currently present
                // in the history header.
                $historyHeader = $response->getHeader(self::HISTORY_HEADER);
                $statusHeader = $response->getHeader(self::STATUS_HISTORY_HEADER);
<<<<<<< HEAD
                \array_unshift($historyHeader, $uri);
                \array_unshift($statusHeader, (string) $statusCode);

=======
                array_unshift($historyHeader, $uri);
                array_unshift($statusHeader, $statusCode);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                return $response->withHeader(self::HISTORY_HEADER, $historyHeader)
                                ->withHeader(self::STATUS_HISTORY_HEADER, $statusHeader);
            }
        );
    }

    /**
     * Check for too many redirects
     *
<<<<<<< HEAD
     * @throws TooManyRedirectsException Too many redirects.
     */
    private function guardMax(RequestInterface $request, array &$options): void
    {
        $current = $options['__redirect_count']
            ?? 0;
=======
     * @return void
     *
     * @throws TooManyRedirectsException Too many redirects.
     */
    private function guardMax(RequestInterface $request, array &$options)
    {
        $current = isset($options['__redirect_count'])
            ? $options['__redirect_count']
            : 0;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        $options['__redirect_count'] = $current + 1;
        $max = $options['allow_redirects']['max'];

        if ($options['__redirect_count'] > $max) {
            throw new TooManyRedirectsException(
                "Will not follow more than {$max} redirects",
                $request
            );
        }
    }

<<<<<<< HEAD
=======
    /**
     * @param RequestInterface  $request
     * @param array             $options
     * @param ResponseInterface $response
     *
     * @return RequestInterface
     */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    public function modifyRequest(
        RequestInterface $request,
        array $options,
        ResponseInterface $response
<<<<<<< HEAD
    ): RequestInterface {
=======
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        // Request modifications to apply.
        $modify = [];
        $protocols = $options['allow_redirects']['protocols'];

        // Use a GET request if this is an entity enclosing request and we are
        // not forcing RFC compliance, but rather emulating what all browsers
        // would do.
        $statusCode = $response->getStatusCode();
        if ($statusCode == 303 ||
            ($statusCode <= 302 && !$options['allow_redirects']['strict'])
        ) {
            $modify['method'] = 'GET';
            $modify['body'] = '';
        }

        $uri = $this->redirectUri($request, $response, $protocols);
        if (isset($options['idn_conversion']) && ($options['idn_conversion'] !== false)) {
<<<<<<< HEAD
            $idnOptions = ($options['idn_conversion'] === true) ? \IDNA_DEFAULT : $options['idn_conversion'];
=======
            $idnOptions = ($options['idn_conversion'] === true) ? IDNA_DEFAULT : $options['idn_conversion'];
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $uri = Utils::idnUriConvert($uri, $idnOptions);
        }

        $modify['uri'] = $uri;
        Psr7\rewind_body($request);

        // Add the Referer header if it is told to do so and only
        // add the header if we are not redirecting from https to http.
        if ($options['allow_redirects']['referer']
            && $modify['uri']->getScheme() === $request->getUri()->getScheme()
        ) {
            $uri = $request->getUri()->withUserInfo('');
            $modify['set_headers']['Referer'] = (string) $uri;
        } else {
            $modify['remove_headers'][] = 'Referer';
        }

        // Remove Authorization header if host is different.
        if ($request->getUri()->getHost() !== $modify['uri']->getHost()) {
            $modify['remove_headers'][] = 'Authorization';
        }

        return Psr7\modify_request($request, $modify);
    }

    /**
     * Set the appropriate URL on the request based on the location header
<<<<<<< HEAD
=======
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $protocols
     *
     * @return UriInterface
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    private function redirectUri(
        RequestInterface $request,
        ResponseInterface $response,
        array $protocols
<<<<<<< HEAD
    ): UriInterface {
=======
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        $location = Psr7\UriResolver::resolve(
            $request->getUri(),
            new Psr7\Uri($response->getHeaderLine('Location'))
        );

        // Ensure that the redirect URI is allowed based on the protocols.
<<<<<<< HEAD
        if (!\in_array($location->getScheme(), $protocols)) {
            throw new BadResponseException(
                \sprintf(
                    'Redirect URI, %s, does not use one of the allowed redirect protocols: %s',
                    $location,
                    \implode(', ', $protocols)
=======
        if (!in_array($location->getScheme(), $protocols)) {
            throw new BadResponseException(
                sprintf(
                    'Redirect URI, %s, does not use one of the allowed redirect protocols: %s',
                    $location,
                    implode(', ', $protocols)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                ),
                $request,
                $response
            );
        }

        return $location;
    }
}
