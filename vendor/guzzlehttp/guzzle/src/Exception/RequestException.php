<?php
<<<<<<< HEAD

namespace GuzzleHttp\Exception;

use Psr\Http\Client\RequestExceptionInterface;
=======
namespace GuzzleHttp\Exception;

use GuzzleHttp\Promise\PromiseInterface;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * HTTP Request exception
 */
<<<<<<< HEAD
class RequestException extends TransferException implements RequestExceptionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface|null
     */
    private $response;

    /**
     * @var array
     */
    private $handlerContext;

    public function __construct(
        string $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        \Throwable $previous = null,
        array $handlerContext = []
    ) {
        // Set the code of the exception if the response is set and not future.
        $code = $response ? $response->getStatusCode() : 0;
=======
class RequestException extends TransferException
{
    /** @var RequestInterface */
    private $request;

    /** @var ResponseInterface|null */
    private $response;

    /** @var array */
    private $handlerContext;

    public function __construct(
        $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $previous = null,
        array $handlerContext = []
    ) {
        // Set the code of the exception if the response is set and not future.
        $code = $response && !($response instanceof PromiseInterface)
            ? $response->getStatusCode()
            : 0;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        parent::__construct($message, $code, $previous);
        $this->request = $request;
        $this->response = $response;
        $this->handlerContext = $handlerContext;
    }

    /**
     * Wrap non-RequestExceptions with a RequestException
<<<<<<< HEAD
     */
    public static function wrapException(RequestInterface $request, \Throwable $e): RequestException
=======
     *
     * @param RequestInterface $request
     * @param \Exception       $e
     *
     * @return RequestException
     */
    public static function wrapException(RequestInterface $request, \Exception $e)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $e instanceof RequestException
            ? $e
            : new RequestException($e->getMessage(), $request, null, $e);
    }

    /**
     * Factory method to create a new exception with a normalized error message
     *
     * @param RequestInterface  $request  Request
     * @param ResponseInterface $response Response received
<<<<<<< HEAD
     * @param \Throwable        $previous Previous exception
     * @param array             $ctx      Optional handler context.
=======
     * @param \Exception        $previous Previous exception
     * @param array             $ctx      Optional handler context.
     *
     * @return self
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public static function create(
        RequestInterface $request,
        ResponseInterface $response = null,
<<<<<<< HEAD
        \Throwable $previous = null,
        array $ctx = []
    ): self {
=======
        \Exception $previous = null,
        array $ctx = []
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        if (!$response) {
            return new self(
                'Error completing request',
                $request,
                null,
                $previous,
                $ctx
            );
        }

<<<<<<< HEAD
        $level = (int) \floor($response->getStatusCode() / 100);
=======
        $level = (int) floor($response->getStatusCode() / 100);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        if ($level === 4) {
            $label = 'Client error';
            $className = ClientException::class;
        } elseif ($level === 5) {
            $label = 'Server error';
            $className = ServerException::class;
        } else {
            $label = 'Unsuccessful request';
            $className = __CLASS__;
        }

        $uri = $request->getUri();
        $uri = static::obfuscateUri($uri);

        // Client Error: `GET /` resulted in a `404 Not Found` response:
        // <html> ... (truncated)
<<<<<<< HEAD
        $message = \sprintf(
=======
        $message = sprintf(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            '%s: `%s %s` resulted in a `%s %s` response',
            $label,
            $request->getMethod(),
            $uri,
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );

<<<<<<< HEAD
        $summary = \GuzzleHttp\Psr7\get_message_body_summary($response);
=======
        $summary = static::getResponseBodySummary($response);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

        if ($summary !== null) {
            $message .= ":\n{$summary}\n";
        }

        return new $className($message, $request, $response, $previous, $ctx);
    }

    /**
<<<<<<< HEAD
     * Obfuscates URI if there is a username and a password present
     */
    private static function obfuscateUri(UriInterface $uri): UriInterface
    {
        $userInfo = $uri->getUserInfo();

        if (false !== ($pos = \strpos($userInfo, ':'))) {
            return $uri->withUserInfo(\substr($userInfo, 0, $pos), '***');
=======
     * Get a short summary of the response
     *
     * Will return `null` if the response is not printable.
     *
     * @param ResponseInterface $response
     *
     * @return string|null
     */
    public static function getResponseBodySummary(ResponseInterface $response)
    {
        return \GuzzleHttp\Psr7\get_message_body_summary($response);
    }

    /**
     * Obfuscates URI if there is a username and a password present
     *
     * @param UriInterface $uri
     *
     * @return UriInterface
     */
    private static function obfuscateUri(UriInterface $uri)
    {
        $userInfo = $uri->getUserInfo();

        if (false !== ($pos = strpos($userInfo, ':'))) {
            return $uri->withUserInfo(substr($userInfo, 0, $pos), '***');
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        return $uri;
    }

    /**
     * Get the request that caused the exception
<<<<<<< HEAD
     */
    public function getRequest(): RequestInterface
=======
     *
     * @return RequestInterface
     */
    public function getRequest()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->request;
    }

    /**
     * Get the associated response
<<<<<<< HEAD
     */
    public function getResponse(): ?ResponseInterface
=======
     *
     * @return ResponseInterface|null
     */
    public function getResponse()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->response;
    }

    /**
     * Check if a response was received
<<<<<<< HEAD
     */
    public function hasResponse(): bool
=======
     *
     * @return bool
     */
    public function hasResponse()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->response !== null;
    }

    /**
     * Get contextual information about the error from the underlying handler.
     *
     * The contents of this array will vary depending on which handler you are
     * using. It may also be just an empty array. Relying on this data will
     * couple you to a specific handler, but can give more debug information
     * when needed.
<<<<<<< HEAD
     */
    public function getHandlerContext(): array
=======
     *
     * @return array
     */
    public function getHandlerContext()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->handlerContext;
    }
}
