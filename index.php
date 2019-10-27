<script src="https://cdn.netpie.io/microgear.js"></script>
<script src="js/raphael.2.1.0.min.js"></script>
<script src="js/justgage.1.0.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css">

<script>
	var user,nice,sys,idle,cpuload,memload;
	window.onload = function(){
		user = new JustGage({
			id: "user", 
			value: 0, 
			min: 0,
			max: 100,
			showMinMax: false,
			title: "user",
			label: "percentage",
			labelFontColor:"#FFF",
			titleFontColor:"#FFF",
			valueFontColor:"#FFF"
		});
		nice = new JustGage({
			id: "nice", 
			value: 0, 
			min: 0,
			max: 100,
			showMinMax: false,
			title: "nice",
			label: "percentage",
			labelFontColor:"#FFF",
			titleFontColor:"#FFF",
			valueFontColor:"#FFF"
		});
		sys = new JustGage({
			id: "sys", 
			value: 0, 
			min: 0,
			max: 100,
			showMinMax: false,
			title: "sys",
			label: "percentage",
			labelFontColor:"#FFF",
			titleFontColor:"#FFF",
			valueFontColor:"#FFF"
		});
		idle = new JustGage({
			id: "idle", 
			value: 0, 
			min: 0,
			max: 100,
			showMinMax: false,
			title: "idle",
			label: "percentage",
			labelFontColor:"#FFF",
			titleFontColor:"#FFF",
			valueFontColor:"#FFF"
		});
		cpuload = new JustGage({
			id: "cpuload", 
			value: 0, 
			min: 0,
			max: 100,
			showMinMax: false,
			title: "CPU Load",
			label: "percentage",
			labelFontColor:"#FFF",
			titleFontColor:"#FFF",
			valueFontColor:"#FFF"
		});
		memload = new JustGage({
			id: "memload", 
			value: 0, 
			min: 0,
			max: 100,
			showMinMax: false,
			title: "Memory Load",
			label: "percentage",
			labelFontColor:"#FFF",
			titleFontColor:"#FFF",
			valueFontColor:"#FFF"
		});
		setInterval(function(){
			var currentdate = new Date(); 
			var datetime = (currentdate+"").split(' ');
			document.getElementById("currenttime").innerHTML = '<p id="datetime"><span id="date">'+datetime[0]+' '+datetime[1]+' '+datetime[2]+' '+datetime[3]+'</span><br><br><span id="time">'+datetime[4]+'</span></p>';
		},1000);
      	};
	const APPKEY = <APPKEY>;
	const APPSECRET = <APPSECRET>;
	const APPID = <APPID>;
	var microgear = Microgear.create({
		gearkey: APPKEY,
		gearsecret: APPSECRET
	});
	microgear.on('message',function(topic,msg) {
		var split_msg = msg.split(",");
		console.log(split_msg);
		if(split_msg.length == 8){
			user.refresh(split_msg[0]);
			nice.refresh(split_msg[1]);
			sys.refresh(split_msg[2]);
			idle.refresh(split_msg[3]);
			cpuload.refresh(split_msg[4]);
			memload.refresh(split_msg[7]);
			document.getElementById("totalmemvalue").innerHTML = Math.floor(((parseFloat(split_msg[5])/1024)/1024));
			document.getElementById("freememvalue").innerHTML = Math.floor(((parseFloat(split_msg[6])/1024)/1024));
		}
	});
	microgear.on('connected', function() {
		microgear.setname('name');
	});
	microgear.resettoken(function(err){
		microgear.connect(APPID);
	});
</script>
<center>
<div style="display:block;width:1226px;height:328px;">
	<div id="logo"><img src="img/logo.png" style="width: 300px;height:193px;display: block;position: absolute;vertical-align:middle;text-align:center;margin:65px 52px;"/></div>
	<div id="cpuload"></div>
	<div style="display:inline-block;">
		<div style="display:table-row;">
			<div id="user"></div>
			<div id="nice"></div>
		</div>
		<div id="row">
			<div id="sys"></div>
			<div id="idle"></div>
		</div>
	</div>
</div>
<div style="display:block;width:1226px;height:328px;">
	<div id="currenttime"></div>
	<div id="memload"></div>
	<div style="display:inline;">
		<div id="row">
	        <div id="totalmem">
            	<p>
                	<span id="topicmem">Total Memory</span><br>
                	<span id="totalmemvalue">0</span><br>
                	<span id="megabytes">megabytes</span>
                </p>
            </div>
		</div>
		<div id="row">
        	<div id="freemem">
                <p>
                	<span id="topicmem">Free Memory</span><br>
                	<span id="freememvalue">0</span><br>
                	<span id="megabytes">megabytes</span>
                </p>
            </div>
		</div>
	</div>
</div>
</center>
