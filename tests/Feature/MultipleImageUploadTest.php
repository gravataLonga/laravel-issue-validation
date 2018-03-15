<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class MultipleImageUploadTest extends TestCase
{
    /** @test */
    public function validate_has_images()
    {
        $this->withoutExceptionHandling();
        \Storage::fake('public');
        $this->post('images', [
            'images' => [
                $image1 = UploadedFile::fake()->image('nice.jpg', 100, 100),
                $image2 = UploadedFile::fake()->image('nice1.jpg', 200, 200)
            ]
        ]);

        \Storage::disk('public')->assertExists($image1->hashName());
    }

    /** @test */
    public function required_to_have_image()
    {
        $this->withoutExceptionHandling();
        \Storage::fake('public');
        $this->post('images', [])
            ->assertStatus(422);
        // Give: ErrorException: Undefined index: images
    } 
}
