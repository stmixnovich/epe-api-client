<?php

namespace Acquia\Epe\Api\Client;

use GuzzleHttp\Client as HttpClient;

/**
 * The Acquia Epe API v2 http client.
 *
 */
class Client extends HttpClient
{

  /**
   * Make ping.
   *
   */
  public function ping()
  {
      return $this->executeRequest('GET', 'oauth/status');
  }

  /**
   * Helper method to execute a HTTP request, returning the output as an object.
   *
   * Sub-classing clients should use this to standardize error handling and responses.
   *
   * For valid options to pass to the request, see the
   * GuzzleHttp\Client::applyOptions() method.
   *
   * @see https://github.com/guzzle/guzzle/blob/6.0.1/src/Client.php#L280
   *
   * @param string $method
   *   The HTTP method to use.
   * @param string $path
   *   The path to call.
   * @param array $options
   *   An associative array of request options.
   *
   * @throws \InvalidArgumentException
   *   Thrown when the request method is invalid.
   *
   * @return string|array
   *   The body content.
   *
   */
  protected function executeRequest($method, $path, array $options = [])
  {
      $response = parent::request($method, $path, $options);
      $content  = json_decode((string) $response->getBody(), true);

      return $content;
  }

}
