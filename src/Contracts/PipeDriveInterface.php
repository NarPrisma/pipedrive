<?php

namespace Pipedrive\Contracts;

interface PipeDriveInterface
{
    public function OAuthRedirect($userId,$redirect);

    public function getAccessToken(string $code): void;

    public function OAuthAuthorize(): void;

    public function hasMapping(): bool;


}