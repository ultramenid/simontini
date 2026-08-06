<?php

use App\Http\Controllers\CmsCommentController;
use App\Http\Controllers\CommentAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeforestationStoryController;
use App\Http\Controllers\DeforestationStorySubscriptionController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InsightContoller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapndataController;
use App\Http\Controllers\StadiController;
use App\Http\Controllers\StoryCommentController;
use App\Http\Middleware\checkSession;
use App\Http\Middleware\hasSession;
use App\Http\Middleware\setLanguage;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::redirect('/', '/id/status-deforestasi-di-indonesia-2025');

Route::get('/comment/login/google', [CommentAuthController::class, 'redirect'])
    ->name('comments.login.google');
Route::get('/comment/login/google/callback', [CommentAuthController::class, 'callback'])
    ->name('comments.login.google.callback');
Route::post('/comment/logout', [CommentAuthController::class, 'logout'])
    ->name('comments.logout');

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

Route::get('/en/status-of-deforestation-in-indonesia-2025', [InsightContoller::class, 'stadi2025EN'])->name('stadi2025EN');
Route::get('/id/status-deforestasi-di-indonesia-2025', [InsightContoller::class, 'stadi2025'])->name('stadi2025');

Route::prefix('{locale}')
    ->where(['locale' => 'id|en'])
    ->middleware('story.locale')
    ->group(function () {
        Route::get('/deforestory', [DeforestationStoryController::class, 'index'])
            ->name('deforestation.index');
        Route::get('/deforestory/{id}/{slug}', [DeforestationStoryController::class, 'show'])
            ->whereNumber('id')
            ->name('deforestation.show');
        Route::post('/deforestory/subscribe', [DeforestationStorySubscriptionController::class, 'storeAll'])
            ->middleware('throttle:10,1')
            ->name('deforestation.subscribe.all');
        Route::post('/deforestory/{id}/comments', [StoryCommentController::class, 'store'])
            ->whereNumber('id')
            ->middleware('throttle:comments')
            ->name('deforestation.comments.store');
        Route::post('/deforestory/{id}/subscribe', [DeforestationStorySubscriptionController::class, 'store'])
            ->whereNumber('id')
            ->middleware('throttle:10,1')
            ->name('deforestation.subscribe');

        Route::middleware(['auth', 'role:admin,editor'])
            ->prefix('preview')
            ->group(function () {
                Route::get('/deforestory', [DeforestationStoryController::class, 'previewIndex'])
                    ->name('deforestation.preview.index');
                Route::get('/deforestory/{id}/{slug}', [DeforestationStoryController::class, 'previewShow'])
                    ->whereNumber('id')
                    ->name('deforestation.preview.show');
            });
    });

// stadi 2025
Route::middleware('httpauth')->group(function () {});

Route::middleware('httpauth')->group(function () {
    Route::get('/penjelasan-data-stadi-2025', [InsightContoller::class, 'penjelasan'])->name('penjelasan-data-stadi-2025');
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
    Route::get('/cms/deforestory', [DashboardController::class, 'deforestory'])->name('cms.deforestory');
    Route::get('/cms/deforestory/add', [DashboardController::class, 'addDeforestory'])->name('cms.deforestory.add');
    Route::get('/cms/deforestory/{id}/edit', [DashboardController::class, 'editDeforestory'])
        ->whereNumber('id')
        ->name('cms.deforestory.edit');
    Route::get('/cms/reference', [DashboardController::class, 'reference'])->name('cms.reference');
    Route::get('/cms/comments', [CmsCommentController::class, 'index'])->name('cms.comments');
    Route::patch('/cms/comments/{id}/{status}', [CmsCommentController::class, 'status'])
        ->whereNumber('id')
        ->name('cms.comments.status');
    Route::delete('/cms/comments/{id}', [CmsCommentController::class, 'destroy'])
        ->whereNumber('id')
        ->name('cms.comments.destroy');

});

// redirect to dashboard if user has session to dashboard
Route::middleware([hasSession::class])->group(function () {
    Route::get('/cms/login', [LoginController::class, 'index'])->name('login');
});

// url to logout session
Route::get('/cms/logout', function () {
    session()->flush();

    return redirect('/cms/login');
});
