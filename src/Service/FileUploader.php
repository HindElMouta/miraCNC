<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

class FileUploader
{
    private $targetDirectory;
    private $kernel;

    public function __construct(KernelInterface $kernel, $targetDirectory)
    {
        $this->kernel = $kernel;
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = preg_replace('/[^a-zA-Z0-9]/', '_', $originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $newFilename);
        } catch (FileException $e) {
            // Handle file upload error
            throw new FileException('Erreur lors de l\'upload du fichier');
        }

        return $newFilename;
    }

    public function getTargetDirectory()
    {
        return $this->kernel->getProjectDir().'/public/uploads';
    }
}
