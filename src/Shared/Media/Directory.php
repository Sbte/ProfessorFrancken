<?php

declare(strict_types=1);

namespace Francken\Shared\Media;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Collection;

final class Directory
{
    private const DISK = 'uploads';

    /**
     * @var string
     */
    private $directory;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $directory, ?string $name = null)
    {
        $this->directory = $directory;

        if ($name !== null) {
            $this->name = $name;
        } else {
            $parts = explode('/', $this->directory);
            $this->name = array_pop($parts);
        }
    }

    public function directory() : string
    {
        return $this->directory;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function url()
    {
        return action(
            [\Francken\Shared\Media\Http\Controllers\MediaController::class, 'index'],
            $this->directory
        );
    }

    public static function childDirectories(
        FilesystemManager $storage,
        string $directory
    ) : Collection {
        $directories = collect($storage->disk(static::DISK)->directories($directory))
            ->map(function ($directory) {
                return new self($directory);
            });

        if ($directory !== '') {
            $directories->prepend(new self(dirname($directory), '..'));
        }

        return $directories;
    }
}
