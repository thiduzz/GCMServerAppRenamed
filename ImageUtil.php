<?php

class ImageUtil {

    const uploadDir = "img"; // Create this folder and give write rights.
    const allowedExtensions = "jpg, jpeg, gif, png";
    const maxSize = 15; // MB
    const maxWidth = 8192; // 8MB
    const maxHeight = 8192;

    private static function validExtension($extension) {
        $allowedExtensions = explode(", ", ImageUtil::allowedExtensions);
        return in_array($extension, $allowedExtensions);
    }

    private static function validSize($size) {
        return $size <= ImageUtil::maxSize * pow(2, 20);
    }

    private static function validDimensions($width, $height) {
        return $width < ImageUtil::maxWidth && $height < ImageUtil::maxHeight;
    }

    private static function uploadedFile($file, $newFile) {
        return move_uploaded_file($file, ImageUtil::uploadDir . '/' . $newFile);
    }

    public static function uploadImage($file, $newName) {

        // check dimensions
        list($width, $height, $type, $w) = getimagesize($file['name']);
        if (!ImageUtil::validDimensions($width, $height))
            throw new InvalidDimensionsException();

        // check size
        if (!ImageUtil::validSize($file['size']))
            throw new InvalidSizeException();

        // move to needed location
        if (!ImageUtil::uploadedFile($file['name'], $newName . "." . $extension))
            throw new UnableToUploadException();

        return true;
    }



}

class InvalidExtensionException extends Exception {

    protected $message = 'Extension is invalid';   // exception message

}

class InvalidDimensionsException extends Exception {

    protected $message = 'Image dimensions are invalid';   // exception message

}

class InvalidSizeException extends Exception {

    protected $message = 'Size is invalid';   // exception message

}

class UnableToUploadException extends Exception {

    protected $message = 'Unable to upload file';   // exception message

}

?>