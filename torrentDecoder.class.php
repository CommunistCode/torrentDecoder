<?php

  // Path to Bencode Class
  $bencodePath = __DIR__."/../bencode/lib/Bencode.php";

  // Include Bencode class
  require_once($bencodePath);

  class torrentDecoder {

    //Torrent in decoded form
    private $decodedTorrent;

    function  __construct($torrentFile) {

      // Check that what has been passed is a file
      if (is_file($torrentFile)) {

        $torrentFileContents = file_get_contents($torrentFile);

        // Attempts to decode it
        $this->decodedTorrent = Bencode::decode($torrentFileContents);
      
      } else {

        throw new Exception("Argument passed was not a file!");

      }

    }

    public function getFiles() {
      
      $torrentFiles = array();
      
      if (isset($this->decodedTorrent['info']['files'])) {

        foreach ($this->decodedTorrent['info']['files'] as $fileArray) {

          foreach($fileArray['path'] as $path) {

            array_push($torrentFiles,$path);

          }  

        }

      }
      
      return $torrentFiles;

    }

    public function getDecodedTorrent() {

      return $this->decodedTorrent;

    }

  }

?>
