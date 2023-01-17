<?php namespace Package;

class BaseEntity {
    public function __construct(array $vars)
    {
        $setInheritVarNames = array_keys(get_class_vars(get_class($this)));
        foreach ($vars as $name => $value) {
            if (array_search($name, $setInheritVarNames) === false) {
                throw new \DomainException(
                    get_class($this) . "に定義されていないメンバー変数がコンストラクタに入力されました。"
                );
            }
            $this->{$name} = $value;
        }
    }

    public function __set($name, $value): void
    {
        $this->{$name} = $value;
    }

    public function __get($name): mixed
    {
        return $this->{$name};
    }
}