<?php

namespace Crudly\Encrypted\Tests\Integration;

use Crudly\Encrypted\Cast;
use Crudly\Encrypted\Tests\TestCase;
use Crudly\Encrypted\Tests\Models\Model;

class BoolCastTest extends TestCase
{
	protected $model;
	protected $value;
	protected $encrypted;

    protected function setUp(): void
    {
        parent::setUp();

		$this->model = new Model;
		$this->value = true;
		$this->encrypted = encrypt($this->value);
    }

    /**
     * Encryption for booleans.
     *
     * @return void
     */
    public function testBoolSetter()
    {
		$this->model->column = $this->value;
		$set = $this->model->getAttributes()['column'];

		$this->assertIsString($set);
		$this->assertNotSame($this->value, $set);
		$this->assertSame($this->value, decrypt($set));
    }

    /**
     * Decryption for booleans.
     *
     * @return void
     */
    public function testBoolGetter()
    {
		$this->model->setRawAttributes(['column' => $this->encrypted]);
		$get = $this->model->column;

		$this->assertIsBool($get);
		$this->assertSame($this->value, $get);
    }
}