<?php

use Illuminate\Http\Request;

$api       = app('Dingo\Api\Routing\Router');
$namespace = config('vc-media-manager.namespace');

$api->version('v1', function ($api) use ($namespace) {
    $api->get('test', function (Request $request) {
        return response()->json(['success' => true]);
    });

    $api->group(['prefix' => $namespace], function ($api) {
        //Collection
        $api->get('collections/all', 'VCComponent\Laravel\MediaManager\Http\Controllers\Api\CollectionController@all');
        $api->resource('collections', 'VCComponent\Laravel\MediaManager\Http\Controllers\Api\CollectionController');

        //Media
        $api->get('medias/all', 'VCComponent\Laravel\MediaManager\Http\Controllers\Api\MediaController@all');
        $api->put('medias/{id}/collection/attach', 'VCComponent\Laravel\MediaManager\Http\Controllers\Api\MediaController@attachToCollection');
        $api->put('medias/{id}/collection/detach', 'VCComponent\Laravel\MediaManager\Http\Controllers\Api\MediaController@detachFromCollection');
        $api->post('medias/bulk', 'VCComponent\Laravel\MediaManager\Http\Controllers\Api\MediaController@createMedias');
        $api->resource('medias', 'VCComponent\Laravel\MediaManager\Http\Controllers\Api\MediaController');
    });
});
