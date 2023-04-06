<?php

namespace kalanis\kw_paths\Extras;


use kalanis\kw_paths\Stuff;


/**
 * Trait TRemoveCycle
 * @package kalanis\kw_paths\Extras
 * low-level work with extended dirs - remove dirs and files in cycle - everything with subdirectories
 * @deprecated since 2023-01-01 use instead
 * @see \kalanis\kw_files\Interfaces\IProcessDirs::deleteDir ((array)$path, TRUE)
 */
trait TRemoveCycle
{
    /**
     * Remove sub dirs and their content recursively
     * @param $dirPath
     * @deprecated
     */
    protected function removeCycle(string $dirPath): void
    {
        $path = Stuff::removeEndingSlash($dirPath);
        if (is_dir($path) && $fileListing = scandir($path)) {
            foreach ($fileListing as $fileName) {
                if (is_dir($path . DIRECTORY_SEPARATOR . $fileName)) {
                    if (('.' != $fileName) && ('..' != $fileName)) {
                        $this->removeCycle($path . DIRECTORY_SEPARATOR . $fileName);
                        rmdir($path . DIRECTORY_SEPARATOR . $fileName);
                    }
                } else {
                    unlink($path . DIRECTORY_SEPARATOR . $fileName);
                }
            }
        }
    }
}
