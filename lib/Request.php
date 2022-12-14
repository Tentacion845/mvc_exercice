<?php
/**
 * Created by PhpStorm.
 * User: criquier
 * Date: 16/10/15
 * Time: 15:31
 */


class Request
{
    private array $get;
    private array $post;
    private array $server;
    private array $files;

    public function __construct($get, $post, $server, $files)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->files = $files;
    }

    public function isMethod($method): bool
    {
        if (strtolower($method) == "post") {
            return count($this->post) > 0;
        } elseif (strtolower($method) == "get") {
            return count($this->get) > 0;
        }

        return false;
    }

    public function get(string $name, $defaultValue = null): ?string
    {
        return $this->get[$name] ?? ($this->post[$name] ?? $defaultValue);
    }

    public function getServer(string $name, $defaultValue = null): string
    {
        return $this->server[$name] ?? $defaultValue;
    }

    public function getFile(string $name, $defaultValue = null): string
    {
        return $this->files[$name] ?? $defaultValue;
    }
}