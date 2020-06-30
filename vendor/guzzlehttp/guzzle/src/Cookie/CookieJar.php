<?php
<<<<<<< HEAD

=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
namespace GuzzleHttp\Cookie;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Cookie jar that stores cookies as an array
 */
class CookieJar implements CookieJarInterface
{
<<<<<<< HEAD
    /**
     * @var SetCookie[] Loaded cookie data
     */
    private $cookies = [];

    /**
     * @var bool
     */
    private $strictMode;

    /**
     * @param bool  $strictMode  Set to true to throw exceptions when invalid
=======
    /** @var SetCookie[] Loaded cookie data */
    private $cookies = [];

    /** @var bool */
    private $strictMode;

    /**
     * @param bool $strictMode   Set to true to throw exceptions when invalid
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     *                           cookies are added to the cookie jar.
     * @param array $cookieArray Array of SetCookie objects or a hash of
     *                           arrays that can be used with the SetCookie
     *                           constructor
     */
<<<<<<< HEAD
    public function __construct(bool $strictMode = false, array $cookieArray = [])
=======
    public function __construct($strictMode = false, $cookieArray = [])
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->strictMode = $strictMode;

        foreach ($cookieArray as $cookie) {
            if (!($cookie instanceof SetCookie)) {
                $cookie = new SetCookie($cookie);
            }
            $this->setCookie($cookie);
        }
    }

    /**
     * Create a new Cookie jar from an associative array and domain.
     *
     * @param array  $cookies Cookies to create the jar from
     * @param string $domain  Domain to set the cookies to
<<<<<<< HEAD
     */
    public static function fromArray(array $cookies, string $domain): self
=======
     *
     * @return self
     */
    public static function fromArray(array $cookies, $domain)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $cookieJar = new self();
        foreach ($cookies as $name => $value) {
            $cookieJar->setCookie(new SetCookie([
                'Domain'  => $domain,
                'Name'    => $name,
                'Value'   => $value,
                'Discard' => true
            ]));
        }

        return $cookieJar;
    }

    /**
<<<<<<< HEAD
     * Evaluate if this cookie should be persisted to storage
     * that survives between requests.
     *
     * @param SetCookie $cookie              Being evaluated.
     * @param bool      $allowSessionCookies If we should persist session cookies
     */
    public static function shouldPersist(SetCookie $cookie, bool $allowSessionCookies = false): bool
    {
=======
     * @deprecated
     */
    public static function getCookieValue($value)
    {
        return $value;
    }

    /**
     * Evaluate if this cookie should be persisted to storage
     * that survives between requests.
     *
     * @param SetCookie $cookie Being evaluated.
     * @param bool $allowSessionCookies If we should persist session cookies
     * @return bool
     */
    public static function shouldPersist(
        SetCookie $cookie,
        $allowSessionCookies = false
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        if ($cookie->getExpires() || $allowSessionCookies) {
            if (!$cookie->getDiscard()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Finds and returns the cookie based on the name
     *
     * @param string $name cookie name to search for
<<<<<<< HEAD
     *
     * @return SetCookie|null cookie that was found or null if not found
     */
    public function getCookieByName(string $name): ?SetCookie
    {
        foreach ($this->cookies as $cookie) {
            if ($cookie->getName() !== null && \strcasecmp($cookie->getName(), $name) === 0) {
=======
     * @return SetCookie|null cookie that was found or null if not found
     */
    public function getCookieByName($name)
    {
        // don't allow a non string name
        if ($name === null || !is_scalar($name)) {
            return null;
        }
        foreach ($this->cookies as $cookie) {
            if ($cookie->getName() !== null && strcasecmp($cookie->getName(), $name) === 0) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                return $cookie;
            }
        }

        return null;
    }

<<<<<<< HEAD
    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return \array_map(static function (SetCookie $cookie): array {
=======
    public function toArray()
    {
        return array_map(function (SetCookie $cookie) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return $cookie->toArray();
        }, $this->getIterator()->getArrayCopy());
    }

<<<<<<< HEAD
    /**
     * @inheritDoc
     */
    public function clear(?string $domain = null, ?string $path = null, ?string $name = null): void
=======
    public function clear($domain = null, $path = null, $name = null)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        if (!$domain) {
            $this->cookies = [];
            return;
        } elseif (!$path) {
<<<<<<< HEAD
            $this->cookies = \array_filter(
                $this->cookies,
                static function (SetCookie $cookie) use ($domain): bool {
=======
            $this->cookies = array_filter(
                $this->cookies,
                function (SetCookie $cookie) use ($domain) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    return !$cookie->matchesDomain($domain);
                }
            );
        } elseif (!$name) {
<<<<<<< HEAD
            $this->cookies = \array_filter(
                $this->cookies,
                static function (SetCookie $cookie) use ($path, $domain): bool {
=======
            $this->cookies = array_filter(
                $this->cookies,
                function (SetCookie $cookie) use ($path, $domain) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    return !($cookie->matchesPath($path) &&
                        $cookie->matchesDomain($domain));
                }
            );
        } else {
<<<<<<< HEAD
            $this->cookies = \array_filter(
                $this->cookies,
                static function (SetCookie $cookie) use ($path, $domain, $name) {
=======
            $this->cookies = array_filter(
                $this->cookies,
                function (SetCookie $cookie) use ($path, $domain, $name) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    return !($cookie->getName() == $name &&
                        $cookie->matchesPath($path) &&
                        $cookie->matchesDomain($domain));
                }
            );
        }
    }

<<<<<<< HEAD
    /**
     * @inheritDoc
     */
    public function clearSessionCookies(): void
    {
        $this->cookies = \array_filter(
            $this->cookies,
            static function (SetCookie $cookie): bool {
=======
    public function clearSessionCookies()
    {
        $this->cookies = array_filter(
            $this->cookies,
            function (SetCookie $cookie) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                return !$cookie->getDiscard() && $cookie->getExpires();
            }
        );
    }

<<<<<<< HEAD
    /**
     * @inheritDoc
     */
    public function setCookie(SetCookie $cookie): bool
=======
    public function setCookie(SetCookie $cookie)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        // If the name string is empty (but not 0), ignore the set-cookie
        // string entirely.
        $name = $cookie->getName();
        if (!$name && $name !== '0') {
            return false;
        }

        // Only allow cookies with set and valid domain, name, value
        $result = $cookie->validate();
        if ($result !== true) {
            if ($this->strictMode) {
                throw new \RuntimeException('Invalid cookie: ' . $result);
<<<<<<< HEAD
            }
            $this->removeCookieIfEmpty($cookie);
            return false;
=======
            } else {
                $this->removeCookieIfEmpty($cookie);
                return false;
            }
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }

        // Resolve conflicts with previously set cookies
        foreach ($this->cookies as $i => $c) {

            // Two cookies are identical, when their path, and domain are
            // identical.
            if ($c->getPath() != $cookie->getPath() ||
                $c->getDomain() != $cookie->getDomain() ||
                $c->getName() != $cookie->getName()
            ) {
                continue;
            }

            // The previously set cookie is a discard cookie and this one is
            // not so allow the new cookie to be set
            if (!$cookie->getDiscard() && $c->getDiscard()) {
                unset($this->cookies[$i]);
                continue;
            }

            // If the new cookie's expiration is further into the future, then
            // replace the old cookie
            if ($cookie->getExpires() > $c->getExpires()) {
                unset($this->cookies[$i]);
                continue;
            }

            // If the value has changed, we better change it
            if ($cookie->getValue() !== $c->getValue()) {
                unset($this->cookies[$i]);
                continue;
            }

            // The cookie exists, so no need to continue
            return false;
        }

        $this->cookies[] = $cookie;

        return true;
    }

<<<<<<< HEAD
    public function count(): int
    {
        return \count($this->cookies);
    }

    /**
     * @return \ArrayIterator<int, SetCookie>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator(\array_values($this->cookies));
    }

    public function extractCookies(RequestInterface $request, ResponseInterface $response): void
    {
=======
    public function count()
    {
        return count($this->cookies);
    }

    public function getIterator()
    {
        return new \ArrayIterator(array_values($this->cookies));
    }

    public function extractCookies(
        RequestInterface $request,
        ResponseInterface $response
    ) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        if ($cookieHeader = $response->getHeader('Set-Cookie')) {
            foreach ($cookieHeader as $cookie) {
                $sc = SetCookie::fromString($cookie);
                if (!$sc->getDomain()) {
                    $sc->setDomain($request->getUri()->getHost());
                }
<<<<<<< HEAD
                if (0 !== \strpos($sc->getPath(), '/')) {
=======
                if (0 !== strpos($sc->getPath(), '/')) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                    $sc->setPath($this->getCookiePathFromRequest($request));
                }
                $this->setCookie($sc);
            }
        }
    }

    /**
     * Computes cookie path following RFC 6265 section 5.1.4
     *
     * @link https://tools.ietf.org/html/rfc6265#section-5.1.4
<<<<<<< HEAD
     */
    private function getCookiePathFromRequest(RequestInterface $request): string
    {
        $uriPath = $request->getUri()->getPath();
        if ('' === $uriPath) {
            return '/';
        }
        if (0 !== \strpos($uriPath, '/')) {
=======
     *
     * @param RequestInterface $request
     * @return string
     */
    private function getCookiePathFromRequest(RequestInterface $request)
    {
        $uriPath = $request->getUri()->getPath();
        if (''  === $uriPath) {
            return '/';
        }
        if (0 !== strpos($uriPath, '/')) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return '/';
        }
        if ('/' === $uriPath) {
            return '/';
        }
<<<<<<< HEAD
        $lastSlashPos = \strrpos($uriPath, '/');
        if (0 === $lastSlashPos || false === $lastSlashPos) {
            return '/';
        }

        return \substr($uriPath, 0, $lastSlashPos);
    }

    public function withCookieHeader(RequestInterface $request): RequestInterface
=======
        if (0 === $lastSlashPos = strrpos($uriPath, '/')) {
            return '/';
        }

        return substr($uriPath, 0, $lastSlashPos);
    }

    public function withCookieHeader(RequestInterface $request)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $values = [];
        $uri = $request->getUri();
        $scheme = $uri->getScheme();
        $host = $uri->getHost();
        $path = $uri->getPath() ?: '/';

        foreach ($this->cookies as $cookie) {
            if ($cookie->matchesPath($path) &&
                $cookie->matchesDomain($host) &&
                !$cookie->isExpired() &&
                (!$cookie->getSecure() || $scheme === 'https')
            ) {
                $values[] = $cookie->getName() . '='
                    . $cookie->getValue();
            }
        }

        return $values
<<<<<<< HEAD
            ? $request->withHeader('Cookie', \implode('; ', $values))
=======
            ? $request->withHeader('Cookie', implode('; ', $values))
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            : $request;
    }

    /**
     * If a cookie already exists and the server asks to set it again with a
     * null value, the cookie must be deleted.
<<<<<<< HEAD
     */
    private function removeCookieIfEmpty(SetCookie $cookie): void
=======
     *
     * @param SetCookie $cookie
     */
    private function removeCookieIfEmpty(SetCookie $cookie)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $cookieValue = $cookie->getValue();
        if ($cookieValue === null || $cookieValue === '') {
            $this->clear(
                $cookie->getDomain(),
                $cookie->getPath(),
                $cookie->getName()
            );
        }
    }
}
