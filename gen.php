<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500&display=swap" rel="stylesheet">
    <style>
      * {
        margin: 0;
        padding: 0;
        color: #fff;
      }

      body {
        font-family: 'Ubuntu', sans-serif; 
        background-color: #1c1a21;
      }

      .navbar {
        background-color: #824DC0; 
        height: 150px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .navbar a {
        color: #fff;
        font-size: 50px;
        margin-left: 20px;
      }

      .navbar img {
         max-height: 100%;
         display: block;
      }

      .latest {
        margin-top: 200px;
        font-size: 50px;
        text-align: center;
      }

      .desc {
        font-size: 20px;
      }
      .descarch {
        font-size: 14px;
      }

      .archive {
        margin-top: 300px;
        margin-left: 20px;
      }

      h1 {
        background: linear-gradient(to right, #6846bc 20%, #00aa8d 40%, #00aa8d 60%, #6846bc 80%);
        background-size: 200% auto;
  
        color: #000;
        background-clip: text;
        text-fill-color: transparent;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      
        animation: shine 5s linear infinite;
    }
        @keyframes shine {
            to {
                background-position: 200% center;
            }
          }

          li {
            list-style: none;
            font-size: 20px;
            margin: 7px 0;
          }

    </style>
  </head>
  <body>
    <div class="navbar">
      <a href="#">FitJKM Repacks</a>
      <img src="jkm.jpg" alt="jkm">
    </div>
    <div class="latest">
      <h1>LATEST REPACK!</h1>
     <?php
function getMostRecentFile($dir) {
    $files = scandir($dir);
    $maxTimestamp = 0;
    $mostRecentFile = '';

    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $filePath = $dir . '/' . $file;

            if (is_dir($filePath)) {
                $subDirMostRecentFile = getMostRecentFile($filePath);
                if ($subDirMostRecentFile['timestamp'] > $maxTimestamp) {
                    $maxTimestamp = $subDirMostRecentFile['timestamp'];
                    $mostRecentFile = $subDirMostRecentFile['file'];
                }
            } else {
                $fileTimestamp = filemtime($filePath);
                if ($fileTimestamp > $maxTimestamp) {
                    $maxTimestamp = $fileTimestamp;
                    $mostRecentFile = $filePath;
                }
            }
        }
    }

    return ['file' => $mostRecentFile, 'timestamp' => $maxTimestamp];
}

$folder = 'repacks/';
$mostRecent = getMostRecentFile($folder);

if (!empty($mostRecent['file'])) {
    $filename = basename($mostRecent['file']);
    $fileLink = $mostRecent['file'];
    $lastModified = date('Y-m-d H:i:s', $mostRecent['timestamp']);
    
    echo "<a href=\"$fileLink\" target=\"_blank\">$filename</a><br>";
    $parts = explode("/", $fileLink);

    // Assuming "DATA" is always the third part of the exploded string
    if (count($parts) >= 3) {
        $data = $parts[2];
        echo "<span class='desc'>$lastModified - $data</span>"; // This will output "DATA"
    } else {
        echo "DATA not found in the string.";
    }
} else {
    echo "No files found in '$folder'.<br>";
}
?>
    </div>
    <div class="archive">
        <h2>Archive</h2>
    <?php
    
    function getMostRecentFiles($dir) {
  $files = scandir($dir);
  $recentFiles = [];

  foreach ($files as $file) {
      if ($file != '.' && $file != '..') {
          $filePath = $dir . '/' . $file;

          if (is_dir($filePath)) {
              $subDirRecentFiles = getMostRecentFiles($filePath);
              $recentFiles = array_merge($recentFiles, $subDirRecentFiles);
          } else {
              $fileTimestamp = filemtime($filePath);
              $recentFiles[] = ['file' => $filePath, 'timestamp' => $fileTimestamp];
          }
      }
  }

  // Sort the files by timestamp in descending order
  usort($recentFiles, function($a, $b) {
      return $b['timestamp'] - $a['timestamp'];
  });

  return $recentFiles;
}

$folder = 'repacks/';
$recentFiles = getMostRecentFiles($folder, 5);

if (!empty($recentFiles)) {
    echo "<ul>";
    foreach ($recentFiles as $fileInfo) {
        $filename = basename($fileInfo['file']);
        $fileLink = $fileInfo['file'];
        $lastModified = date('Y-m-d H:i:s', $fileInfo['timestamp']);

        echo "<li><a href=\"$fileLink\" target=\"_blank\">$filename</a><br>";

        $parts = explode("/", $fileLink);
        
        // Assuming "DATA" is always the third part of the exploded string
        if (count($parts) >= 3) {
            $data = $parts[2];
            echo "<span class='descarch'>$lastModified - $data</span></li>"; // This will output "DATA"
        } else {
            echo "DATA not found in the string.</li>";
        }
    }
    echo "</ul>";
} else {
    echo "No files found in '$folder'.<br>";
}
?>

    </div>
  </body>
</html>
