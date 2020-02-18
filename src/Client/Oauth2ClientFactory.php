<?php

namespace Acquia\Epe\Api\Client;

/**
 * A factory for creating EPE API clients using OAuth2 grants.
 *
 */
class Oauth2ClientFactory extends AbstractClientFactory
{

  /**
   * Create an instance of a EPE API client using OAuth2 client credentials flow.
   */
  public static function createUsingClientCredentials() {}
}
