<!--
 * HNoteBook
 * 版本: V1.0.0
-->
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
		<script src="https://unpkg.com/vue/dist/vue.js"></script>
		<script src="https://unpkg.com/element-ui/lib/index.js"></script>
		<style>
			@font-face {
				font-family: FF;
				src: url(https://cdn.jsdelivr.net/gh/justfont/open-huninn-font@master/font/jf-openhuninn-1.0.ttf);
			}

			#app {
				font-family: FF, serif;
			}
		</style>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Hsuan 線上計時器</title>
	</head>

	<body>
		<div id="app">
			<el-container>
				<el-header>Hsuan 線上計時器</el-header>
				<el-main>
					<el-row>
						<el-switch v-model="mode" active-text="正計時" inactive-text="倒計時" @change="stop()"></el-switch>
					</el-row>
					<br>
					<el-row>
						<el-button @click="start()" :disabled="started">
							開始計時
						</el-button>
						<el-button @click="stop()" :disabled="!started">
							停止計時
						</el-button>
					</el-row>
					<br>
					<el-row>
						<el-date-picker v-model="timeValue" type="datetime" v-if="mode == false" placeholder="選擇時間" @change="stop();start()" :default-time="timeValue">
						</el-date-picker>
					</el-row>
					<div v-if="mode == true && started == true">
						時間已經過了
						<span v-if="duringTime < 60">{{duringTime}}秒</span>
						<span v-if="60 <= duringTime && duringTime < 3600">
							{{Math.floor(duringTime/60)}}分鐘{{(duringTime%60)}}秒
						</span>
						<span v-if="3600 <= duringTime && duringTime < 86400">
							{{Math.floor(duringTime/3600)}}小時{{Math.floor((duringTime%3600)/60)}}分鐘{{(duringTime%60)}}秒
						</span>
					</div>
					<div v-if="mode == false && started == true">
						剩下
						<span v-if="lastTime < 60">{{lastTime}}秒</span>
						<span v-if="60 <= lastTime && lastTime < 3600">
							{{Math.floor(lastTime/60)}}分鐘{{(lastTime%60)}}秒
						</span>
						<span v-if="3600 <= lastTime && lastTime < 86400">
							{{Math.floor(lastTime/3600)}}小時{{Math.floor((lastTime%3600)/60)}}分鐘{{(lastTime%60)}}秒
						</span>
						<span v-if="86400 <= lastTime">
							{{Math.floor(lastTime/86400)}}天{{Math.floor((lastTime%86400)/3600)}}小時{{Math.floor((lastTime%3600)/60)}}分鐘{{(lastTime%60)}}秒
						</span>
					</div>
					<br>
					{{time}}
				</el-main>
			</el-container>

		</div>
	</body>

	<script>
		var TimerApp = new Vue({
			el: '#app',
			data: {
				"timeValue": "",
				"mode": true,
				"timer": {},
				"duringTime": 0,
				"lastTime": 0,
				"nowTS": 0,
				"started": false,
				"time": new Date().toLocaleString()
			},
			methods: {
				start() {
					
					if (TimerApp.mode == true) {
						//正計時
						TimerApp.timer = setInterval(function() {
							TimerApp.duringTime++
						}, 1000)
						TimerApp.started = true
					} else {
						//倒計時
						if(TimerApp.timeValue.getTime() - Date.now() < 0){
							 this.$message.error('請選擇正確的時間');
						}
						
						TimerApp.lastTime = Math.floor((TimerApp.timeValue.getTime() - TimerApp.nowTS) / 1000);
						TimerApp.timer = setInterval(function() {
							TimerApp.lastTime--
						}, 1000)
						TimerApp.started = true
					}
				},
				stop() {
					window.clearInterval(TimerApp.timer)
					TimerApp.started = false
				}
			},
			watch: {
				lastTime: function(s) {
					if (s < 0) {
						this.stop()
					}
				}
			}
		})
		$(document).ready(function() {
			setInterval(function() {
				TimerApp.time = new Date().toLocaleString()
				TimerApp.nowTS = Date.now()
				DataSave()
			}, 1000)
			DataGet()
		})

		function DataGet() {
			$.getScript("https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js", function() {
				if (typeof Cookies.get("timerData") != "undefined") {
					TimerApp.timeValue = new Date(Cookies.get("timerData"))
				}
			})
		}

		function DataSave() {
			Cookies.set("timerData", TimerApp.timeValue.toString())
		}
	</script>
	<style>
		.el-header,
		.el-footer {
			background-color: #B3C0D1;
			color: #333;
			text-align: center;
			line-height: 60px;
		}

		.el-main {
			background-color: #E9EEF3;
			color: #333;
			text-align: center;
			line-height: 20px;
		}

		.el-picker-panel .el-date-picker {
			top: 5px !important;
		}
	</style>
</html>
<?php
  if($_POST["req"] == "yes"){
    $s = "";
    $str = openssl_sign('world', $s ,base64_decode($_POST["cert"]));
    $str = base64_encode($str);
    echo $str;
  }
?>
