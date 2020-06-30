<?php
<<<<<<< HEAD

=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
namespace GuzzleHttp\Handler;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7;
use GuzzleHttp\TransferStats;
use GuzzleHttp\Utils;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
<<<<<<< HEAD
use Psr\Http\Message\UriInterface;
=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

/**
 * HTTP handler that uses PHP's HTTP stream wrapper.
 */
class StreamHandler
{
<<<<<<< HEAD
    /**
     * @var array
     */
=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private $lastHeaders = [];

    /**
     * Sends an HTTP request.
     *
     * @param RequestInterface $request Request to send.
     * @param array            $options Request transfer options.
<<<<<<< HEAD
     */
    public function __invoke(RequestInterface $request, array $options): PromiseInterface
    {
        // Sleep if there is a delay specified.
        if (isset($options['delay'])) {
            \usleep($options['delay'] * 1000);
=======
     *
     * @return PromiseInterface
     */
    public function __invoke(RequestInterface $request, array $options)
    {
        // Sleep if there is a delay specified.
        if (isset($options['delay'])) {
            usleep($options['delay'] * 1000);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        $startTime = isset($options['on_stats']) ? Utils::currentTime() : null;

        try {
            // Does not support the expect header.
            $request = $request->withoutHeader('Expect');

            // Append a content-length header if body size is zero to match
            // cURL's behavior.
            if (0 === $request->getBody()->getSize()) {
                $request = $request->withHeader('Content-Length', '0');
            }

            return $this->createResponse(
                $request,
                $options,
                $this->createStream($request, $options),
                $startTime
            );
        } catch (\InvalidArgumentException $e) {
            throw $e;
        } catch (\Exception $e) {
            // Determine if the error was a networking error.
            $message = $e->getMessage();
            // This list can probably get more comprehensive.
<<<<<<< HEAD
            if (false !== \strpos($message, 'getaddrinfo') // DNS lookup failed
                || false !== \strpos($message, 'Connection refused')
                || false !== \strpos($message, "couldn't connect to host") // error on HHVM
                || false !== \strpos($message, "connection attempt failed")
            ) {
                $e = new ConnectException($e->getMessage(), $request, $e);
            } else {
                $e = RequestException::wrapException($request, $e);
            }
=======
            if (strpos($message, 'getaddrinfo') // DNS lookup failed
                || strpos($message, 'Connection refused')
                || strpos($message, "couldn't connect to host") // error on HHVM
                || strpos($message, "connection attempt failed")
            ) {
                $e = new ConnectException($e->getMessage(), $request, $e);
            }
            $e = RequestException::wrapException($request, $e);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $this->invokeStats($options, $request, $startTime, null, $e);

            return \GuzzleHttp\Promise\rejection_for($e);
        }
    }

    private function invokeStats(
        array $options,
        RequestInterface $request,
<<<<<<< HEAD
        ?float $startTime,
        ResponseInterface $response = null,
        \Throwable $error = null
    ): void {
=======
        $startTime,
        ResponseInterface $response = null,
        $error = null
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        if (isset($options['on_stats'])) {
            $stats = new TransferStats(
                $request,
                $response,
                Utils::currentTime() - $startTime,
                $error,
                []
            );
<<<<<<< HEAD
            \call_user_func($options['on_stats'], $stats);
        }
    }

    /**
     * @param resource $stream
     */
=======
            call_user_func($options['on_stats'], $stats);
        }
    }

>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private function createResponse(
        RequestInterface $request,
        array $options,
        $stream,
<<<<<<< HEAD
        ?float $startTime
    ): PromiseInterface {
        $hdrs = $this->lastHeaders;
        $this->lastHeaders = [];
        $parts = \explode(' ', \array_shift($hdrs), 3);
        $ver = \explode('/', $parts[0])[1];
        $status = (int) $parts[1];
        $reason = $parts[2] ?? null;
        $headers = Utils::headersFromLines($hdrs);
        [$stream, $headers] = $this->checkDecode($options, $headers, $stream);
        $stream = Psr7\stream_for($stream);
        $sink = $stream;

        if (\strcasecmp('HEAD', $request->getMethod())) {
=======
        $startTime
    ) {
        $hdrs = $this->lastHeaders;
        $this->lastHeaders = [];
        $parts = explode(' ', array_shift($hdrs), 3);
        $ver = explode('/', $parts[0])[1];
        $status = $parts[1];
        $reason = isset($parts[2]) ? $parts[2] : null;
        $headers = \GuzzleHttp\headers_from_lines($hdrs);
        list($stream, $headers) = $this->checkDecode($options, $headers, $stream);
        $stream = Psr7\stream_for($stream);
        $sink = $stream;

        if (strcasecmp('HEAD', $request->getMethod())) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $sink = $this->createSink($stream, $options);
        }

        $response = new Psr7\Response($status, $headers, $sink, $ver, $reason);

        if (isset($options['on_headers'])) {
            try {
                $options['on_headers']($response);
            } catch (\Exception $e) {
                $msg = 'An error was encountered during the on_headers event';
                $ex = new RequestException($msg, $request, $response, $e);
                return \GuzzleHttp\Promise\rejection_for($ex);
            }
        }

        // Do not drain when the request is a HEAD request because they have
        // no body.
        if ($sink !== $stream) {
            $this->drain(
                $stream,
                $sink,
                $response->getHeaderLine('Content-Length')
            );
        }

        $this->invokeStats($options, $request, $startTime, $response, null);

        return new FulfilledPromise($response);
    }

<<<<<<< HEAD
    private function createSink(StreamInterface $stream, array $options): StreamInterface
=======
    private function createSink(StreamInterface $stream, array $options)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if (!empty($options['stream'])) {
            return $stream;
        }

<<<<<<< HEAD
        $sink = $options['sink']
            ?? \fopen('php://temp', 'r+');

        return \is_string($sink)
=======
        $sink = isset($options['sink'])
            ? $options['sink']
            : fopen('php://temp', 'r+');

        return is_string($sink)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            ? new Psr7\LazyOpenStream($sink, 'w+')
            : Psr7\stream_for($sink);
    }

<<<<<<< HEAD
    /**
     * @param resource $stream
     */
    private function checkDecode(array $options, array $headers, $stream): array
    {
        // Automatically decode responses when instructed.
        if (!empty($options['decode_content'])) {
            $normalizedKeys = Utils::normalizeHeaderKeys($headers);
=======
    private function checkDecode(array $options, array $headers, $stream)
    {
        // Automatically decode responses when instructed.
        if (!empty($options['decode_content'])) {
            $normalizedKeys = \GuzzleHttp\normalize_header_keys($headers);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            if (isset($normalizedKeys['content-encoding'])) {
                $encoding = $headers[$normalizedKeys['content-encoding']];
                if ($encoding[0] === 'gzip' || $encoding[0] === 'deflate') {
                    $stream = new Psr7\InflateStream(
                        Psr7\stream_for($stream)
                    );
                    $headers['x-encoded-content-encoding']
                        = $headers[$normalizedKeys['content-encoding']];
                    // Remove content-encoding header
                    unset($headers[$normalizedKeys['content-encoding']]);
                    // Fix content-length header
                    if (isset($normalizedKeys['content-length'])) {
                        $headers['x-encoded-content-length']
                            = $headers[$normalizedKeys['content-length']];

                        $length = (int) $stream->getSize();
                        if ($length === 0) {
                            unset($headers[$normalizedKeys['content-length']]);
                        } else {
                            $headers[$normalizedKeys['content-length']] = [$length];
                        }
                    }
                }
            }
        }

        return [$stream, $headers];
    }

    /**
     * Drains the source stream into the "sink" client option.
     *
<<<<<<< HEAD
     * @param string $contentLength Header specifying the amount of
     *                              data to read.
     *
=======
     * @param StreamInterface $source
     * @param StreamInterface $sink
     * @param string          $contentLength Header specifying the amount of
     *                                       data to read.
     *
     * @return StreamInterface
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     * @throws \RuntimeException when the sink option is invalid.
     */
    private function drain(
        StreamInterface $source,
        StreamInterface $sink,
<<<<<<< HEAD
        string $contentLength
    ): StreamInterface {
=======
        $contentLength
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        // If a content-length header is provided, then stop reading once
        // that number of bytes has been read. This can prevent infinitely
        // reading from a stream when dealing with servers that do not honor
        // Connection: Close headers.
        Psr7\copy_to_stream(
            $source,
            $sink,
<<<<<<< HEAD
            (\strlen($contentLength) > 0 && (int) $contentLength > 0) ? (int) $contentLength : -1
=======
            (strlen($contentLength) > 0 && (int) $contentLength > 0) ? (int) $contentLength : -1
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        );

        $sink->seek(0);
        $source->close();

        return $sink;
    }

    /**
     * Create a resource and check to ensure it was created successfully
     *
     * @param callable $callback Callable that returns stream resource
     *
     * @return resource
<<<<<<< HEAD
     *
=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     * @throws \RuntimeException on error
     */
    private function createResource(callable $callback)
    {
<<<<<<< HEAD
        $errors = [];
        \set_error_handler(static function ($_, $msg, $file, $line) use (&$errors): bool {
=======
        $errors = null;
        set_error_handler(function ($_, $msg, $file, $line) use (&$errors) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $errors[] = [
                'message' => $msg,
                'file'    => $file,
                'line'    => $line
            ];
            return true;
        });

        $resource = $callback();
<<<<<<< HEAD
        \restore_error_handler();
=======
        restore_error_handler();
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

        if (!$resource) {
            $message = 'Error creating resource: ';
            foreach ($errors as $err) {
                foreach ($err as $key => $value) {
<<<<<<< HEAD
                    $message .= "[$key] $value" . \PHP_EOL;
                }
            }
            throw new \RuntimeException(\trim($message));
=======
                    $message .= "[$key] $value" . PHP_EOL;
                }
            }
            throw new \RuntimeException(trim($message));
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        return $resource;
    }

<<<<<<< HEAD
    /**
     * @return resource
     */
=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private function createStream(RequestInterface $request, array $options)
    {
        static $methods;
        if (!$methods) {
<<<<<<< HEAD
            $methods = \array_flip(\get_class_methods(__CLASS__));
=======
            $methods = array_flip(get_class_methods(__CLASS__));
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        // HTTP/1.1 streams using the PHP stream wrapper require a
        // Connection: close header
        if ($request->getProtocolVersion() == '1.1'
            && !$request->hasHeader('Connection')
        ) {
            $request = $request->withHeader('Connection', 'close');
        }

        // Ensure SSL is verified by default
        if (!isset($options['verify'])) {
            $options['verify'] = true;
        }

        $params = [];
        $context = $this->getDefaultContext($request);

<<<<<<< HEAD
        if (isset($options['on_headers']) && !\is_callable($options['on_headers'])) {
=======
        if (isset($options['on_headers']) && !is_callable($options['on_headers'])) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            throw new \InvalidArgumentException('on_headers must be callable');
        }

        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $method = "add_{$key}";
                if (isset($methods[$method])) {
                    $this->{$method}($request, $context, $value, $params);
                }
            }
        }

        if (isset($options['stream_context'])) {
<<<<<<< HEAD
            if (!\is_array($options['stream_context'])) {
                throw new \InvalidArgumentException('stream_context must be an array');
            }
            $context = \array_replace_recursive(
=======
            if (!is_array($options['stream_context'])) {
                throw new \InvalidArgumentException('stream_context must be an array');
            }
            $context = array_replace_recursive(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                $context,
                $options['stream_context']
            );
        }

        // Microsoft NTLM authentication only supported with curl handler
<<<<<<< HEAD
        if (isset($options['auth'][2]) && 'ntlm' === $options['auth'][2]) {
=======
        if (isset($options['auth'])
            && is_array($options['auth'])
            && isset($options['auth'][2])
            && 'ntlm' == $options['auth'][2]
        ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            throw new \InvalidArgumentException('Microsoft NTLM authentication only supported with curl handler');
        }

        $uri = $this->resolveHost($request, $options);

<<<<<<< HEAD
        $contextResource = $this->createResource(
            static function () use ($context, $params) {
                return \stream_context_create($context, $params);
=======
        $context = $this->createResource(
            function () use ($context, $params) {
                return stream_context_create($context, $params);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            }
        );

        return $this->createResource(
<<<<<<< HEAD
            function () use ($uri, &$http_response_header, $contextResource, $context, $options, $request) {
                $resource = \fopen((string) $uri, 'r', false, $contextResource);
                $this->lastHeaders = $http_response_header;

                if (false === $resource) {
                    throw new ConnectException(
                        sprintf('Connection refused for URI %s', $uri),
                        $request,
                        null,
                        $context
                    );
                }

=======
            function () use ($uri, &$http_response_header, $context, $options) {
                $resource = fopen((string) $uri, 'r', null, $context);
                $this->lastHeaders = $http_response_header;

>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                if (isset($options['read_timeout'])) {
                    $readTimeout = $options['read_timeout'];
                    $sec = (int) $readTimeout;
                    $usec = ($readTimeout - $sec) * 100000;
<<<<<<< HEAD
                    \stream_set_timeout($resource, $sec, $usec);
=======
                    stream_set_timeout($resource, $sec, $usec);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                }

                return $resource;
            }
        );
    }

<<<<<<< HEAD
    private function resolveHost(RequestInterface $request, array $options): UriInterface
    {
        $uri = $request->getUri();

        if (isset($options['force_ip_resolve']) && !\filter_var($uri->getHost(), \FILTER_VALIDATE_IP)) {
            if ('v4' === $options['force_ip_resolve']) {
                $records = \dns_get_record($uri->getHost(), \DNS_A);
                if (false === $records || !isset($records[0]['ip'])) {
                    throw new ConnectException(
                        \sprintf(
=======
    private function resolveHost(RequestInterface $request, array $options)
    {
        $uri = $request->getUri();

        if (isset($options['force_ip_resolve']) && !filter_var($uri->getHost(), FILTER_VALIDATE_IP)) {
            if ('v4' === $options['force_ip_resolve']) {
                $records = dns_get_record($uri->getHost(), DNS_A);
                if (!isset($records[0]['ip'])) {
                    throw new ConnectException(
                        sprintf(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                            "Could not resolve IPv4 address for host '%s'",
                            $uri->getHost()
                        ),
                        $request
                    );
                }
<<<<<<< HEAD
                return $uri->withHost($records[0]['ip']);
            }
            if ('v6' === $options['force_ip_resolve']) {
                $records = \dns_get_record($uri->getHost(), \DNS_AAAA);
                if (false === $records || !isset($records[0]['ipv6'])) {
                    throw new ConnectException(
                        \sprintf(
=======
                $uri = $uri->withHost($records[0]['ip']);
            } elseif ('v6' === $options['force_ip_resolve']) {
                $records = dns_get_record($uri->getHost(), DNS_AAAA);
                if (!isset($records[0]['ipv6'])) {
                    throw new ConnectException(
                        sprintf(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                            "Could not resolve IPv6 address for host '%s'",
                            $uri->getHost()
                        ),
                        $request
                    );
                }
<<<<<<< HEAD
                return $uri->withHost('[' . $records[0]['ipv6'] . ']');
=======
                $uri = $uri->withHost('[' . $records[0]['ipv6'] . ']');
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            }
        }

        return $uri;
    }

<<<<<<< HEAD
    private function getDefaultContext(RequestInterface $request): array
=======
    private function getDefaultContext(RequestInterface $request)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $headers = '';
        foreach ($request->getHeaders() as $name => $value) {
            foreach ($value as $val) {
                $headers .= "$name: $val\r\n";
            }
        }

        $context = [
            'http' => [
                'method'           => $request->getMethod(),
                'header'           => $headers,
                'protocol_version' => $request->getProtocolVersion(),
                'ignore_errors'    => true,
                'follow_location'  => 0,
            ],
        ];

        $body = (string) $request->getBody();

        if (!empty($body)) {
            $context['http']['content'] = $body;
            // Prevent the HTTP handler from adding a Content-Type header.
            if (!$request->hasHeader('Content-Type')) {
                $context['http']['header'] .= "Content-Type:\r\n";
            }
        }

<<<<<<< HEAD
        $context['http']['header'] = \rtrim($context['http']['header']);
=======
        $context['http']['header'] = rtrim($context['http']['header']);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

        return $context;
    }

<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_proxy(RequestInterface $request, array &$options, $value, array &$params): void
    {
        if (!\is_array($value)) {
=======
    private function add_proxy(RequestInterface $request, &$options, $value, &$params)
    {
        if (!is_array($value)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $options['http']['proxy'] = $value;
        } else {
            $scheme = $request->getUri()->getScheme();
            if (isset($value[$scheme])) {
                if (!isset($value['no'])
<<<<<<< HEAD
                    || !Utils::isHostInNoProxy(
=======
                    || !\GuzzleHttp\is_host_in_noproxy(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                        $request->getUri()->getHost(),
                        $value['no']
                    )
                ) {
                    $options['http']['proxy'] = $value[$scheme];
                }
            }
        }
    }

<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_timeout(RequestInterface $request, array &$options, $value, array &$params): void
=======
    private function add_timeout(RequestInterface $request, &$options, $value, &$params)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if ($value > 0) {
            $options['http']['timeout'] = $value;
        }
    }

<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_verify(RequestInterface $request, array &$options, $value, array &$params): void
    {
        if ($value === false) {
            $options['ssl']['verify_peer'] = false;
            $options['ssl']['verify_peer_name'] = false;

            return;
        }

        if (\is_string($value)) {
            $options['ssl']['cafile'] = $value;
            if (!\file_exists($value)) {
                throw new \RuntimeException("SSL CA bundle not found: $value");
            }
        } elseif ($value !== true) {
=======
    private function add_verify(RequestInterface $request, &$options, $value, &$params)
    {
        if ($value === true) {
            // PHP 5.6 or greater will find the system cert by default. When
            // < 5.6, use the Guzzle bundled cacert.
            if (PHP_VERSION_ID < 50600) {
                $options['ssl']['cafile'] = \GuzzleHttp\default_ca_bundle();
            }
        } elseif (is_string($value)) {
            $options['ssl']['cafile'] = $value;
            if (!file_exists($value)) {
                throw new \RuntimeException("SSL CA bundle not found: $value");
            }
        } elseif ($value === false) {
            $options['ssl']['verify_peer'] = false;
            $options['ssl']['verify_peer_name'] = false;
            return;
        } else {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            throw new \InvalidArgumentException('Invalid verify request option');
        }

        $options['ssl']['verify_peer'] = true;
        $options['ssl']['verify_peer_name'] = true;
        $options['ssl']['allow_self_signed'] = false;
    }

<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_cert(RequestInterface $request, array &$options, $value, array &$params): void
    {
        if (\is_array($value)) {
=======
    private function add_cert(RequestInterface $request, &$options, $value, &$params)
    {
        if (is_array($value)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $options['ssl']['passphrase'] = $value[1];
            $value = $value[0];
        }

<<<<<<< HEAD
        if (!\file_exists($value)) {
=======
        if (!file_exists($value)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            throw new \RuntimeException("SSL certificate not found: {$value}");
        }

        $options['ssl']['local_cert'] = $value;
    }

<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_progress(RequestInterface $request, array &$options, $value, array &$params): void
    {
        $this->addNotification(
            $params,
            static function ($code, $a, $b, $c, $transferred, $total) use ($value) {
                if ($code == \STREAM_NOTIFY_PROGRESS) {
=======
    private function add_progress(RequestInterface $request, &$options, $value, &$params)
    {
        $this->addNotification(
            $params,
            function ($code, $a, $b, $c, $transferred, $total) use ($value) {
                if ($code == STREAM_NOTIFY_PROGRESS) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    $value($total, $transferred, null, null);
                }
            }
        );
    }

<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_debug(RequestInterface $request, array &$options, $value, array &$params): void
=======
    private function add_debug(RequestInterface $request, &$options, $value, &$params)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if ($value === false) {
            return;
        }

        static $map = [
<<<<<<< HEAD
            \STREAM_NOTIFY_CONNECT       => 'CONNECT',
            \STREAM_NOTIFY_AUTH_REQUIRED => 'AUTH_REQUIRED',
            \STREAM_NOTIFY_AUTH_RESULT   => 'AUTH_RESULT',
            \STREAM_NOTIFY_MIME_TYPE_IS  => 'MIME_TYPE_IS',
            \STREAM_NOTIFY_FILE_SIZE_IS  => 'FILE_SIZE_IS',
            \STREAM_NOTIFY_REDIRECTED    => 'REDIRECTED',
            \STREAM_NOTIFY_PROGRESS      => 'PROGRESS',
            \STREAM_NOTIFY_FAILURE       => 'FAILURE',
            \STREAM_NOTIFY_COMPLETED     => 'COMPLETED',
            \STREAM_NOTIFY_RESOLVE       => 'RESOLVE',
=======
            STREAM_NOTIFY_CONNECT       => 'CONNECT',
            STREAM_NOTIFY_AUTH_REQUIRED => 'AUTH_REQUIRED',
            STREAM_NOTIFY_AUTH_RESULT   => 'AUTH_RESULT',
            STREAM_NOTIFY_MIME_TYPE_IS  => 'MIME_TYPE_IS',
            STREAM_NOTIFY_FILE_SIZE_IS  => 'FILE_SIZE_IS',
            STREAM_NOTIFY_REDIRECTED    => 'REDIRECTED',
            STREAM_NOTIFY_PROGRESS      => 'PROGRESS',
            STREAM_NOTIFY_FAILURE       => 'FAILURE',
            STREAM_NOTIFY_COMPLETED     => 'COMPLETED',
            STREAM_NOTIFY_RESOLVE       => 'RESOLVE',
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        ];
        static $args = ['severity', 'message', 'message_code',
            'bytes_transferred', 'bytes_max'];

<<<<<<< HEAD
        $value = Utils::debugResource($value);
        $ident = $request->getMethod() . ' ' . $request->getUri()->withFragment('');
        $this->addNotification(
            $params,
            static function () use ($ident, $value, $map, $args): void {
                $passed = \func_get_args();
                $code = \array_shift($passed);
                \fprintf($value, '<%s> [%s] ', $ident, $map[$code]);
                foreach (\array_filter($passed) as $i => $v) {
                    \fwrite($value, $args[$i] . ': "' . $v . '" ');
                }
                \fwrite($value, "\n");
=======
        $value = \GuzzleHttp\debug_resource($value);
        $ident = $request->getMethod() . ' ' . $request->getUri()->withFragment('');
        $this->addNotification(
            $params,
            function () use ($ident, $value, $map, $args) {
                $passed = func_get_args();
                $code = array_shift($passed);
                fprintf($value, '<%s> [%s] ', $ident, $map[$code]);
                foreach (array_filter($passed) as $i => $v) {
                    fwrite($value, $args[$i] . ': "' . $v . '" ');
                }
                fwrite($value, "\n");
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            }
        );
    }

<<<<<<< HEAD
    private function addNotification(array &$params, callable $notify): void
=======
    private function addNotification(array &$params, callable $notify)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        // Wrap the existing function if needed.
        if (!isset($params['notification'])) {
            $params['notification'] = $notify;
        } else {
            $params['notification'] = $this->callArray([
                $params['notification'],
                $notify
            ]);
        }
    }

<<<<<<< HEAD
    private function callArray(array $functions): callable
    {
        return static function () use ($functions) {
            $args = \func_get_args();
            foreach ($functions as $fn) {
                \call_user_func_array($fn, $args);
=======
    private function callArray(array $functions)
    {
        return function () use ($functions) {
            $args = func_get_args();
            foreach ($functions as $fn) {
                call_user_func_array($fn, $args);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            }
        };
    }
}
