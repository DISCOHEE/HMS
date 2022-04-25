<?php
class UserTest extends \PHPUnit\Framework\TestCase
{
public function testThatWeCanGetTheFirstName()
{
$user = new \App\Models\User;
$user->setFirstName('Billy');
$this->assertEquals($user->getFirstName(), 'Billy');
}
}
