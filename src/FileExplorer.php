<?php
/** @noinspection PhpUnused */

namespace Laravel\FileExplorer;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use RuntimeException;

class FileExplorer
{
    /**
     * The callback that should be used to authenticate FileExplorer users.
     *
     * @var Closure
     */
    public static Closure $authUsing;

    /**
     * Register the FileExplorer authentication callback.
     *
     * @param Closure $callback
     * @return static
     */
    public static function auth(Closure $callback): FileExplorer
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Determine if the given request can access the FileExplorer dashboard.
     *
     * @param Request $request
     * @return bool
     */
    public static function check(Request $request): bool
    {
        return (static::$authUsing ?: function () {
            return App::isLocal();
        })($request);
    }

    /**
     * Get the default JavaScript variables for FileExplorer.
     *
     * @return array
     */
    public static function scriptVariables(): array
    {
        return [
            'path' => Config::get('file-explorer.path'),
            'disks' => Config::get('file-explorer.disks'),
            'assetsAreCurrent' => self::assetsAreCurrent(),
        ];
    }

    /**
     * Determine if FileExplorer's published assets are up-to-date.
     *
     * @return bool
     *
     * @throws RuntimeException
     */
    public static function assetsAreCurrent(): bool
    {
        $publishedPath = public_path('vendor/file-explorer/mix-manifest.json');

        if (!File::exists($publishedPath)) {
            throw new RuntimeException('FileExplorer assets are not published. Please run: php artisan file-explorer:publish');
        }

        return File::get($publishedPath) === File::get(__DIR__ . '/../public/mix-manifest.json');
    }
}
