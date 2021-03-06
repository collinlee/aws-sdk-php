<?php
/**
 * Copyright 2010-2012 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://aws.amazon.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Aws\Tests\Common\Client;

use Aws\Common\Client\DefaultClient;
use Aws\Common\Enum\ClientOptions as Options;
use Aws\Common\Enum\Region;

class DefaultClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    /**
     * @covers Aws\Common\Client\DefaultClient::factory
     */
    public function testFactoryInitializesClient()
    {
        $signature = $this->getMock('Aws\Common\Signature\SignatureInterface');
        $credentials = $this->getMock('Aws\Common\Credentials\CredentialsInterface');

        $client = DefaultClient::factory(array(
            Options::CREDENTIALS => $credentials,
            Options::SIGNATURE   => $signature,
            Options::SERVICE     => 'sns',
            Options::REGION      => Region::US_EAST_1,
        ));

        $this->assertInstanceOf('Aws\Common\Signature\SignatureInterface', $client->getSignature());
        $this->assertInstanceOf('Aws\Common\Credentials\CredentialsInterface', $client->getCredentials());
        $this->assertInstanceOf('Aws\Common\Region\EndpointProviderInterface', $client->getEndpointProvider());
        $this->assertEquals('https://sns.us-east-1.amazonaws.com', $client->getBaseUrl());
    }
}
