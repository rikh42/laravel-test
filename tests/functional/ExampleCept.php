<?php
$I = new FunctionalTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/hello/rik');
$I->see('rik');
$I->see('Lawly has 7 votes');
