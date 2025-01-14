<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('albums can be uploaded', function () {
    Storage::fake('photos');

    Storage::disk('photos')
        ->put('photo1.jpg', UploadedFile::fake()->image('photo1.jpg'));
    Storage::disk('photos')
        ->put('photo2.jpg', UploadedFile::fake()->image('photo2.jpg'));

    // would simulate request
//    $response = $this->json('POST', '/photos', [
//        UploadedFile::fake()->image('photo1.jpg'),
//        UploadedFile::fake()->image('photo2.jpg')
//    ]);

    // Assert one or more files were stored...
    Storage::disk('photos')->assertExists('photo1.jpg');
    Storage::disk('photos')->assertExists(['photo1.jpg', 'photo2.jpg']);

    // Assert one or more files were not stored...
    Storage::disk('photos')->assertMissing('missing.jpg');
    Storage::disk('photos')->assertMissing(['missing.jpg', 'non-existing.jpg']);
});

// Integration based
todo('it retrieves integration credentials correctly');

todo('it lists all accounts connected to a user correctly');
todo('it shows folders in a connected app');

