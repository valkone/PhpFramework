<h2><?= self::$viewBag["password"]; ?></h2>


<?php
$array = [
    1 => [
        'name' => 'dqw',
        'email' => 'dqwdw@abv.bg'
    ]
];

\Framework\ViewHelpers\DropDown::create()
    ->addAttribute('name', 'buildings')
    ->addAttribute('class', 'clasyt')
    ->setDefaultOption('-- Buildings --')
    ->setContent($array, 'name', 'email')
    ->render();

\Framework\ViewHelpers\PasswordField::create()
    ->addAttribute('name', 'ivan')
    ->addAttribute('class', 'button')
    ->render();

\Framework\ViewHelpers\TextField::create()
    ->addAttribute('name', 'ivan')
    ->addAttribute('class', 'button')
    ->render();

\Framework\ViewHelpers\CheckBox::create()
    ->addAttribute('name', 'ivan')
    ->addAttribute('class', 'button')
    ->render();

\Framework\ViewHelpers\RadioButton::create()
    ->addAttribute('name', 'ivan')
    ->addAttribute('class', 'button')
    ->render();


\Framework\ViewHelpers\Textarea::create()
    ->addAttribute('name', 'ivan')
    ->addAttribute('class', 'button')
    ->setRowsAndCols(20, 20)
    ->render();