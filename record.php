<meta charset="utf-8">
    <div id="main">
        

        <div class="content">
  <div class="pure-g">
 

  <button class="pure-button" onclick="startRecording(this);">record</button>
  <button class="pure-button" onclick="stopRecording(this);" disabled>stop</button>

  <ul class="pure-menu-list" id="recordingslist"></ul>

  <pre class="pure-u-1" id="log"></pre>
  <script>
  function __log(e, data) {
    log.innerHTML += e + " " + (data || '')+ "\n" ;
  }
  //给id为log的元素加内容


  var audio_context;
  var recorder;

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    //将声音输入这个对像
    
    __log('Media stream created.' );
    __log("input sample rate " +input.context.sampleRate);

    // Feedback!
    //input.connect(audio_context.destination);
    __log('Input connected to audio context destination.');

    recorder = new Recorder(input, {
                  numChannels: 1
                });
    __log('Recorder initialised.\n');
  }

  function startRecording(button) {
    recorder && recorder.record();
    button.disabled = true;
    button.nextElementSibling.disabled = false;
    __log('Recording...');
  }
  //开始录音的方法

  function stopRecording(button) {
    recorder && recorder.stop();
    button.disabled = true;
    button.previousElementSibling.disabled = false;
    __log('Stopped recording.');

    // create WAV download link using audio data blob
    createDownloadLink();

    recorder.clear();
  }
  //停止录音的方法


  function createDownloadLink() {
    recorder && recorder.exportWAV(function(exportWAV) {
      /*var url = URL.createObjectURL(blob);
      var li = document.createElement('li');
      var au = document.createElement('audio');
      var hf = document.createElement('a');

      au.controls = true;
      au.src = url;
      hf.href = url;
      hf.download = new Date().toISOString() + '.wav';
      hf.innerHTML = hf.download;
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);*/
    });
  }

  window.onload = function init() {
    try {
      // webkit shim


      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      audio_context = new AudioContext;
      //创建一个音频环境对像

      navigator.getUserMedia = ( navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
      //navigator为浏览器对象，包含浏览器信息。
      //getUserMedia允许应用程序访问摄像头麦克风
      window.URL = window.URL || window.webkitURL;

      
      __log('Audio context set up.');
      __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
      alert('No web audio support in this browser!');
    }

    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      __log('No live audio input: ' + e);
    });
    //getUserMedia方法，第一个参数是麦克风，第二个是成功的回调函数，第三个是失败的回调函数
  };
  //js入口

  </script>


        </div>

    </div>
  <script src="js/recordmp3.js"></script>