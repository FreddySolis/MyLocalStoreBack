<?php
<<<<<<< HEAD

namespace GuzzleHttp\Handler;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Utils;
=======
namespace GuzzleHttp\Handler;

use GuzzleHttp\Psr7\Response;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Represents a cURL easy handle and the data it populates.
 *
 * @internal
 */
final class EasyHandle
{
<<<<<<< HEAD
    /**
     * @var resource cURL resource
     */
    public $handle;

    /**
     * @var StreamInterface Where data is being written
     */
    public $sink;

    /**
     * @var array Received HTTP headers so far
     */
    public $headers = [];

    /**
     * @var ResponseInterface|null Received response (if any)
     */
    public $response;

    /**
     * @var RequestInterface Request being sent
     */
    public $request;

    /**
     * @var array Request options
     */
    public $options = [];

    /**
     * @var int cURL error number (if any)
     */
    public $errno = 0;

    /**
     * @var \Throwable|null Exception during on_headers (if any)
     */
=======
    /** @var resource cURL resource */
    public $handle;

    /** @var StreamInterface Where data is being written */
    public $sink;

    /** @var array Received HTTP headers so far */
    public $headers = [];

    /** @var ResponseInterface Received response (if any) */
    public $response;

    /** @var RequestInterface Request being sent */
    public $request;

    /** @var array Request options */
    public $options = [];

    /** @var int cURL error number (if any) */
    public $errno = 0;

    /** @var \Exception Exception during on_headers (if any) */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    public $onHeadersException;

    /**
     * Attach a response to the easy handle based on the received headers.
     *
     * @throws \RuntimeException if no headers have been received.
     */
<<<<<<< HEAD
    public function createResponse(): void
=======
    public function createResponse()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if (empty($this->headers)) {
            throw new \RuntimeException('No headers have been received');
        }

        // HTTP-version SP status-code SP reason-phrase
<<<<<<< HEAD
        $startLine = \explode(' ', \array_shift($this->headers), 3);
        $headers = Utils::headersFromLines($this->headers);
        $normalizedKeys = Utils::normalizeHeaderKeys($headers);
=======
        $startLine = explode(' ', array_shift($this->headers), 3);
        $headers = \GuzzleHttp\headers_from_lines($this->headers);
        $normalizedKeys = \GuzzleHttp\normalize_header_keys($headers);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

        if (!empty($this->options['decode_content'])
            && isset($normalizedKeys['content-encoding'])
        ) {
            $headers['x-encoded-content-encoding']
                = $headers[$normalizedKeys['content-encoding']];
            unset($headers[$normalizedKeys['content-encoding']]);
            if (isset($normalizedKeys['content-length'])) {
                $headers['x-encoded-content-length']
                    = $headers[$normalizedKeys['content-length']];

                $bodyLength = (int) $this->sink->getSize();
                if ($bodyLength) {
                    $headers[$normalizedKeys['content-length']] = $bodyLength;
                } else {
                    unset($headers[$normalizedKeys['content-length']]);
                }
            }
        }

<<<<<<< HEAD
        $statusCode = (int) $startLine[1];

        // Attach a response to the easy handle with the parsed headers.
        $this->response = new Response(
            $statusCode,
            $headers,
            $this->sink,
            \substr($startLine[0], 5),
=======
        // Attach a response to the easy handle with the parsed headers.
        $this->response = new Response(
            $startLine[1],
            $headers,
            $this->sink,
            substr($startLine[0], 5),
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            isset($startLine[2]) ? (string) $startLine[2] : null
        );
    }

<<<<<<< HEAD
    /**
     * @param string $name
     *
     * @return void
     *
     * @throws \BadMethodCallException
     */
=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    public function __get($name)
    {
        $msg = $name === 'handle'
            ? 'The EasyHandle has been released'
            : 'Invalid property: ' . $name;
        throw new \BadMethodCallException($msg);
    }
}
