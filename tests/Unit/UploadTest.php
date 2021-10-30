<?php

namespace Tests\Unit;

use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Tests\TestCase;

class UploadTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $request = Request::create('/upload', 'POST',[
        ]);

        $controller = new UploadController();
        $response = $controller->upload($request);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
