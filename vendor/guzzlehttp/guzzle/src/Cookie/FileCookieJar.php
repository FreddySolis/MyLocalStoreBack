<?php
<<<<<<< HEAD

namespace GuzzleHttp\Cookie;

use GuzzleHttp\Utils;

=======
namespace GuzzleHttp\Cookie;

>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
/**
 * Persists non-session cookies using a JSON formatted file
 */
class FileCookieJar extends CookieJar
{
<<<<<<< HEAD
    /**
     * @var string filename
     */
    private $filename;

    /**
     * @var bool Control whether to persist session cookies or not.
     */
=======
    /** @var string filename */
    private $filename;

    /** @var bool Control whether to persist session cookies or not. */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    private $storeSessionCookies;

    /**
     * Create a new FileCookieJar object
     *
<<<<<<< HEAD
     * @param string $cookieFile          File to store the cookie data
     * @param bool   $storeSessionCookies Set to true to store session cookies
     *                                    in the cookie jar.
     *
     * @throws \RuntimeException if the file cannot be found or created
     */
    public function __construct(string $cookieFile, bool $storeSessionCookies = false)
=======
     * @param string $cookieFile        File to store the cookie data
     * @param bool $storeSessionCookies Set to true to store session cookies
     *                                  in the cookie jar.
     *
     * @throws \RuntimeException if the file cannot be found or created
     */
    public function __construct($cookieFile, $storeSessionCookies = false)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
    {
        parent::__construct();
        $this->filename = $cookieFile;
        $this->storeSessionCookies = $storeSessionCookies;

<<<<<<< HEAD
        if (\file_exists($cookieFile)) {
=======
        if (file_exists($cookieFile)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            $this->load($cookieFile);
        }
    }

    /**
     * Saves the file when shutting down
     */
    public function __destruct()
    {
        $this->save($this->filename);
    }

    /**
     * Saves the cookies to a file.
     *
     * @param string $filename File to save
<<<<<<< HEAD
     *
     * @throws \RuntimeException if the file cannot be found or created
     */
    public function save(string $filename): void
    {
        $json = [];
        /** @var SetCookie $cookie */
        foreach ($this as $cookie) {
=======
     * @throws \RuntimeException if the file cannot be found or created
     */
    public function save($filename)
    {
        $json = [];
        foreach ($this as $cookie) {
            /** @var SetCookie $cookie */
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            if (CookieJar::shouldPersist($cookie, $this->storeSessionCookies)) {
                $json[] = $cookie->toArray();
            }
        }

<<<<<<< HEAD
        $jsonStr = Utils::jsonEncode($json);
        if (false === \file_put_contents($filename, $jsonStr, \LOCK_EX)) {
=======
        $jsonStr = \GuzzleHttp\json_encode($json);
        if (false === file_put_contents($filename, $jsonStr, LOCK_EX)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            throw new \RuntimeException("Unable to save file {$filename}");
        }
    }

    /**
     * Load cookies from a JSON formatted file.
     *
     * Old cookies are kept unless overwritten by newly loaded ones.
     *
     * @param string $filename Cookie file to load.
<<<<<<< HEAD
     *
     * @throws \RuntimeException if the file cannot be loaded.
     */
    public function load(string $filename): void
    {
        $json = \file_get_contents($filename);
        if (false === $json) {
            throw new \RuntimeException("Unable to load file {$filename}");
        }
        if ($json === '') {
            return;
        }

        $data = Utils::jsonDecode($json, true);
        if (\is_array($data)) {
            foreach ($data as $cookie) {
                $this->setCookie(new SetCookie($cookie));
            }
        } elseif (\is_scalar($data) && !empty($data)) {
=======
     * @throws \RuntimeException if the file cannot be loaded.
     */
    public function load($filename)
    {
        $json = file_get_contents($filename);
        if (false === $json) {
            throw new \RuntimeException("Unable to load file {$filename}");
        } elseif ($json === '') {
            return;
        }

        $data = \GuzzleHttp\json_decode($json, true);
        if (is_array($data)) {
            foreach (json_decode($json, true) as $cookie) {
                $this->setCookie(new SetCookie($cookie));
            }
        } elseif (strlen($data)) {
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
            throw new \RuntimeException("Invalid cookie file: {$filename}");
        }
    }
}
