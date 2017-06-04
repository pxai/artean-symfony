<?php

namespace Cuatrovientos\ArteanBundle\Service\Business;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class FileSystemBusiness {

    public function deleteFile ($path) {
        $fs = new Filesystem();
        try {
            $fs->remove($path);
        } catch (IOException $ioe) {

        }
    }
}
