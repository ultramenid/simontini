<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, DownloadController, IndexController, InsightContoller, LoginController, MapndataController, StadiController};
use App\Http\Middleware\{checkSession, hasSession, setLanguage};
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
Route::redirect('/', '/id');

Route::get('/sitemap.xml', function () {

    $sitemap = Sitemap::create()
        ->add(
            Url::create('/')
                ->setLastModificationDate(now())
        )
        ->add(
            Url::create('/id')
                ->setLastModificationDate(now())
        )
        ->add(
            Url::create('/en')
                ->setLastModificationDate(now())
        )
        ->add(
            Url::create('/id/insight')
                ->setLastModificationDate(now())
        )
        ->add(
            Url::create('/en/insight')
                ->setLastModificationDate(now())
        )
        ->add(
            Url::create('/id/download')
                ->setLastModificationDate(now())
        )
         ->add(
            Url::create('/en/download')
                ->setLastModificationDate(now())
        )
         ->add(
            Url::create('/id/mapndata')
                ->setLastModificationDate(now())
        )
         ->add(
            Url::create('/en/mapndata')
                ->setLastModificationDate(now())
        );

    return response($sitemap->render(), 200)
        ->header('Content-Type', 'text/xml');
});
// stadi 2024
Route::get('/id/status-deforestasi-indonesia-2024', [InsightContoller::class, 'stadi2024'])->name('stadi2024');
Route::get('/en/status-of-deforestation-in-indonesia-2024', [InsightContoller::class, 'stadi2024EN'])->name('stadi2024EN');
Route::get('/jp/status-of-deforestation-in-indonesia-2024', [InsightContoller::class, 'stadi2024JP'])->name('stadi2024JP');



// stadi 2025
Route::middleware('httpauth')->group(function () {
    Route::get('/id/status-deforestasi-indonesia-2025', [InsightContoller::class, 'stadi2025'])->name('stadi2025');
});

Route::middleware('httpauth')->group(function () {
    Route::get('/en/status-of-deforestation-in-indonesia-2025', [InsightContoller::class, 'stadi2025EN'])->name('stadi2025EN');
});

Route::middleware([setLanguage::class])->group(function () {
    Route::group(['prefix' => '{lang}'], function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::get('/mapndata', [MapndataController::class, 'index'])->name('mapndata');
        Route::get('/download', [DownloadController::class, 'index'])->name('downloads');
        Route::get('/insight', [InsightContoller::class, 'index'])->name('insight');
        Route::get('/stadi2025', [StadiController::class, 'stadi2025'])->name('stadi2025');

    });
});


Route::middleware([checkSession::class])->group(function () {
    Route::get('/cms/dashboard', [DashboardController::class, 'index']);

});

//redirect to dashboard if user has session to dashboard
Route::middleware([hasSession::class])->group(function () {
    Route::get('/cms/login', [LoginController::class, 'index']);
});

//url to logout session
Route::get('/cms/logout', function () {
    session()->flush();
    return redirect('/cms/login');
});


