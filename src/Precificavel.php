<?php

declare(strict_types=1);

namespace Loja;

interface Precificavel
{
    public function getPrecoEmCentavos(): int;
}
