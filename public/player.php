<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Shaka Player</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<div class="wrapper">
		<header id="header" class="">
			
		</header><!-- /header -->
			<div class="main-body zeroPadding">
				<div class="shakaPlayer">
				 <video id="shakaVideoPlayer" width= "100%" height="640" poster="//shaka-player-demo.appspot.com/assets/poster.jpg" style="background: black;" controls autoplay></video>
				</div><!-- shakaPlayer -->
			</div><!-- main-body -->
		<footer>
		</footer><!-- fotter -->
	</div> <!-- Wrapper -->
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<script src="//imasdk.googleapis.com/js/sdkloader/ima3_debug.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/shaka-player/2.5.9/shaka-player.compiled.js" type="text/javascript"></script>
		<script>
			
		var manifestUri ='<?php echo $_GET['url']; ?>';
		shaka.polyfill.installAll();
		if (shaka.Player.isBrowserSupported()) {
			initPlayer(manifestUri);
		} else {
		   	console.error('Browser not supported!');
		}

		addEventListener();
		function initPlayer(manifestUri) {
			  var video = document.getElementById('shakaVideoPlayer');
			  var shakaVideoPlayer = new shaka.Player(video);
			  window.shakaVideoPlayer = shakaVideoPlayer;
			  shakaVideoPlayer.configure({
				  drm: {
					//servers: { 'org.w3.clearkey': 'https://dogstrainingindia.com/key_url.php' }
					//servers: { 'org.w3.clearkey': '{"keys": [{"k": "hyN9IKGfWKdAwFaE5pm0qg", "kty": "oct", "kid": "oW5AK5BW43HzbTSKpiu3SQ" }], "type": "temporary"}' }
					clearKeys: {
						"<?php echo $_GET['kid']; ?>":"<?php echo $_GET['keyid']; ?>"
		                           	}
				  }
				});
			  shakaVideoPlayer.load(manifestUri).then(function() {
			    console.log('The video has now been loaded!');
			  }).catch(onError);
		}

		function onErrorEvent(event) {
		  onError(event.detail);
		}

		function onError(error) {
		  console.log('Error code', error.code, 'object', error);
		}

		function addEventListener(){
			shakaVideoPlayer.addEventListener('play', onPlay);
			shakaVideoPlayer.addEventListener('playing', onPlaying);
			shakaVideoPlayer.addEventListener('pause', onPause);
			shakaVideoPlayer.addEventListener('ended', onEnded);
			shakaVideoPlayer.addEventListener('seeked', onSeeked);
			shakaVideoPlayer.addEventListener('seeking', onSeeking);
			shakaVideoPlayer.addEventListener('waiting', onWaiting);
			shakaVideoPlayer.addEventListener('error', onErrorEvent);
		}

		function onPlay(){
			console.log("Play");
		}

		function onPlaying(){
			console.log("Playing");
		}

		function onPause(){
			console.log("Paused");
		}

		function onEnded(){
			console.log("onEnded");
		}

		function onSeeked(){
			console.log("onSeeked");
		}

		function onSeeking(){
			console.log("onSeeking");
		}

		function onWaiting(){
			console.log("onWaiting");
		}

		</script>
		</body>
</html>
