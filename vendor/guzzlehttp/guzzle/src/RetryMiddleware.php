<?php
<<<<<<< HEAD

namespace GuzzleHttp;

use GuzzleHttp\Promise\PromiseInterface;
=======
namespace GuzzleHttp;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\RejectedPromise;
use GuzzleHttp\Psr7;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Middleware that retries requests based on the boolean result of
 * invoking the provided "decider" function.
 */
class RetryMiddleware
{
<<<<<<< HEAD
    /**
     * @var callable(RequestInterface, array): PromiseInterface
     */
    private $nextHandler;

    /**
     * @var callable
     */
    private $decider;

    /**
     * @var callable(int)
     */
    private $delay;

    /**
     * @param callable                                            $decider     Function that accepts the number of retries,
     *                                                                         a request, [response], and [exception] and
     *                                                                         returns true if the request is to be
     *                                                                         retried.
     * @param callable(RequestInterface, array): PromiseInterface $nextHandler Next handler to invoke.
     * @param null|callable(int): int                             $delay       Function that accepts the number of retries
     *                                                                         and returns the number of
     *                                                                         milliseconds to delay.
=======
    /** @var callable  */
    private $nextHandler;

    /** @var callable */
    private $decider;

    /** @var callable */
    private $delay;

    /**
     * @param callable $decider     Function that accepts the number of retries,
     *                              a request, [response], and [exception] and
     *                              returns true if the request is to be
     *                              retried.
     * @param callable $nextHandler Next handler to invoke.
     * @param callable $delay       Function that accepts the number of retries
     *                              and [response] and returns the number of
     *                              milliseconds to delay.
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public function __construct(
        callable $decider,
        callable $nextHandler,
        callable $delay = null
    ) {
        $this->decider = $decider;
        $this->nextHandler = $nextHandler;
        $this->delay = $delay ?: __CLASS__ . '::exponentialDelay';
    }

    /**
     * Default exponential backoff delay function.
     *
<<<<<<< HEAD
     * @return int milliseconds.
     */
    public static function exponentialDelay(int $retries): int
    {
        return (int) \pow(2, $retries - 1) * 1000;
    }

    public function __invoke(RequestInterface $request, array $options): PromiseInterface
=======
     * @param int $retries
     *
     * @return int milliseconds.
     */
    public static function exponentialDelay($retries)
    {
        return (int) pow(2, $retries - 1) * 1000;
    }

    /**
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return PromiseInterface
     */
    public function __invoke(RequestInterface $request, array $options)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if (!isset($options['retries'])) {
            $options['retries'] = 0;
        }

        $fn = $this->nextHandler;
        return $fn($request, $options)
            ->then(
                $this->onFulfilled($request, $options),
                $this->onRejected($request, $options)
            );
    }

    /**
     * Execute fulfilled closure
<<<<<<< HEAD
     */
    private function onFulfilled(RequestInterface $request, array $options): callable
    {
        return function ($value) use ($request, $options) {
            if (!\call_user_func(
                $this->decider,
                $options['retries'],
                $request,
=======
     *
     * @return mixed
     */
    private function onFulfilled(RequestInterface $req, array $options)
    {
        return function ($value) use ($req, $options) {
            if (!call_user_func(
                $this->decider,
                $options['retries'],
                $req,
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                $value,
                null
            )) {
                return $value;
            }
<<<<<<< HEAD
            return $this->doRetry($request, $options, $value);
=======
            return $this->doRetry($req, $options, $value);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        };
    }

    /**
     * Execute rejected closure
<<<<<<< HEAD
     */
    private function onRejected(RequestInterface $req, array $options): callable
    {
        return function ($reason) use ($req, $options) {
            if (!\call_user_func(
=======
     *
     * @return callable
     */
    private function onRejected(RequestInterface $req, array $options)
    {
        return function ($reason) use ($req, $options) {
            if (!call_user_func(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                $this->decider,
                $options['retries'],
                $req,
                null,
                $reason
            )) {
                return \GuzzleHttp\Promise\rejection_for($reason);
            }
            return $this->doRetry($req, $options);
        };
    }

<<<<<<< HEAD
    private function doRetry(RequestInterface $request, array $options, ResponseInterface $response = null): PromiseInterface
    {
        $options['delay'] = \call_user_func($this->delay, ++$options['retries'], $response);
=======
    /**
     * @return self
     */
    private function doRetry(RequestInterface $request, array $options, ResponseInterface $response = null)
    {
        $options['delay'] = call_user_func($this->delay, ++$options['retries'], $response);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

        return $this($request, $options);
    }
}
