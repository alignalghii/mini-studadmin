<?php

class Request
{
	private $server, $get, $post;

	public function __construct($server, $get, $post)
	{
		$this->server = $server;
		$this->get    = $get;
		$this->post   = $post;
	}

	public function method()
	{
		return $this->server['REQUEST_METHOD'];
	}

	public function uri()
	{
		return $this->server['REQUEST_URI'];
	}

	public function get()
	{
		return $this->get;
	}

	public function post()
	{
		return $this->post;
	}
}
