<?php

namespace Acquia\Epe\Api\Client;

/**
 * A base class for client factories.
 *
 */
abstract class AbstractClientFactory
{
  /**
   * The Epe API base URI.
   *
   */
  const BASE_URI = 'https://epeapi.acquia.test/api/v2/';


  /**
   * Defines the default timeout for HTTP operations, in seconds.
   *
   * @var int
   *
   */
  const DEFAULT_TIMEOUT = 120;


  /**
   * Returns the default Guzzle client configuration options.
   *
   * @return array
   *
   */
  public static function getClientDefaults()
  {
    return [
      'base_uri'        => static::BASE_URI,
      'connect_timeout' => static::DEFAULT_TIMEOUT,
      'timeout'         => static::DEFAULT_TIMEOUT,
      'read_timeout'    => static::DEFAULT_TIMEOUT,
    ];
  }
}
