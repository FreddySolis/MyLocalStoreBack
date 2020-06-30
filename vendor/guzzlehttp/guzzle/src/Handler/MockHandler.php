<?php
<<<<<<< HEAD

=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
namespace GuzzleHttp\Handler;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\PromiseInterface;
<<<<<<< HEAD
use GuzzleHttp\TransferStats;
use GuzzleHttp\Utils;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
=======
use GuzzleHttp\Promise\RejectedPromise;
use GuzzleHttp\TransferStats;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

/**
 * Handler that returns responses or throw exceptions from a queue.
 */
class MockHandler implements \Countable
{
<<<<<<< HEAD
    /**
     * @var array
     */
    private $queue = [];

    /**
     * @var RequestInterface|null
     */
    private $lastRequest;

    /**
     * @var array
     */
    private $lastOptions = [];

    /**
     * @var callable|null
     */
    private $onFulfilled;

    /**
     * @var callable|null
     */
=======
    private $queue = [];
    private $lastRequest;
    private $lastOptions;
    private $onFulfilled;
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private $onRejected;

    /**
     * Creates a new MockHandler that uses the default handler stack list of
     * middlewares.
     *
<<<<<<< HEAD
     * @param array|null    $queue       Array of responses, callables, or exceptions.
     * @param callable|null $onFulfilled Callback to invoke when the return value is fulfilled.
     * @param callable|null $onRejected  Callback to invoke when the return value is rejected.
=======
     * @param array $queue Array of responses, callables, or exceptions.
     * @param callable $onFulfilled Callback to invoke when the return value is fulfilled.
     * @param callable $onRejected  Callback to invoke when the return value is rejected.
     *
     * @return HandlerStack
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public static function createWithMiddleware(
        array $queue = null,
        callable $onFulfilled = null,
        callable $onRejected = null
<<<<<<< HEAD
    ): HandlerStack {
=======
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        return HandlerStack::create(new self($queue, $onFulfilled, $onRejected));
    }

    /**
     * The passed in value must be an array of
<<<<<<< HEAD
     * {@see \Psr\Http\Message\ResponseInterface} objects, Exceptions,
     * callables, or Promises.
     *
     * @param array<int, mixed>|null $queue       The parameters to be passed to the append function, as an indexed array.
     * @param callable|null          $onFulfilled Callback to invoke when the return value is fulfilled.
     * @param callable|null          $onRejected  Callback to invoke when the return value is rejected.
=======
     * {@see Psr7\Http\Message\ResponseInterface} objects, Exceptions,
     * callables, or Promises.
     *
     * @param array $queue
     * @param callable $onFulfilled Callback to invoke when the return value is fulfilled.
     * @param callable $onRejected  Callback to invoke when the return value is rejected.
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public function __construct(
        array $queue = null,
        callable $onFulfilled = null,
        callable $onRejected = null
    ) {
        $this->onFulfilled = $onFulfilled;
        $this->onRejected = $onRejected;

        if ($queue) {
<<<<<<< HEAD
            \call_user_func_array([$this, 'append'], $queue);
        }
    }

    public function __invoke(RequestInterface $request, array $options): PromiseInterface
=======
            call_user_func_array([$this, 'append'], $queue);
        }
    }

    public function __invoke(RequestInterface $request, array $options)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if (!$this->queue) {
            throw new \OutOfBoundsException('Mock queue is empty');
        }

<<<<<<< HEAD
        if (isset($options['delay']) && \is_numeric($options['delay'])) {
            \usleep($options['delay'] * 1000);
=======
        if (isset($options['delay']) && is_numeric($options['delay'])) {
            usleep($options['delay'] * 1000);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        $this->lastRequest = $request;
        $this->lastOptions = $options;
<<<<<<< HEAD
        $response = \array_shift($this->queue);

        if (isset($options['on_headers'])) {
            if (!\is_callable($options['on_headers'])) {
=======
        $response = array_shift($this->queue);

        if (isset($options['on_headers'])) {
            if (!is_callable($options['on_headers'])) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                throw new \InvalidArgumentException('on_headers must be callable');
            }
            try {
                $options['on_headers']($response);
            } catch (\Exception $e) {
                $msg = 'An error was encountered during the on_headers event';
                $response = new RequestException($msg, $request, $response, $e);
            }
        }

<<<<<<< HEAD
        if (\is_callable($response)) {
            $response = \call_user_func($response, $request, $options);
        }

        $response = $response instanceof \Throwable
=======
        if (is_callable($response)) {
            $response = call_user_func($response, $request, $options);
        }

        $response = $response instanceof \Exception
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            ? \GuzzleHttp\Promise\rejection_for($response)
            : \GuzzleHttp\Promise\promise_for($response);

        return $response->then(
<<<<<<< HEAD
            function (?ResponseInterface $value) use ($request, $options) {
                $this->invokeStats($request, $options, $value);
                if ($this->onFulfilled) {
                    \call_user_func($this->onFulfilled, $value);
                }

                if ($value !== null && isset($options['sink'])) {
                    $contents = (string) $value->getBody();
                    $sink = $options['sink'];

                    if (\is_resource($sink)) {
                        \fwrite($sink, $contents);
                    } elseif (\is_string($sink)) {
                        \file_put_contents($sink, $contents);
                    } elseif ($sink instanceof StreamInterface) {
=======
            function ($value) use ($request, $options) {
                $this->invokeStats($request, $options, $value);
                if ($this->onFulfilled) {
                    call_user_func($this->onFulfilled, $value);
                }
                if (isset($options['sink'])) {
                    $contents = (string) $value->getBody();
                    $sink = $options['sink'];

                    if (is_resource($sink)) {
                        fwrite($sink, $contents);
                    } elseif (is_string($sink)) {
                        file_put_contents($sink, $contents);
                    } elseif ($sink instanceof \Psr\Http\Message\StreamInterface) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                        $sink->write($contents);
                    }
                }

                return $value;
            },
            function ($reason) use ($request, $options) {
                $this->invokeStats($request, $options, null, $reason);
                if ($this->onRejected) {
<<<<<<< HEAD
                    \call_user_func($this->onRejected, $reason);
=======
                    call_user_func($this->onRejected, $reason);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                }
                return \GuzzleHttp\Promise\rejection_for($reason);
            }
        );
    }

    /**
     * Adds one or more variadic requests, exceptions, callables, or promises
     * to the queue.
<<<<<<< HEAD
     *
     * @param mixed ...$values
     */
    public function append(...$values): void
    {
        foreach ($values as $value) {
            if ($value instanceof ResponseInterface
                || $value instanceof \Throwable
                || $value instanceof PromiseInterface
                || \is_callable($value)
            ) {
                $this->queue[] = $value;
            } else {
                throw new \TypeError('Expected a Response, Promise, Throwable or callable. Found ' . Utils::describeType($value));
=======
     */
    public function append()
    {
        foreach (func_get_args() as $value) {
            if ($value instanceof ResponseInterface
                || $value instanceof \Exception
                || $value instanceof PromiseInterface
                || is_callable($value)
            ) {
                $this->queue[] = $value;
            } else {
                throw new \InvalidArgumentException('Expected a response or '
                    . 'exception. Found ' . \GuzzleHttp\describe_type($value));
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            }
        }
    }

    /**
     * Get the last received request.
<<<<<<< HEAD
     */
    public function getLastRequest(): ?RequestInterface
=======
     *
     * @return RequestInterface
     */
    public function getLastRequest()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->lastRequest;
    }

    /**
     * Get the last received request options.
<<<<<<< HEAD
     */
    public function getLastOptions(): array
=======
     *
     * @return array
     */
    public function getLastOptions()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->lastOptions;
    }

    /**
     * Returns the number of remaining items in the queue.
<<<<<<< HEAD
     */
    public function count(): int
    {
        return \count($this->queue);
    }

    public function reset(): void
=======
     *
     * @return int
     */
    public function count()
    {
        return count($this->queue);
    }

    public function reset()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->queue = [];
    }

<<<<<<< HEAD
    /**
     * @param mixed $reason Promise or reason.
     */
=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private function invokeStats(
        RequestInterface $request,
        array $options,
        ResponseInterface $response = null,
        $reason = null
<<<<<<< HEAD
    ): void {
        if (isset($options['on_stats'])) {
            $transferTime = $options['transfer_time'] ?? 0;
            $stats = new TransferStats($request, $response, $transferTime, $reason);
            \call_user_func($options['on_stats'], $stats);
=======
    ) {
        if (isset($options['on_stats'])) {
            $transferTime = isset($options['transfer_time']) ? $options['transfer_time'] : 0;
            $stats = new TransferStats($request, $response, $transferTime, $reason);
            call_user_func($options['on_stats'], $stats);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }
    }
}
