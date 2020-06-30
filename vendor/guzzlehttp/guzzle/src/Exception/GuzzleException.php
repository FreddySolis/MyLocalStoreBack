<?php
<<<<<<< HEAD

namespace GuzzleHttp\Exception;

use Psr\Http\Client\ClientExceptionInterface;

interface GuzzleException extends ClientExceptionInterface
{
=======
namespace GuzzleHttp\Exception;

use Throwable;

if (interface_exists(Throwable::class)) {
    interface GuzzleException extends Throwable
    {
    }
} else {
    /**
     * @method string getMessage()
     * @method \Throwable|null getPrevious()
     * @method mixed getCode()
     * @method string getFile()
     * @method int getLine()
     * @method array getTrace()
     * @method string getTraceAsString()
     */
    interface GuzzleException
    {
    }
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
}
