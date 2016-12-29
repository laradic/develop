<?php 
$i = new AcceptanceTester($scenario);
$i->wantTo('perform actions and see result');
$i->wantTo('ensure the frontpage works');
$i->amOnPage('/');
$i->see('Laravel');
