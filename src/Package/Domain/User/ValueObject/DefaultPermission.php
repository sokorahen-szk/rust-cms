<?php

namespace Package\Domain\User\ValueObject;

class DefaultPermission
{
    private const DEFAULT_PERMISSION_KEY = "DEFAULT";

    public function __construct(private string $value)
    {
        if (!$this->isAllowdValue($value)) {
            throw new \InvalidArgumentException("DefaultPermissionのキーが適切ではありません。");
        }
    }

    /**
     * @param string $value
     * @return boolean
     */
    private function isAllowdValue(string $value): bool
    {
        if ($value === "") {
            return true;
        }

        if ($value === self::DEFAULT_PERMISSION_KEY) {
            return true;
        }

        return false;
    }
}
