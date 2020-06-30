<?php
<<<<<<< HEAD

=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
namespace GuzzleHttp;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Represents data at the point after it was transferred either successfully
 * or after a network error.
 */
final class TransferStats
{
<<<<<<< HEAD
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface|null
     */
    private $response;

    /**
     * @var float|null
     */
    private $transferTime;

    /**
     * @var array
     */
    private $handlerStats;

    /**
     * @var mixed|null
     */
=======
    private $request;
    private $response;
    private $transferTime;
    private $handlerStats;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private $handlerErrorData;

    /**
     * @param RequestInterface       $request          Request that was sent.
     * @param ResponseInterface|null $response         Response received (if any)
     * @param float|null             $transferTime     Total handler transfer time.
     * @param mixed                  $handlerErrorData Handler error data.
     * @param array                  $handlerStats     Handler specific stats.
     */
    public function __construct(
        RequestInterface $request,
<<<<<<< HEAD
        ?ResponseInterface $response = null,
        ?float $transferTime = null,
        $handlerErrorData = null,
        array $handlerStats = []
=======
        ResponseInterface $response = null,
        $transferTime = null,
        $handlerErrorData = null,
        $handlerStats = []
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->transferTime = $transferTime;
        $this->handlerErrorData = $handlerErrorData;
        $this->handlerStats = $handlerStats;
    }

<<<<<<< HEAD
    public function getRequest(): RequestInterface
=======
    /**
     * @return RequestInterface
     */
    public function getRequest()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->request;
    }

    /**
     * Returns the response that was received (if any).
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
     * Returns true if a response was received.
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
     * Gets handler specific error data.
     *
     * This might be an exception, a integer representing an error code, or
     * anything else. Relying on this value assumes that you know what handler
     * you are using.
     *
     * @return mixed
     */
    public function getHandlerErrorData()
    {
        return $this->handlerErrorData;
    }

    /**
     * Get the effective URI the request was sent to.
<<<<<<< HEAD
     */
    public function getEffectiveUri(): UriInterface
=======
     *
     * @return UriInterface
     */
    public function getEffectiveUri()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->request->getUri();
    }

    /**
     * Get the estimated time the request was being transferred by the handler.
     *
     * @return float|null Time in seconds.
     */
<<<<<<< HEAD
    public function getTransferTime(): ?float
=======
    public function getTransferTime()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->transferTime;
    }

    /**
     * Gets an array of all of the handler specific transfer data.
<<<<<<< HEAD
     */
    public function getHandlerStats(): array
=======
     *
     * @return array
     */
    public function getHandlerStats()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->handlerStats;
    }

    /**
     * Get a specific handler statistic from the handler by name.
     *
     * @param string $stat Handler specific transfer stat to retrieve.
     *
     * @return mixed|null
     */
<<<<<<< HEAD
    public function getHandlerStat(string $stat)
=======
    public function getHandlerStat($stat)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return isset($this->handlerStats[$stat])
            ? $this->handlerStats[$stat]
            : null;
    }
}
