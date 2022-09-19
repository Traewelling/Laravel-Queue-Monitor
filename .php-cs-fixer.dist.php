<?php

return Traewelling\Fixer\Config::make()
    ->in(__DIR__)
    ->preset(
        new Traewelling\Fixer\Presets\PrettyLaravel()
    )
    ->out();
