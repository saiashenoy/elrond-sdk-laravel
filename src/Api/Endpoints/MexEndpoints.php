<?php

namespace Superciety\ElrondSdk\Api\Endpoints;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\EndpointBase;
use Superciety\ElrondSdk\Api\Entities\MexPair;
use Superciety\ElrondSdk\Api\Entities\MexToken;

class MexEndpoints extends EndpointBase
{
    public function __construct(
        protected ?Carbon $cacheTtl,
    ) {
    }

    public function getPairs(): Collection
    {
        return MexPair::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/mex/pairs")
        );
    }

    public function getTokens(): Collection
    {
        return MexToken::fromApiResponseMany(
            $this->request('GET', "{$this->getApiBaseUrl()}/mex/tokens")
        );
    }
}
