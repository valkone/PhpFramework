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

$testArray = [
    1 => 'dqw',
    "dqw" => "we"
];
?>

<script type="text/javascript">
    <?php
        \Framework\ViewHelpers\AjaxViewHelper::create()
        ->init('#asd', 'click', 'http://localhost/asd.php', 'POST', $testArray, "alert('ads');")
        ->render();
    ?>
</script>

<form action="http://localhost/PhpFrameworkGit/trunk/User/testToken" method="post">
    <?php
        \Framework\ViewHelpers\TextField::create()
        ->addAttribute('name', 'ivan')
        ->addAttribute('class', 'button')
        ->render();

        \Framework\ViewHelpers\TokenHelper::create()->generateHiddenField();
    ?>
    <input type="submit" value="go" />
</form>


<form action="http://localhost/PhpFrameworkGit/trunk/User/testBinding" method="post">
    <?php
    \Framework\ViewHelpers\TextField::create()
        ->addAttribute('name', 'id')
        ->render();

    \Framework\ViewHelpers\TextField::create()
        ->addAttribute('name', 'name')
        ->render();

    \Framework\ViewHelpers\TextField::create()
        ->addAttribute('name', 'password')
        ->render();
    ?>
    <input type="submit" value="go" />
</form>
