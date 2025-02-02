<?php

use Superciety\ElrondSdk\Elrond;
use Superciety\ElrondSdk\Api\Entities\NftCollection;

it('gets a collection by id', function () {
    fakeApiRequestWithResponse('/collections/VNFT-507997', 'collections/collection.json');

    $actual = Elrond::api()
        ->collections()
        ->getById('VNFT-507997');

    assertMatchesResponseSnapshot($actual);

    expect($actual)->toBeInstanceOf(NftCollection::class);
});

it('gets nfts', function () {
    fakeApiRequestWithResponse('/collections/VNFT-507997/nfts', 'collections/nfts.json');

    $actual = Elrond::api()
        ->collections()
        ->getNftsById('VNFT-507997');

    assertMatchesResponseSnapshot($actual);
});

it('gets accounts', function () {
    fakeApiRequestWithResponse('/collections/VNFT-507997/accounts', 'collections/accounts.json');

    $actual = Elrond::api()
        ->collections()
        ->getAccounts('VNFT-507997');

    assertMatchesResponseSnapshot($actual);
});
