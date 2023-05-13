<?php

class FileHandler{

    public $filesExtensions = array(
        "word" => array(
            "mime" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "extension" => "docx"
        ),
        "ppt" => array(
            "mime" => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            "extension" => "pptx"
        ),
        "excel" => array(
            "mime" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "extension" => "xlsx"
        ),
        "pdf" => array(
            "mime" => "application/pdf",
            "extension" => "pdf"
        ),
        "txt" => array(
            "mime" => "text/plain",
            "extension" => "txt"
        )
    );

    public function __construct()
    {
        
    }

    public function base64MimeType(string $encoded, bool $strict = true){
        if ($decoded = base64_decode($encoded, $strict)) {
        $tmpFile = tmpFile();
        $tmpFilename = stream_get_meta_data($tmpFile)['uri'];

        file_put_contents($tmpFilename, $decoded);

        return mime_content_type($tmpFilename) ?: null;
        }

        return null;
    }

    function base64DecodeFile($encodedData)
    {
        if(preg_match('/^data\:([a-zA-Z]+\/[a-zA-Z.-]+);base64\,([a-zA-Z0-9\+\/]+\=*)$/', $encodedData, $matches)) {
            return [
                    'mime' => $matches[1],
                    'data' => base64_decode($matches[2]),
            ];
        }
        return [
            'mime' => 'null',
            "data" => 'null'
        ];
    }

    function getExtensionFromMime($mime){
        foreach($this->filesExtensions as $extesion){
            if(strcmp($extesion["mime"], $mime) == 0)
                return $extesion["extension"];
        }

        return "";
    }

    function storeFileInServer($serverPath, $fileBase64){
        $fileData =  $this->base64DecodeFile($fileBase64);
        $extension = $this->getExtensionFromMime($fileData['mime']);
        if(strcmp($extension, "") !== 0){
            $filename = uniqid("FILE-", true).".".$extension;
            $serverPath = $serverPath.$filename;
            $trg = fopen($serverPath, 'w');
            fwrite($trg, $fileData['data']);
            fclose($trg);

            return [
                "serverPath" => "http://localhost:8080/files/documents/".$filename,
                "extension"  => $extension,
                "serverName" => $filename
            ];
        }

        return[
            "server_path" => null,
            "extension"  => null,
            "serverName" => null
        ]; 
    }

    function storeVideoInServer($videoData){
        $videoLocation = $videoData['tmp_name'];
        $videoName = $videoData['name'];
        $videoExtension = strtolower(pathinfo($videoName, PATHINFO_EXTENSION));
        $videoServerName = uniqid("VIDEO-", true).'.'.$videoExtension;
        $videoServerPath = "./files/videos/".$videoServerName;

        if(move_uploaded_file($videoLocation, $videoServerPath)){
            return [
                "name"=>$videoServerName,
                "extension" => $videoExtension,
                "serverName" => $videoServerName
            ];
        }

        return null;
    }
}