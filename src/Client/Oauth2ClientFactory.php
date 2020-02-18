<?php

namespace Acquia\Epe\Api\Client;

use Acquia\Epe\Api\Client\Middleware\GuzzleOAuth2Middleware;
use GuzzleHttp\HandlerStack;
use League\OAuth2\Client\Provider\GenericProvider;

/**
 * A factory for creating EPE API clients using OAuth2 grants.
 *
 */
class Oauth2ClientFactory extends AbstractClientFactory
{

  /**
   * The URL to retrieve the token from.
   *
   */
  const TOKEN_URL = 'https://epeapi.acquia.test/oauth/token';

  /**
   * Create an instance of a EPE API client using OAuth2 client credentials flow.
   *
   * @param string $client_id
   *   The client id.
   * @param string $client_secret
   *   The client secret.
   * @param string $token_url
   *   The access token url.
   * @param array $config
   *   An associative array of configuration values for a Guzzle client.
   */
  public static function createUsingClientCredentials(
    $client_id,
    $client_secret,
    $token_url = null,
    array $config = []
  ) {
      $oauth_options = [
          'clientId'                => $client_id,
          'clientSecret'            => $client_secret,
          'urlAccessToken'          => !empty($token_url) ? $token_url : static::TOKEN_URL,
          'urlAuthorize'            => '',
          'urlResourceOwnerDetails' => '',
      ];

    $provider   = new GenericProvider($oauth_options);
    $middleware = new GuzzleOAuth2Middleware($provider);
    $stack      = HandlerStack::create();
    $stack->push($middleware);

    $config['handler'] = $stack;
    $config            = $config + static::getClientDefaults();

    new Client($config);
  }
}
