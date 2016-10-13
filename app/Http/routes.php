<?php

$route_partials = [
    'authenticate'
];

foreach ($route_partials as $partial) {
    $file = __DIR__ . '/Routes/' . $partial . '.php';

    if (!file_exists($file)) {
        $msg = "Route partial [{$partial}] not found.";
        throw new \League\Flysystem\FileNotFoundException($msg);
    }

    require_once $file;
}

Route::controllers([
    'password' => 'Auth\PasswordController',
]);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/***************************
 * PORTAL
 * ***************************/
Route::group(['prefix' => 'portal', 'as' => 'portal.'], function () {

    Route::get('home', ['as' => 'home.index', 'uses' => 'Portal\HomeController@index']);
    Route::get('/', 'Portal\HomeController@index');

    Route::get('city/list/{id}', ['as' => 'city.list', 'uses' => 'Portal\CityController@getCity']);
    Route::get('state/getUfId/{uf}', ['as' => 'city.list', 'uses' => 'Portal\StateController@getUfId']);

    //MANAGE
    Route::group(['prefix' => 'manage', 'as' => 'manage.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Portal\Condominium\CondominiumController@index']);

        //reserve_areas
        Route::get('reserve-areas', ['as' => 'reserve-areas.index', 'uses' => 'Portal\Manage\ReserveAreasController@index']);
        Route::get('reserve-areas/create', ['as' => 'reserve-areas.create', 'uses' => 'Portal\Manage\ReserveAreasController@create']);
        Route::post('reserve-areas/store', ['as' => 'reserve-areas.store', 'uses' => 'Portal\Manage\ReserveAreasController@store']);
        Route::get('reserve-areas/edit/{id}', ['as' => 'reserve-areas.edit', 'uses' => 'Portal\Manage\ReserveAreasController@edit']);
        Route::post('reserve-areas/update/{id}', ['as' => 'reserve-areas.update', 'uses' => 'Portal\Manage\ReserveAreasController@update']);
        Route::get('reserve-areas/destroy/{id}', ['as' => 'reserve-areas.destroy', 'uses' => 'Portal\Manage\ReserveAreasController@destroy']);

        //contract
        Route::get('contracts', ['as' => 'contracts.index', 'uses' => 'Portal\Manage\Contract\ContractController@index']);
        Route::get('contract/create', ['as' => 'contract.create', 'uses' => 'Portal\Manage\Contract\ContractController@create']);
        Route::post('contract/store', ['as' => 'contract.store', 'uses' => 'Portal\Manage\Contract\ContractController@store']);
        Route::get('contract/edit/{id}', ['as' => 'contract.edit', 'uses' => 'Portal\Manage\Contract\ContractController@edit']);
        Route::post('contract/update/{id}', ['as' => 'contract.update', 'uses' => 'Portal\Manage\Contract\ContractController@update']);
        Route::get('contract/destroy/{id}', ['as' => 'contract.destroy', 'uses' => 'Portal\Manage\Contract\ContractController@destroy']);

        Route::get('contract/file/destroy/{id}', ['as' => 'contract.file.destroy', 'uses' => 'Portal\Manage\Contract\ContractFileController@destroy']);
        Route::get('contract/file/show/{id}', ['as' => 'contract.file.show', 'uses' => 'Portal\Manage\Contract\ContractFileController@show']);

        //Maintenance
        Route::group(['prefix' => 'maintenance', 'as' => 'maintenance.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Portal\Manage\Maintenance\MaintenanceController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Portal\Manage\Maintenance\MaintenanceController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Portal\Manage\Maintenance\MaintenanceController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Portal\Manage\Maintenance\MaintenanceController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'Portal\Manage\Maintenance\MaintenanceController@update']);
            Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'Portal\Manage\Maintenance\MaintenanceController@destroy']);

            Route::group(['prefix' => 'completed', 'as' => 'completed.'], function () {
                Route::get('/{id}', ['as' => 'index', 'uses' => 'Portal\Manage\Maintenance\MaintenanceCompletedController@index']);
                Route::get('create', ['as' => 'create', 'uses' => 'Portal\Manage\Maintenance\MaintenanceCompletedController@create']);
                Route::post('store', ['as' => 'store', 'uses' => 'Portal\Manage\Maintenance\MaintenanceCompletedController@store']);
                Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Portal\Manage\Maintenance\MaintenanceCompletedController@edit']);
                Route::post('update/{id}', ['as' => 'update', 'uses' => 'Portal\Manage\Maintenance\MaintenanceCompletedController@update']);
                Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'Portal\Manage\Maintenance\MaintenanceCompletedController@destroy']);
            });
        });


    });

    //REGISTER CONDOMINIUM
    Route::group(['prefix' => 'condominium', 'as' => 'condominium.'], function () {
        //CONDOMINIUM
        Route::get('/', ['as' => 'index', 'uses' => 'Portal\Condominium\CondominiumController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'Portal\Condominium\CondominiumController@create']);
        Route::get('/create/info', ['as' => 'create.info', 'uses' => 'Portal\Condominium\CondominiumController@createInfo']);
        Route::get('/create/config', ['as' => 'create.config', 'uses' => 'Portal\Condominium\CondominiumController@createConfig']);
        Route::get('/create/finish', ['as' => 'create.finish', 'uses' => 'Portal\Condominium\CondominiumController@finish']);
        Route::post('/create/unit', ['as' => 'create.unit', 'uses' => 'Portal\Condominium\CondominiumController@createUnit']);
        Route::post('/create/finish', ['as' => 'create.finish', 'uses' => 'Portal\Condominium\CondominiumController@finishStore']);
        Route::post('/store', ['as' => 'store', 'uses' => 'Portal\Condominium\CondominiumController@store']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'Portal\Condominium\CondominiumController@edit']);
        Route::post('/update', ['as' => 'update', 'uses' => 'Portal\Condominium\CondominiumController@update']);
        Route::post('/update/info', ['as' => 'update.info', 'uses' => 'Portal\Condominium\CondominiumController@updateInfo']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'Portal\Condominium\CondominiumController@destroy']);
        Route::get('/unitBlockClear', ['as' => 'unitBlockClear', 'uses' => 'Portal\Condominium\CondominiumController@clearUnitBlock']);

        //UNIT
        Route::group(['prefix' => 'unit', 'as' => 'unit.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Portal\Condominium\Unit\UnitController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Portal\Condominium\Unit\UnitController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Portal\Condominium\Unit\UnitController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Portal\Condominium\Unit\UnitController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'Portal\Condominium\Unit\UnitController@update']);
            Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'Portal\Condominium\Unit\UnitController@destroy']);

            //GARAGE
            Route::get('garage', ['as' => 'garage.index', 'uses' => 'Portal\Condominium\Unit\UnitController@garage']);
            Route::get('garage/create', ['as' => 'garage.create', 'uses' => 'Portal\Condominium\Unit\UnitController@garageCreate']);
            Route::post('garage/store', ['as' => 'garage.store', 'uses' => 'Portal\Condominium\Unit\UnitController@garageStore']);
            Route::get('garage/edit/{id}', ['as' => 'garage.edit', 'uses' => 'Portal\Condominium\Unit\UnitController@garageEdit']);
            Route::post('garage/update/{id}', ['as' => 'garage.update', 'uses' => 'Portal\Condominium\Unit\UnitController@garageUpdate']);

            Route::get('block/{blockId}', ['as' => 'block', 'uses' => 'Portal\Condominium\Unit\UnitController@block']);

            //USER UNIT
            Route::get('user', ['as' => 'user.index', 'uses' => 'Portal\Condominium\Unit\UsersUnitController@index']);
            Route::get('user/create', ['as' => 'user.create', 'uses' => 'Portal\Condominium\Unit\UsersUnitController@create']);
            Route::post('user/storeJson', ['as' => 'user.storeJon', 'uses' => 'Portal\Condominium\Unit\UsersUnitController@storeJson']);
            Route::get('user/edit/{id}', ['as' => 'user.edit', 'uses' => 'Portal\Condominium\Unit\UsersUnitController@edit']);
            Route::post('user/listAll', ['as' => 'user.listAll', 'uses' => 'Portal\Condominium\Unit\UsersUnitController@listAll']);
            Route::post('user/update/{id}', ['as' => 'user.update', 'uses' => 'Portal\Condominium\Unit\UsersUnitController@update']);
            Route::get('user/destroy/{id}', ['as' => 'user.destroy', 'uses' => 'Portal\Condominium\Unit\UsersUnitController@destroy']);

        });


        //BLOCK
        Route::get('block', ['as' => 'block.index', 'uses' => 'Portal\Condominium\Block\BlockController@index']);
        Route::get('block/create', ['as' => 'block.create', 'uses' => 'Portal\Condominium\Block\BlockController@create']);
        Route::post('block/store', ['as' => 'block.store', 'uses' => 'Portal\Condominium\Block\BlockController@store']);
        Route::get('block/edit/{id}', ['as' => 'block.edit', 'uses' => 'Portal\Condominium\Block\BlockController@edit']);
        Route::post('block/update/{id}', ['as' => 'block.update', 'uses' => 'Portal\Condominium\Block\BlockController@update']);
        Route::get('block/destroy/{id}', ['as' => 'block.destroy', 'uses' => 'Portal\Condominium\Block\BlockController@destroy']);

        //SECURITY CAM
        Route::group(['prefix' => 'security-cam', 'as' => 'security-cam.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Portal\Condominium\SecurityCamController@index']);
            Route::get('list', ['as' => 'list', 'uses' => 'Portal\Condominium\SecurityCamController@listAll']);
            Route::get('create', ['as' => 'create', 'uses' => 'Portal\Condominium\SecurityCamController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Portal\Condominium\SecurityCamController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Portal\Condominium\SecurityCamController@edit']);
            Route::get('show/{id}', ['as' => 'show', 'uses' => 'Portal\Condominium\SecurityCamController@show']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'Portal\Condominium\SecurityCamController@update']);
            Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'Portal\Condominium\SecurityCamController@destroy']);
        });

        //GROUP CONDOMINUM
        Route::group(['prefix' => 'group', 'as' => 'group.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Portal\Condominium\Group\GroupCondominiumController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Portal\Condominium\Group\GroupCondominiumController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Portal\Condominium\Group\GroupCondominiumController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Portal\Condominium\Group\GroupCondominiumController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'Portal\Condominium\Group\GroupCondominiumController@update']);
            Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'Portal\Condominium\Group\GroupCondominiumController@destroy']);

            //USERS GROUP CONDOMINIUM
            Route::get('/{idGroup}/user/', ['as' => 'user.index', 'uses' => 'Portal\Condominium\Group\UsersGroupCondominiumController@index']);
            Route::get('/{idGroup}/user/create', ['as' => 'user.create', 'uses' => 'Portal\Condominium\Group\UsersGroupCondominiumController@create']);
            Route::post('/{idGroup}/user/store', ['as' => 'user.store', 'uses' => 'Portal\Condominium\Group\UsersGroupCondominiumController@store']);
            Route::get('/{idGroup}/destroy/{id}', ['as' => 'user.destroy', 'uses' => 'Portal\Condominium\Group\UsersGroupCondominiumController@destroy']);
        });

        //PROVIDERS
        Route::group(['prefix' => 'provider', 'as' => 'provider.'], function () {
            Route::get('', ['as' => 'index', 'uses' => 'Portal\Condominium\Provider\ProvidersController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Portal\Condominium\Provider\ProvidersController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'Portal\Condominium\Provider\ProvidersController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Portal\Condominium\Provider\ProvidersController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'Portal\Condominium\Provider\ProvidersController@update']);
            Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'Portal\Condominium\Provider\ProvidersController@destroy']);

            //PROVIDER CATEGORY
            Route::get('category', ['as' => 'category.index', 'uses' => 'Portal\Condominium\Provider\ProviderCategoryController@index']);
            Route::get('category/create', ['as' => 'category.create', 'uses' => 'Portal\Condominium\Provider\ProviderCategoryController@create']);
            Route::post('category/store', ['as' => 'category.store', 'uses' => 'Portal\Condominium\Provider\ProviderCategoryController@store']);
            Route::get('category/edit/{id}', ['as' => 'category.edit', 'uses' => 'Portal\Condominium\Provider\ProviderCategoryController@edit']);
            Route::post('category/update/{id}', ['as' => 'category.update', 'uses' => 'Portal\Condominium\Provider\ProviderCategoryController@update']);
            Route::get('category/destroy/{id}', ['as' => 'category.destroy', 'uses' => 'Portal\Condominium\Provider\ProviderCategoryController@destroy']);
        });

        //USER
        Route::get('user', ['as' => 'user.index', 'uses' => 'Portal\Condominium\UsersCondominiumController@index']);
        Route::get('user/create', ['as' => 'user.create', 'uses' => 'Portal\Condominium\UsersCondominiumController@create']);
        Route::post('user/store', ['as' => 'user.store', 'uses' => 'Portal\Condominium\UsersCondominiumController@store']);
        Route::get('user/edit/{id}', ['as' => 'user.edit', 'uses' => 'Portal\Condominium\UsersCondominiumController@edit']);
        Route::post('user/update/{id}', ['as' => 'user.update', 'uses' => 'Portal\Condominium\UsersCondominiumController@update']);
        Route::get('user/destroy/{id}', ['as' => 'user.destroy', 'uses' => 'Portal\Condominium\UsersCondominiumController@destroy']);
        Route::get('user/show/{id}', ['as' => 'user.show', 'uses' => 'Portal\Condominium\UsersCondominiumController@show']);
        Route::get('user/unit/{id}', ['as' => 'user.unit', 'uses' => 'Portal\Condominium\UsersCondominiumController@unit']);
        Route::post('user/unit/create', ['as' => 'user.unit.create', 'uses' => 'Portal\Condominium\UsersCondominiumController@userUnitCreate']);
        Route::get('user/image/{id}/{image}', ['as' => 'user.image', 'uses' => 'Portal\UserController@showImage']);
    });


    //USER ROLE
    Route::get('user/role', ['as' => 'user.role.index', 'uses' => 'Portal\UsersRolesController@index']);
    Route::get('user/role/create', ['as' => 'user.role.create', 'uses' => 'Portal\UsersRolesController@create']);
    Route::post('user/role/store', ['as' => 'user.role.store', 'uses' => 'Portal\UsersRolesController@store']);
    Route::get('user/role/edit/{id}', ['as' => 'user.role.edit', 'uses' => 'Portal\UsersRolesController@edit']);
    Route::post('user/role/update/{id}', ['as' => 'user.role.update', 'uses' => 'Portal\UsersRolesController@update']);
    Route::get('user/role/destroy/{id}', ['as' => 'user.role.destroy', 'uses' => 'Portal\UsersRolesController@destroy']);

    //USER ROLE CONDOMINIUM
    Route::get('condominium/role', ['as' => 'condominium.role.index', 'uses' => 'Portal\UsersRoleCondominiumController@index']);
    Route::get('condominium/role/create', ['as' => 'condominium.role.create', 'uses' => 'Portal\UsersRoleCondominiumController@create']);
    Route::post('condominium/role/store', ['as' => 'condominium.role.store', 'uses' => 'Portal\UsersRoleCondominiumController@store']);
    Route::get('condominium/role/edit/{id}', ['as' => 'condominium.role.edit', 'uses' => 'Portal\UsersRoleCondominiumController@edit']);
    Route::post('condominium/role/update/{id}', ['as' => 'condominium.role.update', 'uses' => 'Portal\UsersRoleCondominiumController@update']);
    Route::get('condominium/role/destroy/{id}', ['as' => 'condominium.role.destroy', 'uses' => 'Portal\UsersRoleCondominiumController@destroy']);

    //USER CONDOMINIUM
    /*
    Route::get('condominium/user', ['as' => 'condominium.user.index', 'uses' => 'Portal\Condominium\UsersCondominiumController@index']);
    Route::get('condominium/user/create', ['as' => 'condominium.user.create', 'uses' => 'Portal\Condominium\UsersCondominiumController@create']);
    Route::post('condominium/user/store', ['as' => 'condominium.user.store', 'uses' => 'Portal\Condominium\UsersCondominiumController@store']);
    Route::get('condominium/user/edit/{id}', ['as' => 'condominium.user.edit', 'uses' => 'Portal\Condominium\UsersCondominiumController@edit']);
    Route::post('condominium/user/update/{id}', ['as' => 'condominium.user.update', 'uses' => 'Portal\Condominium\UsersCondominiumController@update']);
    Route::get('condominium/user/destroy/{id}', ['as' => 'condominium.user.destroy', 'uses' => 'Portal\Condominium\UsersCondominiumController@destroy']);
*/


    //CONDOMINIUM FINALITY
    Route::get('condominium/finality', ['as' => 'condominium.finality.index', 'uses' => 'Portal\FinalityController@index']);
    Route::get('condominium/finality/create', ['as' => 'condominium.finality.create', 'uses' => 'Portal\FinalityController@create']);
    Route::post('condominium/finality/store', ['as' => 'condominium.finality.store', 'uses' => 'Portal\FinalityController@store']);
    Route::get('condominium/finality/edit/{id}', ['as' => 'condominium.finality.edit', 'uses' => 'Portal\FinalityController@edit']);
    Route::post('condominium/finality/update/{id}', ['as' => 'condominium.finality.update', 'uses' => 'Portal\FinalityController@update']);
    Route::get('condominium/finality/destroy/{id}', ['as' => 'condominium.finality.destroy', 'uses' => 'Portal\FinalityController@destroy']);


    //USEFULL PHONES
    Route::get('condominium/useful-phones', ['as' => 'condominium.useful-phones.index', 'uses' => 'Portal\UsefulPhonesController@index']);
    Route::get('condominium/useful-phones/create', ['as' => 'condominium.useful-phones.create', 'uses' => 'Portal\UsefulPhonesController@create']);
    Route::post('condominium/useful-phones/store', ['as' => 'condominium.useful-phones.store', 'uses' => 'Portal\UsefulPhonesController@store']);
    Route::get('condominium/useful-phones/edit/{id}', ['as' => 'condominium.useful-phones.edit', 'uses' => 'Portal\UsefulPhonesController@edit']);
    Route::post('condominium/useful-phones/update/{id}', ['as' => 'condominium.useful-phones.update', 'uses' => 'Portal\UsefulPhonesController@update']);
    Route::get('condominium/useful-phones/destroy/{id}', ['as' => 'condominium.useful-phones.destroy', 'uses' => 'Portal\UsefulPhonesController@destroy']);

    //UNIT TYPE
    Route::get('unit/type', ['as' => 'unit.type.index', 'uses' => 'Portal\UnitTypeController@index']);
    Route::get('unit/type/create', ['as' => 'unit.type.create', 'uses' => 'Portal\UnitTypeController@create']);
    Route::post('unit/type/store', ['as' => 'unit.type.store', 'uses' => 'Portal\UnitTypeController@store']);
    Route::get('unit/type/edit/{id}', ['as' => 'unit.type.edit', 'uses' => 'Portal\UnitTypeController@edit']);
    Route::post('unit/type/update/{id}', ['as' => 'unit.type.update', 'uses' => 'Portal\UnitTypeController@update']);
    Route::get('unit/type/destroy/{id}', ['as' => 'unit.type.destroy', 'uses' => 'Portal\UnitTypeController@destroy']);


    //BLOCK NOMEMCLATURE
    Route::get('block/nomemclature', ['as' => 'block.nomemclature.index', 'uses' => 'Portal\BlockNomemclatureController@index']);
    Route::get('block/nomemclature/create', ['as' => 'block.nomemclature.create', 'uses' => 'Portal\BlockNomemclatureController@create']);
    Route::post('block/nomemclature/store', ['as' => 'block.nomemclature.store', 'uses' => 'Portal\BlockNomemclatureController@store']);
    Route::get('block/nomemclature/edit/{id}', ['as' => 'block.nomemclature.edit', 'uses' => 'Portal\BlockNomemclatureController@edit']);
    Route::post('block/nomemclature/update/{id}', ['as' => 'block.nomemclature.update', 'uses' => 'Portal\BlockNomemclatureController@update']);
    Route::get('block/nomemclature/destroy/{id}', ['as' => 'block.nomemclature.destroy', 'uses' => 'Portal\BlockNomemclatureController@destroy']);


    //DIARY
    Route::get('diary', ['as' => 'diary.index', 'uses' => 'Portal\DiaryController@index']);
    Route::get('diary/create', ['as' => 'diary.create', 'uses' => 'Portal\DiaryController@create']);
    Route::post('diary/store', ['as' => 'diary.store', 'uses' => 'Portal\DiaryController@store']);
    Route::get('diary/edit/{id}', ['as' => 'diary.edit', 'uses' => 'Portal\DiaryController@edit']);
    Route::post('diary/update/{id}', ['as' => 'diary.update', 'uses' => 'Portal\DiaryController@update']);
    Route::get('diary/destroy/{id}', ['as' => 'diary.destroy', 'uses' => 'Portal\DiaryController@destroy']);

    Route::get('diary/{diaryId}/user/', ['as' => 'diary.user.index', 'uses' => 'Portal\UsersDiaryController@index']);
    Route::get('diary/{diaryId}/user/create', ['as' => 'diary.user.create', 'uses' => 'Portal\UsersDiaryController@create']);
    Route::post('diary/{diaryId}/user/store', ['as' => 'diary.user.store', 'uses' => 'Portal\UsersDiaryController@store']);
    Route::get('diary/{diaryId}/edit/{id}', ['as' => 'diary.user.edit', 'uses' => 'Portal\UsersDiaryController@edit']);
    Route::post('diary/{diaryId}/update/{id}', ['as' => 'diary.user.update', 'uses' => 'Portal\UsersDiaryController@update']);
    Route::get('diary/{diaryId}/destroy/{id}', ['as' => 'diary.user.destroy', 'uses' => 'Portal\UsersDiaryController@destroy']);

    Route::get('diary/reserve-areas', ['as' => 'diary.reserve-areas.index', 'uses' => 'Portal\ReserveAreasController@index']);
    Route::get('diary/reserve-areas/create', ['as' => 'diary.reserve-areas.create', 'uses' => 'Portal\ReserveAreasController@create']);
    Route::post('diary/reserve-areas/store', ['as' => 'diary.reserve-areas.store', 'uses' => 'Portal\ReserveAreasController@store']);
    Route::get('diary/reserve-areas/edit/{id}', ['as' => 'diary.reserve-areas.edit', 'uses' => 'Portal\ReserveAreasController@edit']);
    Route::post('diary/reserve-areas/update/{id}', ['as' => 'diary.reserve-areas.update', 'uses' => 'Portal\ReserveAreasController@update']);
    Route::get('diary/reserve-areas/destroy/{id}', ['as' => 'diary.reserve-areas.destroy', 'uses' => 'Portal\ReserveAreasController@destroy']);



    //COMUNICATION
    Route::group(['prefix' => 'communication', 'as' => 'communication.'], function () {
        //MESSAGE
        Route::group(['prefix' => 'message', 'as' => 'message.'], function () {
            //PUBLIC
            Route::group(['prefix' => 'public', 'as' => 'public.'], function () {
                Route::get('', ['as' => 'index', 'uses' => 'Portal\Communication\Message\MessagePublicController@index']);
                Route::get('create', ['as' => 'create', 'uses' => 'Portal\Communication\Message\MessagePublicController@create']);
                Route::post('store', ['as' => 'store', 'uses' => 'Portal\Communication\Message\MessagePublicController@store']);
                Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'Portal\Communication\Message\MessagePublicController@destroy']);

                Route::post('reply.store', ['as' => 'reply.store', 'uses' => 'Portal\Communication\Message\MessageReplyController@store']);
                Route::get('reply.destroy/{id}', ['as' => 'reply.destroy', 'uses' => 'Portal\Communication\Message\MessageReplyController@destroy']);
            });
        });

        //MESSAGE RESPOSTA
        Route::get('message/{messageId}/reply/', ['as' => 'message.reply.index', 'uses' => 'Portal\MessageReplyController@index']);
        Route::get('message/{messageId}/reply/create', ['as' => 'message.reply.create', 'uses' => 'Portal\MessageReplyController@create']);
        Route::post('message/{messageId}/reply/store', ['as' => 'message.reply.store', 'uses' => 'Portal\MessageReplyController@store']);
        Route::get('message/{messageId}/reply/edit/{id}', ['as' => 'message.reply.edit', 'uses' => 'Portal\MessageReplyController@edit']);
        Route::post('message/{messageId}/reply/update/{id}', ['as' => 'message.reply.update', 'uses' => 'Portal\MessageReplyController@update']);
        Route::get('message/{messageId}/reply/destroy/{id}', ['as' => 'message.reply.destroy', 'uses' => 'Portal\MessageReplyController@destroy']);

    });

    //CALLED
    Route::get('called', ['as' => 'called.index', 'uses' => 'Portal\CalledController@index']);
    Route::get('called/create', ['as' => 'called.create', 'uses' => 'Portal\CalledController@create']);
    Route::post('called/store', ['as' => 'called.store', 'uses' => 'Portal\CalledController@store']);
    Route::get('called/edit/{id}', ['as' => 'called.edit', 'uses' => 'Portal\CalledController@edit']);
    Route::post('called/update/{id}', ['as' => 'called.update', 'uses' => 'Portal\CalledController@update']);
    Route::get('called/destroy/{id}', ['as' => 'called.destroy', 'uses' => 'Portal\CalledController@destroy']);

    //CALLED HISTORIC
    Route::get('called/{calledId}/historic/', ['as' => 'called.historic.index', 'uses' => 'Portal\CalledHistoricController@index']);

    //CALLED CATEGORY
    Route::get('called/category', ['as' => 'called.category.index', 'uses' => 'Portal\CalledCategoryController@index']);
    Route::get('called/category/create', ['as' => 'called.category.create', 'uses' => 'Portal\CalledCategoryController@create']);
    Route::post('called/category/store', ['as' => 'called.category.store', 'uses' => 'Portal\CalledCategoryController@store']);
    Route::get('called/category/edit/{id}', ['as' => 'called.category.edit', 'uses' => 'Portal\CalledCategoryController@edit']);
    Route::post('called/category/update/{id}', ['as' => 'called.category.update', 'uses' => 'Portal\CalledCategoryController@update']);
    Route::get('called/category/destroy/{id}', ['as' => 'called.category.destroy', 'uses' => 'Portal\CalledCategoryController@destroy']);

    //CALLED STATUS
    Route::get('called/status', ['as' => 'called.status.index', 'uses' => 'Portal\CalledStatusController@index']);
    Route::get('called/status/create', ['as' => 'called.status.create', 'uses' => 'Portal\CalledStatusController@create']);
    Route::post('called/status/store', ['as' => 'called.status.store', 'uses' => 'Portal\CalledStatusController@store']);
    Route::get('called/status/edit/{id}', ['as' => 'called.status.edit', 'uses' => 'Portal\CalledStatusController@edit']);
    Route::post('called/status/update/{id}', ['as' => 'called.status.update', 'uses' => 'Portal\CalledStatusController@update']);
    Route::get('called/status/destroy/{id}', ['as' => 'called.status.destroy', 'uses' => 'Portal\CalledStatusController@destroy']);

    //FORUM
    Route::get('forum', ['as' => 'forum.index', 'uses' => 'Portal\ForumController@index']);
    Route::get('forum/create', ['as' => 'forum.create', 'uses' => 'Portal\ForumController@create']);
    Route::post('forum/store', ['as' => 'forum.store', 'uses' => 'Portal\ForumController@store']);
    Route::get('forum/edit/{id}', ['as' => 'forum.edit', 'uses' => 'Portal\ForumController@edit']);
    Route::post('forum/update/{id}', ['as' => 'forum.update', 'uses' => 'Portal\ForumController@update']);
    Route::get('forum/destroy/{id}', ['as' => 'forum.destroy', 'uses' => 'Portal\ForumController@destroy']);

    //FORUM RESPOSTA
    Route::get('forum/{forumId}/response/', ['as' => 'forum.response.index', 'uses' => 'Portal\ForumResponseController@index']);
    Route::get('forum/{forumId}/response/create', ['as' => 'forum.response.create', 'uses' => 'Portal\ForumResponseController@create']);
    Route::post('forum/{forumId}/response/store', ['as' => 'forum.response.store', 'uses' => 'Portal\ForumResponseController@store']);
    Route::get('forum/{forumId}/response/edit/{id}', ['as' => 'forum.response.edit', 'uses' => 'Portal\ForumResponseController@edit']);
    Route::post('forum/{forumId}/response/update/{id}', ['as' => 'forum.response.update', 'uses' => 'Portal\ForumResponseController@update']);
    Route::get('forum/{forumId}/response/destroy/{id}', ['as' => 'forum.response.destroy', 'uses' => 'Portal\ForumResponseController@destroy']);


    //COMUNICADOS
    Route::get('communication', ['as' => 'communication.index', 'uses' => 'Portal\CommunicationController@index']);
    Route::get('communication/create', ['as' => 'communication.create', 'uses' => 'Portal\CommunicationController@create']);
    Route::post('communication/store', ['as' => 'communication.store', 'uses' => 'Portal\CommunicationController@store']);
    Route::get('communication/edit/{id}', ['as' => 'communication.edit', 'uses' => 'Portal\CommunicationController@edit']);
    Route::post('communication/update/{id}', ['as' => 'communication.update', 'uses' => 'Portal\CommunicationController@update']);
    Route::get('communication/destroy/{id}', ['as' => 'communication.destroy', 'uses' => 'Portal\CommunicationController@destroy']);

    //COMUNICADOS GROUP
    Route::get('communication/{communicationId}/group/', ['as' => 'communication.group.index', 'uses' => 'Portal\CommunicationGroupController@index']);

    //ACHADOS E PERDIDOS
    Route::get('lost-and-found', ['as' => 'lost-and-found.index', 'uses' => 'Portal\LostAndFoundController@index']);
    Route::get('lost-and-found/create', ['as' => 'lost-and-found.create', 'uses' => 'Portal\LostAndFoundController@create']);
    Route::post('lost-and-found/store', ['as' => 'lost-and-found.store', 'uses' => 'Portal\LostAndFoundController@store']);
    Route::get('lost-and-found/edit/{id}', ['as' => 'lost-and-found.edit', 'uses' => 'Portal\LostAndFoundController@edit']);
    Route::post('lost-and-found/update/{id}', ['as' => 'lost-and-found.update', 'uses' => 'Portal\LostAndFoundController@update']);
    Route::get('lost-and-found/destroy/{id}', ['as' => 'lost-and-found.destroy', 'uses' => 'Portal\LostAndFoundController@destroy']);
    Route::get('lost-and-found/{id}/completed', ['as' => 'lost-and-found.completed', 'uses' => 'Portal\LostAndFoundCompletedController@create']);
    Route::post('lost-and-found/{id}/completed/store', ['as' => 'lost-and-found.completed.store', 'uses' => 'Portal\LostAndFoundCompletedController@store']);

});

