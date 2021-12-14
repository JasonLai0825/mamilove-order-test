<?php

declare(strict_types=1);

namespace Mamilove\Interfaces;

interface BillerInterface {
    public function bill($account_id, $amount);
}