<?php

class ChoiceLoader {

    private const CONST_1 = "hello";
    private const CONST_2 = "world";
    private const CONST_3 = "Jhon";

    public function loadConstants(): array {
        return [
            'Un' => self::CONST_1,
            'Deux' => self::CONST_2,
            'Trois' => self::CONST_3,
        ];
    }
}