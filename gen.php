<html lang="IT">
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="fitjkm-icon-extracted.png"/>
    <title>FitJKM Repacks</title>
    <style>
      * {
	margin: 0;
	padding: 0;
	color: #fff;
      }
      html {
          scroll-behavior: smooth;
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

      .latest {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

	font-size: 50px;
    height: 1400px;
          padding-bottom: 600px;
      }

      .desc {
	font-size: 40px;
      }

      .storia {
          color: #F77F00;
      }

      .tps {
          color: #6ec8d7;
      }

      .sistemi {
          color: #00aa8d;
      }

      .italiano {
          color: #a082e1;
      }

      .archivelink {
          font-size: 30px;
      }
      .descarch {
	font-size: 30px;
      }

	  #aiimage {
		    margin-top: 100px;
          border-radius: 20px;
          height: 500px;
	  }

      .imagecit {
          margin-bottom: 150px;
          margin-top: 50px;
          border-radius: 20px;
		  height: 300px;
      }

	  #sd {
		font-size: 25px;
          margin-top: 10px;
	  }

      .archive {
		margin-top: 50px;
      }
	  
	  .archive h2 {
		padding-top: 20px;
	  }

	  .content {
		padding: 20px;
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

      h2 {
          font-size: 50px;
          text-align: center;
          margin-bottom: 70px;
          border-top: white 2px solid;
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

      footer {
		  padding: 100px 0;
		  display: flex;
		  justify-content: center;
          font-size: 20px;
          border-top: 1px solid #fff;
          margin-top: 100px;
      }

	  .imagecitbox {
		width: 100%;
		display: flex;
		  justify-content: center;
	  }

	  .footer-content {
		padding: 0 20px
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
	    <a href="#footer" id="audio">Credits</a>
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
		echo "<span class='desc {$data}'>$data</span>"; // This will output "DATA"
	} else {
		echo "DATA not found in the string.";
	}
} else {
	echo "No files found in '$folder'.<br>";
}
?>
	<br>
	<img src="vine.gif" id="aiimage" alt="AIIMAGE">
	<div id="sd">Scrolla per vedere l'archivio</div>
    </div>
    <div class="archive">
	<h2>Archive</h2>

	<div class="content">
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
			echo "<li class='archivelink' ><a href=\"https://docs.google.com/viewerng/viewer?url=https://fitjkm-repack.github.io/$fileLink\" target=\"_blank\">$filename</a> - <a href=\"$fileLink\" target=\"_blank\">download</a> <br>";
			echo "<span class='descarch {$data}'>$data</span></li>";
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
    </div>
    <footer id="footer">
		<div class="footer-content">
	<p><b>Note:</b> Questi appunti sono del quarto e quinto anno di informatica.</p><br>
	<p>Se ci sono problemi o comunque errori da correggere scrivete a <a href="mailto:beastdune88@proton.me">beastdune88@proton.me</a>.</p><br>
	<p>Per chi è interessato a leggere il codice del sito è su Github: <a href="https://github.com/fitjkm-repack/fitjkm-repack.github.io">fitjkm-repack</a>.</p><br><br><br><br>

        <p>♥ Gli appunti sono stati fatti con amore e sudore da FunnySuperst56.</p>
        <p><i>“I'm sad, but at the same time, I'm really happy that something can make me feel that sad.”</i></p>
        <div class="imagecitbox"><img src="sad.gif" class="imagecit" alt="imagecit"></div>
        <p>♥ Il sito è possibile grazie a OrangeXarot, quel pazzo maniaco.</p>
        <p><i>“È meglio non sapere e sapere di non sapere, che sapere e avere ansia di non sapere.”</i></p>
        <div class="imagecitbox"><img src="tboi.gif" class="imagecit" alt="imagecit"></div>
        </div>
    </footer>
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

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            // Code to execute if the user is on a phone

        } else {
            // Code for other devices
            //zoom: 0.5;
            //-moz-transform: scale(0.5);
            //-moz-transform-origin: 50% 0;
            document.body.style.zoom = "0.5";
            document.body.style.MozTransform = "scale(0.5)";
            document.body.style.MozTransformOrigin = "50% 0";
        }
    </script>
  </body>
</html>
