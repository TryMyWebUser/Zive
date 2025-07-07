<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php'; // correct path
use Dotenv\Dotenv;


class Config
{
    private static bool  $booted = false;
    private static array $env    = [];

    /** Load .env once */
    private static function boot(): void
    {
        if (self::$booted) return;

        $root = dirname(__DIR__, 2);   // → project root
        if (!is_file($root . '/.env')) {
            throw new RuntimeException('.env file not found at project root');
        }

        Dotenv::createImmutable($root)->safeLoad();
        self::$env    = array_merge($_ENV, getenv());  // allow real env‑vars to win
        self::$booted = true;
    }

    /** Get string env (default = null) */
    public static function env(string $key, ?string $default = null): string
    {
        self::boot();
        return self::$env[$key] ?? $default ?? '';
    }

    /** Quick boolean helper */
    public static function bool(string $key, bool $default = false): bool
    {
        $val = strtolower(self::env($key, $default ? '1' : '0'));
        return in_array($val, ['1', 'true', 'yes', 'on'], true);
    }
}