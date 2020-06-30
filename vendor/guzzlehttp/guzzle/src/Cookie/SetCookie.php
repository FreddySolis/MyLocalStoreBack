<?php
<<<<<<< HEAD

=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
namespace GuzzleHttp\Cookie;

/**
 * Set-Cookie object
 */
class SetCookie
{
<<<<<<< HEAD
    /**
     * @var array
     */
=======
    /** @var array */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private static $defaults = [
        'Name'     => null,
        'Value'    => null,
        'Domain'   => null,
        'Path'     => '/',
        'Max-Age'  => null,
        'Expires'  => null,
        'Secure'   => false,
        'Discard'  => false,
        'HttpOnly' => false
    ];

<<<<<<< HEAD
    /**
     * @var array Cookie data
     */
=======
    /** @var array Cookie data */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private $data;

    /**
     * Create a new SetCookie object from a string
     *
     * @param string $cookie Set-Cookie header string
<<<<<<< HEAD
     */
    public static function fromString(string $cookie): self
=======
     *
     * @return self
     */
    public static function fromString($cookie)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        // Create the default return array
        $data = self::$defaults;
        // Explode the cookie string using a series of semicolons
<<<<<<< HEAD
        $pieces = \array_filter(\array_map('trim', \explode(';', $cookie)));
        // The name of the cookie (first kvp) must exist and include an equal sign.
        if (empty($pieces[0]) || !\strpos($pieces[0], '=')) {
=======
        $pieces = array_filter(array_map('trim', explode(';', $cookie)));
        // The name of the cookie (first kvp) must exist and include an equal sign.
        if (empty($pieces[0]) || !strpos($pieces[0], '=')) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return new self($data);
        }

        // Add the cookie pieces into the parsed data array
        foreach ($pieces as $part) {
<<<<<<< HEAD
            $cookieParts = \explode('=', $part, 2);
            $key = \trim($cookieParts[0]);
            $value = isset($cookieParts[1])
                ? \trim($cookieParts[1], " \n\r\t\0\x0B")
=======
            $cookieParts = explode('=', $part, 2);
            $key = trim($cookieParts[0]);
            $value = isset($cookieParts[1])
                ? trim($cookieParts[1], " \n\r\t\0\x0B")
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                : true;

            // Only check for non-cookies when cookies have been found
            if (empty($data['Name'])) {
                $data['Name'] = $key;
                $data['Value'] = $value;
            } else {
<<<<<<< HEAD
                foreach (\array_keys(self::$defaults) as $search) {
                    if (!\strcasecmp($search, $key)) {
=======
                foreach (array_keys(self::$defaults) as $search) {
                    if (!strcasecmp($search, $key)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                        $data[$search] = $value;
                        continue 2;
                    }
                }
                $data[$key] = $value;
            }
        }

        return new self($data);
    }

    /**
     * @param array $data Array of cookie data provided by a Cookie parser
     */
    public function __construct(array $data = [])
    {
<<<<<<< HEAD
        /** @var array|null $replaced will be null in case of replace error */
        $replaced = \array_replace(self::$defaults, $data);
        if ($replaced === null) {
            throw new \InvalidArgumentException('Unable to replace the default values for the Cookie.');
        }

        $this->data = $replaced;
        // Extract the Expires value and turn it into a UNIX timestamp if needed
        if (!$this->getExpires() && $this->getMaxAge()) {
            // Calculate the Expires date
            $this->setExpires(\time() + $this->getMaxAge());
        } elseif (null !== ($expires = $this->getExpires()) && !\is_numeric($expires)) {
            $this->setExpires($expires);
=======
        $this->data = array_replace(self::$defaults, $data);
        // Extract the Expires value and turn it into a UNIX timestamp if needed
        if (!$this->getExpires() && $this->getMaxAge()) {
            // Calculate the Expires date
            $this->setExpires(time() + $this->getMaxAge());
        } elseif ($this->getExpires() && !is_numeric($this->getExpires())) {
            $this->setExpires($this->getExpires());
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
        }
    }

    public function __toString()
    {
        $str = $this->data['Name'] . '=' . $this->data['Value'] . '; ';
        foreach ($this->data as $k => $v) {
            if ($k !== 'Name' && $k !== 'Value' && $v !== null && $v !== false) {
                if ($k === 'Expires') {
<<<<<<< HEAD
                    $str .= 'Expires=' . \gmdate('D, d M Y H:i:s \G\M\T', $v) . '; ';
=======
                    $str .= 'Expires=' . gmdate('D, d M Y H:i:s \G\M\T', $v) . '; ';
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
                } else {
                    $str .= ($v === true ? $k : "{$k}={$v}") . '; ';
                }
            }
        }

<<<<<<< HEAD
        return \rtrim($str, '; ');
    }

    public function toArray(): array
=======
        return rtrim($str, '; ');
    }

    public function toArray()
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        return $this->data;
    }

    /**
     * Get the cookie name
     *
     * @return string
     */
    public function getName()
    {
        return $this->data['Name'];
    }

    /**
     * Set the cookie name
     *
     * @param string $name Cookie name
     */
<<<<<<< HEAD
    public function setName($name): void
=======
    public function setName($name)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->data['Name'] = $name;
    }

    /**
     * Get the cookie value
     *
<<<<<<< HEAD
     * @return string|null
=======
     * @return string
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public function getValue()
    {
        return $this->data['Value'];
    }

    /**
     * Set the cookie value
     *
     * @param string $value Cookie value
     */
<<<<<<< HEAD
    public function setValue($value): void
=======
    public function setValue($value)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->data['Value'] = $value;
    }

    /**
     * Get the domain
     *
     * @return string|null
     */
    public function getDomain()
    {
        return $this->data['Domain'];
    }

    /**
     * Set the domain of the cookie
     *
     * @param string $domain
     */
<<<<<<< HEAD
    public function setDomain($domain): void
=======
    public function setDomain($domain)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->data['Domain'] = $domain;
    }

    /**
     * Get the path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->data['Path'];
    }

    /**
     * Set the path of the cookie
     *
     * @param string $path Path of the cookie
     */
<<<<<<< HEAD
    public function setPath($path): void
=======
    public function setPath($path)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->data['Path'] = $path;
    }

    /**
     * Maximum lifetime of the cookie in seconds
     *
     * @return int|null
     */
    public function getMaxAge()
    {
        return $this->data['Max-Age'];
    }

    /**
     * Set the max-age of the cookie
     *
     * @param int $maxAge Max age of the cookie in seconds
     */
<<<<<<< HEAD
    public function setMaxAge($maxAge): void
=======
    public function setMaxAge($maxAge)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->data['Max-Age'] = $maxAge;
    }

    /**
     * The UNIX timestamp when the cookie Expires
     *
<<<<<<< HEAD
     * @return string|int|null
=======
     * @return mixed
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
     */
    public function getExpires()
    {
        return $this->data['Expires'];
    }

    /**
     * Set the unix timestamp for which the cookie will expire
     *
<<<<<<< HEAD
     * @param int|string $timestamp Unix timestamp or any English textual datetime description.
     */
    public function setExpires($timestamp): void
    {
        $this->data['Expires'] = \is_numeric($timestamp)
            ? (int) $timestamp
            : \strtotime($timestamp);
=======
     * @param int $timestamp Unix timestamp
     */
    public function setExpires($timestamp)
    {
        $this->data['Expires'] = is_numeric($timestamp)
            ? (int) $timestamp
            : strtotime($timestamp);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    }

    /**
     * Get whether or not this is a secure cookie
     *
     * @return bool|null
     */
    public function getSecure()
    {
        return $this->data['Secure'];
    }

    /**
     * Set whether or not the cookie is secure
     *
     * @param bool $secure Set to true or false if secure
     */
<<<<<<< HEAD
    public function setSecure($secure): void
=======
    public function setSecure($secure)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->data['Secure'] = $secure;
    }

    /**
     * Get whether or not this is a session cookie
     *
     * @return bool|null
     */
    public function getDiscard()
    {
        return $this->data['Discard'];
    }

    /**
     * Set whether or not this is a session cookie
     *
     * @param bool $discard Set to true or false if this is a session cookie
     */
<<<<<<< HEAD
    public function setDiscard($discard): void
=======
    public function setDiscard($discard)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->data['Discard'] = $discard;
    }

    /**
     * Get whether or not this is an HTTP only cookie
     *
     * @return bool
     */
    public function getHttpOnly()
    {
        return $this->data['HttpOnly'];
    }

    /**
     * Set whether or not this is an HTTP only cookie
     *
     * @param bool $httpOnly Set to true or false if this is HTTP only
     */
<<<<<<< HEAD
    public function setHttpOnly($httpOnly): void
=======
    public function setHttpOnly($httpOnly)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $this->data['HttpOnly'] = $httpOnly;
    }

    /**
     * Check if the cookie matches a path value.
     *
     * A request-path path-matches a given cookie-path if at least one of
     * the following conditions holds:
     *
     * - The cookie-path and the request-path are identical.
     * - The cookie-path is a prefix of the request-path, and the last
     *   character of the cookie-path is %x2F ("/").
     * - The cookie-path is a prefix of the request-path, and the first
     *   character of the request-path that is not included in the cookie-
     *   path is a %x2F ("/") character.
     *
     * @param string $requestPath Path to check against
<<<<<<< HEAD
     */
    public function matchesPath(string $requestPath): bool
=======
     *
     * @return bool
     */
    public function matchesPath($requestPath)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        $cookiePath = $this->getPath();

        // Match on exact matches or when path is the default empty "/"
        if ($cookiePath === '/' || $cookiePath == $requestPath) {
            return true;
        }

        // Ensure that the cookie-path is a prefix of the request path.
<<<<<<< HEAD
        if (0 !== \strpos($requestPath, $cookiePath)) {
=======
        if (0 !== strpos($requestPath, $cookiePath)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return false;
        }

        // Match if the last character of the cookie-path is "/"
<<<<<<< HEAD
        if (\substr($cookiePath, -1, 1) === '/') {
=======
        if (substr($cookiePath, -1, 1) === '/') {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return true;
        }

        // Match if the first character not included in cookie path is "/"
<<<<<<< HEAD
        return \substr($requestPath, \strlen($cookiePath), 1) === '/';
=======
        return substr($requestPath, strlen($cookiePath), 1) === '/';
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    }

    /**
     * Check if the cookie matches a domain value
     *
     * @param string $domain Domain to check against
<<<<<<< HEAD
     */
    public function matchesDomain(string $domain): bool
    {
        $cookieDomain = $this->getDomain();
        if (null === $cookieDomain) {
            return true;
        }

        // Remove the leading '.' as per spec in RFC 6265.
        // https://tools.ietf.org/html/rfc6265#section-5.2.3
        $cookieDomain = \ltrim($cookieDomain, '.');

        // Domain not set or exact match.
        if (!$cookieDomain || !\strcasecmp($domain, $cookieDomain)) {
=======
     *
     * @return bool
     */
    public function matchesDomain($domain)
    {
        // Remove the leading '.' as per spec in RFC 6265.
        // http://tools.ietf.org/html/rfc6265#section-5.2.3
        $cookieDomain = ltrim($this->getDomain(), '.');

        // Domain not set or exact match.
        if (!$cookieDomain || !strcasecmp($domain, $cookieDomain)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return true;
        }

        // Matching the subdomain according to RFC 6265.
<<<<<<< HEAD
        // https://tools.ietf.org/html/rfc6265#section-5.1.3
        if (\filter_var($domain, \FILTER_VALIDATE_IP)) {
            return false;
        }

        return (bool) \preg_match('/\.' . \preg_quote($cookieDomain, '/') . '$/', $domain);
=======
        // http://tools.ietf.org/html/rfc6265#section-5.1.3
        if (filter_var($domain, FILTER_VALIDATE_IP)) {
            return false;
        }

        return (bool) preg_match('/\.' . preg_quote($cookieDomain, '/') . '$/', $domain);
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    }

    /**
     * Check if the cookie is expired
<<<<<<< HEAD
     */
    public function isExpired(): bool
    {
        return $this->getExpires() !== null && \time() > $this->getExpires();
=======
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->getExpires() !== null && time() > $this->getExpires();
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    }

    /**
     * Check if the cookie is valid according to RFC 6265
     *
     * @return bool|string Returns true if valid or an error message if invalid
     */
    public function validate()
    {
        // Names must not be empty, but can be 0
        $name = $this->getName();
<<<<<<< HEAD
        if (empty($name) && !\is_numeric($name)) {
=======
        if (empty($name) && !is_numeric($name)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return 'The cookie name must not be empty';
        }

        // Check if any of the invalid characters are present in the cookie name
<<<<<<< HEAD
        if (\preg_match(
=======
        if (preg_match(
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            '/[\x00-\x20\x22\x28-\x29\x2c\x2f\x3a-\x40\x5c\x7b\x7d\x7f]/',
            $name
        )) {
            return 'Cookie name must not contain invalid characters: ASCII '
                . 'Control characters (0-31;127), space, tab and the '
                . 'following characters: ()<>@,;:\"/?={}';
        }

        // Value must not be empty, but can be 0
        $value = $this->getValue();
<<<<<<< HEAD
        if (empty($value) && !\is_numeric($value)) {
=======
        if (empty($value) && !is_numeric($value)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return 'The cookie value must not be empty';
        }

        // Domains must not be empty, but can be 0
        // A "0" is not a valid internet domain, but may be used as server name
        // in a private network.
        $domain = $this->getDomain();
<<<<<<< HEAD
        if (empty($domain) && !\is_numeric($domain)) {
=======
        if (empty($domain) && !is_numeric($domain)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            return 'The cookie domain must not be empty';
        }

        return true;
    }
}
