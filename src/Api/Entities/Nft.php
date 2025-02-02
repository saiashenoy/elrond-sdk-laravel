<?php

namespace Superciety\ElrondSdk\Api\Entities;

use Illuminate\Support\Str;
use Superciety\ElrondSdk\Api\ApiTransformable;
use Superciety\ElrondSdk\Domain\Address;

final class Nft
{
    use ApiTransformable;

    const NonFungibleESDT = 'NonFungibleESDT';
    const SemiFungibleESDT = 'SemiFungibleESDT';
    const MetaESDT = 'MetaESDT';

    public function __construct(
        public string $identifier,
        public string $collection,
        public int|string $nonce,
        public string $type,
        public string $name,
        public string $creator,
        public int|string|null $timestamp = null,
        public string $attributes = '',
        public ?int $royalties = null,
        public ?string $url = null,
        public ?string $ticker = null,
        public ?string $thumbnailUrl = null,
        public ?Address $owner = null,
        public ?int $supply = null,
        public array $tags = [],
        public ?string $description = null,
    ) {
    }

    public function getTags(): array
    {
        if (!empty($this->tags)) {
            return array_filter($this->tags);
        }

        preg_match('/tags:(?<tags>[\w\s\,]*)/', base64_decode($this->attributes), $matches);

        return Str::of($matches['tags'] ?? '')
            ->explode(',')
            ->filter()
            ->all();
    }

    public function getIpfsContentId(): ?string
    {
        preg_match('/metadata:(?<metadata>[\w]*)/', base64_decode($this->attributes), $matches);

        return $matches['metadata'] ?? null;
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'description' => $res['metadata']['description'] ?? null,
            'owner' => isset($res['owner']) ? Address::fromBech32($res['owner']) : null,
        ]);
    }
}
