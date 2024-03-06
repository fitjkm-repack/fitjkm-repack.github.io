<html lang="IT">
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="fitjkm-icon-extracted.png"/>
    <title>FitJKM Repacks - Normal Zone</title>
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
    position: fixed;
    width: 100%;
      }

      .navbar a {
	color: #fff;
	font-size: 50px;
	margin-left: 20px;
      }

      #title {
          text-decoration: none;
      }

      #audio {
	font-size: 20px;
	margin: 0
      }


      .navbar img {
	 height: 120px;
	 display: block;
	 border-radius: 15px;


      }
        /** PC **/
      @media only screen and (min-width: 601px) {

          .latest {
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;

              padding-top: 200px;

              font-size: 30px;
              height: 100%;
          }
      }

      /** MOBILE **/
      @media only screen and (max-width: 600px) {
          .latest {
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;

              font-size: 50px;
              height: 100%;
          }
      }
      .desc {
	font-size: 20px;
      }

      .storia {
          color: #F77F00;
      }

      .tps {
          color: #0096A3;
      }

      .sistemi {
          color: #00aa8d;
      }

      .italiano {
          color: #6846bc;
      }

      .descarch {
	font-size: 14px;
      }

      /** PC **/
      @media only screen and (min-width: 601px) {
          #aiimage {
              border-radius: 20px;
          }
      }

      /** MOBILE **/
      @media only screen and (max-width: 600px) {
          #aiimage {
              margin-top: 100px;
              border-radius: 20px;
          }
      }



	  #sd {
		font-size: 16px;
	  }

      .archive {
	margin-top: 50px;
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
      <a href="#" id="title">FitJKM Repacks</a>
      <table>
      <tr>
	  <th>      
	    <img src="budgiesIA.jpeg" alt="jkm" onclick="easteregg()" id="jkmimg">
	  </th>
	</tr>
	<tr>
	  <th>     
	    <a href="audio.html" id="audio">Audio Zone</a>
	  </th>
	</tr>

      </table>
    </div>
    <div class="latest">
      <h1>LATEST REPACK!</h1>
<?php
function getFileWithLargestNumber($dir) {
	$files = scandir($dir);
	$largestNumber = -1;
	$fileWithLargestNumber = '';

	foreach ($files as $file) {
		if ($file != '.' && $file != '..') {
			$filePath = $dir . '/' . $file;

			if (is_dir($filePath)) {
				$subDirLargestNumberFile = getFileWithLargestNumber($filePath);
				$subDirLargestNumber = $subDirLargestNumberFile['number'];
				if ($subDirLargestNumber > $largestNumber) {
					$largestNumber = $subDirLargestNumber;
					$fileWithLargestNumber = $subDirLargestNumberFile['file'];
				}
			} else {
				$number = extractNumberFromFileName($file);
				if ($number !== false && $number > $largestNumber) {
					$largestNumber = $number;
					$fileWithLargestNumber = $filePath;
				}
			}
		}
	}

	return ['file' => $fileWithLargestNumber, 'number' => $largestNumber];
}

function extractNumberFromFileName($fileName) {
	$pattern = '/(\d+)/';
	if (preg_match($pattern, $fileName, $matches)) {
		return intval($matches[0]);
	}
	return false;
}

$folder = 'repacks';
$mostRecent = getFileWithLargestNumber($folder);


if (!empty($mostRecent['file'])) {
	$filename = basename($mostRecent['file']);
	$fileLink = $mostRecent['file'];
	$encodedLink = urlencode($fileLink);
	echo "<a href=\"https://docs.google.com/viewerng/viewer?url=https://fitjkm-repack.github.io/$fileLink\" target=\"_blank\">$filename</a><a href=\"$fileLink\" target=\"_blank\">download</a>";
	$parts = explode("/", $fileLink);
// window.location.href = "pagina_destinazione.html?messaggio=" + encodeURIComponent(tuaStringa);
	// Assuming "DATA" is always the third part of the exploded string
	if (count($parts) >= 2) {
		$data = $parts[1];
		echo "<span class='desc ${data}'>$data</span>"; // This will output "DATA"
	} else {
		echo "DATA not found in the string.";
	}
} else {
	echo "No files found in '$folder'.<br>";
}
?>
	<br>
	<img src="image.png" id="aiimage" alt="AIIMAGE">
	<div id="sd">Image automatically generated by stable diffusion</div>
    </div>
    <div class="archive">
	<h2>Archive</h2>
<?php

function getFilesWithLargestNumber($dir) {
	$files = scandir($dir);
	$filesWithLargestNumber = [];

	foreach ($files as $file) {
		if ($file != '.' && $file != '..') {
			$filePath = $dir . '/' . $file;

			if (is_dir($filePath)) {
				$subDirFilesWithLargestNumber = getFilesWithLargestNumber($filePath);
				$filesWithLargestNumber = array_merge($filesWithLargestNumber, $subDirFilesWithLargestNumber);
			} else {
				$number = extractNumberFromFileName($file);
				if ($number !== false) {
					$filesWithLargestNumber[] = ['file' => $filePath, 'number' => $number];
				}
			}
		}
	}

	// Sort the files by the largest number in their names in descending order
	usort($filesWithLargestNumber, function($a, $b) {
		return $b['number'] - $a['number'];
	});

	return $filesWithLargestNumber;
}


$folder = 'repacks';
$filesWithLargestNumber = getFilesWithLargestNumber($folder);

if (!empty($filesWithLargestNumber)) {
	echo "<ul>";
	foreach ($filesWithLargestNumber as $fileInfo) {
		$filename = basename($fileInfo['file']);
		$fileLink = $fileInfo['file'];

		$parts = explode("/", $fileLink);
		// Assuming "DATA" is always the third part of the exploded string
		if (count($parts) >= 2) {
			$data = $parts[1];
			//echo "<a href=\"display.html?file=$encodedLink\" target=\"_blank\">$filename</a><br>";
			//echo "<a href=\"$fileLink\" style='font-size: 20px;' target=\"_blank\">download</a><br>";

			$encodedLink = urlencode($fileLink);
			//echo "<li><a href=\"$fileLink\" target=\"_blank\">$filename</a><br>";
			echo "<li><a href=\"https://docs.google.com/viewerng/viewer?url=https://fitjkm-repack.github.io/$fileLink\" target=\"_blank\">$filename</a> - <a href=\"$fileLink\" target=\"_blank\">download</a> <br>";
			echo "<span class='descarch ${data}'>$data</span></li>";
		} else {
			echo "DATA not found in the string.</li>";
		}
	}
	echo "</ul>";
} else {
	echo "No files with numbers found in '$folder'.<br>";
}

?>

    </div>
	<script>
		function easteregg() {
			const img = document.getElementById('jkmimg');
			img.src = "lob.jpg";
			let audio = new Audio("secret.mp3");
			audio.play();
			audio.onended = function() {
				img.src = "budgiesIA.jpeg";
			}
		}
		</script>
  </body>
</html>
