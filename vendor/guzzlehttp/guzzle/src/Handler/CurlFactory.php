<?php
<<<<<<< HEAD

=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
namespace GuzzleHttp\Handler;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\FulfilledPromise;
<<<<<<< HEAD
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\LazyOpenStream;
use GuzzleHttp\TransferStats;
use GuzzleHttp\Utils;
=======
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\LazyOpenStream;
use GuzzleHttp\TransferStats;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
use Psr\Http\Message\RequestInterface;

/**
 * Creates curl resources from a request
 */
class CurlFactory implements CurlFactoryInterface
{
<<<<<<< HEAD
    public const CURL_VERSION_STR = 'curl_version';
    public const LOW_CURL_VERSION_NUMBER = '7.21.2';

    /**
     * @var resource[]
     */
    private $handles = [];

    /**
     * @var int Total number of idle handles to keep in cache
     */
=======
    const CURL_VERSION_STR = 'curl_version';
    const LOW_CURL_VERSION_NUMBER = '7.21.2';

    /** @var array */
    private $handles = [];

    /** @var int Total number of idle handles to keep in cache */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private $maxHandles;

    /**
     * @param int $maxHandles Maximum number of idle handles.
     */
<<<<<<< HEAD
    public function __construct(int $maxHandles)
=======
    public function __construct($maxHandles)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->maxHandles = $maxHandles;
    }

<<<<<<< HEAD
    public function create(RequestInterface $request, array $options): EasyHandle
=======
    public function create(RequestInterface $request, array $options)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if (isset($options['curl']['body_as_string'])) {
            $options['_body_as_string'] = $options['curl']['body_as_string'];
            unset($options['curl']['body_as_string']);
        }

        $easy = new EasyHandle;
        $easy->request = $request;
        $easy->options = $options;
        $conf = $this->getDefaultConf($easy);
        $this->applyMethod($easy, $conf);
        $this->applyHandlerOptions($easy, $conf);
        $this->applyHeaders($easy, $conf);
        unset($conf['_headers']);

        // Add handler options from the request configuration options
        if (isset($options['curl'])) {
<<<<<<< HEAD
            $conf = \array_replace($conf, $options['curl']);
        }

        $conf[\CURLOPT_HEADERFUNCTION] = $this->createHeaderFn($easy);
        $easy->handle = $this->handles
            ? \array_pop($this->handles)
            : \curl_init();
=======
            $conf = array_replace($conf, $options['curl']);
        }

        $conf[CURLOPT_HEADERFUNCTION] = $this->createHeaderFn($easy);
        $easy->handle = $this->handles
            ? array_pop($this->handles)
            : curl_init();
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        curl_setopt_array($easy->handle, $conf);

        return $easy;
    }

<<<<<<< HEAD
    public function release(EasyHandle $easy): void
=======
    public function release(EasyHandle $easy)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $resource = $easy->handle;
        unset($easy->handle);

<<<<<<< HEAD
        if (\count($this->handles) >= $this->maxHandles) {
            \curl_close($resource);
=======
        if (count($this->handles) >= $this->maxHandles) {
            curl_close($resource);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        } else {
            // Remove all callback functions as they can hold onto references
            // and are not cleaned up by curl_reset. Using curl_setopt_array
            // does not work for some reason, so removing each one
            // individually.
<<<<<<< HEAD
            \curl_setopt($resource, \CURLOPT_HEADERFUNCTION, null);
            \curl_setopt($resource, \CURLOPT_READFUNCTION, null);
            \curl_setopt($resource, \CURLOPT_WRITEFUNCTION, null);
            \curl_setopt($resource, \CURLOPT_PROGRESSFUNCTION, null);
            \curl_reset($resource);
=======
            curl_setopt($resource, CURLOPT_HEADERFUNCTION, null);
            curl_setopt($resource, CURLOPT_READFUNCTION, null);
            curl_setopt($resource, CURLOPT_WRITEFUNCTION, null);
            curl_setopt($resource, CURLOPT_PROGRESSFUNCTION, null);
            curl_reset($resource);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $this->handles[] = $resource;
        }
    }

    /**
     * Completes a cURL transaction, either returning a response promise or a
     * rejected promise.
     *
<<<<<<< HEAD
     * @param callable(RequestInterface, array): PromiseInterface $handler
     * @param CurlFactoryInterface                                $factory Dictates how the handle is released
=======
     * @param callable             $handler
     * @param EasyHandle           $easy
     * @param CurlFactoryInterface $factory Dictates how the handle is released
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public static function finish(
        callable $handler,
        EasyHandle $easy,
        CurlFactoryInterface $factory
<<<<<<< HEAD
    ): PromiseInterface {
=======
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        if (isset($easy->options['on_stats'])) {
            self::invokeStats($easy);
        }

        if (!$easy->response || $easy->errno) {
            return self::finishError($handler, $easy, $factory);
        }

        // Return the response if it is present and there is no error.
        $factory->release($easy);

        // Rewind the body of the response if possible.
        $body = $easy->response->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }

        return new FulfilledPromise($easy->response);
    }

<<<<<<< HEAD
    private static function invokeStats(EasyHandle $easy): void
    {
        $curlStats = \curl_getinfo($easy->handle);
        $curlStats['appconnect_time'] = \curl_getinfo($easy->handle, \CURLINFO_APPCONNECT_TIME);
=======
    private static function invokeStats(EasyHandle $easy)
    {
        $curlStats = curl_getinfo($easy->handle);
        $curlStats['appconnect_time'] = curl_getinfo($easy->handle, CURLINFO_APPCONNECT_TIME);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        $stats = new TransferStats(
            $easy->request,
            $easy->response,
            $curlStats['total_time'],
            $easy->errno,
            $curlStats
        );
<<<<<<< HEAD
        \call_user_func($easy->options['on_stats'], $stats);
    }

    /**
     * @param callable(RequestInterface, array): PromiseInterface $handler
     */
=======
        call_user_func($easy->options['on_stats'], $stats);
    }

>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private static function finishError(
        callable $handler,
        EasyHandle $easy,
        CurlFactoryInterface $factory
<<<<<<< HEAD
    ): PromiseInterface {
        // Get error information and release the handle to the factory.
        $ctx = [
            'errno' => $easy->errno,
            'error' => \curl_error($easy->handle),
            'appconnect_time' => \curl_getinfo($easy->handle, \CURLINFO_APPCONNECT_TIME),
        ] + \curl_getinfo($easy->handle);
        $ctx[self::CURL_VERSION_STR] = \curl_version()['version'];
=======
    ) {
        // Get error information and release the handle to the factory.
        $ctx = [
            'errno' => $easy->errno,
            'error' => curl_error($easy->handle),
            'appconnect_time' => curl_getinfo($easy->handle, CURLINFO_APPCONNECT_TIME),
        ] + curl_getinfo($easy->handle);
        $ctx[self::CURL_VERSION_STR] = curl_version()['version'];
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        $factory->release($easy);

        // Retry when nothing is present or when curl failed to rewind.
        if (empty($easy->options['_err_message'])
            && (!$easy->errno || $easy->errno == 65)
        ) {
            return self::retryFailedRewind($handler, $easy, $ctx);
        }

        return self::createRejection($easy, $ctx);
    }

<<<<<<< HEAD
    private static function createRejection(EasyHandle $easy, array $ctx): PromiseInterface
    {
        static $connectionErrors = [
            \CURLE_OPERATION_TIMEOUTED  => true,
            \CURLE_COULDNT_RESOLVE_HOST => true,
            \CURLE_COULDNT_CONNECT      => true,
            \CURLE_SSL_CONNECT_ERROR    => true,
            \CURLE_GOT_NOTHING          => true,
=======
    private static function createRejection(EasyHandle $easy, array $ctx)
    {
        static $connectionErrors = [
            CURLE_OPERATION_TIMEOUTED  => true,
            CURLE_COULDNT_RESOLVE_HOST => true,
            CURLE_COULDNT_CONNECT      => true,
            CURLE_SSL_CONNECT_ERROR    => true,
            CURLE_GOT_NOTHING          => true,
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        ];

        // If an exception was encountered during the onHeaders event, then
        // return a rejected promise that wraps that exception.
        if ($easy->onHeadersException) {
            return \GuzzleHttp\Promise\rejection_for(
                new RequestException(
                    'An error was encountered during the on_headers event',
                    $easy->request,
                    $easy->response,
                    $easy->onHeadersException,
                    $ctx
                )
            );
        }
<<<<<<< HEAD
        if (\version_compare($ctx[self::CURL_VERSION_STR], self::LOW_CURL_VERSION_NUMBER)) {
            $message = \sprintf(
=======
        if (version_compare($ctx[self::CURL_VERSION_STR], self::LOW_CURL_VERSION_NUMBER)) {
            $message = sprintf(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                'cURL error %s: %s (%s)',
                $ctx['errno'],
                $ctx['error'],
                'see https://curl.haxx.se/libcurl/c/libcurl-errors.html'
            );
        } else {
<<<<<<< HEAD
            $message = \sprintf(
=======
            $message = sprintf(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                'cURL error %s: %s (%s) for %s',
                $ctx['errno'],
                $ctx['error'],
                'see https://curl.haxx.se/libcurl/c/libcurl-errors.html',
                $easy->request->getUri()
            );
        }

        // Create a connection exception if it was a specific error code.
        $error = isset($connectionErrors[$easy->errno])
            ? new ConnectException($message, $easy->request, null, $ctx)
            : new RequestException($message, $easy->request, $easy->response, null, $ctx);

        return \GuzzleHttp\Promise\rejection_for($error);
    }

<<<<<<< HEAD
    /**
     * @return array<int|string, mixed>
     */
    private function getDefaultConf(EasyHandle $easy): array
    {
        $conf = [
            '_headers'              => $easy->request->getHeaders(),
            \CURLOPT_CUSTOMREQUEST  => $easy->request->getMethod(),
            \CURLOPT_URL            => (string) $easy->request->getUri()->withFragment(''),
            \CURLOPT_RETURNTRANSFER => false,
            \CURLOPT_HEADER         => false,
            \CURLOPT_CONNECTTIMEOUT => 150,
        ];

        if (\defined('CURLOPT_PROTOCOLS')) {
            $conf[\CURLOPT_PROTOCOLS] = \CURLPROTO_HTTP | \CURLPROTO_HTTPS;
=======
    private function getDefaultConf(EasyHandle $easy)
    {
        $conf = [
            '_headers'             => $easy->request->getHeaders(),
            CURLOPT_CUSTOMREQUEST  => $easy->request->getMethod(),
            CURLOPT_URL            => (string) $easy->request->getUri()->withFragment(''),
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_HEADER         => false,
            CURLOPT_CONNECTTIMEOUT => 150,
        ];

        if (defined('CURLOPT_PROTOCOLS')) {
            $conf[CURLOPT_PROTOCOLS] = CURLPROTO_HTTP | CURLPROTO_HTTPS;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        $version = $easy->request->getProtocolVersion();
        if ($version == 1.1) {
<<<<<<< HEAD
            $conf[\CURLOPT_HTTP_VERSION] = \CURL_HTTP_VERSION_1_1;
        } elseif ($version == 2.0) {
            $conf[\CURLOPT_HTTP_VERSION] = \CURL_HTTP_VERSION_2_0;
        } else {
            $conf[\CURLOPT_HTTP_VERSION] = \CURL_HTTP_VERSION_1_0;
=======
            $conf[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        } elseif ($version == 2.0) {
            $conf[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_2_0;
        } else {
            $conf[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_0;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        return $conf;
    }

<<<<<<< HEAD
    private function applyMethod(EasyHandle $easy, array &$conf): void
=======
    private function applyMethod(EasyHandle $easy, array &$conf)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $body = $easy->request->getBody();
        $size = $body->getSize();

        if ($size === null || $size > 0) {
            $this->applyBody($easy->request, $easy->options, $conf);
            return;
        }

        $method = $easy->request->getMethod();
        if ($method === 'PUT' || $method === 'POST') {
<<<<<<< HEAD
            // See https://tools.ietf.org/html/rfc7230#section-3.3.2
            if (!$easy->request->hasHeader('Content-Length')) {
                $conf[\CURLOPT_HTTPHEADER][] = 'Content-Length: 0';
            }
        } elseif ($method === 'HEAD') {
            $conf[\CURLOPT_NOBODY] = true;
            unset(
                $conf[\CURLOPT_WRITEFUNCTION],
                $conf[\CURLOPT_READFUNCTION],
                $conf[\CURLOPT_FILE],
                $conf[\CURLOPT_INFILE]
=======
            // See http://tools.ietf.org/html/rfc7230#section-3.3.2
            if (!$easy->request->hasHeader('Content-Length')) {
                $conf[CURLOPT_HTTPHEADER][] = 'Content-Length: 0';
            }
        } elseif ($method === 'HEAD') {
            $conf[CURLOPT_NOBODY] = true;
            unset(
                $conf[CURLOPT_WRITEFUNCTION],
                $conf[CURLOPT_READFUNCTION],
                $conf[CURLOPT_FILE],
                $conf[CURLOPT_INFILE]
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            );
        }
    }

<<<<<<< HEAD
    private function applyBody(RequestInterface $request, array $options, array &$conf): void
=======
    private function applyBody(RequestInterface $request, array $options, array &$conf)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $size = $request->hasHeader('Content-Length')
            ? (int) $request->getHeaderLine('Content-Length')
            : null;

        // Send the body as a string if the size is less than 1MB OR if the
        // [curl][body_as_string] request value is set.
        if (($size !== null && $size < 1000000) ||
            !empty($options['_body_as_string'])
        ) {
<<<<<<< HEAD
            $conf[\CURLOPT_POSTFIELDS] = (string) $request->getBody();
=======
            $conf[CURLOPT_POSTFIELDS] = (string) $request->getBody();
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            // Don't duplicate the Content-Length header
            $this->removeHeader('Content-Length', $conf);
            $this->removeHeader('Transfer-Encoding', $conf);
        } else {
<<<<<<< HEAD
            $conf[\CURLOPT_UPLOAD] = true;
            if ($size !== null) {
                $conf[\CURLOPT_INFILESIZE] = $size;
=======
            $conf[CURLOPT_UPLOAD] = true;
            if ($size !== null) {
                $conf[CURLOPT_INFILESIZE] = $size;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                $this->removeHeader('Content-Length', $conf);
            }
            $body = $request->getBody();
            if ($body->isSeekable()) {
                $body->rewind();
            }
<<<<<<< HEAD
            $conf[\CURLOPT_READFUNCTION] = static function ($ch, $fd, $length) use ($body) {
=======
            $conf[CURLOPT_READFUNCTION] = function ($ch, $fd, $length) use ($body) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                return $body->read($length);
            };
        }

        // If the Expect header is not present, prevent curl from adding it
        if (!$request->hasHeader('Expect')) {
<<<<<<< HEAD
            $conf[\CURLOPT_HTTPHEADER][] = 'Expect:';
=======
            $conf[CURLOPT_HTTPHEADER][] = 'Expect:';
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        // cURL sometimes adds a content-type by default. Prevent this.
        if (!$request->hasHeader('Content-Type')) {
<<<<<<< HEAD
            $conf[\CURLOPT_HTTPHEADER][] = 'Content-Type:';
        }
    }

    private function applyHeaders(EasyHandle $easy, array &$conf): void
=======
            $conf[CURLOPT_HTTPHEADER][] = 'Content-Type:';
        }
    }

    private function applyHeaders(EasyHandle $easy, array &$conf)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        foreach ($conf['_headers'] as $name => $values) {
            foreach ($values as $value) {
                $value = (string) $value;
                if ($value === '') {
                    // cURL requires a special format for empty headers.
                    // See https://github.com/guzzle/guzzle/issues/1882 for more details.
<<<<<<< HEAD
                    $conf[\CURLOPT_HTTPHEADER][] = "$name;";
                } else {
                    $conf[\CURLOPT_HTTPHEADER][] = "$name: $value";
=======
                    $conf[CURLOPT_HTTPHEADER][] = "$name;";
                } else {
                    $conf[CURLOPT_HTTPHEADER][] = "$name: $value";
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                }
            }
        }

        // Remove the Accept header if one was not set
        if (!$easy->request->hasHeader('Accept')) {
<<<<<<< HEAD
            $conf[\CURLOPT_HTTPHEADER][] = 'Accept:';
=======
            $conf[CURLOPT_HTTPHEADER][] = 'Accept:';
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }
    }

    /**
     * Remove a header from the options array.
     *
     * @param string $name    Case-insensitive header to remove
     * @param array  $options Array of options to modify
     */
<<<<<<< HEAD
    private function removeHeader(string $name, array &$options): void
    {
        foreach (\array_keys($options['_headers']) as $key) {
            if (!\strcasecmp($key, $name)) {
=======
    private function removeHeader($name, array &$options)
    {
        foreach (array_keys($options['_headers']) as $key) {
            if (!strcasecmp($key, $name)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                unset($options['_headers'][$key]);
                return;
            }
        }
    }

<<<<<<< HEAD
    private function applyHandlerOptions(EasyHandle $easy, array &$conf): void
=======
    private function applyHandlerOptions(EasyHandle $easy, array &$conf)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $options = $easy->options;
        if (isset($options['verify'])) {
            if ($options['verify'] === false) {
<<<<<<< HEAD
                unset($conf[\CURLOPT_CAINFO]);
                $conf[\CURLOPT_SSL_VERIFYHOST] = 0;
                $conf[\CURLOPT_SSL_VERIFYPEER] = false;
            } else {
                $conf[\CURLOPT_SSL_VERIFYHOST] = 2;
                $conf[\CURLOPT_SSL_VERIFYPEER] = true;
                if (\is_string($options['verify'])) {
                    // Throw an error if the file/folder/link path is not valid or doesn't exist.
                    if (!\file_exists($options['verify'])) {
=======
                unset($conf[CURLOPT_CAINFO]);
                $conf[CURLOPT_SSL_VERIFYHOST] = 0;
                $conf[CURLOPT_SSL_VERIFYPEER] = false;
            } else {
                $conf[CURLOPT_SSL_VERIFYHOST] = 2;
                $conf[CURLOPT_SSL_VERIFYPEER] = true;
                if (is_string($options['verify'])) {
                    // Throw an error if the file/folder/link path is not valid or doesn't exist.
                    if (!file_exists($options['verify'])) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                        throw new \InvalidArgumentException(
                            "SSL CA bundle not found: {$options['verify']}"
                        );
                    }
                    // If it's a directory or a link to a directory use CURLOPT_CAPATH.
                    // If not, it's probably a file, or a link to a file, so use CURLOPT_CAINFO.
<<<<<<< HEAD
                    if (
                        \is_dir($options['verify']) ||
                        (
                            \is_link($options['verify']) === true &&
                            ($verifyLink = \readlink($options['verify'])) !== false &&
                            \is_dir($verifyLink)
                        )
                    ) {
                        $conf[\CURLOPT_CAPATH] = $options['verify'];
                    } else {
                        $conf[\CURLOPT_CAINFO] = $options['verify'];
=======
                    if (is_dir($options['verify']) ||
                        (is_link($options['verify']) && is_dir(readlink($options['verify'])))) {
                        $conf[CURLOPT_CAPATH] = $options['verify'];
                    } else {
                        $conf[CURLOPT_CAINFO] = $options['verify'];
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    }
                }
            }
        }

        if (!empty($options['decode_content'])) {
            $accept = $easy->request->getHeaderLine('Accept-Encoding');
            if ($accept) {
<<<<<<< HEAD
                $conf[\CURLOPT_ENCODING] = $accept;
            } else {
                $conf[\CURLOPT_ENCODING] = '';
                // Don't let curl send the header over the wire
                $conf[\CURLOPT_HTTPHEADER][] = 'Accept-Encoding:';
=======
                $conf[CURLOPT_ENCODING] = $accept;
            } else {
                $conf[CURLOPT_ENCODING] = '';
                // Don't let curl send the header over the wire
                $conf[CURLOPT_HTTPHEADER][] = 'Accept-Encoding:';
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            }
        }

        if (isset($options['sink'])) {
            $sink = $options['sink'];
<<<<<<< HEAD
            if (!\is_string($sink)) {
                $sink = \GuzzleHttp\Psr7\stream_for($sink);
            } elseif (!\is_dir(\dirname($sink))) {
                // Ensure that the directory exists before failing in curl.
                throw new \RuntimeException(\sprintf(
                    'Directory %s does not exist for sink value of %s',
                    \dirname($sink),
=======
            if (!is_string($sink)) {
                $sink = \GuzzleHttp\Psr7\stream_for($sink);
            } elseif (!is_dir(dirname($sink))) {
                // Ensure that the directory exists before failing in curl.
                throw new \RuntimeException(sprintf(
                    'Directory %s does not exist for sink value of %s',
                    dirname($sink),
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    $sink
                ));
            } else {
                $sink = new LazyOpenStream($sink, 'w+');
            }
            $easy->sink = $sink;
<<<<<<< HEAD
            $conf[\CURLOPT_WRITEFUNCTION] = static function ($ch, $write) use ($sink): int {
=======
            $conf[CURLOPT_WRITEFUNCTION] = function ($ch, $write) use ($sink) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                return $sink->write($write);
            };
        } else {
            // Use a default temp stream if no sink was set.
<<<<<<< HEAD
            $conf[\CURLOPT_FILE] = \fopen('php://temp', 'w+');
            $easy->sink = Psr7\stream_for($conf[\CURLOPT_FILE]);
=======
            $conf[CURLOPT_FILE] = fopen('php://temp', 'w+');
            $easy->sink = Psr7\stream_for($conf[CURLOPT_FILE]);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }
        $timeoutRequiresNoSignal = false;
        if (isset($options['timeout'])) {
            $timeoutRequiresNoSignal |= $options['timeout'] < 1;
<<<<<<< HEAD
            $conf[\CURLOPT_TIMEOUT_MS] = $options['timeout'] * 1000;
=======
            $conf[CURLOPT_TIMEOUT_MS] = $options['timeout'] * 1000;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        // CURL default value is CURL_IPRESOLVE_WHATEVER
        if (isset($options['force_ip_resolve'])) {
            if ('v4' === $options['force_ip_resolve']) {
<<<<<<< HEAD
                $conf[\CURLOPT_IPRESOLVE] = \CURL_IPRESOLVE_V4;
            } elseif ('v6' === $options['force_ip_resolve']) {
                $conf[\CURLOPT_IPRESOLVE] = \CURL_IPRESOLVE_V6;
=======
                $conf[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
            } elseif ('v6' === $options['force_ip_resolve']) {
                $conf[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V6;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            }
        }

        if (isset($options['connect_timeout'])) {
            $timeoutRequiresNoSignal |= $options['connect_timeout'] < 1;
<<<<<<< HEAD
            $conf[\CURLOPT_CONNECTTIMEOUT_MS] = $options['connect_timeout'] * 1000;
        }

        if ($timeoutRequiresNoSignal && \strtoupper(\substr(\PHP_OS, 0, 3)) !== 'WIN') {
            $conf[\CURLOPT_NOSIGNAL] = true;
        }

        if (isset($options['proxy'])) {
            if (!\is_array($options['proxy'])) {
                $conf[\CURLOPT_PROXY] = $options['proxy'];
=======
            $conf[CURLOPT_CONNECTTIMEOUT_MS] = $options['connect_timeout'] * 1000;
        }

        if ($timeoutRequiresNoSignal && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $conf[CURLOPT_NOSIGNAL] = true;
        }

        if (isset($options['proxy'])) {
            if (!is_array($options['proxy'])) {
                $conf[CURLOPT_PROXY] = $options['proxy'];
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            } else {
                $scheme = $easy->request->getUri()->getScheme();
                if (isset($options['proxy'][$scheme])) {
                    $host = $easy->request->getUri()->getHost();
                    if (!isset($options['proxy']['no']) ||
<<<<<<< HEAD
                        !Utils::isHostInNoProxy($host, $options['proxy']['no'])
                    ) {
                        $conf[\CURLOPT_PROXY] = $options['proxy'][$scheme];
=======
                        !\GuzzleHttp\is_host_in_noproxy($host, $options['proxy']['no'])
                    ) {
                        $conf[CURLOPT_PROXY] = $options['proxy'][$scheme];
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    }
                }
            }
        }

        if (isset($options['cert'])) {
            $cert = $options['cert'];
<<<<<<< HEAD
            if (\is_array($cert)) {
                $conf[\CURLOPT_SSLCERTPASSWD] = $cert[1];
                $cert = $cert[0];
            }
            if (!\file_exists($cert)) {
=======
            if (is_array($cert)) {
                $conf[CURLOPT_SSLCERTPASSWD] = $cert[1];
                $cert = $cert[0];
            }
            if (!file_exists($cert)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                throw new \InvalidArgumentException(
                    "SSL certificate not found: {$cert}"
                );
            }
<<<<<<< HEAD
            $conf[\CURLOPT_SSLCERT] = $cert;
        }

        if (isset($options['ssl_key'])) {
            if (\is_array($options['ssl_key'])) {
                if (\count($options['ssl_key']) === 2) {
                    [$sslKey, $conf[\CURLOPT_SSLKEYPASSWD]] = $options['ssl_key'];
                } else {
                    [$sslKey] = $options['ssl_key'];
                }
            }

            $sslKey = $sslKey ?? $options['ssl_key'];

            if (!\file_exists($sslKey)) {
=======
            $conf[CURLOPT_SSLCERT] = $cert;
        }

        if (isset($options['ssl_key'])) {
            if (is_array($options['ssl_key'])) {
                if (count($options['ssl_key']) === 2) {
                    list($sslKey, $conf[CURLOPT_SSLKEYPASSWD]) = $options['ssl_key'];
                } else {
                    list($sslKey) = $options['ssl_key'];
                }
            }

            $sslKey = isset($sslKey) ? $sslKey: $options['ssl_key'];

            if (!file_exists($sslKey)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                throw new \InvalidArgumentException(
                    "SSL private key not found: {$sslKey}"
                );
            }
<<<<<<< HEAD
            $conf[\CURLOPT_SSLKEY] = $sslKey;
=======
            $conf[CURLOPT_SSLKEY] = $sslKey;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        if (isset($options['progress'])) {
            $progress = $options['progress'];
<<<<<<< HEAD
            if (!\is_callable($progress)) {
=======
            if (!is_callable($progress)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                throw new \InvalidArgumentException(
                    'progress client option must be callable'
                );
            }
<<<<<<< HEAD
            $conf[\CURLOPT_NOPROGRESS] = false;
            $conf[\CURLOPT_PROGRESSFUNCTION] = static function () use ($progress) {
                $args = \func_get_args();
                // PHP 5.5 pushed the handle onto the start of the args
                if (\is_resource($args[0])) {
                    \array_shift($args);
                }
                \call_user_func_array($progress, $args);
=======
            $conf[CURLOPT_NOPROGRESS] = false;
            $conf[CURLOPT_PROGRESSFUNCTION] = function () use ($progress) {
                $args = func_get_args();
                // PHP 5.5 pushed the handle onto the start of the args
                if (is_resource($args[0])) {
                    array_shift($args);
                }
                call_user_func_array($progress, $args);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            };
        }

        if (!empty($options['debug'])) {
<<<<<<< HEAD
            $conf[\CURLOPT_STDERR] = Utils::debugResource($options['debug']);
            $conf[\CURLOPT_VERBOSE] = true;
=======
            $conf[CURLOPT_STDERR] = \GuzzleHttp\debug_resource($options['debug']);
            $conf[CURLOPT_VERBOSE] = true;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }
    }

    /**
     * This function ensures that a response was set on a transaction. If one
     * was not set, then the request is retried if possible. This error
     * typically means you are sending a payload, curl encountered a
     * "Connection died, retrying a fresh connect" error, tried to rewind the
     * stream, and then encountered a "necessary data rewind wasn't possible"
     * error, causing the request to be sent through curl_multi_info_read()
     * without an error status.
<<<<<<< HEAD
     *
     * @param callable(RequestInterface, array): PromiseInterface $handler
=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    private static function retryFailedRewind(
        callable $handler,
        EasyHandle $easy,
        array $ctx
<<<<<<< HEAD
    ): PromiseInterface {
=======
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        try {
            // Only rewind if the body has been read from.
            $body = $easy->request->getBody();
            if ($body->tell() > 0) {
                $body->rewind();
            }
        } catch (\RuntimeException $e) {
            $ctx['error'] = 'The connection unexpectedly failed without '
                . 'providing an error. The request would have been retried, '
                . 'but attempting to rewind the request body failed. '
                . 'Exception: ' . $e;
            return self::createRejection($easy, $ctx);
        }

        // Retry no more than 3 times before giving up.
        if (!isset($easy->options['_curl_retries'])) {
            $easy->options['_curl_retries'] = 1;
        } elseif ($easy->options['_curl_retries'] == 2) {
            $ctx['error'] = 'The cURL request was retried 3 times '
                . 'and did not succeed. The most likely reason for the failure '
                . 'is that cURL was unable to rewind the body of the request '
                . 'and subsequent retries resulted in the same error. Turn on '
                . 'the debug option to see what went wrong. See '
                . 'https://bugs.php.net/bug.php?id=47204 for more information.';
            return self::createRejection($easy, $ctx);
        } else {
            $easy->options['_curl_retries']++;
        }

        return $handler($easy->request, $easy->options);
    }

<<<<<<< HEAD
    private function createHeaderFn(EasyHandle $easy): callable
=======
    private function createHeaderFn(EasyHandle $easy)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if (isset($easy->options['on_headers'])) {
            $onHeaders = $easy->options['on_headers'];

<<<<<<< HEAD
            if (!\is_callable($onHeaders)) {
=======
            if (!is_callable($onHeaders)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                throw new \InvalidArgumentException('on_headers must be callable');
            }
        } else {
            $onHeaders = null;
        }

<<<<<<< HEAD
        return static function ($ch, $h) use (
=======
        return function ($ch, $h) use (
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $onHeaders,
            $easy,
            &$startingResponse
        ) {
<<<<<<< HEAD
            $value = \trim($h);
=======
            $value = trim($h);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            if ($value === '') {
                $startingResponse = true;
                $easy->createResponse();
                if ($onHeaders !== null) {
                    try {
                        $onHeaders($easy->response);
                    } catch (\Exception $e) {
                        // Associate the exception with the handle and trigger
                        // a curl header write error by returning 0.
                        $easy->onHeadersException = $e;
                        return -1;
                    }
                }
            } elseif ($startingResponse) {
                $startingResponse = false;
                $easy->headers = [$value];
            } else {
                $easy->headers[] = $value;
            }
<<<<<<< HEAD
            return \strlen($h);
=======
            return strlen($h);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        };
    }
}
