
const video = document.createElement("video");
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");

let scanning = false;

qrcode.callback = (res) => {
  if (res) {
	if (window.location.href=="https://192.168.1.148/sites/updatelocation.php"){
    	window.location=('updatelocation.php?id='+res);
	} else if (window.location.href=="https://192.168.1.148/sites/scansearch.php"){
    	window.location=('chemprofile.php?id='+res);
	}
  }
};

navigator.mediaDevices
  .getUserMedia({ video: { facingMode: "environment" } })
  .then(function (stream) {
    scanning = true;
    canvasElement.hidden = false;
    video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
	stream.getVideoTracks()[0].applyConstraints({
		advanced: [{torch: true}]
	});
    video.srcObject = stream;
    video.play();
    tick();
    scan();
  });

function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}

