<?php

namespace Acquia\Epe\Api\Client\Middleware;

use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\RequestInterface;

/**
 * A Guzzle middleware that obtains a bearer token and adds it to the authorization header.
 *
 */
class GuzzleOAuth2Middleware
{
  /**
   * The OAuth2 client provider.
   *
   * @var GenericProvider
   *
   */
  protected $provider;


  /**
   * The OAuth2 AccessToken
   *
   * @var AccessToken|null
   *
   */
  protected $token = null;


  /**
   * The OAuth2 grant type.
   *
   * @var string
   *
   */
  protected $grant_type;


  /**
   * The OAuth2 provider options.
   *
   * @var array
   *
   */
  protected $options;


  /**
   * Constructor.
   *
   * @param GenericProvider $provider
   *   The OAuth2 client provider.
   * @param array $options
   *   The OAuth2 options
   * @param string $grant_type
   *   The OAuth2 grant type.
   *
   */
  public function __construct(GenericProvider $provider, array $options = [], $grant_type = 'client_credentials')
  {
      $this->provider   = $provider;
      $this->options    = $options;
      $this->grant_type = $grant_type;
  }


  /**
   * Called when the middleware is handled.
   *
   * @param callable $handler
   *
   * @return \Closure
   *
   * @throws
   */
  public function __invoke(callable $handler)
  {
      $this->token = $this->token ?: $this->provider->getAccessToken($this->grant_type, $this->options);

      return function ($request, array $options) use ($handler) {
          if ($this->token && !$this->token->hasExpired()) {
              $request = $this->addAuthorizationHeaders($request, $this->token);
          }

          return $handler($request, $options);
      };
  }


  /**
   * Adds the authorization headers to the request.
   *
   * @param RequestInterface $request
   *   The request being signed.
   * @param AccessToken $token
   *   The access bearer token.
   *
   * @return RequestInterface
   *   The request with the added Authorization header.
   *
   */
  protected function addAuthorizationHeaders(RequestInterface $request, AccessToken $token)
  {
      return $request->withHeader('Authorization', 'Bearer ' . $token->getToken());
  }
}
